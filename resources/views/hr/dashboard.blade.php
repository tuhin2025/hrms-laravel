@extends('layouts.app')

@section('content')

    <div class="row">

        <div class="col-md-4">
            <div class="card bg-primary text-white p-3">
                <h5>Employees</h5>
{{--                <h3>{{ $employeeCount }}</h3>--}}
            </div>
        </div>

        <div class="col-md-4">
            <div class="card bg-success text-white p-3">
                <h5>Departments</h5>
{{--                <h3>{{ $departmentCount }}</h3>--}}
            </div>
        </div>

        <div class="col-md-4">
            <div class="card bg-warning text-dark p-3">
                <h5>Jobs</h5>
{{--                <h3>{{ $jobCount }}</h3>--}}
            </div>
        </div>

    </div>

{{--    <hr>--}}

{{--    <h5>Recent Employees</h5>--}}

{{--    <table class="table table-bordered">--}}
{{--        <tr>--}}
{{--            <th>ID</th>--}}
{{--            <th>Name</th>--}}
{{--            <th>Department</th>--}}
{{--        </tr>--}}

{{--        @foreach($employees as $emp)--}}
{{--            <tr>--}}
{{--                <td>{{ $emp->employee_id }}</td>--}}
{{--                <td>{{ $emp->first_name }} {{ $emp->last_name }}</td>--}}
{{--                <td>{{ $emp->department->department_name ?? '' }}</td>--}}
{{--            </tr>--}}
{{--        @endforeach--}}
{{--    </table>--}}

@endsection
