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

    <link rel="stylesheet" href="{{asset('css/tiket.css')}}">
    <link rel="stylesheet" href="{{asset('css/user.css')}}">
    @vite(['public/css/user.css','public/css/tiket.css'])
</head>
<body>
    @extends('components.reaload10')
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
            <div class="mainoneRihtFrame">
                <div class="headsectionTikect">
                    <form id="ticketForm" action="{{url('/tikcetSend')}}" method="POST">
                        @csrf
                        <div class="engTicketAddHeader">
                            <h1>Add Ticket</h1>
                        </div>
                        <table class="engTicketAddForm">
                            <tr>
                                <td class="engTicketAddLabel">Subject</td>
                                <td class="engTicketAddInput" colspan="3">
                                    <select name="subject" id="engSubject">
                                        <option value="" disabled selected hidden>The Issue</option>
                                        <option value="Payment Verification">Payment Verification</option>
                                        <option value="TV Advert">TV Advert</option>
                                        <option value="Newspaper Advert">Newspaper Advert</option>
                                        <option value="Social Media Advert">Social Media Advert</option>
                                        <option value="Printer issues">Printer Issues</option>
                                        <option value="PC Hardware issues">PC Hardware issues</option>
                                        <option value="PC Software issues">PC Software issues</option>
                                        <option value="System issues">System issues</option>
                                        <option value="Design Advertisement">Advertisement (Design)</option>
                                        <option value="Social Media video Advert">Social Media (video) Advert</option>
                                        <option value="TV video Advert">TV (video) Advert</option>
                                        <option value="none">Other</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td class="engTicketAddLabel">Company</td>
                                <td class="engTicketAddInput" colspan="3">
                                    <select name="company" id="engCompany">
                                        <option value="" disabled selected hidden>what's Company</option>
                                        <option value="Doubleclick head office.">Doubleclick Head Office.</option>
                                        <option value="Doubleclick Exchange Pty Ltd.">Doubleclick Exchange Pty Ltd.</option>
                                        <option value="Amazonbetting Pty Ltd.">Amazonbetting Pty Ltd.</option>
                                        <option value="Amazon Slots Pty Ltd.">Amazon Slots Pty Ltd.</option>
                                        <option value="Breeze Garden.">Breeze Garden.</option>
                                        <option value="Fashion and Sports World.">Fashion and Sports World.</option>
                                        <option value="Marlu Seychelles.">Marlu Seychelles.</option>
                                        <option value="Doubleclick Café & Gifts.">Doubleclick Café & Gifts.</option>
                                        <option value="Doubleclick bakery.">Doubleclick bakery.</option>
                                        <option value="Other">Other</option>
                                    </select>
                                </td>
                                <td class="engTicketAddLabel">Branch</td>
                                <td class="engTicketAddInput">
                                    <select name="branch">
                                        <option value="" disabled selected hidden>City/Branch</option>
                                        @foreach($branches as $branch)
                                        <option value="{{ $branch->name }} | {{ Auth::user()->name }}">{{$branch->name}}</option>
                                        @endforeach
                                        <option value="Doubleclick head office.">Doubleclick Head Office.</option>
                                        <option value="Amazonbetting head office.">Amazonbetting Head Office.</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td class="engTicketAddLabel">Description</td>
                                <td class="engTicketAddTextArea" colspan="3">
                                    <textarea name="description" cols="30" rows="10"></textarea>
                                </td>
                            </tr>
                        </table>
                        <div class="buttonsCLEARANDENNTERtikects">
                            <input class="greenbutton" type="reset" value="Clear">
                            <input class="redbutton" type="submit" value="Enter">
                        </div>
                        <input type="text" name="email" value={{ Auth::user()->email }} hidden>
                        <input type="email" value="{{ Auth::user()->email }}" name="sender" hidden>
                    </form>
                </div>
                <div id="ticketDisplay"></div>
                @if($tickets->isEmpty())
                <p>No tickets found.</p>
                @else
                @foreach($tickets as $ticket)
                <div class="Edittikectuser">
                    <table>
                        <h1>Your Ticket: {{ $ticket->id }}</h1>
                        <tr>
                            <td class="engTicketAddLabel">Subject</td>
                            <td colspan="3">{{ $ticket->subject }}</td>
                        </tr>
                        <tr>
                            <td class="engTicketAddLabel">Company</td>
                            <td>{{ $ticket->company }}</td>
                            <td class="engTicketAddLabel">Branch | User</td>
                            <td>{{ $ticket->branch }} | {{ Auth::user()->name }}</td>
                        </tr>
                        <tr>
                            <td class="engTicketAddLabel">Description</td>
                            <td colspan="3">{{ $ticket->description }}</td>
                        </tr>
                    </table>
                </div>
                @endforeach
                @endif
            </div>






    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.getElementById('ticketForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(this);
            fetch(this.action, {
                    method: 'POST'
                    , headers: {
                        'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                    }
                    , body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        Swal.fire({
                            icon: 'success'
                            , title: 'Ticket Created Successfully!'
                            , text: `Your Ticket ID: ${data.ticket.id}`
                        , });
                        const ticketDisplay = document.getElementById('ticketDisplay');
                        const newTicketHTML = `
                        <div class="Edittikectuser">
                            <table>
                                <h1>Your Ticket: ${data.ticket.id}</h1>
                                <tr>
                                    <td class="engTicketAddLabel">Subject</td>
                                    <td colspan="3">${data.ticket.subject}</td>
                                </tr>
                                <tr>
                                    <td class="engTicketAddLabel">Company</td>
                                    <td>${data.ticket.company}</td>
                                    <td class="engTicketAddLabel">Branch</td>
                                    <td>${data.ticket.branch}</td>
                                </tr>
                                <tr>
                                    <td class="engTicketAddLabel">Description</td>
                                    <td colspan="3">${data.ticket.description || 'N/A'}</td>
                                </tr>
                            </table>
                        </div>
                    `;
                        ticketDisplay.insertAdjacentHTML('beforeend', newTicketHTML);
                        document.getElementById('ticketForm').reset();
                    } else {
                        Swal.fire({
                            icon: 'error'
                            , title: 'Ticket Creation Failed'
                            , text: 'Please try again later.'
                        , });
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    Swal.fire({
                        icon: 'error'
                        , title: 'Error Occurred'
                        , text: 'Something went wrong. Please try again.'
                    , });
                });
        });

    </script>
</body>
</html>

