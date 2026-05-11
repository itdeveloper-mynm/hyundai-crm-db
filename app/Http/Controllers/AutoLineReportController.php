<?php

namespace App\Http\Controllers;

use App\Models\Application;
use Illuminate\Http\Request;

class AutoLineReportController extends Controller
{
    const SYNC_START_DATE = '2026-03-29';
    const ERROR_RATE_THRESHOLD = 3.0;

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:autoline-report-list');
    }

    public function index(Request $request)
    {
        $from = $request->input('from', self::SYNC_START_DATE);
        $to   = $request->input('to', now()->toDateString());

        $base = Application::where('category', 'Qualified')
            ->whereDate('updated_at', '>=', $from)
            ->whereDate('updated_at', '<=', $to);

        $total    = (clone $base)->count();
        $synced   = (clone $base)->whereNotNull('lead_id')->count();
        $unsynced = (clone $base)->whereNull('lead_id')->count();

        $errorRate = $total > 0 ? round(($unsynced / $total) * 100, 2) : 0;

        $unsyncedLeads = (clone $base)->whereNull('lead_id')
            ->with(['customer', 'branch', 'vehicle', 'campaign'])
            ->orderBy('updated_at', 'desc')
            ->paginate(50)
            ->withQueryString();

        return view('admin.autoline_report.index', compact(
            'total', 'synced', 'unsynced', 'errorRate',
            'unsyncedLeads', 'from', 'to'
        ));
    }
}
