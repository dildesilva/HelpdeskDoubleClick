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
    <link rel="stylesheet" href="{{asset('css/dashpartsuder.css')}}">
    @vite(['public/css/dash.css','public/css/dashpartsuder.css'])
</head>
<body>
    @extends('components.reaload10')
    <div class="sidebar">
        <div class="logo-details">
            <img src="https://raw.githubusercontent.com/dildesilva/ddpp/refs/heads/main/image.png" alt="logo">
        </div>
        <ul class="nav-links">

            <div class="scrolwithoverflowadmindash">
                <li>
                    <a href="{{url('/dashboard')}}" class="active">
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
                        <span class="links_name">Processing  </span>
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
                    <a href="{{url('/bucketT')}}">
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
        <div class="home-contentDshabordadmin">
        <div class="home-contentDshabordadminBB">
            <div class="dashbordEngcssmain">
                <section class="dashboard">
                    <div class="row">
                        <div class="card">
                            <h3>My Ticket Processing Status</h3>
                            <div class="card greenCard">
                                <h3>Ongoing</h3>
                                <p class="metric">{{$inProgressTickets}}</p>
                            </div>
                            <div class="card  bluCard">
                                <h3>Done</h3>
                                <p class="metric">{{$closedTickets}}</p>
                            </div>
                            <div class="card redCard">
                                <h3>Hold</h3>
                                <p class="metric">{{$holdTickets}}</p>
                            </div>
                        </div>
                            <div class="card">
                                <h3>My Ticket Status Overview</h3>
                                <canvas id="ticketStatusChart"></canvas>
                            </div>
                            <div class="card">
                                <h3>Ticket Status</h3>
                                <div class="card greenCard">
                                    <h3>For Approval</h3>
                                    <p class="metric" id="ticketApproval">{{$ticketApproval}}</p>
                                </div>
                                <div class="card yellowCard">
                                    <h3>My Tickets</h3>
                                    <p class="metric">{{$myall}}</p>
                                </div>
                                <div class="card orangeCard">
                                    <h3>New Tickets</h3>
                                    <p class="metric" id="ticketCount">{{$tickets}}</p>
                                </div>
                           </div>
                    </div>
                    <div class="row">
                        <div class="card whiteCraeddark">
                            <h3>Total Tickets</h3>
                            <p class="metric">{{$dashdeta}}</p>
                        </div>
                        <div class="card  bluCard">
                            <h3>All Done Tickets</h3>
                            <p class="metric">{{$dashdetaDone}}</p>
                        </div>
                        <div class="card redCard">
                            <h3>All Hold Tickets</h3>
                            <p class="metric">{{$dashdetahold}}</p>
                        </div>
                    </div>
                    <div class="row charts">
                        <div class="card greenCard">
                            <h3>All Ongoing Tickets</h3>
                            <div class="tableCArt">
                                <table class="ticket-table">
                                    <thead>
                                        <tr>
                                            <th>Token No</th>
                                            <th>Client</th>
                                            <th>Subject</th>
                                            <th>Eng Name</th>
                                            <th>Duration</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($onginall as $deta)
                                            <tr>
                                                <td>{{ $deta->AsingId }}</td>
                                                <td>{{ $deta->company }} - {{ $deta->branch }}</td>
                                                <td>{{ Str::limit($deta->subject, 20) }}</td>
                                                <td>{{ App\Models\User::where('email', $deta->email)->first()->name }}</td>
                                                <td>{{ abs((int) $deta->duration) }} days</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card bluCard">
                            <h3>All Done Tickets</h3>
                            <div class="tableCArt">
                                <table class="ticket-table">
                                    <thead>
                                        <tr>
                                            <th>Token No</th>
                                            <th>Client</th>
                                            <th>Subject</th>
                                            <th>Eng Name</th>
                                            <th>Duration</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($alldone as $deta)
                                            <tr>
                                                <td>{{ $deta->AsingId }}</td>
                                                <td>{{ $deta->company }} - {{ $deta->branch }}</td>
                                                <td>{{ Str::limit($deta->subject, 20) }}</td>
                                                <td>{{ App\Models\User::where('email', $deta->email)->first()->name }}</td>

                                                <td>{{ abs((int) $deta->duration) }} days</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card">
                            <h3>My Tickets by Priority</h3>
                            <div class="tableCArt">
                                <table class="ticket-table">
                                    <thead>
                                        <tr>
                                            <th>Token No</th>
                                            <th>Client</th>
                                            <th>Subject</th>
                                            <th>Duration</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($ticketsPro as $deta)
                                            <tr>
                                                <td>{{ $deta->AsingId }}</td>
                                                <td>{{ $deta->company }} - {{ $deta->branch }}</td>
                                                <td>{{ Str::limit($deta->subject, 20) }}</td>
                                                <td>{{ abs((int) $deta->duration) }} days</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card full-width">
                            <h3>Recent Done</h3>
                            <ul class="activity-list">
                                @foreach ($lataest as $done)
                                    <li class="list-item">
                                        <span>{{$done->AsingId}} | {{$done->company}} | {{$done->branch }}</span>
                                        <span class="time">{{$done->time}} ago</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </section>
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
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Ensure the chart canvas element exists
        const statusCtx = document.getElementById('ticketStatusChart').getContext('2d');
        if (statusCtx) {
            new Chart(statusCtx, {
                type: 'doughnut',  // Doughnut chart type
                data: {
                    labels: ['Done', 'Ongoing', 'Hold', 'Total Tickets', 'My Tickets'],  // Categories
                    datasets: [{
                        data: [{{ $closedTickets }}, {{ $inProgressTickets }}, {{ $holdTickets }}, {{ $dashdeta }}, {{ $myall }}],  // Dynamic data from the controller
                        backgroundColor: ['#4e73df', '#1cc88a', '#e74a3b', '#36b9cc', 'rgb(255, 174, 0)'],  // Colors for each status
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            display: true,  // Show legend
                            position: 'bottom',  // Position at the bottom
                        }
                    }
                }
            });
        } else {
            console.error("Chart canvas element not found!");
        }

        // Sidebar toggle script
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
    });
</script>
<script>
    function updateTicketCount() {
        fetch('/ticket-Approval') // Replace with your route URL
            .then(response => response.json())
            .then(data => {
                // Update the ticket count element
                document.getElementById('ticketApproval').textContent = data.count;
            })
            .catch(error => console.error('Error fetching ticket count:', error));
    }

    // Update every 30 seconds (or your desired interval)
    setInterval(updateTicketCount, 5000);

    // Call the function once on page load
    updateTicketCount();
</script>
</body>
</html>

