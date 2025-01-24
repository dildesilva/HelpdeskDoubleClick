<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8" />
    <title>DC Engineer</title>
    <link rel="icon" href="https://github.com/dildesilva/ddpp/blob/main/logo.png?raw=true">
    <link href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="{{asset('css/eng.css')}}">
    <link rel="stylesheet" href="{{asset('css/procEng.css')}}">
    @vite(['public/css/eng.css', 'public/css/procEng.css'])
</head>
<body>
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
                <a href="{{url('/addengtikect')}}">
                    <i class="bi bi-folder-plus"></i>
                    <span class="links_name">Create Tickets</span>
                </a>
            </li>
            <li>
                <a href="{{url('/engTiket')}}">
                    <i class="bx bx-list-ul"></i>
                    <span class="links_name">Tickets List</span>
                </a>
            </li>
            <li>
                <a href="{{url('/engProcessing')}}" class="active">
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
            <div class="search-box">
                powered by Doubleclick IT
            </div>
            <div class="profile-details">
                <img src="{{asset('zdpuser/' . Auth::user()->userDP)}}" alt="" />
                <span class="admin_name">{{ Auth::user()->name }}</span>
                <a href="{{route('profile.edit')}}"> <i class="bx bx-chevron-down"></i> </a>
            </div>
        </nav>
        <div class="engProMindev">
            <div class="proceestikettabell">
                <h4>Ongoing Task</h4>
                <table class="ticket-table">
                    <tr>
                        <th class="ticket-tablebnum">Token No</th>
                        <th>Client</th>
                        <th class="ticket-tablebigtaxt">Subject</th>
                        <th>State</th>
                        <th class="ticket-tablebnum">Duration</th>
                        <th class="ticket-tablebigtaxt">Technical Update</th>
                        <th colspan="2">JOB DONE</th>
                    </tr>
                    @foreach($ticketsPro as $deta)
                    <tr>
                        <td rowspan="2">{{ $deta->AsingId }}</td>
                        <td>{{ $deta->company }}|{{ $deta->branch }}</td>
                        <td rowspan="2" class="subjectdescol">
                            {{ $deta->subject }} <br>
                            {{ $deta->description }}
                        </td>
                        <td rowspan="2" id="ticket-{{ $deta->id }}" class="ticket-details">
                            <form id="state-form-{{$deta->id}}" action="{{ route('tickets.updateState', $deta->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <select name="state" onchange="updateState({{$deta->id}})">
                                    <option hidden disabled selected>Select state</option>
                                    <option value="ongoing" {{ $deta->state == 'ongoing' ? 'selected' : '' }}>Ongoing</option>
                                    <option value="hold" {{ $deta->state == 'hold' ? 'selected' : '' }}>Hold</option>
                                    <option value="reassigned" {{ $deta->state == 'reassigned' ? 'selected' : '' }}>Reassigned</option>
                                    <option value="busy" {{ $deta->state == 'busy' ? 'selected' : '' }}>Busy</option>
                                </select>
                            </form>
                        </td>
                        <td rowspan="2">Day : {{ abs((int) $deta->duration) }}</td>
                        <td rowspan="2">
                            <div id="ticket-{{ $deta->id }}">
                                <div class="nameTupadetengpage1">
                                    {{ $deta->TUpdate }}
                                </div>
                            </div>
                            <div class="nameTupadetengpage2">
                                <form id="TUpdate-form-{{$deta->id}}" class="tdinputfromupdate" action="{{ route('tickets.updateTUpdate', $deta->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <input name="TUpdate" type="text">
                                    <input type="hidden" name="OldTUpdate" value="{{ $deta->TUpdate }}">
                                    <button class="update-button grebutton" type="button" onclick="updateTUpdate({{$deta->id}})" data-ticket-id="{{ $deta->id }}">Update</button>
                                    <button class="clrbutton" type="reset">Reset</button>
                                </form>
                            </div>
                        </td>
                        <td rowspan="2">
                            <button class="redbutton submit-button" id="submitButton" data-ticket-id="{{ $deta->id }}">DONE</button>
                        </td>
                    </tr>
                    <tr></tr>
                    <form id="engoooo{{ $deta->id }}" action="{{ route('engtickets.updateState',  $deta->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="text" name="state" value="Done" hidden>
                    </form>
                    @endforeach
                </table>
            </div>
        </div>
    </section>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function updateTUpdate(ticketId) {
            var form = $('#TUpdate-form-' + ticketId);
            $.ajax({
                url: form.attr('action')
                , type: 'PUT'
                , data: form.serialize()
                , headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
                , success: function(response) {
                    Swal.fire({
                        title: 'Success'
                        , text: 'Ticket update has been successfully modified!'
                        , icon: 'success'
                        , confirmButtonText: 'OK'
                    });
                }
                , error: function(xhr, status, error) {
                    Swal.fire({
                        title: 'Error'
                        , text: 'Failed to update ticket.'
                        , icon: 'error'
                        , confirmButtonText: 'OK'
                    });
                }
            });
        }

    </script>
    <script>
        document.querySelectorAll('.submit-button').forEach(button => {
            button.addEventListener('click', function(event) {
                event.preventDefault();
                const ticketId = this.getAttribute('data-ticket-id');
                const formElement = document.getElementById('engoooo' + ticketId);

                if (formElement.dataset.processing === "true") return;
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
                                Swal.fire({
                                    title: 'Ticket Processed'
                                    , text: 'The ticket has been successfully processed.'
                                    , icon: 'success'
                                    , confirmButtonText: 'OK'
                                });
                                button.closest('tr').remove();
                            })
                            .catch(error => Swal.fire({
                                title: 'Error'
                                , text: error.message
                                , icon: 'error'
                                , confirmButtonText: 'OK'
                            }))
                            .finally(() => formElement.dataset.processing = "false");
                    }
                });
            });
        });

    </script>
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
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.update-button').forEach(button => {
                button.addEventListener('click', function() {
                    const ticketId = this.getAttribute('data-ticket-id'); // Get the ticket ID
                    fetch(`/tickets/${ticketId}/fetch-updates`)
                        .then(response => response.json())
                        .then(data => {
                            if (data.error) {
                                alert(data.error);
                            } else {
                                const updateSection = document.querySelector(`#ticket-${ticketId} .nameTupadetengpage1`);
                                const durationSection = document.querySelector(`#ticket-${ticketId} .duration-section`);
                                updateSection.innerText = data.TUpdate;
                                durationSection.innerText = `Duration: ${data.duration} days`;
                            }
                        })
                        .catch(error => {
                            console.error('Error fetching updates:', error);
                        });
                });
            });
        });

    </script>
    <script>
        function updateState(ticketId) {
            var form = $('#state-form-' + ticketId);
            $.ajax({
                url: form.attr('action')
                , type: 'PUT'
                , data: form.serialize()
                , headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
                , success: function(response) {
                    Swal.fire({
                        title: 'Success'
                        , text: 'Ticket state updated successfully!'
                        , icon: 'success'
                        , confirmButtonText: 'OK'
                    });
                }
                , error: function(xhr, status, error) {
                    Swal.fire({
                        title: 'Error'
                        , text: 'Failed to update ticket state.'
                        , icon: 'error'
                        , confirmButtonText: 'OK'
                    });
                }
            });
        }

    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.addEventListener('keydown', function(event) {
                if (event.key === 'Enter') {
                    event.preventDefault();
                    return false;
                }
            });
        });

    </script>
</body>
</html>

