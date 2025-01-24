<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>DC Cashier</title>
    <link rel="icon" href="https://github.com/dildesilva/ddpp/blob/main/logo.png?raw=true">
    <link href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="{{asset('css/userdashcontact.css')}}">
    <link rel="stylesheet" href="{{asset('css/user.css')}}">
    @vite(['public/css/user.css','public/css/userdashcontact.css'])
</head>
<body>
 
    <div class="userdashmain">
        <div class="mainonelesft">
            <div class="posioncSHEIR">
                <h1>Cashier Account</h1>
            </div>
            <div class="profilepiceuser">
                <div class="profilepiceuserimg">
                    <img src="{{asset('zdpuser/' . Auth::user()->userDP)}}" alt="" />
                </div>
                <div class="profilepiceusername">
                    <p>Name: {{ Auth::user()->name }}</p>
                </div>
            </div>
            <div class="profiledenav">
                <ul>
                    <li class="ActiveTbs"><i class="bx bx-list-ul"></i><a href="{{url('userDash')}}"> Home</a></li>
                    <li><i class="bi bi-door-open"></i><a href="{{url('userDashup')}}">Open Tikets</a></li>
                    <li><i class="bx bx-user"></i><a href="{{url('serDashupdatePROCEING')}}">Procceing Tikets</a></li>
                    <li><i class="bi bi-balloon-heart"></i><a href="{{url('userDashCont')}}">Contact</a></li>
                    <li> <i class="bx bx-log-out"></i>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')" onclick="event.preventDefault();this.closest('form').submit();">
        
                                <span class="links_name"> Log out</span>
                            </x-dropdown-link>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
        <div class="mainoneRiht">
            <div class="tabs">
                <button class="tab-button active" onclick="openTab(event, 'officeStaff')">Office Staff</button>
                <button class="tab-button" onclick="openTab(event, 'admin')">Admin</button>
                <button class="tab-button" onclick="openTab(event, 'engineers')">Engineers</button>
            </div>
            <div id="officeStaff" class="tab-content active">
                <table class="user-table">
                    <thead>
                        <tr>
                            <th>User ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>phone</th>
                            <th>Join date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($Officeusers as $user )
                        <tr>
                            <td>{{$user->id}}</td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->phoneNUM}}</td>
                            <td>{{$user->created_at}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div id="admin" class="tab-content">
                <table class="user-table">
                    <thead>
                        <tr>
                            <th>User ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>phone</th>
                            <th>Join date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($adminusers as $user )
                        <tr>
                            <td>{{$user->id}}</td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->phoneNUM}}</td>
                            <td>{{$user->created_at}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div id="engineers" class="tab-content">
                <table class="user-table">
                    <thead>
                        <tr>
                            <th>User ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>phone</th>
                            <th>Join date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($engusers as $user )
                        <tr>
                            <td>{{$user->id}}</td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->phoneNUM}}</td>
                            <td>{{$user->created_at}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <script>
                function openTab(evt, tabName) {
                    var tabContents = document.querySelectorAll('.tab-content');
                    tabContents.forEach(function(content) {
                        content.classList.remove('active');
                    });
                    var tabButtons = document.querySelectorAll('.tab-button');
                    tabButtons.forEach(function(button) {
                        button.classList.remove('active');
                    });
                    document.getElementById(tabName).classList.add('active');
                    evt.currentTarget.classList.add('active');
                }

            </script>
        </div>
    </div>
</body>
</html>

