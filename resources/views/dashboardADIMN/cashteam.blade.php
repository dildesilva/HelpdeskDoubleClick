<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8" />
    <title>DC Admin</title>
    <link rel="icon" href="https://github.com/dildesilva/ddpp/blob/main/logo.png?raw=true">
    <link href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{asset('css/dash.css')}}">
    <link rel="stylesheet" href="{{asset('css/tiketdd.css')}}">
    @vite(['public/css/dash.css', 'public/css/tiketdd.css'])
</head>
<body>
    <div class="sidebar">
        <div class="logo-details">
            <img src="https://raw.githubusercontent.com/dildesilva/ddpp/refs/heads/main/image.png" alt="logo">
        </div>
        <ul class="nav-links">
            <div class="scrolwithoverflowadmindash">
                <li><a href="{{url('/dashboard')}}"><i class="bi bi-speedometer2"></i><span class="links_name">Dashboard</span></a></li>
                <li><a href="{{url('/tikect')}}"><i class="bi bi-folder-plus"></i><span class="links_name">CreateTikets</span></a></li>
                <li><a href="{{url('/tiketAdmin')}}"><i class="bx bx-list-ul"></i><span class="links_name">Tikets list</span></a></li>
                <li><a href="{{url('/processingAdmin')}}"><i class="bi bi-cpu"></i><span class="links_name">Processing</span></a></li>
                <li><a href="{{ url('/doneAdmin') }}"><i class="bi bi-stack"></i><span class="links_name">Done</span></a></li>
                <li><a href="{{url('/cashteam')}}" class="active"><i class="bi bi-folder-symlink"></i><span class="links_name">For Approval</span></a></li>
                <li><a href="{{url('/bucketT')}}"><i class="bi bi-archive"></i><span class="links_name">Tikets Bucket</span></a></li>
                <li><a href="{{url('/adminTiketopen')}}"><i class="bi bi-door-open"></i><span class="links_name">Open Tikets</span></a></li>
                <li><a href="{{url('/adminTiketprocess')}}"><i class="bi bi-gear-wide-connected"></i><span class="links_name">Procceing Tikets</span></a></li>
                <li><a href="{{url('/adminReport')}}"><i class="bi bi-person-workspace"></i><span class="links_name">Report</span></a></li>
                <li><a href="{{url('/addUser')}}"><i class="bi bi-person-plus"></i><span class="links_name">Add Users</span></a></li>
                <li><a href="{{url('/addBranch')}}"><i class="bi bi-building-add"></i><span class="links_name">Add Branch</span></a></li>
                <li><a href="{{url('/manageUsers')}}"><i class="bi bi-people"></i><span class="links_name">Manage users</span></a></li>
                <li><a href="{{url('/manageBranch')}}"><i class="bi bi-kanban"></i><span class="links_name">Manage Branch</span></a></li>
            </div>
            <li class="log_out">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-dropdown-link :href="route('logout')" onclick="event.preventDefault();this.closest('form').submit();">
                        <i class="bx bx-log-out"></i><span class="links_name">Log out</span>
                    </x-dropdown-link>
                </form>
            </li>
        </ul>
    </div>
    @extends('components.securityfdc')
    <section class="home-section">
        <nav>
            <div class="sidebar-button">
                <i class="bx bx-menu sidebarBtn"></i>
                <span class="dashboard">Admin</span>
            </div>
            <div class="profile-details">
                <img src="{{asset('zdpuser/' . Auth::user()->userDP)}}" alt="" />
                <a href="{{route('profile.edit')}}"><span class="admin_name">{{ Auth::user()->name }}</span></a>
            </div>
        </nav>

        <div class="mytiketsasingdivNEW">
            <div class="usersentADMINTtiketReassingsection" id="contentdd">
                @if($tickets->isEmpty())
                    <p class="usersentADMINTtiketReassingsectionpp">hooore! , No tickets found. Now coffe or te?</p>
                @else
                    @foreach($tickets as $ticket)
                        <form id="engdddd{{ $ticket->id }}" action="{{url('/assignedTECH') }}" method="post" data-processing="false">
                            <div id="ticket-container"></div>
                            <div class="FROMENEWTICTEadmin">
                                @csrf
                                <table id="FROMENEWTICTEadmintabale">
                                    <h1 id="data-list">Tiket ID : {{ $ticket->id }}</h1>
                                    <tr>
                                        <td>Assigned</td>
                                        <td class="tdRigthtiket" colspan="3">
                                            <select name="assigne" id="cars" required>
                                                <option value="" disabled selected hidden>IT Engineer</option>
                                                @foreach ( $users as $engtech)
                                                    <option value="{{$engtech->email}}">{{$engtech->name}}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="tdlefttiketLINE">Subject</td>
                                        <td class="tdRigthtiketLINE">
                                            <input type="text" value={{ $ticket->subject }} name="subject" hidden>
                                            <p>{{ $ticket->subject }}</p>
                                        </td>
                                        <td class="tdlefttiketLINE">Created Date</td>
                                        <td class="tdRigthtiketLINE">
                                            <input type="date" name="dateCreated" value={{ $ticket->created_at }} hidden>
                                            <p>{{ $ticket->created_at }}</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="tdlefttiketLINE">Company</td>
                                        <td class="tdRigthtiketLINE">
                                            <input type="text" name="company" value="Ticket ID: {{ $ticket->id }}, {{ $ticket->company }}" hidden>
                                            <p>{{ $ticket->company }} (Ticket ID:{{ $ticket->id }})</p>
                                        </td>
                                        <td class="tdlefttiketLINE">Branch</td>
                                        <td class="tdRigthtiketLINE">
                                            <input type="text" name="branch" value={{ $ticket->branch }} hidden>
                                            <p>{{ $ticket->branch }}</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Description</td>
                                        <td class="tdRigthtiket" colspan="3">
                                            <textarea name="description" id="" cols="30" rows="10">{{ $ticket->description }}</textarea>
                                        </td>
                                    </tr>
                                </table>
                                <input type="text" name="state" value="Start" hidden>
                                <input type="email" value="{{ $ticket->sender }}" name="sender" hidden>
                                <div class="buttonsCLEARANDENNTERtikects">
                                    <button class="redbutton submit-button" data-ticket-id={{ $ticket->id }}>Assigned</button>
                                </div>
                            </div>
                        </form>
                        <form id="engoooo{{ $ticket->id }}" action="{{ route('usertickets.updateState',  $ticket->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <input type="text" name="Assigned" value="Assigned" hidden>
                        </form>
                    @endforeach
                @endif
            </div>
        </div>
    </section>

    <script>
        let sidebar = document.querySelector(".sidebar");
        let sidebarBtn = document.querySelector(".sidebarBtn");
        sidebarBtn.onclick = function() {
            sidebar.classList.toggle("active");
            sidebarBtn.classList.toggle("bx-menu-alt-right");
        };
    </script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function () {
            function loadLatestData() {
                $.ajax({
                    url: '/fetchAssined-updates',
                    type: 'GET',
                    success: function (data) {
                        console.log('Fetched data:', data);
                        data.forEach(function (ticket) {
                            if (!$(`#engdddd${ticket.id}`).length) {
                                const createdDate = new Date(ticket.created_at).toISOString().split('T')[0];
                                const newTicket = `
                                    <form id="engdddd${ticket.id}" action="{{ url('/assignedTECH') }}" method="post" data-processing="false">
                                        <div class="FROMENEWTICTEadmin">
                                            @csrf
                                            <table id="FROMENEWTICTEadmintabale">
                                                <h1 id="data-list">Ticket ID: ${ticket.id}</h1>
                                                <tr>
                                                    <td>Assigned</td>
                                                    <td class="tdRigthtiket" colspan="3">
                                                        <select name="assigne" id="cars" required>
                                                            <option value="" disabled selected hidden>IT Engineer</option>
                                                            @foreach ($users as $engtech)
                                                                <option value="{{ $engtech->email }}">{{ $engtech->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="tdlefttiketLINE">Subject</td>
                                                    <td class="tdRigthtiketLINE">
                                                        <input type="text" value="${ticket.subject}" name="subject" hidden>
                                                        <p>${ticket.subject}</p>
                                                    </td>
                                                    <td class="tdlefttiketLINE">Created Date</td>
                                                    <td class="tdRigthtiketLINE">
                                                        <input type="date" name="dateCreated" value="${createdDate}" hidden>
                                                        <p>${createdDate}</p>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="tdlefttiketLINE">Company</td>
                                                    <td class="tdRigthtiketLINE">
                                                        <input type="text" name="company" value="Ticket ID: ${ticket.id}, ${ticket.company}" hidden>
                                                        <p>${ticket.company} (Ticket ID: ${ticket.id})</p>
                                                    </td>
                                                    <td class="tdlefttiketLINE">Branch</td>
                                                    <td class="tdRigthtiketLINE">
                                                        <input type="text" name="branch" value="${ticket.branch}" hidden>
                                                        <p>${ticket.branch}</p>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Description</td>
                                                    <td class="tdRigthtiket" colspan="3">
                                                        <textarea name="description" cols="30" rows="10">${ticket.description}</textarea>
                                                    </td>
                                                </tr>
                                            </table>
                                            <input type="text" name="state" value="Start" hidden>
                                            <div class="buttonsCLEARANDENNTERtikects">
                                                <button class="redbutton submit-button" data-ticket-id="${ticket.id}">Assigned</button>
                                            </div>
                                        </div>
                                    </form>
                                    <form id="engoooo${ticket.id}" action="/usertickets/${ticket.id}/update-state" method="POST" style="display:none;">
                                        @csrf
                                        @method('PUT')
                                        <input type="text" name="Assigned" value="Assigned" hidden>
                                    </form>
                                `;
                                $('#ticket-container').append(newTicket);
                                bindSubmitButton();
                            }
                        });
                    },
                    error: function (xhr, status, error) {
                        console.error('Error fetching new tickets:', status, error);
                        console.log(xhr.responseText);
                    }
                });
            }

            function bindSubmitButton() {
                document.querySelectorAll('.submit-button').forEach(button => {
                    button.addEventListener('click', function (event) {
                        event.preventDefault();
                        const ticketId = this.getAttribute('data-ticket-id');
                        const formId = 'engdddd' + ticketId;
                        const deleteFormId = 'engoooo' + ticketId;
                        const formElement = document.getElementById(formId);


                        const assigneField = formElement.querySelector('select[name="assigne"]');
                if (!assigneField.value) {
                    Swal.fire({
                        title: 'Validation Error',
                        text: 'Please select an IT Engineer before submitting.',
                        icon: 'warning',
                        confirmButtonText: 'OK'
                    });
                    return;
                } 
                        if (formElement.dataset.processing === "true") return;
                        formElement.dataset.processing = "true";

                        Swal.fire({
                            title: 'Processing Ticket',
                            text: 'Marking ticket as "Assigned" and finalizing.',
                            icon: 'info',
                            allowOutsideClick: false,
                            showConfirmButton: false,
                            didOpen: () => {
                                Swal.showLoading();
                                fetch(formElement.action, {
                                    method: 'POST',
                                    body: new FormData(formElement),
                                    headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content }
                                })
                                .then(response => {
                                    if (!response.ok) throw new Error('Failed to mark as "Get Started".');
                                    return fetch(document.getElementById(deleteFormId).action, {
                                        method: 'POST',
                                        body: new FormData(document.getElementById(deleteFormId)),
                                        headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content }
                                    });
                                })
                                .then(response => {
                                    if (!response.ok) throw new Error('Failed to update ticket state.');
                                    Swal.fire({
                                        title: 'Ticket Processed',
                                        text: 'The ticket has been successfully Assigned.',
                                        icon: 'success',
                                        confirmButtonText: 'OK'
                                    });
                                    button.closest('.FROMENEWTICTEadmin').remove();
                                })
                                .catch(error => {
                                    Swal.fire({
                                        title: 'Error',
                                        text: error.message,
                                        icon: 'error',
                                        confirmButtonText: 'OK'
                                    });
                                })
                                .finally(() => {
                                    formElement.dataset.processing = "false";
                                });
                            }
                        });
                    });
                });
            }

            setInterval(loadLatestData, 5000);
            bindSubmitButton();
        });
    </script>
</body>
</html>
