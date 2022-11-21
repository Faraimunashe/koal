<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item nav-profile">
            <a href="{{route('profile')}}" class="nav-link">
                <div class="profile-image">
                    <img class="img-xs rounded-circle" src="{{asset('assets/images/profile.png')}}" alt="profile image">
                    <div class="dot-indicator bg-success"></div>
                </div>
                <div class="text-wrapper">
                    <p class="profile-name">{{ Auth::user()->name }}</p>
                    <p class="designation">{{ Auth::user()->roles->first()->display_name }}</p>
                </div>
                <div class="icon-container">
                    <i class="icon-bubbles"></i>
                    <div class="dot-indicator bg-danger"></div>
                </div>
            </a>
        </li>
        <li class="nav-item nav-category">
            <span class="nav-link">Menu Options</span>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('dashboard')}}">
                <span class="menu-title">Dashboard</span>
                <i class="icon-screen-desktop menu-icon"></i>
            </a>
        </li>
        @if (Auth::user()->hasRole('admin'))
            <li class="nav-item">
                <a class="nav-link" href="{{route('admin-bookings')}}">
                    <span class="menu-title">Bookings</span>
                    <i class="icon-user menu-icon"></i>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('admin-prices')}}">
                    <span class="menu-title">Prices</span>
                    <i class="icon-doc menu-icon"></i>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('admin-transactions')}}">
                    <span class="menu-title">Transactions</span>
                    <i class="icon-briefcase menu-icon"></i>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('admin-quotes')}}">
                    <span class="menu-title">Quotations</span>
                    <i class="icon-doc menu-icon"></i>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('admin-abattoirs')}}">
                    <span class="menu-title">Abattoirs</span>
                    <i class="icon-speech  menu-icon"></i>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('admin-diagnosis')}}">
                    <span class="menu-title">Diagnosis</span>
                    <i class="icon-speech  menu-icon"></i>
                </a>
            </li>
        @elseif(Auth::user()->hasRole('user'))
            <li class="nav-item">
                <a class="nav-link" href="{{route('user-transactions')}}">
                    <span class="menu-title">Payments</span>
                    <i class="icon-credit-card menu-icon"></i>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('user-quotes')}}">
                    <span class="menu-title">Quotations</span>
                    <i class="icon-doc menu-icon"></i>
                </a>
            </li>
        @endif
    </ul>
</nav>
