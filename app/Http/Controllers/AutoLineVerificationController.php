<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Services\AutoLineService;
use Illuminate\Http\Request;

class AutoLineVerificationController extends Controller
{
    const SYNC_START_DATE = '2026-03-29';

    protected $autoline;

    public function __construct(AutoLineService $autoline)
    {
        $this->middleware('auth');
        $this->middleware('permission:autoline-verification-list');
        $this->autoline = $autoline;
    }

    public function index(Request $request)
    {
        $from      = $request->input('from', self::SYNC_START_DATE);
        $to        = $request->input('to', now()->toDateString());
        $sortCol   = in_array($request->input('sort'), ['created_at', 'updated_at']) ? $request->input('sort') : 'created_at';
        $sortDir   = $request->input('direction', 'desc') === 'asc' ? 'asc' : 'desc';

        $syncedLeads = Application::where('category', 'Qualified')
            ->whereNotNull('lead_id')
            ->whereDate('updated_at', '>=', $from)
            ->whereDate('updated_at', '<=', $to)
            ->with(['customer', 'branch', 'vehicle', 'campaign'])
            ->orderBy($sortCol, $sortDir)
            ->paginate(50)
            ->withQueryString();

        return view('admin.autoline_verification.index', compact('syncedLeads', 'from', 'to', 'sortCol', 'sortDir'));
    }

    public function verify(Application $application)
    {
        if (empty($application->lead_id)) {
            return response()->json(['status' => 'error', 'message' => 'No lead ID on this record.'], 422);
        }

        $found = $this->autoline->verifyLead($application->lead_id);

        if (!$found) {
            return response()->json([
                'status'  => 'not_found',
                'message' => 'Lead not found in AutoLine.',
            ]);
        }

        return response()->json([
            'status'  => 'found',
            'message' => 'Lead confirmed in AutoLine.',
        ]);
    }

    public function clearLeadId(Application $application)
    {
        if (empty($application->lead_id)) {
            return response()->json(['status' => 'error', 'message' => 'No lead ID on this record.'], 422);
        }

        $application->update(['lead_id' => null]);

        return response()->json([
            'status'  => 'cleared',
            'message' => 'Lead ID cleared. The lead will be re-synced on the next run.',
        ]);
    }
}
