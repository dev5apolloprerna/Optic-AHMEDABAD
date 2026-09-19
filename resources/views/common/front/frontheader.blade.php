<style>
    /* ==========================================
   AHMEDABAD EDITION HEADER LINK
========================================== */

.optic-edition-link {
    position: relative;
    display: inline-flex;
    align-items: center;
    min-height: 42px;
    margin-left: 32px;
    overflow: hidden;
    border: 1px solid #173f70;
    border-radius: 8px;
    background: #ffffff;
    color: #173f70 !important;
    text-decoration: none !important;
    vertical-align: middle;
    box-shadow: 0 7px 18px rgba(12, 48, 91, 0.13);
    transition:
        transform 0.25s ease,
        box-shadow 0.25s ease,
        border-color 0.25s ease;
}

/* Left orange icon area */

.optic-edition-icon {
    position: relative;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    align-self: stretch;
    width: 42px;
    min-height: 42px;
    background: linear-gradient(145deg, #f37820, #ff9b52);
    color: #ffffff;
    font-size: 15px;
}

.optic-edition-icon::after {
    content: "";
    position: absolute;
    top: 50%;
    right: -6px;
    width: 12px;
    height: 12px;
    background: #f78a38;
    transform: translateY(-50%) rotate(45deg);
}

/* Text area */

.optic-edition-content {
    position: relative;
    z-index: 1;
    display: flex;
    flex-direction: column;
    justify-content: center;
    padding: 5px 15px 5px 17px;
    line-height: 1.1;
}

.optic-edition-content small {
    margin-bottom: 3px;
    color: #78889a;
    font-size: 9px;
    font-weight: 700;
    line-height: 1;
    letter-spacing: 1.1px;
    text-transform: uppercase;
}

.optic-edition-content strong {
    color: #173f70;
    font-size: 13px;
    font-weight: 800;
    line-height: 1;
    letter-spacing: 0.2px;
    text-transform: uppercase;
}

/* Right arrow */

.optic-edition-arrow {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 32px;
    height: 42px;
    border-left: 1px dashed rgba(23, 63, 112, 0.22);
    color: #f37820;
    font-size: 10px;
    transition:
        color 0.25s ease,
        transform 0.25s ease;
}

/* Decorative corner */

.optic-edition-link::before {
    content: "";
    position: absolute;
    top: -18px;
    right: -18px;
    width: 36px;
    height: 36px;
    border-radius: 50%;
    background: rgba(243, 120, 32, 0.12);
    transition: transform 0.35s ease;
}

/* Hover */

.optic-edition-link:hover {
    border-color: #f37820;
    color: #173f70 !important;
    transform: translateY(-2px);
    box-shadow:
        0 11px 24px rgba(12, 48, 91, 0.16),
        0 5px 12px rgba(243, 120, 32, 0.14);
}

.optic-edition-link:hover::before {
    transform: scale(3);
}

.optic-edition-link:hover .optic-edition-arrow {
    color: #173f70;
    transform: translateX(3px);
}

/* Tablet adjustment */

@media (max-width: 1199px) {
    .optic-edition-link {
        margin-left: 15px;
    }

    .optic-edition-content {
        padding-right: 11px;
        padding-left: 15px;
    }

    .optic-edition-content strong {
        font-size: 12px;
    }
}
</style>

<style>
    /* ==================================================
   RESPONSIVE TOP HEADER
================================================== */

.top-info-bar {
    width: 100%;
    padding: 9px 0;
    background: #f3f4f6;
}

.top-info-list {
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    gap: 10px 18px;
}

.top-info-item {
    display: inline-flex;
    align-items: flex-start;
    gap: 7px;
    margin: 0 !important;
    color: #161616 !important;
    font-size: 14px;
    font-weight: 500;
    line-height: 1.45;
    text-decoration: none !important;
    transition: color 0.25s ease;
}

.top-info-item i {
    flex: 0 0 auto;
    margin-top: 3px;
    padding: 0;
    background: transparent;
    color: #f37820;
    font-size: 15px;
}

.top-info-item:hover {
    color: #f37820 !important;
}

.top-info-phone .fa-phone-alt {
    transform: scaleX(-1);
}

/* Jaipur ticket positioning */

.top-info-list .optic-edition-link {
    flex: 0 0 auto;
    /*margin: 0 0 0 auto;*/
}

/* Social icons */

.top-social-list {
    display: flex;
    align-items: center;
    justify-content: flex-end;
    gap: 10px;
    margin: 0;
    padding: 0;
    list-style: none;
}

.top-social-list li {
    margin: 0;
}

.top-social-list li a {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 34px;
    height: 34px;
    border-radius: 8px;
    background: #1f5ca9;
    color: #ffffff;
    font-size: 18px;
    text-decoration: none;
    transition:
        transform 0.25s ease,
        background-color 0.25s ease;
}

.top-social-list li a:hover {
    background: #f37820;
    color: #ffffff;
    transform: translateY(-2px);
}

/* ==================================================
   TABLET
================================================== */

@media (max-width: 1199px) {
    .top-info-list {
        gap: 9px 13px;
    }

    .top-info-item {
        font-size: 13px;
    }

    .top-info-list .optic-edition-link {
        margin-left: 0;
    }
}

/* ==================================================
   MOBILE HEADER
================================================== */

@media (max-width: 767px) {
    .top-info-bar {
        padding: 12px 0 10px;
    }

    .top-info-bar .container {
        padding-right: 14px;
        padding-left: 14px;
    }

    .top-info-row {
        row-gap: 10px;
    }

    .top-info-list {
        display: grid;
        grid-template-columns: minmax(0, 1fr) minmax(0, 1fr);
        gap: 10px;
        width: 100%;
    }

    /* Venue gets full mobile width */

    .top-info-venue {
        grid-column: 1 / -1;
    }

    /* Date and phone appear side by side */

    .top-info-date,
    .top-info-phone {
        width: 100%;
    }

    .top-info-item {
        min-width: 0;
        font-size: 13px;
        line-height: 1.35;
    }

    .top-info-item span {
        min-width: 0;
        overflow-wrap: anywhere;
    }

    /* Jaipur ticket on separate row */

    .top-info-list .optic-edition-link {
        grid-column: 1 / -1;
        justify-self: start;
        width: 100%;
        max-width: 230px;
        min-height: 42px;
        margin: 0;
    }

    .optic-edition-content {
        flex: 1;
    }

    .optic-edition-arrow {
        flex: 0 0 32px;
    }

    /* Social icons aligned right */

    .top-social-list {
        justify-content: flex-end;
        margin-top: 2px;
    }

    /* Logo area */

    .middle-bar {
        display: flex;
        flex-direction: row;
        align-items: center;
        gap: 15px;
        padding: 5px 0;
    }

    .middle-bar .logo {
        justify-content: center;
        width: 100%;
    }

    .middle-bar .logo img {
        display: block;
        width: auto;
        max-width: 150px;
        height: auto;
        margin: 0 auto;
        object-fit: contain;
    }

    .middle-bar .spo-logo {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        justify-content: center;
        gap: 10px;
        width: 100%;
    }

    .middle-bar .spo-logo img,
    .middle-bar .spo-logo img[style] {
        width: auto !important;
        max-width: 145px;
        height: 70px !important;
        margin: 0;
        object-fit: contain !important;
    }

    /* Mobile navigation bar */

    .bo .navbar {
        min-height: 46px;
        padding: 5px 0;
    }

    .bo .navbar-toggler {
        margin-left: 8px;
    }
}

@media (max-width: 420px) {
    .top-info-list {
        grid-template-columns: 1fr;
    }

    .top-info-venue,
    .top-info-date,
    .top-info-phone,
    .top-info-list .optic-edition-link {
        grid-column: 1;
    }

    .top-info-list .optic-edition-link {
        max-width: 100%;
        width: 196px;
    }

    .top-social-list {
        justify-content: flex-start;
    }

    .middle-bar .spo-logo img,
    .middle-bar .spo-logo img[style] {
        max-width: 110px;
        height: 50px !important;
    }
}
</style>

<header class="header-section">
    <div style="tp-bar" class="social-icon d-flex align-items-center">
        <div class="social-icon top-info-bar">
    <div class="container">
        <div class="row align-items-center top-info-row">

            <div class="col-lg-10 col-12">
                <div class="top-info-list">

                    <!-- Venue -->
                    <a class="top-info-item top-info-venue"
                        href="https://maps.app.goo.gl/ypF9qMT3WsSx9hHb8"
                        target="_blank"
                        rel="noopener noreferrer">

                        <i class="fas fa-map-pin"></i>

                        <span>
                            {{ config('app.site_venue') }}
                        </span>
                    </a>

                    <!-- Date -->
                    <a class="top-info-item top-info-date" href="#">
                        <i class="fas fa-calendar-alt"></i>

                        <span>
                            {{ config('app.front_header_date') }}
                        </span>
                    </a>

                    <!-- Phone -->
                    <a class="top-info-item top-info-phone"
                        href="tel:+919898121818">

                        <i class="fas fa-phone-alt"></i>

                        <span>
                            +91 9898121818
                        </span>
                    </a>

                    <!-- Jaipur edition -->
                    <a class="optic-edition-link"
                        href="https://opticexhibition.com/Jaipur/"
                        target="_blank"
                        rel="noopener noreferrer">

                        <span class="optic-edition-icon">
                            <i class="fas fa-map-marker-alt"></i>
                        </span>

                        <span class="optic-edition-content">
                            <small>Explore Edition</small>
                            <strong>Jaipur</strong>
                        </span>

                        <span class="optic-edition-arrow">
                            <i class="fas fa-chevron-right"></i>
                        </span>
                    </a>

                </div>
            </div>

            <div class="col-lg-2 col-12">
                <ul class="s-icon top-social-list">
                    <li>
                        <a href="https://www.facebook.com/opticexpoindia"
                            target="_blank"
                            rel="noopener noreferrer">
                            <i class="fab fa-facebook-square"></i>
                        </a>
                    </li>

                    <li>
                        <a href="https://www.instagram.com/opticexpoindia/"
                            target="_blank"
                            rel="noopener noreferrer">
                            <i class="fab fa-instagram-square"></i>
                        </a>
                    </li>
                </ul>
            </div>

        </div>
    </div>
</div>
    </div>

    <section class="bg-white">
        <div class="container">

            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="middle-bar">
                        <div class="logo d-flex">
                            <a href="{{ route('FrontIndex') }}">
                                <img src="{{ asset('assets/front/img/optic-2024.png') }}" alt="">
                            </a>
                        </div>

                        <div class="spo-logo">
                            <img style="height: 90px;width: 200px;object-fit: contain;"
                                src="{{ asset('assets/front/img/Optic-Expo-Asso.png') }}" alt="">
                            <img src="{{ asset('assets/front/img/Optic-Expo-Arise.png') }}" alt="">
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Middle bar End -------------------------------->
    <section class="bo">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="main-menu-bar">
                        <nav class="navbar navbar-expand-lg">
                            <div class="container">
                                <!-- <a class="navbar-brand" href="#">Navbar</a> -->
                                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
                                    aria-label="Toggle navigation">
                                    <i class="fas fa-stream navbar-toggler-icon"></i>
                                    <!-- <i class="fa-solid fa-bars"></i> -->
                                </button>
                                <div class="collapse navbar-collapse" id="navbarNav">
                                    <ul class="navbar-nav">
                                        <li class="nav-item">
                                            <div class="dropdown">
                                                <button
                                                    class="dropbtn @if (request()->routeIs('FrontIndex')) {{ 'active' }} @endif">
                                                    <a href="{{ route('FrontIndex') }}" class="home">HOME</a>
                                                </button>
                                            </div>
                                        </li>
                                        <li class="nav-item">
                                            <div class="dropdown">
                                                <a href="{{ route('FrontAbout') }}">
                                                    <button
                                                        class="dropbtn @if (request()->routeIs('FrontAbout')) {{ 'active' }} @endif">ABOUT
                                                        US</button>
                                                </a>
                                            </div>
                                        </li>


                                        <li class="nav-item">
                                            <div class="dropdown">
                                                <a href="{{ route('FrontExhibitor_Profile') }}">
                                                    <button
                                                        class="dropbtn @if (request()->routeIs('FrontExhibitor_Profile')) {{ 'active' }} @endif">Exhibitor
                                                        Profile</button>
                                                </a>
                                            </div>
                                        </li>
                                        <li class="nav-item">
                                            <div class="dropdown">
                                                <a href="{{ route('visitors_profile') }}">
                                                    <button
                                                        class="dropbtn @if (request()->routeIs('visitors_profile')) {{ 'active' }} @endif">VISITOR
                                                        PROFILE</button>
                                                </a>
                                            </div>
                                        </li>
                                        <li class="nav-item">
                                            <div class="dropdown">
                                                <a href="{{ route('FrontFloor_Plan') }}">
                                                    <button
                                                        class="dropbtn @if (request()->routeIs('FrontFloor_Plan')) {{ 'active' }} @endif">Floor
                                                        Plan</button>
                                                </a>
                                            </div>
                                        </li>
                                        <li class="nav-item">
                                            <div class="dropdown">
                                                <a href="{{ route('FrontVenue') }}">
                                                    <button
                                                        class="dropbtn @if (request()->routeIs('FrontVenue')) {{ 'active' }} @endif">VENUE</button>
                                                </a>
                                            </div>
                                        </li>
                                        <li class="nav-item">
                                            <div class="dropdown">
                                                <a href="{{ route('FrontContact') }}">
                                                    <button
                                                        class="dropbtn @if (request()->routeIs('FrontContact')) {{ 'active' }} @endif">CONTACT
                                                        US</button>
                                                </a>
                                            </div>
                                        </li>
                                        <li class="nav-item">
                                            <div class="dropdown">
                                                <a href="{{ route('FrontExhibitor_Login') }}">
                                                    <button
                                                        class="dropbtn @if (request()->routeIs('FrontExhibitor_Login')) {{ 'active' }} @endif">Exhibitor
                                                        Login</button>
                                                </a>
                                            </div>
                                        </li>
                                        <li class="nav-item">
                                            <div class="dropdown">
                                                <a href="{{ route('FrontBlog') }}">
                                                    <button 
                                                        class="dropbtn @if (request()->routeIs('FrontBlog')) {{ 'active' }} @endif">Blog</button>
                                                </a>
                                            </div>
                                        </li>
                                        <li class="nav-item">
                                            <div class="dropdown" style="margin-top:10px;">
                                                <a href="http://seminars.opticexhibition.com/" target="_blank"
                                                    <button 
                                                        class="dropbtn @if (request()->routeIs('FrontBlog')) {{ 'active' }} @endif"> Seminars </button>
                                                </a>
                                            </div>
                                        </li>
                                        <!--  <li class="nav-item"><div class="dropdown"><button class="dropbtn">VISITOR REGISTRATION</button><div class="dropdown-content"><a href="#">Link 1</a><a href="#">Link 2</a><a href="#">Link 3</a></div> -->
                                        <li class="nav-item">
                                            <div class="dropdown">
                                                <a href="{{ route('FrontVisitor_Registration') }}">
                                                    <button style="background: white;
                                                        border: none;
                                                        font-size: 16px;
                                                        padding: 7px;
                                                        color: #1F5CA9;
                                                        margin: 4px 0px;
                                                        border-radius: 4px;">VISITOR
                                                        REGISTRATION</button>
                                                </a>
                                            </div>
                                        </li>
                                        

                                </div>
                                </li>
                                </ul>
                            </div>
                    </div>
                    </nav>
                </div>
            </div>
        </div>
        </div>
    </section>
</header>