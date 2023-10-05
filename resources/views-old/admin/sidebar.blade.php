<div class="sidebar-wrapper">
            <div class="sidebar-logo">
                <a href="/">
                    <img class="" src="{{asset('public/admin_assets/images/logo.png')}}" alt="">
                </a>
              <div class="back-btn"><i class="fa fa-angle-left"></i></div>
            </div>
            <div class="sidebar-nav">
                <nav class="sidebar sidebar-offcanvas" id="sidebar">
                    <ul class="nav">
                        <li class="nav-item @if($route_name=='admin.dashboard') active @endif">
                            <a class="nav-link" href="{{route('admin.dashboard')}}">
                                <span class="menu-icon"><i class="iconsax" icon-name="grid-apps">
                                    <img src="https://nileprojects.in/timesharesimplified/public/admin_assets/plugins/Iconsax/icons/grid-apps.svg">
                                </i></span>
                                <span class="menu-title">Dashboard</span>
                            </a>

                        </li>
                        <li class="nav-item @if($route_name=='admin.users' || Route::current()->uri() =='admin/users-details') active @endif">
                            <a class="nav-link" href="{{route('admin.users')}}">
                                <span class="menu-icon"><i class="iconsax" icon-name="users">
                                    <img src="https://nileprojects.in/timesharesimplified/public/admin_assets/plugins/Iconsax/icons/users.svg">
                                </i></span>
                                <span class="menu-title">Users</span>
                            </a>
                        </li>
                        
                        <li class="nav-item @if($route_name=='admin.contracts') active @endif">
                            <a class="nav-link" href="{{route('admin.contracts')}}">
                                <span class="menu-icon"><i class="iconsax" icon-name="document-text-1">
                                    <img src="https://nileprojects.in/timesharesimplified/public/admin_assets/plugins/Iconsax/icons/document-text-1.svg"></i></span>
                                <span class="menu-title">Contracts</span>
                            </a>
                        </li>

                        <li class="nav-item @if($route_name=='admin.points-estimation') active @endif">
                            <a class="nav-link" href="{{route('admin.points-estimation')}}">
                                <span class="menu-icon"><i class="iconsax" icon-name="coins-3">'
                                    <img src="https://nileprojects.in/timesharesimplified/public/admin_assets/plugins/Iconsax/icons/coins-3.svg">
                                </i></span>
                                <span class="menu-title">Points Estimation</span>
                            </a>
                        </li>

                        <li class="nav-item @if($route_name=='admin.manage-coupon') active @endif">
                            <a class="nav-link" href="{{route('admin.manage-coupon')}}">
                                <span class="menu-icon"><i class="iconsax" icon-name="ticket-discount">
                                    <img src="https://nileprojects.in/timesharesimplified/public/admin_assets/plugins/Iconsax/icons/ticket-discount.svg">
                                </i></span>
                                <span class="menu-title">Manage Coupon</span>
                            </a>
                        </li>
                        
                        <li class="nav-item @if($route_name=='admin.notification') active @endif">
                            <a class="nav-link" href="{{route('admin.notification')}}">
                                <span class="menu-icon"><i class="iconsax" icon-name="bell-2">
                                    <img src="https://nileprojects.in/timesharesimplified/public/admin_assets/plugins/Iconsax/icons/bell-2.svg">
                                </i></span>
                                <span class="menu-title">Manage App notification</span>
                            </a>
                        </li>

                        <li class="nav-item @if($route_name=='admin.help-support') active @endif">
                            <a class="nav-link" href="{{url('admin/help-support')}}">
                                <span class="menu-icon"><i class="iconsax" icon-name="headphones">
                                    <img src="https://nileprojects.in/timesharesimplified/public/admin_assets/plugins/Iconsax/icons/headphones.svg">
                                </i></span>
                                <span class="menu-title">Help & Support</span>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="collapse" href="#Settingsdropdown" >
                                <span class="menu-icon"><i class="iconsax" icon-name="setting-1">
                                    <img src="https://nileprojects.in/timesharesimplified/public/admin_assets/plugins/Iconsax/icons/setting-1.svg">
                                </i></span>
                                <span class="menu-title">Settings</span>
                                <span class="dropdown-icon"><i class="iconsax" icon-name="chevron-down"></i></span>
                            </a>
                            <ul class="collapse" id="Settingsdropdown">
                                <li class="@if($route_name=='admin.manage-points') active @endif"><a class="dropdown-item" href="{{route('admin.manage-points')}}">Manage Points</a></li>
                                <li class="@if($route_name=='admin.manage-developers') active @endif"><a class="dropdown-item" href="{{route('admin.manage-developers')}}">Manage Developers</a></li>
                                <li class="@if($route_name=='admin.manage-enrolled-type') active @endif"><a class="dropdown-item" href="{{route('admin.manage-enrolled-type')}}">Manage Developer Enrolls</a></li>
                               
                                <li class="@if($route_name=='admin.manage-budget') active @endif"><a class="dropdown-item" href="{{route('admin.manage-budget')}}">Manage Budget</a></li>
                                <li class="@if($route_name=='admin.manage-video') active @endif"><a class="dropdown-item" href="{{route('admin.manage-video')}}">Manage Videos</a></li>
                                <li class="@if($route_name=='admin.app-menu') active @endif"><a class="dropdown-item" href="{{route('admin.app-menu')}}">App Menu</a></li>
                            </ul>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{url('admin/logout')}}">
                                <span class="menu-icon"><i class="iconsax" icon-name="logout-1">
                                    <img src="https://nileprojects.in/timesharesimplified/public/admin_assets/plugins/Iconsax/icons/logout-1.svg">
                                </i></span>
                                <span class="menu-title">Logout</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>