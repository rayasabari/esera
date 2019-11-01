<div class="kt-header__topbar kt-grid__item">

    @if(Auth::user())
        <div class="kt-header__topbar-item kt-header__topbar-item--user mr-2"  data-toggle="kt-tooltip" title="" data-placement="right" data-original-title="Saldo Deposit">
            <div class="kt-header__topbar-wrapper" data-offset="10px,0px">
                <span class="kt-header__topbar-username">
                    {{-- <i class="kt-font-light kt-font-hover-warning"><i class="fa fa-money-bill-alt mr-1"></i></i> --}}
                </span>
                <span class="kt-header__topbar-username">
                    <a class="kt-font-light">Rp</a>
                </span>
                <span class="kt-header__topbar-username">
                    <a class="kt-font-light">
                        {{ isset($nipl) ? number_format($nipl->deposite,0,',','.') : 0 }},-
                    </a>
                </span>
            </div>
        </div>
    @endif

    <!--begin: User bar -->
    <div class="kt-header__topbar-item kt-header__topbar-item--user">
        @if(Auth::user())
        <div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="10px,0px">
            <span class="kt-header__topbar-welcome">Hi,</span>
            <span class="kt-header__topbar-username"><a href="/login" class="kt-font-light" >{{ Auth::user()->first_name }}</a></span>
            <span class="kt-header__topbar-icon"><b>{{ substr(Auth::user()->first_name, 0, 1) }}</b></span>
        </div>
        <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-xl">

            <!--begin: Head -->
            <div class="kt-user-card kt-user-card--skin-dark kt-notification-item-padding-x" style="background-image: url(assets/media/misc/bg-1.jpg)">
                <div class="kt-user-card__avatar">
                    <img class="kt-hidden" alt="Pic" src="assets/media/users/300_25.jpg" />

                    <!--use below badge element instead the user avatar to display username's first letter(remove kt-hidden class to display it) -->
                    <span class="kt-badge kt-badge--lg kt-badge--rounded kt-badge--bold kt-font-success">{{ substr(Auth::user()->first_name, 0, 1) }}</span>
                </div>
                <div class="kt-user-card__name">
                    {{ Auth::user()->first_name .' '. Auth::user()->last_name }}
                </div>
                <div class="kt-user-card__badge">
                    <span class="btn btn-success btn-sm btn-bold btn-font-md">23 messages</span>
                </div>
            </div>

            <!--end: Head -->

            <!--begin: Navigation -->
            <div class="kt-notification">
                <a href="custom/apps/user/profile-1/personal-information.html" class="kt-notification__item">
                    <div class="kt-notification__item-icon">
                        <i class="flaticon2-calendar-3 kt-font-success"></i>
                    </div>
                    <div class="kt-notification__item-details">
                        <div class="kt-notification__item-title kt-font-bold">
                            My Profile
                        </div>
                        <div class="kt-notification__item-time">
                            Account settings and more
                        </div>
                    </div>
                </a>
                <a href="custom/apps/user/profile-3.html" class="kt-notification__item">
                    <div class="kt-notification__item-icon">
                        <i class="flaticon2-mail kt-font-warning"></i>
                    </div>
                    <div class="kt-notification__item-details">
                        <div class="kt-notification__item-title kt-font-bold">
                            My Messages
                        </div>
                        <div class="kt-notification__item-time">
                            Inbox and tasks
                        </div>
                    </div>
                </a>
                <a href="custom/apps/user/profile-2.html" class="kt-notification__item">
                    <div class="kt-notification__item-icon">
                        <i class="flaticon2-rocket-1 kt-font-danger"></i>
                    </div>
                    <div class="kt-notification__item-details">
                        <div class="kt-notification__item-title kt-font-bold">
                            My Activities
                        </div>
                        <div class="kt-notification__item-time">
                            Logs and notifications
                        </div>
                    </div>
                </a>
                <a href="custom/apps/user/profile-3.html" class="kt-notification__item">
                    <div class="kt-notification__item-icon">
                        <i class="flaticon2-hourglass kt-font-brand"></i>
                    </div>
                    <div class="kt-notification__item-details">
                        <div class="kt-notification__item-title kt-font-bold">
                            My Tasks
                        </div>
                        <div class="kt-notification__item-time">
                            latest tasks and projects
                        </div>
                    </div>
                </a>
                <a href="custom/apps/user/profile-1/overview.html" class="kt-notification__item">
                    <div class="kt-notification__item-icon">
                        <i class="flaticon2-cardiogram kt-font-warning"></i>
                    </div>
                    <div class="kt-notification__item-details">
                        <div class="kt-notification__item-title kt-font-bold">
                            Billing
                        </div>
                        <div class="kt-notification__item-time">
                            billing & statements <span class="kt-badge kt-badge--danger kt-badge--inline kt-badge--pill kt-badge--rounded">2 pending</span>
                        </div>
                    </div>
                </a>
                <div class="kt-notification__custom kt-space-between">
                    <a target="_blank" class="btn btn-label btn-label-brand btn-sm btn-bold" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">Sign Out</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                    <a href="custom/user/login-v2.html" target="_blank" class="btn btn-clean btn-sm btn-bold">Upgrade Plan</a>
                </div>
            </div>
            <!--end: Navigation -->
        </div>
        @elseif(Auth::guest())
            <span class="kt-header__topbar-username"><a href="/login" class="kt-font-light" >Login</a></span>
        @endif
    </div>
    <!--end: User bar -->

</div>