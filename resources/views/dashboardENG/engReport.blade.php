<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8" />
    <title>DC Engineer</title>
    <link rel="icon" href="https://github.com/dildesilva/ddpp/blob/main/logo.png?raw=true">
    <link href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="{{asset('css/eng.css')}}">
    <link rel="stylesheet" href="{{asset('css/engReport.css')}}">
    @vite(['public/css/eng.css','public/css/engReport.css'])
</head>
<body>
    @extends('components.reaload10')
    <div class="sidebar">
        <div class="logo-details">
            <img src="https://raw.githubusercontent.com/dildesilva/ddpp/refs/heads/main/image.png" alt="logo">
        </div>
        <ul class="nav-links">
            <li>
                <a href="{{ url('/engDash') }}">
                    <i class="bx bx-grid-alt"></i>
                    <span class="links_name">Dashboard</span>
                </a>
            </li>
            <li>
                <a href="{{url('/addengtikect')}}">
                    <i class="bi bi-folder-plus"></i>
                    <span class="links_name">CreateTikets </span>
                </a>
            </li>
            <li>
                <a href="{{ url('/engTiket') }}">
                    <i class="bx bx-list-ul"></i>
                    <span class="links_name">Tickets List</span>
                </a>
            </li>
            <li>
                <a href="{{ url('/engProcessing') }}">
                    <i class="bx bx-user"></i>
                    <span class="links_name">Processing</span>
                </a>
            </li>
            <li>
                <a href="{{ url('/engdone') }}">
                    <i class="bi bi-check-circle"></i>
                    <span class="links_name">Done</span>
                </a>
            </li>
            <li>
                <a href="{{ url('/engTeam') }}">
                    <i class="bi bi-balloon-heart"></i>
                    <span class="links_name">Team</span>
                </a>
            </li>
            <li><a href="{{url('/engTiketopen')}}"><i class="bi bi-door-open"></i><span class="links_name">Open Tikets</span></a></li>
            <li><a href="{{url('/engTiketprocess')}}"><i class="bi bi-gear-wide-connected"></i><span class="links_name">Procceing Tikets</span></a></li>
            <li><a href="{{url('/engReport')}}"  class="active"><i class="bi bi-person-workspace"></i><span class="links_name">Report</span></a></li>

            <li class="log_out">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-dropdown-link :href="route('logout')" onclick="event.preventDefault();this.closest('form').submit();">
                        <i class="bx bx-log-out"></i>
                        <span class="links_name">Log Out</span>
                    </x-dropdown-link>
                </form>
            </li>
        </ul>
    </div>
    <section class="home-section">
        <nav>
            <div class="sidebar-button">
                <i class="bx bx-menu sidebarBtn"></i>
                <span class="dashboard">IT HelpDesk Engineer</span>
            </div>
            <div class="search-box">
                powered by Doubleclick IT
            </div>
            <div class="profile-details">
                <img src="{{asset('zdpuser/' . Auth::user()->userDP)}}" alt="" />
                <span class="admin_name">{{ Auth::user()->name }}</span>
                <a href="{{route('profile.edit')}}"> <i class="bx bx-chevron-down"></i> </a>
            </div>
        </nav>
        <div class="doneTiketmaindev">
            <div class="doneTiketmaindev-2">
                <div class="containerReport">
                    <h1>My HelpDesk Week Report</h1>
                  <h2>  Week Duration: {{$lastMonday->format('Y-m-d')}} to {{$lastSunday->format('Y-m-d')}}</h2>
                        @if($isDownloadButtonVisible)
                        <form method="POST" action="{{ route('report') }}">
                            @csrf
                            <input type="hidden" name="start_date" value="{{ $lastMonday->format('Y-m-d') }}">
                            <input type="hidden" name="end_date" value="{{ $lastSunday->format('Y-m-d') }}">
                            <button type="submit" class="download-report-btn"> Download Weekly Report </button>
                        </form>
                    @endif

                    <table>
                        <thead>
                            <tr>
                                <th>Subject</th>
                                <th>Sender</th>
                                <th>Company</th>
                                <th>Branch</th>
                                <th>Updated At</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($completedTickets as $ticket)
                            <tr>
                                <td>{{ $ticket->subject }}</td>
                                <td>{{ $ticket->sender }}</td>
                                <td>{{ $ticket->company }}</td>
                                <td>{{ $ticket->branch }}</td>
                                <td>{{ $ticket->updated_at->format('Y-m-d') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
            </div>
        </div>
    </section>
    <script>
        let sidebar = document.querySelector(".sidebar");
        let sidebarBtn = document.querySelector(".sidebarBtn");

        sidebarBtn.onclick = function() {
            sidebar.classList.toggle("active");
            if (sidebar.classList.contains("active")) {
                sidebarBtn.classList.replace("bx-menu", "bx-menu-alt-right");
            } else {
                sidebarBtn.classList.replace("bx-menu-alt-right", "bx-menu");
            }
        };

    </script>
</body>
</html>
