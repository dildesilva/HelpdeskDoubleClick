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
    <link rel="stylesheet" href="{{asset('css/addUser.css')}}">
    @vite(['public/css/dash.css','public/css/addUser.css'])
</head>
<body>

    <div class="sidebar">
        <div class="logo-details">
            <img src="https://raw.githubusercontent.com/dildesilva/ddpp/refs/heads/main/image.png" alt="logo">
        </div>
        <ul class="nav-links">
            <li>
                <a href="{{ url('/addUser') }}" class="active">
                    <i class="bi bi-person-plus"></i>
                    <span class="links_name">Add Users</span>
                </a>
            </li>
        </ul>
    </div>

    <section class="home-section">
        <nav>
            <div class="sidebar-button">
                <i class="bx bx-menu sidebarBtn"></i>
                <span class="dashboard">Add Users</span>
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

                    <form method="POST" action="{{ route('adreg') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="user-details">
                            <div class="input-box">
                                <span class="details">Full Name</span>
                                <input type="text" name="name" placeholder="Enter your name" required>
                                @error('name')<div style="color: red; font-size: 12px;">{{ $message }}</div>@enderror
                            </div>

                            <div class="input-box">
                                <span class="details">Email</span>
                                <input type="email" name="email" placeholder="Enter your email" required>
                                @error('email')<div style="color: red; font-size: 12px;">{{ $message }}</div>@enderror
                            </div>

                            <div class="input-box">
                                <span class="details">Phone Number</span>
                                <input type="text" name="phoneNUM" placeholder="Enter your number" required>
                                @error('phoneNUM')<div style="color: red; font-size: 12px;">{{ $message }}</div>@enderror
                            </div>

                            <div class="input-box">
                                <span class="details">Upload DP</span>
                                <input type="file" name="userDP" required>
                                @error('userDP')<div style="color: red; font-size: 12px;">{{ $message }}</div>@enderror
                            </div>

                            <div class="input-box">
                                <span class="details">Role</span>
                                <select name="usertype" required>
                                    <option value="admin">Admin</option>
                                    <option value="itEng">Engineer</option>
                                    <option value="user">Cashier</option>
                                </select>
                                @error('usertype')<div style="color: red; font-size: 12px;">{{ $message }}</div>@enderror
                            </div>

                            <div class="input-box">
                                <span class="details">Gender</span>
                                <select name="gender" required>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                    <option value="other">Other</option>
                                </select>
                                @error('gender')<div style="color: red; font-size: 12px;">{{ $message }}</div>@enderror
                            </div>

                            <div class="input-box">
                                <span class="details">Password</span>
                                <input type="password" name="password" placeholder="Enter your password" required>
                                @error('password')<div style="color: red; font-size: 12px;">{{ $message }}</div>@enderror
                            </div>

                            <div class="input-box">
                                <span class="details">Confirm Password</span>
                                <input type="password" name="password_confirmation" placeholder="Confirm your password" required>
                                @error('password')<div style="color: red; font-size: 12px;">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        <div class="button">
                            <input type="submit" value="Register">
                        </div>
                    </form>
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
