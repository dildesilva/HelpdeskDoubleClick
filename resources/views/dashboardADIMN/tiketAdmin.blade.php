<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8" />
    <title>DC Admin</title>
    <link rel="icon" href="https://github.com/dildesilva/ddpp/blob/main/logo.png?raw=true">
    <link href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="{{asset('css/dash.css')}}">
    <link rel="stylesheet" href="{{asset('css/dashpartsuder.css')}}">
    {{-- @vite(['public/css/dash.css','public/css/dashpartsuder.css']) --}}
</head>
<body>
    @extends('components.reaload5')
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
                    <a href="{{url('/tiketAdmin')}}" class="active">
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
        <div class="tiketAdminmain">
            <div class="tiketAdminmainBB">
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
                            <input type="email" value="{{ $ticket->sender }}" name="sender" hidden>
                            <input type="date" value="{{ $ticket->dateCreated }}" name="opendate" hidden>
                            <input type="text" value="{{ $ticket->description }}" name="description" hidden>
                            <input type="email" value="{{ Auth::user()->email }}" name="email" hidden>
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

                                    // Prevent submission if already in progress
                                    if (formElement.dataset.processing === "true") {
                                        console.log("Duplicate request prevented for Ticket ID:", ticketId);
                                        return;
                                    }

                                    // Mark the form as processing
                                    formElement.dataset.processing = "true";

                                    Swal.fire({
                                        title: 'Processing Ticket'
                                        , text: 'Marking ticket as "Get Started" and finalizing.'
                                        , icon: 'info'
                                        , allowOutsideClick: false
                                        , showConfirmButton: false
                                        , didOpen: () => {
                                            Swal.showLoading();

                                            // Submit the "Get Started" form first
                                            fetch(formElement.action, {
                                                    method: 'POST'
                                                    , body: new FormData(formElement)
                                                    , headers: {
                                                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                                                    }
                                                })
                                                .then(response => {
                                                    if (!response.ok) throw new Error('Failed to mark as "Get Started".');

                                                    // Submit the delete/update form after "Get Started"
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

                                                    // Remove the row from the table after successful processing
                                                    button.closest('tr').remove();
                                                })
                                                .catch(error => {
                                                    Swal.fire({
                                                        title: 'Error'
                                                        , text: 'The ticket has been unsuccessfully processed.'
                                                        , icon: 'error'
                                                        , confirmButtonText: 'OK'
                                                    });
                                                })
                                                .finally(() => {
                                                    // Reset the form processing flag
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

