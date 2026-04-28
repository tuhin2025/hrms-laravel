@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-md-4">
            <div class="card border-0 shadow-sm rounded-3 overflow-hidden">

                <div class="card-body d-flex justify-content-between align-items-center"
                     style="background: linear-gradient(135deg, #4e73df, #36b9cc); color: white;">

                    <div>
                        <h6 class="mb-1 text-uppercase text-center">Employees</h6>
                        <h2 class="mb-0 fw-bold text-center">{{ $employeeCount }}</h2>
                    </div>

                    <div style="font-size: 40px; opacity: 0.7;">
                        👨‍💼
                    </div>

                </div>

            </div>
        </div>

        <div class="col-md-4">
            <div class="card border-0 shadow-sm rounded-3 overflow-hidden">

                <div class="card-body d-flex justify-content-between align-items-center"
                     style="background: linear-gradient(135deg, #1cc88a, #17a673); color: white;">

                    <div>
                        <h6 class="mb-1 text-uppercase">Departments</h6>
                        <h2 class="mb-0 fw-bold text-center">{{ $departmentCount }}</h2>
                    </div>

                    <div style="font-size: 40px; opacity: 0.7;">
                        🏢
                    </div>

                </div>

            </div>
        </div>

        <div class="col-md-4">
            <div class="card border-0 shadow-sm rounded-3 overflow-hidden">

                <div class="card-body d-flex justify-content-between align-items-center"
                     style="background: linear-gradient(135deg, #C9C9FF, #1AEAEAFF); color: white;">

                    <div>
                        <h6 class="mb-1 text-uppercase ">Jobs</h6>
                        <h2 class="mb-0 fw-bold text-center">{{ $jobCount }}</h2>
                    </div>

                    <div style="font-size: 40px; opacity: 0.7;">
                        💼
                    </div>

                </div>

            </div>
        </div>

    </div>


@endsection
