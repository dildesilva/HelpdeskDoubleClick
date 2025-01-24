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
    <link rel="stylesheet" href="{{asset('css/tiketB.css')}}">
    @vite(['public/css/dash.css','public/css/tiketB.css'])
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
                    <a href="{{url('/tikect')}}" class="active">
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
                    <a href="{{url('/manageUsers')}}">
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
        <div class="mytiketsasingdivNEW">
            <div class="FROMENEWTICTEadmin">
                <form method="POST" id="submited" action="{{url('/assignedTECH') }}" onsubmit="submitForm()">
                    @csrf
                    <input type="text" name="state" value="Start" hidden>
                    <input type="email" value={{ Auth::user()->email }} name="sender" hidden>
                    <table>
                        <h1>New Tiket</h1>
                        <tr>
                            <td class="tdlefttiket">Subject</td>
                            <td class="tdRigthtiket" colspan="3">
                                <select name="subject">
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
                            <td class="tdlefttiketLINE">Company</td>
                            <td class="tdRigthtiketLINE">
                                <select name="company" id="cars" required>
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
                            <td class="tdlefttiketLINE">Branch</td>
                            <td class="tdRigthtiketLINE">
                                <select name="branch" id="cars">
                                    <option value="" disabled selected hidden>City/Branch</option>
                                    @foreach ( $branches as $branch)
                                    <option value={{$branch->name}}>{{$branch->name}}</option>
                                    @endforeach
                                    <option value="Doubleclick head office.">Doubleclick Head Office.</option>
                                    <option value="Amazonbetting head office.">Amazonbetting Head Office.</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Assigned</td>
                            <td class="tdRigthtiket" colspan="3">
                                <select name="assigne" id="cars">
                                    <option value="" disabled selected hidden>IT Engineer</option>
                                    @foreach ( $users as $engtech)
                                    <option value={{$engtech->email}}>{{$engtech->name}}</option>
                                    @endforeach
                                </select></td>
                        </tr>
                        <tr>
                            <td>Description</td>
                            <td class="tdRigthtiket" colspan="3">
                                <textarea name="description" id="" cols="30" rows="10"></textarea> </td>
                        </tr>
                    </table>
                    <input type="date" name="dateCreated" value="<?php echo date('Y-m-d'); ?>" hidden>
                    <div class="buttonsCLEARANDENNTERtikects">
                        <input class="greenbutton" type="reset" value="Clear">
                        <button class="redbutton">Enter </button>
                    </div>
                </form>
                <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                <script>
                    // Function to handle form submission via AJAX
                    function submitForm(event) {
                        // Prevent the form from submitting normally (no page refresh)
                        event.preventDefault();
                        // Get the form element
                        var form = document.getElementById('submited');
                        // Create a FormData object from the form
                        var formData = new FormData(form);
                        // Perform the AJAX request (using Fetch API)
                        fetch("{{ url('/assignedTECH') }}", {
                                method: "POST"
                                , body: formData
                                , headers: {
                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content // CSRF token
                                }
                            })
                            .then(response => response.json()) // Parse the JSON response
                            .then(data => {
                                // Check if the submission was successful
                                if (data.success) {
                                    // Display a success message using SweetAlert
                                    Swal.fire({
                                        position: "bottom-end"
                                        , icon: "success"
                                        , title: "Ticket added successfully!"
                                        , showConfirmButton: false
                                        , timer: 1500
                                    });

                                    // Clear the form after submission
                                    form.reset();
                                } else {
                                    // Display an error message if the response indicates failure
                                    Swal.fire({
                                        position: "bottom-end"
                                        , icon: "error"
                                        , title: "Error: " + data.message
                                        , showConfirmButton: true
                                    });
                                }
                            })
                            .catch(error => {
                                // Handle network or other errors
                                console.error('Error:', error);
                                Swal.fire({
                                    position: "bottom-end"
                                    , icon: "error"
                                    , title: "An error occurred. Please try again."
                                    , showConfirmButton: true
                                });
                            });
                    }
                    // Attach the submitForm function to the form submit event
                    document.getElementById('submited').addEventListener('submit', submitForm);

                </script>
            </div>
        </div>
    </section>
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
</body>
</html>

