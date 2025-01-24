<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8" />
    <title>DC Engineer</title>
    <link rel="icon" href="https://github.com/dildesilva/ddpp/blob/main/logo.png?raw=true">
    <link href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{asset('css/eng.css')}}">
    <link rel="stylesheet" href="{{asset('css/engTiket.css')}}">
    @vite(['public/css/eng.css','public/css/engTiket.css'])
</head>
<body>
    @extends('components.reaload5')
    <div class="sidebar">
        <div class="logo-details">
            <img src="https://raw.githubusercontent.com/dildesilva/ddpp/refs/heads/main/image.png" alt="logo">
        </div>
        <ul class="nav-links">
            <li><a href="{{url('/engDash')}}"><i class="bx bx-grid-alt"></i><span class="links_name">Dashboard</span></a></li>
            <li><a href="{{url('/addengtikect')}}"><i class="bi bi-folder-plus"></i><span class="links_name">CreateTikets </span></a></li>
            <li><a href="{{url('/engTiket')}}" class="active"><i class="bx bx-list-ul"></i><span class="links_name">Tikets list</span></a></li>
            <li><a href="{{url('/engProcessing')}}"><i class="bx bx-user"></i><span class="links_name">Processing</span></a></li>
            <li><a href="{{ url('/engdone') }}"><i class="bi bi-check-circle"></i><span class="links_name">Done</span></a></li>
            <li><a href="{{url('/engTeam')}}"><i class="bi bi-balloon-heart"></i><span class="links_name">Team</span></a></li>
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
            <div class="search-box">
                powered by Doubleclick IT
            </div>
            <div class="profile-details">
                <img src="{{asset('zdpuser/' . Auth::user()->userDP)}}" alt="" />
                <span class="admin_name">{{ Auth::user()->name }}</span>
                <a href="{{route('profile.edit')}}"> <i class="bx bx-chevron-down"></i> </a>
            </div>
        </nav>
        <div class="engDshTiketHome">
            <div class="engDshTiketHomeTable">
                <h1>Your Tikets</h1>
                <table>
                    <tr>
                        <th>Token No</th>
                        <th>Subject</th>
                        <th>Company</th>
                        <th>Branch</th>
                        <th>State</th>
                        <th>Assigned Date</th>
                        <th>Action</th>
                    </tr>
                    @if($tickets->isEmpty())
                    <tr>
                        <th colspan="7">Hooore! Drink Water: Stay hydrated by drinking plenty of water daily.</th>
                    </tr>
                    @else
                    @foreach($tickets as $ticket)
                    <form id="engdddd{{ $ticket->id }}" action="{{url('/proEng')}}" method="post" data-processing="false">
                        @csrf
                        <input type="date" value="{{ $ticket->dateCreated }}" name="opendate" hidden>
                        <input type="text" value="{{ $ticket->description }}" name="description" hidden>
                        <input type="email" value="{{ Auth::user()->email }}" name="email" hidden>
                        <input type="email" value="{{ $ticket->sender }}" name="sender" hidden>
                        <tr>
                            <td><input type="number" value={{ $ticket->id }} name="AsingId" hidden> {{ $ticket->id }}</td>
                            <td><input type="text" value={{ $ticket->subject }} name="subject" hidden>{{ $ticket->subject }}</td>
                            <td><input type="text" value={{ $ticket->company }} name="company" hidden> {{ $ticket->company }}</td>
                            <td><input type="text" value={{ $ticket->branch }} name="branch" hidden> {{ $ticket->branch }}</td>
                            <td><input type="text" value="GetStarted" name="state" hidden> {{ $ticket->state }}</td>
                            <td><input type="date" value={{ $ticket->created_at }} name="Assinreddate" hidden> {{ $ticket->created_at }}</td>
                            <td>
                                <button class="redbutton submit-button" data-ticket-id={{ $ticket->id }}>Get Started</button>
                            </td>
                        </tr>
                    </form>
                    <form id="engoooo{{ $ticket->id }}" action="{{ route('admintickets.updateState',  $ticket->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="text" name="state" value="GetStarted" hidden>
                    </form>
                    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                    <script>
                        document.querySelectorAll('.submit-button').forEach(button => {
                            button.addEventListener('click', function(event) {
                                event.preventDefault();
                                const ticketId = this.getAttribute('data-ticket-id');
                                const formId = 'engdddd' + ticketId;
                                const deleteFormId = 'engoooo' + ticketId;
                                const formElement = document.getElementById(formId);
                                if (formElement.dataset.processing === "true") {
                                    console.log("Duplicate request prevented for Ticket ID:", ticketId);
                                    return;
                                }
                                formElement.dataset.processing = "true";
                                Swal.fire({
                                    title: 'Processing Ticket'
                                    , text: 'Marking ticket as "Get Started" and finalizing.'
                                    , icon: 'info'
                                    , allowOutsideClick: false
                                    , showConfirmButton: false
                                    , didOpen: () => {
                                        Swal.showLoading();
                                        fetch(formElement.action, {
                                                method: 'POST'
                                                , body: new FormData(formElement)
                                                , headers: {
                                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                                                }
                                            })
                                            .then(response => {
                                                if (!response.ok) throw new Error('Failed to mark as "Get Started".');
                                                return fetch(document.getElementById(deleteFormId).action, {
                                                    method: 'POST'
                                                    , body: new FormData(document.getElementById(deleteFormId))
                                                    , headers: {
                                                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                                                    }
                                                });
                                            })
                                            .then(response => {
                                                if (!response.ok) throw new Error('Failed to update ticket state.');

                                                Swal.fire({
                                                    title: 'Ticket Processed'
                                                    , text: 'The ticket has been successfully processed.'
                                                    , icon: 'success'
                                                    , confirmButtonText: 'OK'
                                                });
                                                button.closest('tr').remove();
                                            })
                                            .catch(error => {
                                                Swal.fire({
                                                    title: 'Error'
                                                    , text: error.message
                                                    , icon: 'error'
                                                    , confirmButtonText: 'OK'
                                                });
                                            })
                                            .finally(() => {
                                                formElement.dataset.processing = "false";
                                            });
                                    }
                                });
                            });
                        });

                    </script>
                    @endforeach
                    @endif
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
            } else sidebarBtn.classList.replace("bx-menu-alt-right", "bx-menu");
        };

    </script>
</body>
</html>

