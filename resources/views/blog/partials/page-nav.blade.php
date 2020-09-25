{{-- Navigation bar --}}
<nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
    <div class="container">
        {{-- Brand and toggle get grouped for better mobile display --}}
        <a href="/" class="navbar-brand">{{ config('blog.name') }}</a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive">
            Menus
            <i class="fas fa-bars"></i>
        </button>

        {{-- Collect the nav links, forms, and other content for toggling --}}
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a href="/blog" class="nav-link">Home</a>
                </li>
            </ul>
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a href="/contact" class="nav-link">Contact me</a>
                </li>
            </ul>
            <ul class="navbar-nav">
                <li class="nav-item">
                    @auth
                        <a href="{{ url('/admin') }}">Admin</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </li>
            </ul>
        </div>
    </div>
</nav>
