<nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
    <div class="container">
        <a class="navbar-brand" href="{{ route('principal') }}"><img src="{{ asset('images/general/logo.png') }}" alt="..." style="width: 5cm; height: 2cm"/></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            Menu
            <i class="fas fa-bars ms-1"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav text-uppercase ms-auto py-4 py-lg-0">
                <li class="nav-item"><a class="nav-link" href="{{ route('principal') }}">Home</a></li>
                <li class="nav-item dropdown">
                    <button class="btn btn-outline-dark text-light dropdown-toggle" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                        Shop By
                    </button>
                    <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="dropdownMenuButton">
                        <li><a class="dropdown-item" href="{{ route('products.bysex', ['sex' => 'woman']) }}">Woman</a></li>
                        <li><a class="dropdown-item" href="{{ route('products.bysex', ['sex' => 'man']) }}">Man</a></li>
                        <li><a class="dropdown-item" href="{{ route('products.bysex', ['sex' => 'unisex']) }}">Unisex</a></li>
                    </ul>
                </li>
                @auth
                    @if(auth()->user()->role == 'admin')
                        <li class="nav-item dropdown">
                            <button class="btn btn-outline-dark text-light dropdown-toggle" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                Data Management
                            </button>
                            <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="dropdownMenuButton">
                                <li><a class="dropdown-item" href="{{route('gestion.products')}}">Products</a></li>
                                <li><a class="dropdown-item" href="{{route('categories.index')}}">Categories</a></li>
                            </ul>
                        </li>

                    @endif
                    <li class="nav-item">
                        <div class="d-flex cart">
                            <a class="btn btn-outline-light" type="submit" href="{{ route('cart') }}">
                                <i class="fas fa-cart-shopping mx-1"></i>
                                Cart
                                <span class="badge bg-dark text-white ms-1 rounded-pill">@if(session()->has('totalItems')) {{ session()->get('totalItems') }} @else 0 @endif</span>
                            </a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <form method="post" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="btn btn-outline-danger" href="{{ route('logout') }}">Logout</button>
                        </form>
                    </li>
                    <form id="logout-form" method="POST" action="{{ route('logout') }}">@csrf</form>
                @else
                    <li class="nav-item"><a class="btn btn-outline-light" href="{{ route('login') }}">Sign In</a></li>
                @endauth
                <form action="{{ route('products.index') }}" class="mb-3" method="get">
                    @csrf
                    <div class="input-group">
                        <input type="text" class="form-control" id="search" name="search"  aria-label="Search" aria-describedby="basic-addon2">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="submit">Search</button>
                        </div>
                    </div>
                </form>
            </ul>
        </div>
    </div>
</nav>
