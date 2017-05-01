<nav class="navbar navbar-fixed-top" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header page-scroll">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-responsive-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="toggle-icon">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </span>
            </button>
            <a class="navbar-brand" href="#intro">
                <img class="logo-default" src="{{ asset('front/assets/onepage2/img/logo_default.png') }}" alt="Logo">
                <img class="logo-scroll" src="{{ asset('front/assets/onepage2/img/logo_scroll.png') }}" alt="Logo">
            </a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse navbar-responsive-collapse">
            <ul class="nav navbar-nav">
                <li class="page-scroll active">
                    <a href="#intro">Home</a>
                </li>
                <li class="page-scroll">
                    <a href="#about">About</a>
                </li>
                <li class="page-scroll">
                    <a href="#features">Features</a>
                </li>
                <li class="page-scroll">
                    <a href="#team">Team</a>
                </li>
                <li class="page-scroll">
                    <a href="#clients">Clients</a>
                </li>                    
                <li class="page-scroll">
                    <a href="#portfolio">Portfolio</a>
                </li>
                <li class="page-scroll">
                    <a href="#pricing">Pricing</a>
                </li>
                <li class="page-scroll">
                    <a href="#contact">Contact</a>
                </li>
                <li class="page-scroll">
                    <a href="{{ url('/register') }}">Register</a>
                </li>
                <li class="page-scroll">
                    <a href="{{ url('/login') }}">Login</a>
                </li>
            </ul>
        </div>
        <!-- End Navbar Collapse -->
    </div>
    <!--/container-->
</nav>