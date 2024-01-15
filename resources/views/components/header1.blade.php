<!-- ======= Property Search Section ======= -->
<div class="click-closed"></div>
<!--/ Form Search Star /-->

<div class="box-collapse">
    <div class="title-box-d">
        <h3 class="title-d">Search Property</h3>
    </div>
    <span class="close-box-collapse right-boxed bi bi-x"></span>
    <div class="box-collapse-wrap form">
        <form class="form-a" action="{{ route('search.properties') }}" method="post" id="property-search-form">
            @csrf
            <div class="row">

                <div class="col-md-6 mb-2">
                    <div class="form-group mt-3">
                        <label class="pb-2" for="type">Type</label>
                        <select class="form-control form-select form-control-a" name="type" id="Type">
                            <option>All Type</option>
                            <option>House</option>
                            <option>Ghetto</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6 mb-2">
                    <div class="form-group mt-3">
                        <label class="pb-2" for="province">Province</label>
                        <select class="form-control form-select form-control-a" name="province" id="city">
                            <option value="all province">All province</option>
                            <option value="East">East</option>
                            <option value="West">West</option>
                            <option value="Kigali">Kigali</option>
                            <option value="North">North</option>
                            <option value="South">South</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6 mb-2">
                    <div class="form-group mt-3">
                        <label class="pb-2" for="rooms">rooms</label>
                        <input type="number" class="form-control form-control form-control-a" name="rooms"
                            placeholder="0">
                    </div>
                </div>

                <div class="col-md-6 mb-2">
                    <div class="form-group mt-3">
                        <label class="pb-2" for="price">max Price</label>
                        <input type="number" class="form-control form-control form-control-a" name="max_price"
                            placeholder="0">
                    </div>
                </div>
                <div class="col-md-12">
                    <button type="submit" class="btn btn-b">Search Property</button>
                </div>
            </div>
        </form>
    </div>
</div><!-- End Property Search Section -->>


<!-- ======= Header/Navbar ======= -->
<nav class="navbar navbar-default navbar-trans navbar-expand-lg fixed-top">
    <div class="container">
        <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarDefault" aria-controls="navbarDefault" aria-expanded="false"
            aria-label="Toggle navigation">
            <span></span>
            <span></span>
            <span></span>
        </button>
        <a class="navbar-brand text-brand" href="{{ url('/') }}">Home<span class="color-b">Finder360</span></a>

        <div class="navbar-collapse collapse justify-content-center" id="navbarDefault">
            <ul class="navbar-nav">

                <li class="nav-item">
                    <a class="nav-link {{ Request::is('/') ? 'active' : '' }}" href="{{ url('/') }}">Home</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ Request::is('about') ? 'active' : '' }}" href="{{ route('about') }}">About</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ Request::is('properties') ? 'active' : '' }}"
                        href="{{ route('properties') }}">Property</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('contact') ? 'active' : '' }}"
                        href="{{ route('contact') }}">Contact</a>
                </li>

                @guest
                    <!-- Show login button if the user is not logged in -->
                    <li class="nav-item">
                        <a href="{{ route('login') }}" class="btn btn-primary">Login</a>
                    </li>
                @else
                    <!-- Show profile icon with dropdown if the user is logged in -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img src="../storage/{{ auth()->user()->profile_image }}" class="rounded-circle"
                                style="width: 40px; height: 40px; object-fit: cover;" alt="profile">
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            @auth
                                <a class="dropdown-item" href="{{ route('user-profile') }}">{{ auth()->user()->name }}</a>
                            @endauth
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                                Logout
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest

            </ul>
        </div>

        <button type="button" class="btn btn-b-n navbar-toggle-box navbar-toggle-box-collapse"
            data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01">
            <i class="bi bi-search"></i>
        </button>

    </div>
</nav><!-- End Header/Navbar -->
