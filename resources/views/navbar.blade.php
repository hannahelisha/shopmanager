<nav class="navbar">
    <div class="container">
        <a class="navbar-brand" href="#">
            🍦 Nani Ga Suki?
        </a>
        <div class="d-flex ms-auto">
            <ul class="navbar-nav flex-row gap-3 align-items-center">
                @auth
                    <li class="nav-item">
                        <a class="nav-link" href="/dashboard"
                           style="color: white; font-family: 'Poppins', sans-serif;">
                            <i class="fas fa-tachometer-alt"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('users.index') }}"
                           style="color: white; font-family: 'Poppins', sans-serif;">
                            <i class="fas fa-users"></i> Users
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('products.index') }}"
                           style="color: white; font-family: 'Poppins', sans-serif;">
                            <i class="fas fa-ice-cream"></i> Flavors
                        </a>
                    </li>
                    <li class="nav-item">
    <a class="nav-link" href="{{ route('profile') }}"
       style="color: white; font-family: 'Poppins', sans-serif;">
        <i class="fas fa-user"></i> Profile
    </a>
</li>
                    <li class="nav-item">
                        <form action="/logout" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn-logout">
                                <i class="fas fa-sign-out-alt"></i> Logout
                            </button>
                        </form>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>