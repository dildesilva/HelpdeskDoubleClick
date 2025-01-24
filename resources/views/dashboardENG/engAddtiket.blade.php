<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8" />
    <title>DC Engineer</title>
    <link rel="icon" href="https://github.com/dildesilva/ddpp/blob/main/logo.png?raw=true">
    <link href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="{{asset('css/eng.css')}}">
    <link rel="stylesheet" href="{{asset('css/engaddtiket.css')}}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    @vite(['public/css/eng.css','public/css/engaddtiket.css'])
</head>
<body>
    @extends('components.reaload10')
    <div class="sidebar">
        <div class="logo-details">
            <img src="https://raw.githubusercontent.com/dildesilva/ddpp/refs/heads/main/image.png" alt="logo">
        </div>
        <ul class="nav-links">
            <li>
                <a href="{{url('/engDash')}}">
                    <i class="bx bx-grid-alt"></i>
                    <span class="links_name">Dashboard</span>
                </a>
            </li>
            <li>
                <a href="{{url('/addengtikect')}}" class="active">
                    <i class="bi bi-folder-plus"></i>
                    <span class="links_name">CreateTikets </span>
                </a>
            </li>
            <li>
                <a href="{{url('/engTiket')}}">
                    <i class="bx bx-list-ul"></i>
                    <span class="links_name">Tikets list</span>
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

                </a>
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
        <div class="engTicketAddWrapper-main">
            <div class="engTicketAddWrapper-mainTW">
                <div class="engTicketAddWrapper">
                    <form id="ticketForm" action="{{url('/tikcetSend')}}" method="POST">
                        @csrf
                        <div class="engTicketAddHeader">
                            <h1>Add Ticket</h1>
                        </div>
                        <table class="engTicketAddForm">
                            <tr>
                                <td class="engTicketAddLabel">Subject</td>
                                <td class="engTicketAddInput" colspan="3">
                                    <select name="subject" id="engSubject">
                                        <option value="" disabled selected hidden>The Issue</option>
                                        <option value="Payment Verification">Payment Verification</option>
                                        <option value="TV Advert">TV Advert</option>
                                        <option value="Newspaper Advert">Newspaper Advert</option>
                                        <option value="Social Media Advert">Social Media Advert</option>
                                        <option value="Printer issues">Printer Issues</option>
                                        <option value="PC Hardware issues">PC Hardware issues</option>
                                        <option value="PC Software issues">PC Software issues</option>
                                        <option value="System issues">System issues</option>
                                        <option value="Design Advertisement">Advertisement (Design)</option>
                                        <option value="Social Media video Advert">Social Media (video) Advert</option>
                                        <option value="TV video Advert">TV (video) Advert</option>
                                        <option value="none">Other</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td class="engTicketAddLabel">Company</td>
                                <td class="engTicketAddInput" colspan="3">
                                    <select name="company" id="engCompany">
                                        <option value="" disabled selected hidden>what's Company</option>
                                        <option value="Doubleclick head office.">Doubleclick Head Office.</option>
                                        <option value="Doubleclick Exchange Pty Ltd.">Doubleclick Exchange Pty Ltd.</option>
                                        <option value="Amazonbetting Pty Ltd.">Amazonbetting Pty Ltd.</option>
                                        <option value="Amazon Slots Pty Ltd.">Amazon Slots Pty Ltd.</option>
                                        <option value="Breeze Garden.">Breeze Garden.</option>
                                        <option value="Fashion and Sports World.">Fashion and Sports World.</option>
                                        <option value="Marlu Seychelles.">Marlu Seychelles.</option>
                                        <option value="Doubleclick Café & Gifts.">Doubleclick Café & Gifts.</option>
                                        <option value="Doubleclick bakery.">Doubleclick bakery.</option>
                                        <option value="Other">Other</option>
                                    </select>
                                </td>
                                <td class="engTicketAddLabel">Branch</td>
                                <td class="engTicketAddInput">
                                    <select name="branch">
                                        <option value="" disabled selected hidden>City/Branch</option>
                                        @foreach($branches as $branch)
                                        <option value="{{ $branch->name }} | {{ Auth::user()->name }}">{{$branch->name}}</option>
                                        @endforeach
                                        <option value="Doubleclick head office.">Doubleclick Head Office.</option>
                                        <option value="Amazonbetting head office.">Amazonbetting Head Office.</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td class="engTicketAddLabel">Description</td>
                                <td class="engTicketAddTextArea" colspan="3">
                                    <textarea name="description" cols="30" rows="10"></textarea>
                                </td>
                            </tr>
                        </table>
                        <div class="engTicketAddActions">
                            <input class="engTicketAddResetBtn" type="reset" value="Clear">
                            <input class="engTicketAddSubmitBtn" type="submit" value="Enter">
                        </div>
                        <input type="text" name="email" value={{ Auth::user()->email }} hidden>
                        <input type="email" value="{{ Auth::user()->email }}" name="sender" hidden>
                    </form>
                </div>
                <div id="ticketDisplay"></div>
                @if($tickets->isEmpty())
                <p>No tickets found.</p>
                @else
                @foreach($tickets as $ticket)
                <div class="engTicketAddDisplayTicket">
                    <table>
                        <h1>Your Ticket: {{ $ticket->id }}</h1>
                        <tr>
                            <td class="engTicketAddLabel">Subject</td>
                            <td colspan="3">{{ $ticket->subject }}</td>
                        </tr>
                        <tr>
                            <td class="engTicketAddLabel">Company</td>
                            <td>{{ $ticket->company }}</td>
                            <td class="engTicketAddLabel">Branch | User</td>
                            <td>{{ $ticket->branch }} | {{ Auth::user()->name }}</td>
                        </tr>
                        <tr>
                            <td class="engTicketAddLabel">Description</td>
                            <td colspan="3">{{ $ticket->description }}</td>
                        </tr>
                    </table>
                </div>
                @endforeach
                @endif
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.getElementById('ticketForm').addEventListener('submit', function(e) {
            e.preventDefault(); // Prevent the default form submission

            const formData = new FormData(this);

            fetch(this.action, {
                    method: 'POST'
                    , headers: {
                        'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                    }
                    , body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        // Show success message using SweetAlert2
                        Swal.fire({
                            icon: 'success'
                            , title: 'Ticket Created Successfully!'
                            , text: `Your Ticket ID: ${data.ticket.id}`
                        , });

                        // Dynamically add the new ticket to the display
                        const ticketDisplay = document.getElementById('ticketDisplay');
                        const newTicketHTML = `
                        <div class="engTicketAddDisplayTicket">
                            <table>
                                <h1>Your Ticket: ${data.ticket.id}</h1>
                                <tr>
                                    <td class="engTicketAddLabel">Subject</td>
                                    <td colspan="3">${data.ticket.subject}</td>
                                </tr>
                                <tr>
                                    <td class="engTicketAddLabel">Company</td>
                                    <td>${data.ticket.company}</td>
                                    <td class="engTicketAddLabel">Branch</td>
                                    <td>${data.ticket.branch}</td>
                                </tr>
                                <tr>
                                    <td class="engTicketAddLabel">Description</td>
                                    <td colspan="3">${data.ticket.description || 'N/A'}</td>
                                </tr>
                            </table>
                        </div>
                    `;
                        ticketDisplay.insertAdjacentHTML('beforeend', newTicketHTML);

                        // Reset the form
                        document.getElementById('ticketForm').reset();
                    } else {
                        // Show error message using SweetAlert2
                        Swal.fire({
                            icon: 'error'
                            , title: 'Ticket Creation Failed'
                            , text: 'Please try again later.'
                        , });
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    // Show error message using SweetAlert2
                    Swal.fire({
                        icon: 'error'
                        , title: 'Error Occurred'
                        , text: 'Something went wrong. Please try again.'
                    , });
                });
        });

    </script>
</body>
</html>

