{{--<div class="header d-flex justify-content-between">--}}
{{--    <h4 class="fw-bold text-primary text-center">--}}
{{--        HR Management System--}}
{{--    </h4>--}}
{{--    <p class="mb-0 text-muted text-center">--}}
{{--        Smart HR Solution for Modern Organizations--}}
{{--    </p>--}}
{{--    <div>--}}
{{--        Admin |--}}
{{--        <a href="#">Logout</a>--}}
{{--    </div>--}}
{{--</div>--}}

<div class="header mb-0 d-flex justify-content-between align-items-center px-3 shadow-sm"
     style="height: 45px; background: #fff; position: fixed;  left: 230px; right: 0; z-index: 1000;">

    <!-- LEFT: Logo -->
    <div class="d-flex align-items-center gap-2">
        <span style="font-size: 18px;">🏢</span>
        <div>
            <h6 class="mb-0 fw-bold text-primary">HR Management System</h6>
        </div>
    </div>

    <!-- CENTER: Slogan Carousel -->
    <div class="flex-grow-1 mx-3 d-none d-md-block">

        <div id="headerCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="2500"
             data-bs-pause="hover">
            <div class="carousel-inner text-center">

                <div class="carousel-item active">
                    <small class="text-muted">
                        Empowering Smart Human Resource Management
                    </small>
                </div>

                <div class="carousel-item">
                    <small class="text-muted">
                        Manage Employees Easily & Efficiently
                    </small>
                </div>

                <div class="carousel-item">
                    <small class="text-muted">
                        Smart HR Analytics for Better Decisions
                    </small>
                </div>

            </div>

        </div>

    </div>

    <!-- RIGHT: optional -->
    <div>
        <form method="POST" action="{{ route('auth.logout') }}">
            @csrf

            <button type="submit" class="btn btn-danger btn-sm">
                Logout
            </button>
        </form>
    </div>

</div>
