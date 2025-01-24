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
                <div class="assinedTiketsTech">
                    <h2>Open Tikets</h2>
                    <table class="ticket-table open-tickets">
                        <tr>
                            <th>Token No</th>
                            <th> Subject</th>
                            <th> Company</th>
                            <th> branch</th>
                            <th>Assigne Date</th>
                            <th>Cancel</th>
                        </tr>
                        @if($tickets->isEmpty())
                        <tr>
                            <th colspan="8"> No tickets</th>
                        </tr> @else
                        @foreach($tickets as $ticket)
                        <tr>
                            <td> {{ $ticket->id }}</td>
                            <td>{{ $ticket->subject}}</td>
                            <td> {{ $ticket->company }}</td>
                            <td> {{ $ticket->branch }}</td>
                            <td>{{ $ticket->updated_at }}</td>
                            <td>
                                <form action="{{ route('admintickets.updateState', $ticket->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <input type="text" name="state" value="Cancel" hidden>
                                    <button type="submit" class="cancel-btn">
                                        <i class="fas fa-times"></i> Cancel
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                        @endif
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

