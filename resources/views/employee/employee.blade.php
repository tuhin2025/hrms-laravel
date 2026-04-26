@extends('layouts.app')

@section('content')

    <div class="container mt-4">

        <!-- 🔵 Employee Info Form -->
        <div class="card mb-4 shadow-sm">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">
                    {{ isset($employee) ? '✏️ Edit Employee' : '➕ Add Employee' }}
                </h5>
            </div>

            <div class="card-body">
                <form method="POST"
                      action="{{ isset($employee) ? route('employee.emp-update',$employee->employee_id) : route('employee.emp-store') }}">

                    @csrf
                    @if(isset($employee)) @method('PUT') @endif

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label>First Name</label>
                            <input type="text" name="first_name" class="form-control"
                                   value="{{ old('first_name', $employee->first_name ?? '') }}">
                        </div>

                        <div class="col-md-4">
                            <label>Last Name</label>
                            <input type="text" name="last_name" class="form-control"
                                   value="{{ old('last_name', $employee->last_name ?? '') }}">
                        </div>

                        <div class="col-md-4">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control"
                                   value="{{ old('email', $employee->email ?? '') }}">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label>Phone</label>
                            <input type="text" name="phone_number" class="form-control"
                                   value="{{ old('phone_number', $employee->phone_number ?? '') }}">
                        </div>

                        <div class="col-md-4">
                            <label>Hire Date</label>
                            <input type="date" name="hire_date" class="form-control"
                                   value="{{ old('hire_date', $employee->hire_date ?? '') }}">
                        </div>

                        <div class="col-md-4">
                            <label>Job ID</label>
                            <input type="text" name="job_id" class="form-control"
                                   value="{{ old('job_id', $employee->job_id ?? '') }}">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label>Salary</label>
                            <input type="number" name="salary" class="form-control"
                                   value="{{ old('salary', $employee->salary ?? '') }}">
                        </div>

                        <div class="col-md-3">
                            <label>Manager ID</label>
                            <input type="number" name="manager_id" class="form-control"
                                   value="{{ old('manager_id', $employee->manager_id ?? '') }}">
                        </div>

                        <div class="col-md-3">
                            <label>Department ID</label>
                            <input type="number" name="department_id" class="form-control"
                                   value="{{ old('department_id', $employee->department_id ?? '') }}">
                        </div>
                    </div>

                    <div class="text-end">
                        <button class="btn btn-success">
                            {{ isset($employee) ? 'Update' : 'Save' }}
                        </button>
                    </div>

                </form>
            </div>
        </div>

        <!-- 🟢 Employee Data Table -->
        <div class="card shadow-sm">
            <div class="card-header bg-dark text-white">
                <h5 class="mb-0">📋 Employee List</h5>
            </div>

            <div class="card-body">
                <table class="table table-bordered table-hover text-center">
                    <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Department</th>
                        <th>Salary</th>
                        <th width="150">Action</th>
                    </tr>
                    </thead>

                    <tbody>
                    <tr>
                        <td>1</td>
                        <td>John Doe</td>
                        <td>john@mail.com</td>
                        <td>IT</td>
                        <td>50000</td>
                        <td>
                            <button class="btn btn-sm btn-warning">Edit</button>
                            <button class="btn btn-sm btn-danger">Delete</button>
                        </td>
                    </tr>
                    </tbody>

                </table>
            </div>
        </div>

    </div>

@endsection



