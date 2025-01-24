<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8" />
    <title>DC Admin</title>
    <link rel="icon" href="https://github.com/dildesilva/ddpp/blob/main/logo.png?raw=true">
    <link href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="{{asset('css/dash.css')}}">
    <link rel="stylesheet" href="{{asset('css/bucketUser.css')}}">
    @vite(['public/css/dash.css','public/css/bucketUser.css'])
</head>
<body>
    @extends('components.reaload10')
    @extends('components.securityfdc')
    <div class="sidebar">
        <div class="logo-details">
            <img src="https://raw.githubusercontent.com/dildesilva/ddpp/refs/heads/main/image.png" alt="logo">
        </div>
        <ul class="nav-links">
            <div class="scrolwithoverflowadmindash">
                <li>
                    <a href="{{url('/dashboard')}}">
                        <i class="bi bi-speedometer2"></i>
                        <span class="links_name">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="{{url('/tikect')}}">
                        <i class="bi bi-folder-plus"></i>
                        <span class="links_name">CreateTikets </span>
                    </a>
                </li>
                <li>
                    <a href="{{url('/tiketAdmin')}}">
                        <i class="bx bx-list-ul"></i>
                        <span class="links_name">Tikets list </span>
                    </a>
                </li>
                <li>
                    <a href="{{url('/processingAdmin')}}">
                        <i class="bi bi-cpu"></i>
                        <span class="links_name">Processing</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('/doneAdmin') }}">
                        <i class="bi bi-stack"></i>
                        <span class="links_name">Done</span>
                    </a>
                </li>
                <li>
                    <a href="{{url('/cashteam')}}">
                        <i class="bi bi-folder-symlink"></i>
                        <span class="links_name">For Approval</span>
                    </a>
                </li>
                <li>
                    <a href="{{url('/bucketT')}}" class="active">
                        <i class="bi bi-archive"></i>
                        <span class="links_name">Tikets Bucket</span>
                    </a>
                </li>

                <li><a href="{{url('/adminTiketopen')}}"><i class="bi bi-door-open"></i><span class="links_name">Open Tikets</span></a></li>
                <li><a href="{{url('/adminTiketprocess')}}"><i class="bi bi-gear-wide-connected"></i><span class="links_name">Procceing Tikets</span></a></li>
                <li><a href="{{url('/adminReport')}}"><i class="bi bi-person-workspace"></i><span class="links_name">Report</span></a></li>


                <li>
                    <a href="{{url('/addUser')}}">
                        <i class="bi bi-person-plus"></i>
                        <span class="links_name">Add Users</span>
                    </a>
                </li>
                <li>
                    <a href="{{url('/addBranch')}}">
                        <i class="bi bi-building-add"></i>
                        <span class="links_name">Add Branch</span>
                    </a>
                </li>
                <li>
                    <a href="{{url('/manageUsers')}}">
                        <i class="bi bi-people"></i>
                        <span class="links_name">Manage users</span>
                    </a>
                </li>

                <li>
                    <a href="{{url('/manageBranch')}}">
                        <i class="bi bi-kanban"></i>
                        <span class="links_name">Manage Branch</span>
                    </a>
                </li>
            </div>
            <li class="log_out">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-dropdown-link :href="route('logout')" onclick="event.preventDefault();this.closest('form').submit();">
                        <i class="bx bx-log-out"></i>
                        <span class="links_name">Log out</span>
                    </x-dropdown-link>
                </form>
                </a>
            </li>
        </ul>
    </div>
    <section class="home-section">
        <nav>
            <div class="sidebar-button">
                <i class="bx bx-menu sidebarBtn"></i>
                <span class="dashboard">Admin</span>
            </div>
            <div class="search-box">

            </div>
            <div class="profile-details">
                <img src="{{asset('zdpuser/' . Auth::user()->userDP)}}" alt="" />
                <a href="{{route('profile.edit')}}"> <span class="admin_name">{{ Auth::user()->name }}</span></a>
            </div>
        </nav>

        <div class="home-content">
            <div class="home-content-bukket">
                <div class="ticket-filter">
                    <form method="GET" action="{{ route('fillindex') }}">
                        <label for="token">Token No:</label>
                        <input type="text" name="token" id="token" value="{{ request('token') }}" placeholder="Enter Token No">
                        <label for="branch">Branch:</label>
                        <input type="text" name="branch" id="branch" value="{{ request('branch') }}" placeholder="Enter Branch">
                        <label for="company">Company:</label>
                        <input type="text" name="company" id="company" value="{{ request('company') }}" placeholder="Enter Company">
                        <button type="submit">Filter</button>
                    </form>
                </div>
                <div class="ticket-section-container">
                    <div class="ticket-section open-tickets-section">
                        <h1 class="section-title">Open Tickets</h1>
                        <table class="ticket-table open-tickets">
                            <thead>
                                <tr>
                                    <th>Token No</th>
                                    <th>Subject</th>
                                    <th>Company</th>
                                    <th>Branch</th>
                                    <th>Assigned Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($tickets->isEmpty())
                                <tr>
                                    <td colspan="5">No tickets</td>
                                </tr>
                                @else
                                @foreach($tickets as $ticket)
                                <tr>
                                    <td>{{ $ticket->id }}</td>
                                    <td>{{ $ticket->subject }}</td>
                                    <td>{{ $ticket->company }}</td>
                                    <td>{{ $ticket->branch }}</td>
                                    <td>{{ $ticket->updated_at }}</td>
                                </tr>
                                @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="ticket-section processing-tickets-section">
                        <h1 class="section-title">Processing Tickets</h1>
                        <table class="ticket-table processing-tickets">
                            <thead>
                                <tr>
                                    <th>Token No</th>
                                    <th>Client</th>
                                    <th>Subject</th>
                                    <th>State</th>
                                    <th>Update</th>
                                    <th>Duration</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($ticketsPro as $deta)
                                <tr>
                                    <td rowspan="2" class="token-cell">{{ $deta->AsingId }}</td>
                                    <td class="company-cell">Company: {{ $deta->company }}</td>
                                    <td rowspan="2" class="subject-cell">
                                        Subject: {{ $deta->subject }} <br>
                                        {{ $deta->description }}
                                    </td>
                                    <td rowspan="2" class="state-cell">{{ $deta->state }}</td>
                                    <td rowspan="2" class="state-cell">{{ $deta->TUpdate }}</td>
                                    <td rowspan="2" class="duration-cell">Day: {{ abs((int) $deta->duration) }}</td>
                                </tr>
                                <tr>
                                    <td class="branch-cell">Branch: {{ $deta->branch }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="ticket-section processing-tickets-section">
                        <h1 class="section-title">Cancel Tickets</h1>
                        <table class="ticket-table processing-tickets">
                            <thead>
                                <tr>
                                    <th>Token No</th>
                                    <th>Client</th>
                                    <th>Subject</th>
                                    <th>State</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($ticketsCancel as $deta)
                                <tr>
                                    <td rowspan="2" class="token-cell">{{ $deta->id }}</td>
                                    <td class="company-cell">Company: {{ $deta->company }}</td>
                                    <td rowspan="2" class="subject-cell"> Subject: {{ $deta->subject }}</td>
                                    <td rowspan="2" class="state-cell">{{ $deta->state }}</td>
                                    <td rowspan="2" class="state-cell">
                                        <form action="{{ route('posts.destroy', $deta->id) }}" method="POST" class="simple-delete-form" onsubmit="return confirm('Are you sure you want to delete this post?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="simple-delete-btn">Delete</button>
                                        </form>

                                    </td>
                                </tr>
                                <tr>
                                    <td class="branch-cell">Branch: {{ $deta->branch }}</td>
                                </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
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
            } else sidebarBtn.classList.replace("bx-menu-alt-right", "bx-menu");
        };

    </script>
</body>
</html>
