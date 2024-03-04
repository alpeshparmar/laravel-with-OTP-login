@php
    $email = session('email');
@endphp
<header class="header">
    <div class="container">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12"> <a class="logo" href="#"><img
                        src="images/logo.png" alt="logo"></a>
                <div class="nav-wrapper">
                    <!-- stellarnav -->
                    {{-- {{ session('email') }} --}}
                    @if (!auth()->user())
                    <div class="stellarnav">
                        <ul>
                            <li class="nav-item"><a href="{{ url('/') }}">Home</a></li>
                        </ul>
                    </div>
                    @endif
                    <!-- stellarnav End -->
                    <!-- Dropdown button -->
                    <div class="dropdown"> <a href="/" class="dropdown-toggle theme-btn" data-toggle="dropdown">My
                            Account</a>
                        <div class="dropdown-menu">
                            @if (!auth()->user())
                                <a href="{{ route('auth.login') }}" class="dropdown-item">Log in</a>
                                <a href="{{ route('auth.register') }}" class="dropdown-item">Sign up</a>
                            @endif
                            @if (auth()->user())
                            <form action="{{ route('auth.step1Logout') }}" method="post">
                                @csrf
                                <button type="submit" class="dropdown-item">Logout</button>
                            </form>
                            @endif
                        </div>
                    </div>
                    <!-- Dropdown button End -->
                </div>
            </div>
        </div>
    </div>
</header>
