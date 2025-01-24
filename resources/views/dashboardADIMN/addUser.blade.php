<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>DC Admin</title>
    <link rel="icon" href="https://github.com/dildesilva/ddpp/blob/main/logo.png?raw=true">
    <link href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="{{asset('css/dash.css')}}">
    <link rel="stylesheet" href="{{asset('css/addUser.css')}}">
    @vite(['public/css/dash.css', 'public/css/addUser.css'])
</head>
<body>
    <div class="sidebar">
        <div class="logo-details">
            <img src="https://raw.githubusercontent.com/dildesilva/ddpp/refs/heads/main/image.png" alt="logo">
        </div>
        <ul class="nav-links">
            <div class="scrolwithoverflowadmindash">
                <li><a href="{{url('/dashboard')}}"><i class="bi bi-speedometer2"></i><span class="links_name">Dashboard</span></a></li>
                <li><a href="{{url('/tikect')}}"><i class="bi bi-folder-plus"></i><span class="links_name">Create Tickets</span></a></li>
                <li><a href="{{url('/tiketAdmin')}}"><i class="bx bx-list-ul"></i><span class="links_name">Tickets List</span></a></li>
                <li><a href="{{url('/processingAdmin')}}"><i class="bi bi-cpu"></i><span class="links_name">Processing</span></a></li>
                <li><a href="{{ url('/doneAdmin') }}"><i class="bi bi-stack"></i><span class="links_name">Done</span></a></li>
                <li><a href="{{url('/cashteam')}}"><i class="bi bi-folder-symlink"></i><span class="links_name">For Approval</span></a></li>
                <li><a href="{{url('/bucketT')}}"><i class="bi bi-archive"></i><span class="links_name">Tickets Bucket</span></a></li>

                <li><a href="{{url('/adminTiketopen')}}"><i class="bi bi-door-open"></i><span class="links_name">Open Tikets</span></a></li>
                <li><a href="{{url('/adminTiketprocess')}}"><i class="bi bi-gear-wide-connected"></i><span class="links_name">Procceing Tikets</span></a></li>
                <li><a href="{{url('/adminReport')}}"><i class="bi bi-person-workspace"></i><span class="links_name">Report</span></a></li>

                <li><a href="{{url('/addUser')}}" class="active"><i class="bi bi-person-plus"></i><span class="links_name">Add Users</span></a></li>
                <li><a href="{{url('/addBranch')}}"><i class="bi bi-building-add"></i><span class="links_name">Add Branch</span></a></li>
                <li><a href="{{url('/manageUsers')}}"><i class="bi bi-people"></i><span class="links_name">Manage Users</span></a></li>
                <li><a href="{{url('/manageBranch')}}"><i class="bi bi-kanban"></i><span class="links_name">Manage Branch</span></a></li>
            </div>
            <li class="log_out">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                        <i class="bx bx-log-out"></i><span class="links_name">Log out</span>
                    </x-dropdown-link>
                </form>
            </li>
        </ul>
    </div>

    <section class="home-section">
        <nav>
            <div class="sidebar-button">
                <i class="bx bx-menu sidebarBtn"></i>
                <span class="dashboard">Admin</span>
            </div>
            <div class="profile-details">
                <img src="{{asset('zdpuser/' . Auth::user()->userDP)}}" alt="" />
                <a href="{{route('profile.edit')}}"> <span class="admin_name">{{ Auth::user()->name }}</span></a>
            </div>
        </nav>

        <div class="home-content">
            <div class="container">
                <div class="title">Registration</div>
                <div class="content">
                    @if(session('success'))
                    <div style="background-color: green; color: white; padding: 10px; border-radius: 5px;">
                        {{ session('success') }}
                    </div>
                    @endif

                    <form id="adregForm" enctype="multipart/form-data">
                        @csrf
                        <div class="user-details">
                            <div class="input-box">
                                <span class="details">Full Name</span>
                                <input type="text" name="name" placeholder="Enter your name" required>
                            </div>
                            <div class="input-box">
                                <span class="details">Email</span>
                                <input type="email" name="email" placeholder="Enter your email" required>
                            </div>
                            <div class="input-box">
                                <span class="details">Phone Number</span>
                                <input type="text" name="phoneNUM" placeholder="Enter your number" required>
                            </div>
                            <div class="input-box">
                                <span class="details">Upload DP</span>
                                <input type="file" name="userDP" required>
                            </div>
                            <div class="input-box">
                                <span class="details">Role</span>
                                <select name="usertype" required>
                                    <option value="admin">Admin</option>
                                    <option value="itEng">Engineer</option>
                                    <option value="user">Cashier</option>
                                </select>
                            </div>
                            <div class="input-box">
                                <span class="details">Gender</span>
                                <select name="gender" required>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                    <option value="other">Other</option>
                                </select>
                            </div>
                            <div class="input-box">
                                <span class="details">Password</span>
                                <input type="password" name="password" placeholder="Enter your password" required>
                            </div>
                            <div class="input-box">
                                <span class="details">Confirm Password</span>
                                <input type="password" name="password_confirmation" placeholder="Confirm your password" required>
                            </div>
                        </div>
                        <div class="button">
                            <input type="submit" value="Register">
                        </div>
                    </form>

                    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
                    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                    <script>
                        document.getElementById('adregForm').addEventListener('submit', function(e) {
                            e.preventDefault();
                            const form = e.target;
                            const formData = new FormData(form);

                            axios.post("{{ route('adreg') }}", formData)
                                .then(response => {
                                    Swal.fire({
                                        title: 'Success!',
                                        text: response.data.message,
                                        icon: 'success',
                                        confirmButtonText: 'OK'
                                    }).then(() => {
                                        form.reset();
                                    });
                                })
                                .catch(error => {
                                    Swal.fire({
                                        title: 'Error!',
                                        text: 'There was an issue with the request. Please try again later.',
                                        icon: 'error',
                                        confirmButtonText: 'OK'
                                    });
                                });
                        });
                    </script>
                </div>
            </div>
        </div>
    </section>

    <script>
        let sidebar = document.querySelector(".sidebar");
        let sidebarBtn = document.querySelector(".sidebarBtn");

        sidebarBtn.onclick = function() {
            sidebar.classList.toggle("active");
            sidebarBtn.classList.toggle("bx-menu-alt-right");
            sidebarBtn.classList.toggle("bx-menu");
        };
    </script>
</body>
</html>
