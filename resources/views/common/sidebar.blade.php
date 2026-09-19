<!-- ========== App Menu ========== -->
<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <!-- Dark Logo-->
        <a href="{{ route('home') }}" class="logo logo-dark">
            <span class="logo-sm">
                <img src="{{ asset('assets/front/img/optic-2024.png') }}" alt="" height="16">
            </span>
            <span class="logo-lg">
                <img src="{{ asset('assets/front/img/optic-2024.png') }}" alt="" height="50">
            </span>
        </a>
        <!-- Light Logo-->
        <a href="{{ route('home') }}" class="logo logo-light">
            <span class="logo-sm">
                <img src="{{ asset('assets/front/img/optic-2024.png') }}" alt="" height="16">
            </span>
            <span class="logo-lg">
                <img src="{{ asset('assets/front/img/optic-2024.png') }}" alt="" height="50">
            </span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover"
            id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <div id="scrollbar">
        <div class="container-fluid">

            <div id="two-column-menu">
            </div>
            <?php //dd(Auth::user()->role_id);
            ?>
            <ul class="navbar-nav" id="navbar-nav">
                @if(Auth::user()->role_id == 1 || Auth::user()->role_id == 3)
                    <li class="menu-title"><span data-key="t-menu"></span></li>
                    <li class="nav-item">
                        <a class="nav-link menu-link @if (request()->routeIs('home')) {{ 'active' }} @endif"
                            href="{{ route('home') }}">
                            <i class="fa-solid fa-gauge "></i>
                            <span data-key="t-dashboards">Dashboards</span>
                        </a>
                    </li>
                @endif                    

                @if(Auth::user()->role_id == 1)    
                 <li class="nav-item">
                    <a class="nav-link menu-link @if (request()->routeIs('brochure.index')) {{ 'active' }} @endif"
                        href="{{ route('brochure.index') }}">
                        <i class="fa-solid fa-store "></i>
                        <span data-key="t-dashboards">Book My Stall</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link @if (request()->routeIs('users.index')) {{ 'active' }} @endif || @if (request()->routeIs('users.create')) {{ 'active' }} @endif"
                        href="#sidebarApps" data-bs-toggle="collapse" role="button" aria-expanded="false"
                        aria-controls="sidebarApps">
                        <i class="fa-solid fa-user-plus "></i>
                        <span data-key="t-apps">User</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarApps">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('users.create') }}" class="nav-link" data-key="t-chat"> Add New</a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ route('users.index') }}" class="nav-link" data-key="t-calendar"> List
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link menu-link" href="{{ route('csvupload.index') }}">

                                    <span data-key="t-dashboards">Upload CSV</span>
                                </a>
                            </li>


                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                        <a class="nav-link menu-link @if (request()->routeIs('employees.index')) {{ 'active' }} @endif"
                            href="{{ route('employees.index') }}">
                            <i class="fa-solid fa-user-plus "></i>
                            <span data-key="t-dashboards"> Employees </span>
                        </a>
                    </li>
                <li class="nav-item">
                    <a class="nav-link menu-link @if (request()->routeIs('SMSData.index')) {{ 'active' }} @endif"
                        href="{{ route('SMSData.index') }}">
                        <i class="fa-brands fa-whatsapp  fa-lg"></i>
                        <span data-key="t-dashboards"> Whatsapp invites</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link @if (request()->routeIs('visitor.index')) {{ 'active' }} @endif"
                        href="{{ route('visitor.index') }}">
                        <i class="fa-solid fa-users "></i>
                        <span data-key="t-dashboards">Visitor</span>
                    </a>
                </li>
                <li class="nav-item">
                        <a class="nav-link menu-link @if (request()->routeIs('visitor.international_index')) {{ 'active' }} @endif"
                            href="{{ route('visitor.international_index') }}">
                            <i class="fa-solid fa-users "></i>
                            <span data-key="t-dashboards">International Visitor</span>
                        </a>
                    </li>
    

                <li class="nav-item">
                    <a class="nav-link menu-link @if (request()->routeIs('furnituremaster.index')) {{ 'active' }} @endif"
                        href="{{ route('furnituremaster.index') }}">
                        <i class="fa-solid fa-couch  fa-sm"></i>
                        <span data-key="t-dashboards"> Furniture Master</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link @if (request()->routeIs('exhibitor_services.exhibitor_details')) {{ 'active' }} @endif || @if (request()->routeIs('exhibitor_services.exhibitor_lanyard')) {{ 'active' }} @endif || @if (request()->routeIs('exhibitor_services.additional_furniture')) {{ 'active' }} @endif || @if (request()->routeIs('exhibitor_services.exhibitorvendor')) {{ 'active' }} @endif"
                        href="{{ route('exhibitor_services.exhibitor_details') }}">
                        <i class="fa-solid fa-gears "></i>
                        <span data-key="t-dashboards"> Exhibitor Services</span>
                    </a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link menu-link @if (request()->routeIs('floor_plan.index')) {{ 'active' }} @endif"
                        href="{{ route('floor_plan.index') }}">
                        <i class="fa-solid fa-gears "></i>
                        <span data-key="t-dashboards"> Floor Plan</span>
                    </a>
                </li>
                <li class="nav-item">
                        <a class="nav-link menu-link @if (request()->routeIs('blog.index')) active @endif"
                            href="{{ route('blog.index') }}">
                            <i class="fa-solid fa-blog"></i>
                            <span data-key="t-dashboards"> Blog </span>
                        </a>
                    </li>
                
                @elseif(Auth::user()->role_id == 3)
                <li class="nav-item">
                    <a class="nav-link menu-link @if (request()->routeIs('employees_module.index')) {{ 'active' }} @endif"
                        href="{{ route('employees_module.index') }}">
                        <i class="fa fa-address-book" aria-hidden="true"></i>

                        <span data-key="t-dashboards"> Visitor Registration </span>
                    </a>
                </li>
                @endif


            </ul>

        </div>
        <!-- Sidebar -->
    </div>

    <div class="sidebar-background"></div>
</div>
<!-- Left Sidebar End -->
<!-- Vertical Overlay-->
<div class="vertical-overlay"></div>
