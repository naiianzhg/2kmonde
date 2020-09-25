<ul class="navbar-nav ml-lg-5 mr-auto">
    <li class="nav-item"><a href="/blog" class="nav-link">Home</a></li>
    @auth
        <li @if (\Illuminate\Support\Facades\Request::is('admin/post*')) class="nav-item active" @else class="nav-item" @endif>
            <a href="/admin/post" class="nav-link">Post</a>
        </li>
        <li @if (\Illuminate\Support\Facades\Request::is('admin/tag*')) class="nav-item active" @else class="nav-item" @endif>
            <a href="/admin/tag" class="nav-link">Tag</a>
        </li>
        <li @if (\Illuminate\Support\Facades\Request::is('admin/upload*')) class="nav-item active" @else class="nav-item" @endif>
            <a href="/admin/upload" class="nav-link">Upload</a>
        </li>
    @endauth
</ul>

<ul class="navbar-nav ml-auto">
    @guest
        <li class="nav-item"><a href="/login" class="nav-link">Login</a></li>
    @else
        <li class="nav-item dropdown">
            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                {{ Auth::user()->name }}
                <span class="caret"></span>
            </a>
            <div class="dropdown-menu" role="menu">
                <a href="/logout" class="dropdown-item">Logout</a>
            </div>
        </li>
    @endguest
</ul>
