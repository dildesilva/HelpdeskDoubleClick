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
    <link rel="stylesheet" href="{{asset('css/userUpdate.css')}}">
    <link rel="stylesheet" href="{{asset('public/css/user.css')}}">
    @vite(['public/css/user.css','public/css/userUpdate.css'])
</head>
<body>
    @extends('components.reaload5')
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
            <div class="maindevassingtechtiket">
                <div class="statedTiketsTech">
                    <h2>Procceing tikets</h2>
                    <table class="ticket-table" border="1">
                        <tr>
                            <th>Token No</th>
                            <th>Client</th>
                            <th>Subject</th>
                            <th>State</th>
                            <th>Duration</th>
                            <th>Technical Update</th>
                        </tr>
                        @foreach($ticketsPro as $deta)
                        <tr>
                            <td rowspan="2">{{ $deta->AsingId }}</td>
                            <td>Company: {{ $deta->company }}</td>
                            <td rowspan="2" class="subjectdescol">
                                Subject: {{ $deta->subject }} <br>
                                {{ $deta->description }}
                            </td>
                            <td rowspan="2">
                                {{ $deta->state}}
                            </td>
                            <td rowspan="2">Day : {{ abs((int) $deta->duration) }}</td>
                            <td rowspan="2">{{ $deta->TUpdate }}</td>
                        </tr>
                        <tr>
                            <td>Branch: {{ $deta->branch }}</td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

