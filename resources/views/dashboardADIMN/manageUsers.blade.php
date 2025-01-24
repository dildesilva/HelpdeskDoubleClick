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
    <link rel="stylesheet" href="{{asset('css/manageUsers.css')}}">
    @vite(['public/css/dash.css','public/css/manageUsers.css'])
</head>
<body>
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
                    <a href="{{url('/manageUsers')}}" class="active">
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
            <div class="container">
                <header class="header">
                    <h1>User Management</h1>
                </header>
                <section class="filter-section">
                    <input type="text" id="filterName" placeholder="Search by name..." class="input" onkeyup="filterTable()">
                    <select id="filterRole" class="input" onchange="filterTable()">
                        <option value="">Filter by role</option>
                        <option value="admin">Admin</option>
                        <option value="user">User</option>
                        <option value="itEng">IT Engineer</option>
                    </select>
                </section>
                <section class="user-table">
                    <table>
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="userList">
                            @foreach ($userDatas as $deta)
                            <tr data-role="{{$deta->usertype}}" id="row-{{ $deta->id }}">
                                <form id="edit-form-{{ $deta->id }}" action="{{ route('userechenges', $deta->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')

                                    <td>
                                        <input type="text" name="name-{{ $deta->id }}" id="name-{{ $deta->id }}" value="{{ old('name', $deta->name) }}" placeholder="Name" class="name-input">
                                    </td>
                                    <td>
                                        <input type="email" name="email-{{ $deta->id }}" id="email-{{ $deta->id }}" value="{{ old('email', $deta->email) }}" placeholder="Email" class="email-input">
                                    </td>
                                    <td>
                                        <span class="usertype-display">{{ $deta->usertype }}</span>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-warning edit-button" data-id="{{ $deta->id }}" data-url="{{ route('userechenges', $deta->id) }}">
                                            Edit
                                        </button>

                                </form>
                                <form id="delete-form-{{ $deta->id }}" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')

                                    <button class="btn btn-danger delete-button" data-id="{{ $deta->id }}" data-url="{{ route('userAdmind.delete', $deta->id) }}">
                                        Delete
                                    </button>

                                </form>

                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </section>
            </div>
            <script>
                function filterTable() {
                    var inputName = document.getElementById("filterName").value.toLowerCase();
                    var selectRole = document.getElementById("filterRole").value;
                    var table = document.getElementById("userList");
                    var rows = table.getElementsByTagName("tr");

                    for (var i = 0; i < rows.length; i++) {
                        var name = rows[i].getElementsByTagName("td")[0].textContent.toLowerCase();
                        var role = rows[i].getAttribute("data-role");
                        var nameMatch = name.indexOf(inputName) > -1;
                        var roleMatch = selectRole ? role === selectRole : true;

                        if (nameMatch && roleMatch) {
                            rows[i].style.display = "";
                        } else {
                            rows[i].style.display = "none";
                        }
                    }
                }

            </script>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.delete-button').on('click', function(e) {
                e.preventDefault();
                const userId = $(this).data('id');
                const url = $(this).data('url');
                const row = $(this).closest('tr');
                Swal.fire({
                    title: 'Are you sure?'
                    , text: "You won't be able to revert this!"
                    , icon: 'warning'
                    , showCancelButton: true
                    , confirmButtonColor: '#d33'
                    , cancelButtonColor: '#3085d6'
                    , confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: url
                            , type: 'POST'
                            , data: {
                                _method: 'DELETE'
                                , _token: '{{ csrf_token() }}'
                            }
                            , success: function(response) {
                                row.remove();
                                Swal.fire(
                                    'Deleted!'
                                    , 'The user has been deleted.'
                                    , 'success'
                                );
                            }
                            , error: function() {
                                Swal.fire(
                                    'Error!'
                                    , 'Could not delete the user. Please try again later.'
                                    , 'error'
                                );
                            }
                        });
                    }
                });
            });
        });

    </script>

    <script>
        $(document).ready(function() {
            $('.edit-button').on('click', function(e) {
                e.preventDefault();
                const userId = $(this).data('id');
                const url = $(this).data('url');
                const nameInput = $(`#name-${userId}`);
                const emailInput = $(`#email-${userId}`);
                const row = $(`#row-${userId}`);
                const name = nameInput.val();
                const email = emailInput.val();
                $.ajax({
                    url: url
                    , type: 'POST'
                    , data: {
                        _method: 'PUT'
                        , _token: '{{ csrf_token() }}'
                        , name: name
                        , email: email
                    }
                    , success: function(response) {
                        Swal.fire(
                            'Updated!'
                            , 'The user information has been updated successfully.'
                            , 'success'
                        );

                    }
                    , error: function() {
                        Swal.fire(
                            'Error!'
                            , 'Could not update the user. Please try again later.'
                            , 'error'
                        );
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
        function usernameUpdate() {
            fetch('/usernameupdate')
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    document.getElementById('usernameupdate').textContent = data.username;
                })
                .catch(error => console.error('Error fetching username:', error));
        }
        setInterval(usernameUpdate, 500);
        usernameUpdate();

    </script>
</body>
</html>

