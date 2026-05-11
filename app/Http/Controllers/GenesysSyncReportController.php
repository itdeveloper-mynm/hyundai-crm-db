<?php

namespace App\Http\Controllers;

use App\Models\Application;
use Illuminate\Http\Request;

class GenesysSyncReportController extends Controller
{
    const SYNC_START_DATE = '2026-03-30';
    const ERROR_RATE_THRESHOLD = 3.0;

    const SYNCED_TYPES = [
        'request_a_test_quote', 'request_a_test_drive', 'career', 'used_cars',
        'request_a_brochure', 'request_a_quote', 'special_offers', 'leads',
        'events', 'employees_program', 'online_service_booking', 'service_offers',
        'contact_us',
    ];

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:genesys-report-list');
    }

    public function index(Request $request)
    {
        $from = $request->input('from', self::SYNC_START_DATE);
        $to   = $request->input('to', now()->toDateString());

        $base = Application::whereIn('type', self::SYNCED_TYPES)
            ->whereDate('created_at', '>=', $from)
            ->whereDate('created_at', '<=', $to);

        $total    = (clone $base)->count();
        $synced   = (clone $base)->where('sync_genesys', 1)->count();
        $unsynced = (clone $base)->where('sync_genesys', 0)->count();

        $errorRate = $total > 0 ? round(($unsynced / $total) * 100, 2) : 0;

        $unsyncedLeads = (clone $base)->where('sync_genesys', 0)
            ->with(['customer', 'branch', 'vehicle', 'campaign'])
            ->orderBy('created_at', 'desc')
            ->paginate(50)
            ->withQueryString();

        return view('admin.genesys_report.index', compact(
            'total', 'synced', 'unsynced', 'errorRate',
            'unsyncedLeads', 'from', 'to'
        ));
    }
}
