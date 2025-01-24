<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <title>DC Admin</title>
    <link rel="icon" href="https://github.com/dildesilva/ddpp/blob/main/logo.png?raw=true">
    <link href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('css/dash.css')}}">
    <link rel="stylesheet" href="{{asset('css/addBranch.css')}}">
    @vite(['public/css/dash.css', 'public/css/addBranch.css'])
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
                <li><a href="{{url('/cashteam')}}"><i class="bi bi-folder-symlink"></i><span class="links_name">For Approval</span></a></li>
                <li><a href="{{url('/bucketT')}}"><i class="bi bi-archive"></i><span class="links_name">Tikets Bucket</span></a></li>
                <li><a href="{{url('/adminTiketopen')}}"><i class="bi bi-door-open"></i><span class="links_name">Open Tikets</span></a></li>
                <li><a href="{{url('/adminTiketprocess')}}"><i class="bi bi-gear-wide-connected"></i><span class="links_name">Procceing Tikets</span></a></li>
                <li><a href="{{url('/adminReport')}}"><i class="bi bi-person-workspace"></i><span class="links_name">Report</span></a></li> 
                <li><a href="{{url('/addUser')}}"><i class="bi bi-person-plus"></i><span class="links_name">Add Users</span></a></li>
                <li><a href="{{url('/addBranch')}}" class="active"><i class="bi bi-building-add"></i><span class="links_name">Add Branch</span></a></li>
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

    <section class="home-section">
        <nav>
            <div class="sidebar-button"><i class="bx bx-menu sidebarBtn"></i><span class="dashboard">Admin</span></div>
            <div class="profile-details">
                <img src="{{asset('zdpuser/' . Auth::user()->userDP)}}" alt="">
                <a href="{{route('profile.edit')}}"><span class="admin_name">{{ Auth::user()->name }}</span></a>
            </div>
        </nav>

        <div class="branchAddmaindev">
            <div class="branchAddmaindev-2">
                <div class="form-container">
                    <h2>Create New Branch</h2>
                    @if(session('success'))
                    <div class="success-message">{{ session('success') }}</div>
                    @endif
                    <form id="addbranchdataForm" action="{{route('addbranchdata')}}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="branch_name">Branch Name</label>
                            <input type="text" name="name" id="branch_name" class="form-input" required>
                            @error('branch_name')<span class="error">{{ $message }}</span>@enderror
                        </div>
                        <div class="form-group">
                            <label for="contact">Branch Contact</label>
                            <input type="text" name="contact" id="contact" class="form-input" required>
                            @error('contact')<span class="error">{{ $message }}</span>@enderror
                        </div>
                        <div class="form-group">
                            <label for="location">Location</label>
                            <input type="text" name="location" id="location" class="form-input" required>
                            @error('location')<span class="error">{{ $message }}</span>@enderror
                        </div>
                        <div class="form-group">
                            <label for="company">Company</label>
                            <select name="company" class="form-input">
                                <option value="" disabled selected hidden>what's Company</option>
                                <option value="Doubleclick Exchange Pty Ltd.">Doubleclick Exchange Pty Ltd.</option>
                                <option value="Amazonbetting Pty Ltd.">Amazonbetting Pty Ltd.</option>
                                <option value="Amazon Slots Pty Ltd.">Amazon Slots Pty Ltd.</option>
                                <option value="Breeze Garden.">Breeze Garden.</option>
                                <option value="Fashion and Sports World.">Fashion and Sports World.</option>
                                <option value="Marlu Seychelles.">Marlu Seychelles.</option>
                                <option value="Doubleclick Café & Gifts.">Doubleclick Café & Gifts.</option>
                                <option value="none">Other</option>
                            </select>
                            @error('company')<span class="error">{{ $message }}</span>@enderror
                        </div>
                        <div class="form-group">
                            <input type="submit" class="submit-btn" value="Create Branch">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.getElementById('addbranchdataForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const form = e.target;
            const formData = new FormData(form);
            axios.post("{{ route('addbranchdata') }}", formData)
                .then(response => {
                    Swal.fire({
                        title: 'Success!',
                        text: response.data.message,
                        icon: 'success',
                        confirmButtonText: 'OK'
                    }).then(() => form.reset());
                })
                .catch(() => {
                    Swal.fire({
                        title: 'Error!',
                        text: 'There was an issue with the request. Please try again later.',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                });
        });

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
