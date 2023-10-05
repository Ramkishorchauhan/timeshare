<div class="header">
    <nav class="navbar">
        <div class="navbar-menu-wrapper">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link toggle-sidebar mon-icon-bg">
                        <i class="iconsax" icon-name="menu-hamburger">
                            <img src="https://nileprojects.in/timesharesimplified/public/admin_assets/plugins/Iconsax/icons/menu-hamburger.svg">
                        </i>
                    </a>
                </li>
            </ul>
            <ul class="navbar-nav">
                <li class="nav-item profile-dropdown dropdown">
                    <a class="nav-link dropdown-toggle" id="profile" data-bs-toggle="dropdown" aria-expanded="false">
                        <div  class="profile-pic"><img src="{{asset('public/admin_assets/images/user.jpg')}}" alt="user"> </div>
                    </a>

                    <div class="dropdown-menu">
                        <a href="#" class="dropdown-item">
                            <i class="las la-user"></i> Profile
                        </a>
                        <a href="{{url('admin/logout')}}" class="dropdown-item">
                            <i class="las la-sign-out-alt"></i> Logout
                        </a>
                    </div>
                </li>

            </ul>

            </ul>
        </div>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
            <span class="icon-menu"></span>
        </button>
    </nav>
</div>