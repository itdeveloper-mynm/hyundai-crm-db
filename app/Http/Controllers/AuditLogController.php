<?php

namespace App\Http\Controllers;

use App\Models\ApplicationAuditLog;
use App\Models\User;
use Illuminate\Http\Request;

class AuditLogController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:SuperAdmin');
    }

    public function index(Request $request)
    {
        $from = $request->input('from', today()->toDateString());
        $to   = $request->input('to', today()->toDateString());

        $query = ApplicationAuditLog::with(['application.customer', 'user'])
            ->whereBetween('application_audit_logs.created_at', [$from . ' 00:00:00', $to . ' 23:59:59'])
            ->orderByDesc('application_audit_logs.created_at');

        if ($request->filled('application_id')) {
            $query->where('application_id', $request->input('application_id'));
        }

        if ($request->filled('user_id')) {
            $query->where('user_id', $request->input('user_id'));
        }

        if ($request->filled('mobile')) {
            $query->whereHas('application.customer', function ($q) use ($request) {
                $q->where('mobile', 'like', '%' . $request->input('mobile') . '%');
            });
        }

        $logs  = $query->paginate(50)->withQueryString();
        $users = User::whereHas('roles', fn($q) => $q->where('name', '!=', 'SuperAdmin'))
            ->orderBy('name')
            ->get();

        return view('admin.audit_log.index', compact('logs', 'users', 'from', 'to'));
    }
}
