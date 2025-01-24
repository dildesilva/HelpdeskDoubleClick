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
    <link rel="stylesheet" href="{{asset('css/engDash.css')}}">
    @vite(['public/css/eng.css','public/css/engDash.css'])
</head>
<body>
    @extends('components.reaload10')
    @extends('components.securityfdc')
    <div class="sidebar">
        <div class="logo-details">
            <img src="https://raw.githubusercontent.com/dildesilva/ddpp/refs/heads/main/image.png" alt="logo">
        </div>
        <ul class="nav-links">
            <li>
                <a href="{{url('/engDash')}}" class="active">
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
                <a href="{{url('/engTiket')}}">
                    <i class="bx bx-list-ul"></i>
                    <span class="links_name" >Tikets list  </span> <i id="ticketCountside">{{$tickets}}</i>
                </a>
            </li>
            <li>
                <a href="{{url('/engProcessing')}}">
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
                <a href="{{url('/engTeam')}}">
                    <i class="bi bi-balloon-heart"></i>
                    <span class="links_name">Team</span>
                </a>
            </li>

            <li><a href="{{url('/engTiketopen')}}"><i class="bi bi-door-open"></i><span class="links_name">Open Tikets</span></a></li>
            <li><a href="{{url('/engTiketprocess')}}"><i class="bi bi-gear-wide-connected"></i><span class="links_name">Procceing Tikets</span></a></li>
            <li><a href="{{url('/engReport')}}"><i class="bi bi-person-workspace"></i><span class="links_name">Report</span></a></li>


            <li class="log_out">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-dropdown-link :href="route('logout')" onclick="event.preventDefault();this.closest('form').submit();">
                        <i class="bx bx-log-out"></i>
                        <span class="links_name">Log out</span>
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
            <div class="profile-details">
                <img src="{{asset('zdpuser/' . Auth::user()->userDP)}}" alt="" />
                <span class="admin_name">{{ Auth::user()->name }}</span>
                <a href="{{route('profile.edit')}}"> <i class="bx bx-chevron-down"></i> </a>

            </div>
        </nav>

        <div class="dashbordEngcssmain">
            <section class="dashboard">
                <div class="row">
                    <div class="card whiteCraeddark">
                        <h3>Total Tickets</h3>
                        <p class="metric">{{$dashdeta}}</p>
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
                <div class="row">
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


                <div class="row charts">
                    <!-- Charts -->
                    <div class="card">
                        <h3>Ticket Status Overview</h3>
                        <canvas id="ticketStatusChart"></canvas>
                    </div>

                    <div class="card">
                        <h3>Tickets by Priority</h3>
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
    </section>

    <!-- JavaScript at the end of the body to improve page load -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Ticket Status Chart
        const statusCtx = document.getElementById('ticketStatusChart').getContext('2d');
        new Chart(statusCtx, {
            type: 'doughnut',  // Doughnut chart type
            data: {
                labels: ['Done', 'ongoing', 'Hold','Total tickets','My Tickets'],  // Categories
                datasets: [{
                    data: [{{ $closedTickets }}, {{ $inProgressTickets }},{{$holdTickets }},  {{$dashdeta}},{{$myall}}],  // Dynamic data from the controller
                    backgroundColor: ['#4e73df', '#1cc88a','#e74a3b ','#36b9cc', 'rgb(255, 174, 0)'],  // Colors for each status
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

        let sidebar = document.querySelector(".sidebar");
        let sidebarBtn = document.querySelector(".sidebarBtn");
        sidebarBtn.onclick = function() {
            sidebar.classList.toggle("active");
            if (sidebar.classList.contains("active")) {
                sidebarBtn.classList.replace("bx-menu", "bx-menu-alt-right");
            } else sidebarBtn.classList.replace("bx-menu-alt-right", "bx-menu");
        };
    </script>
    <script>
        function updateTicketCount() {
            fetch('/ticket-count') // Replace with your route URL
                .then(response => response.json())
                .then(data => {
                    // Update the ticket count element
                    document.getElementById('ticketCount','ticketCountside').textContent = data.count;
                })
                .catch(error => console.error('Error fetching ticket count:', error));
        }

        // Update every 30 seconds (or your desired interval)
        setInterval(updateTicketCount, 5000);

        // Call the function once on page load
        updateTicketCount();
    </script>
    <script>
        function updateTicketCount() {
            fetch('/ticket-count') // Replace with your route URL
                .then(response => response.json())
                .then(data => {
                    // Update the ticket count element
                    document.getElementById('ticketCountside').textContent = data.count;
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
