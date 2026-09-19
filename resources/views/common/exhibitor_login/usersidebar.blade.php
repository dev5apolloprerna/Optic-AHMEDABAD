<!-- ========== App Menu ========== -->
<div class="app-menu navbar-menu" style="background: #ea5e20 !important;">
    <div id="scrollbar">
        <div class="container-fluid">
            <div id="two-column-menu"></div>
            <nav class="navbar navbar-expand-lg">
                <!--<a class="navbar-brand" href="#">Navbar</a>-->
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
                    <ul class="navbar-nav" id="navbar-nav">
                        <li class="menu-title"><span data-key="t-menu"></span></li>
                        <li class="nav-item">
                            <a class="nav-link menu-link @if (request()->routeIs('exhibitordashboard')) {{ 'active' }} @endif"
                                href="{{ route('exhibitordashboard') }}">
                                <i class="fa-solid fa-gauge"></i>
                                <span data-key="t-dashboards">Dashboards</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link menu-link @if (request()->routeIs('User.UploadedSMS')) {{ 'active' }} @endif"
                                href="{{ route('User.UploadedSMS') }}">
                                <i class="fa-brands fa-whatsapp fa-lg"></i>
                                <span data-key="t-dashboards"> Whatsapp einvites</span>
                            </a>
                        </li>

                          <li class="nav-item">
                            <a class="nav-link menu-link @if (request()->routeIs('User.visitorregistration')) {{ 'active' }} @endif"
                                href="{{ route('User.visitorregistration') }}">
                                <i class="fa-solid fa-users "></i>
                                <span data-key="t-dashboards">Visitor Registration</span>
                            </a>
                        </li>  

                        <li class="nav-item">
                            <a class="nav-link menu-link @if (request()->routeIs('User.exhibitor_details')) {{ 'active' }} @endif || @if (request()->routeIs('User.exhibitor_lanyard')) {{ 'active' }} @endif || @if (request()->routeIs('User.AdditionalFurniture')) {{ 'active' }} @endif || @if (request()->routeIs('User.ExhibitionVendor')) {{ 'active' }} @endif"
                                href="{{ route('User.exhibitor_details') }}">
                                <i class="fa-solid fa-gears"></i>
                                <span data-key="t-dashboards"> Exhibitor Services</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->
<!-- Vertical Overlay-->
