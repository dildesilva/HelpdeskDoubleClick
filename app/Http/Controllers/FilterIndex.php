<?php

namespace App\Http\Controllers;

use App\Models\TiketAdminMOD;
use App\Models\TiketEngMOD;
use Illuminate\Http\Request;

class FilterIndex extends Controller
{
    public function findex(Request $request)
    {
        $queryPro = TiketEngMOD::query();
        if ($request->filled('token')) {
            $queryPro->where('AsingId', $request->token);
        }
        if ($request->filled('branch')) {
            $queryPro->where('branch', 'like', '%' . $request->branch . '%');
        }
        if ($request->filled('company')) {
            $queryPro->where('company', 'like', '%' . $request->company . '%');
        }
        $ticketsPro = $queryPro->where('state', '!=', 'done')->get();
        $ticketsPro->each(function ($ticket) {
            $a = $ticket->Assinreddate;
            $ticket->duration = today()->diffInDays($a);
        });
        $query = TiketAdminMOD::query();
        if ($request->filled('token')) {
            $query->where('id', $request->token);
        }
        if ($request->filled('branch')) {
            $query->where('branch', 'like', '%' . $request->branch . '%');
        }
        if ($request->filled('company')) {
            $query->where('company', 'like', '%' . $request->company . '%');
        }
        $tickets = $query->where('state', 'start')->get();
        $queryC = TiketAdminMOD::query();
        if ($request->filled('token')) {
            $queryC->where('id', $request->token);
        }
        if ($request->filled('branch')) {
            $queryC->where('branch', 'like', '%' . $request->branch . '%');
        }
        if ($request->filled('company')) {
            $queryC->where('company', 'like', '%' . $request->company . '%');
        }
        $ticketsCancel = $queryC->where('state', 'Cancel')->get();
        return view('dashboardADIMN.bucket', compact('tickets', 'ticketsPro', 'ticketsCancel'));
    }
}
