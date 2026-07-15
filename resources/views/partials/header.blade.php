<style>
    :root{
        --sidebar-width:230px;
    }

    .sidebar{
        width:var(--sidebar-width);
    }

    .main{
        margin-left:var(--sidebar-width);
    }

    .header,
    .footer{
        left:var(--sidebar-width);
    }
</style>
<div class="header d-flex justify-content-between align-items-center px-3 shadow-sm">
    <button class="btn btn-outline-secondary btn-sm" id="sidebarToggle">
        <i class="fas fa-bars"></i>
    </button>
    <!-- Logo -->
    <div class="d-flex align-items-center">
        <i class="fas fa-users text-primary me-2 fs-4"></i>

        <h5 class="mb-0 fw-bold text-primary">
            HRM System
        </h5>
    </div>

    <!-- Slogan -->
    <div class="flex-grow-1 mx-4 d-none d-lg-block">

        <marquee behavior="scroll"
                 direction="left"
                 scrollamount="5"
                 onmouseover="this.stop();"
                 onmouseout="this.start();">

        <span class="text-muted fw-semibold">
            📢 Empowering Smart Human Resource Management &nbsp;&nbsp;&nbsp;&nbsp;|
            &nbsp;&nbsp;&nbsp;&nbsp;
            👨‍💼 Manage Employees Easily & Efficiently &nbsp;&nbsp;&nbsp;&nbsp;|
            &nbsp;&nbsp;&nbsp;&nbsp;
{{--            📊 Smart HR Analytics for Better Decisions &nbsp;&nbsp;&nbsp;&nbsp;|--}}
{{--            &nbsp;&nbsp;&nbsp;&nbsp;--}}
            🎯 Employee Performance • Payroll • Leave • Attendance
        </span>

        </marquee>

    </div>

    <!-- Right Side -->
    <div class="d-flex align-items-center">

        <!-- Notification -->
        <div class="dropdown me-3">

            <a href="#"
               class="notification-btn"
               data-bs-toggle="dropdown">

                <i class="fa-regular fa-bell"></i>

                @if($unreadCount>0)

                    <span class="notification-count">

                        {{ $unreadCount > 99 ? '99+' : $unreadCount }}

                    </span>
                @endif
            </a>

            <div class="dropdown-menu dropdown-menu-end notification-dropdown">
                <div class="notification-header">
                    <h6>
                        <i class="fas fa-bell me-2"></i>
                        Notifications
                    </h6>

                    <span class="badge bg-primary">
                        {{ $unreadCount }}
                    </span>
                </div>

                <div class="notification-body">

                    @forelse($notifications as $notification)
                        <a href="{{ route('hr.notification-read',$notification->id) }}"
                           class="notification-item">
                            <div class="notification-icon">

                                @switch($notification->type)
                                    @case('job')
                                    <i class="fas fa-briefcase"></i>
                                    @break
                                    @case('Dept')
                                    <i class="fas fa-briefcase"></i>
                                    @break
                                    @case('leave')
                                    <i class="fas fa-calendar-alt"></i>
                                    @break
                                    @case('EMP')
                                    <i class="fas fa-user-plus"></i>
                                    @break
                                    @default
                                    <i class="fas fa-bell"></i>
                                @endswitch
                            </div>

                            <div class="notification-content">
                                <div class="fw-bold">
                                    {{ $notification->title }}
                                </div>
                                <small>
                                    {{ $notification->message }}
                                </small>
                                <br>
                                <small class="text-muted">
                                    {{--                                    {{ $notification->created_at->diffForHumans() }}--}}
                                    {{ \Carbon\Carbon::parse($notification->insert_dt)->diffForHumans() }}
                                </small>
                            </div>

                            @if(!$notification->is_read)
                                <span class="notification-dot"></span>
                            @endif
                        </a>
                    @empty
                        <div class="text-center py-5">
                            <i class="far fa-bell-slash fa-3x text-muted mb-3"></i>
                            <div class="text-muted">
                                No Notifications
                            </div>
                        </div>
                    @endforelse
                </div>

                <div class="notification-footer">
                    <a href="#">
                        View All Notifications
                    </a>
                </div>
            </div>
        </div>

        <!-- User -->
        @if(Auth::check())

            <div class="dropdown">

                <a href="#"
                   data-bs-toggle="dropdown"
                   class="d-flex align-items-center text-decoration-none">

                    <img src="{{ asset('image/'.(Auth::user()->emp_image ?? 'tuhin.png')) }}"
                         class="rounded-circle border"
                         width="36"
                         height="36">
                    <span class="ms-2 fw-semibold">

                        {{ Auth::user()->username }}
                    </span>
                    <i class="fas fa-chevron-down ms-2 small"></i>
                </a>

                <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                        <form action="{{ route('auth.logout') }}"
                              method="POST">
                            @csrf
                            <button class="dropdown-item text-danger">
                                <i class="fas fa-sign-out-alt me-2"></i>
                                Logout
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        @endif
    </div>

</div>
<script>

    // document.getElementById('sidebarToggle').addEventListener('click', function () {
    //
    //     document.getElementById('sidebar').classList.toggle('collapsed');
    //
    //     document.querySelector('.main').classList.toggle('expanded');
    //
    //     document.querySelector('.header').classList.toggle('expanded');
    //
    //     document.querySelector('.footer').classList.toggle('expanded');
    //
    // });

    const root = document.documentElement;

    document.getElementById('sidebarToggle').onclick = function () {

        if(document.getElementById('sidebar').classList.toggle('collapsed')){
            root.style.setProperty('--sidebar-width','70px');
        }else{
            root.style.setProperty('--sidebar-width','230px');
        }

    }
</script>
