<title>DoubleClick</title>
<link rel="icon" href="{{ asset('img/favicon.png') }}">
<link rel="stylesheet" href="{{asset('css/welcome.css')}}">
<body>
    <div class="homemainwindowwellcome">
        <div class="windowWellcome">
            <div class="logodivetion"><img src="{{asset('img/image.png')}}" alt=""></div>
            <div class="logoname2">
                <h1>Welcome to IT helpdesk</h1>
                <p>A diversified, leading, and fast-growing business group in Seychelles</p>
                <p> A group where our business partners and associates know we are in for the long term and will always value the relationship than a transaction.</p>
            </div>
        </div>
        <div class="windowWellcometw">
            <img src="{{asset('img/image.png')}}" alt="">
            <div class="windowWellcometwfrom">
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <ul>
                        <li> <input type="email" name="email" placeholder="Email Address " /></li>
                        <li><input type="password" name="password" required placeholder="Password" /></li>
                    </ul>
                    <input class="btnlog" type="submit" value=" Login">
                </form>
            </div>
        </div>
    </div>
</body>

