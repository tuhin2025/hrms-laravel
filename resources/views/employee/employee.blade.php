@extends('layouts.app')

@section('content')

    <div class="container-fluid">

        <!-- ================= FORM ================= -->
        <fieldset class="border p-2 rounded mb-3">
            <legend class="float-none w-auto px-2 fs-6">
                {{ isset($employee) ? 'Edit Employee' : 'Add Employee' }}
            </legend>

            <div class="card border-0 shadow-sm">
                <div class="card-body">

                    <form id="empForm" method="POST"
                          action="{{ isset($employee) ? route('employee.emp-update',$employee->employee_id) : route('employee.emp-store') }}"
                          enctype="multipart/form-data">

                        @csrf
                        @if(isset($employee))
                            @method('PUT')
                        @endif

                        <div class="row">

                            <!-- ================= LEFT (8) ================= -->
                            <div class="col-md-9">
                                <!-- Row 1 -->
                                <div class="row g-2 mb-2">
                                    <div class="col-md-4">
                                        <label>First Name</label>
                                        <input type="text" name="first_name" id="first_name"
                                               class="form-control form-control-sm"
                                               value="{{ old('first_name', isset($employee) ? $employee->first_name : '') }}">
                                    </div>

                                    <div class="col-md-4">
                                        <label>Last Name</label>
                                        <input type="text" name="last_name" id="last_name"
                                               class="form-control form-control-sm"
{{--                                               value="{{ old('last_name', $employee->last_name ?? '') }}">--}}
                                        value="{{ old('last_name', isset($employee) ? $employee->last_name : '') }}">
                                    </div>

                                    <div class="col-md-4">
                                        <label>Email</label>
                                        <input type="email" name="email" id="email"
                                               class="form-control form-control-sm"
{{--                                               value="{{ old('email', $employee->email ?? '') }}">--}}
                                               value="{{ old('email', isset($employee) ? $employee->email : '') }}">
                                    </div>
                                </div>

                                <!-- Row 2 -->
                                <div class="row g-2 mb-2">
                                    <div class="col-md-4">
                                        <label>Phone</label>
                                        <input type="text" name="phone_number"
                                               class="form-control form-control-sm"
{{--                                               value="{{ old('phone_number', $employee->phone_number ?? '') }}">--}}
                                               value="{{ old('email', isset($employee) ? $employee->phone_number : '') }}">
                                    </div>

                                    <div class="col-md-4">
                                        <label>Hire Date</label>
                                        <input type="date" name="hire_date" id="hire_date"
                                               class="form-control form-control-sm"
                                               value="{{ old('hire_date', $employee->hire_date ?? \Carbon\Carbon::now()->format('Y-m-d')) }}">
                                    </div>

                                    <div class="col-md-4">
                                        <label>Job</label>
                                        <select name="job_id" id="job_id"
                                                class="form-control form-control-sm">
                                            <option value="">Select One</option>
                                            @foreach($job as $jobs)
                                                <option value="{{ $jobs->job_id }}"
                                                    {{ old('job_id', $employee->job_id ?? 'IT_PROG') == $jobs->job_id ? 'selected' : '' }}>
                                                    {{ $jobs->job_title }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <!-- Row 3 -->
                                <div class="row g-2 mb-2">
                                    <div class="col-md-4">
                                        <label>Salary</label>
                                        <input type="number" name="salary" id="salary"
                                               class="form-control form-control-sm"
                                               value="{{ old('salary', $employee->salary ?? '') }}">
                                    </div>

                                    <div class="col-md-4">
                                        <label>Manager</label>
                                        <select name="manager_id" class="form-control form-control-sm">
                                            <option value="">Select One</option>
                                            @foreach($employees as $emp)
                                                @if($emp->employee_id != ($employee->employee_id ?? 0))
                                                    <option value="{{ $emp->employee_id }}"
                                                        {{ old('manager_id', $employee->manager_id ?? '111') == $emp->employee_id ? 'selected' : '' }}>
                                                        {{ $emp->full_name }}
                                                    </option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-4">
                                        <label>Department</label>
                                        <select name="department_id"
                                                class="form-control form-control-sm">
                                            <option value="">Select One</option>
                                            @foreach($departments as $dept)
                                                <option value="{{ $dept->department_id }}"
                                                    {{ old('department_id', $employee->department_id ?? '10') == $dept->department_id ? 'selected' : '' }}>
                                                    {{ $dept->department_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <!-- Status -->
                                <div class="row mb-2">
                                    <div class="col-md-4">
                                        <input type="hidden" name="active_status" value="N">

                                        <div class="form-check">
                                            <input class="form-check-input"
                                                   type="checkbox"
                                                   name="active_status"
                                                   value="Y"
                                                {{ old('active_status', $employee->active_status ?? 'Y') == 'Y' ? 'checked' : '' }}>
                                            <label class="form-check-label">Active</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- ================= RIGHT (4) ================= -->
                            <div class="col-md-3">

                                <div class="card shadow-sm border-0 p-3 text-center">

                                    <!-- IMAGE PREVIEW -->
                                    <div class="mb-3">
                                        <div class="border rounded mx-auto"
                                             style="width:160px;height:150px;overflow:hidden;">
                                            <img id="previewImage"
                                                 src="{{ !empty($employee->emp_image) ? 'data:image/png;base64,'.$employee->emp_image : '' }}"
                                                 style="width:100%;height:100%;object-fit:cover;
                                             {{ !empty($employee->emp_image) ? '' : 'display:none;' }}">
                                        </div>
                                    </div>

                                    <!-- FILE -->
                                    <input type="file"
                                           name="emp_image"
                                           id="emp_image"
                                           class="form-control form-control-sm mb-3"
                                           accept="image/*">

                                    <!-- BUTTON -->
                                    <div class="text-center">
                                        <button type="button"
                                                id="submitBtn"
                                                class="btn btn-success align-content-lg-center" style="width: 200px">
                                            {{ isset($employee) ? 'Update' : 'Save' }}
                                        </button>
                                    </div>

                                </div>

                            </div>

                        </div>

                    </form>

                </div>
            </div>
        </fieldset>

        <!-- ================= TABLE ================= -->
        <fieldset class="border p-2 rounded">
            <legend class="float-none w-auto px-2 fs-6">Employee List</legend>

            <div class="card-body">
                <table class="table table-bordered table-hover text-center">
                    <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Department</th>
                        <th>Job</th>
                        <th>Salary</th>
                        <th>Status</th>
                        <th>Image</th>
                        <th>Action</th>
                    </tr>
                    </thead>

                    <tbody>
                        @foreach($employees as $key => $emp)
                            <tr>
                                <td>
                                    {{ $employees->firstItem() + $loop->index }}
                                </td>
                                <td class="text-start">{{ $emp->full_name }}</td>
                                <td class="text-start">{{ $emp->email }}</td>
                                <td>{{ $emp->department->department_name ?? 'N/A' }}</td>
                                <td>{{ $emp->job->job_title ?? 'N/A' }}</td>
                                <td class="text-end">{{ $emp->salary }}</td>
                                <td>
                                    @if($emp->active_status == 'Y')
                                        <span class="badge bg-success">Active</span>
                                    @else
                                        <span class="badge bg-danger">Inactive</span>
                                    @endif
                                </td>
                                <td class="text-center">

                                    @if($emp->emp_image)

                                        <img src="data:image/png;base64,{{ $emp->emp_image }}"
                                             alt="Employee Image"
                                             class="border shadow-sm"
                                             width="50"
                                             height="50"
                                             style="object-fit: cover;">

                                    @else

                                        <span class="text-muted">No Image</span>

                                    @endif

                                </td>
                                <td>
                                    <a href="{{ route('employee.emp-edit',$emp->employee_id) }}"
                                       class="btn btn-sm btn-warning">Edit</a>

                                    <form action="{{ route('employee.emp-delete',$emp->employee_id) }}"
                                          method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')

                                        <button type="button"
                                                class="btn btn-sm btn-danger"
                                                onclick="confirmDelete(this)">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="mt-3 d-flex justify-content-end">
                    {{ $employees->links() }}
                </div>
            </div>
        </fieldset>

    </div>
@endsection


@push('scripts')
    <script>

        $('#submitBtn').on('click', function () {

            let firstName = $('#first_name').val().trim();
            let lastName = $('#last_name').val().trim();
            let email = $('#email').val().trim();

            if (firstName === '' || lastName === '' || email === '') {
                Swal.fire('Error', 'Required fields missing', 'error');
                return;
            }

            Swal.fire({
                title: 'Confirm?',
                text: "Save Employee?",
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Yes'
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#empForm').submit();
                }
            });

        });

        function confirmDelete(btn) {
            Swal.fire({
                title: 'Delete?',
                text: "This cannot be undone",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes'
            }).then((r) => {
                if (r.isConfirmed) {
                    btn.closest('form').submit();
                }
            });
        }

        $('#emp_image').on('change', function (e) {
            let file = e.target.files[0];
            let reader = new FileReader();

            reader.onload = function (e) {
                $('#previewImage').attr('src', e.target.result).show();
            }

            if (file) {
                reader.readAsDataURL(file);
            }
        });

        document.getElementById('emp_image').addEventListener('change', function (e) {

            const file = e.target.files[0];
            const preview = document.getElementById('previewImage');

            if (!file) {
                preview.style.display = "none";
                return;
            }

            const reader = new FileReader();

            reader.onload = function (event) {
                preview.src = event.target.result;
                preview.style.display = "block";
            }

            reader.readAsDataURL(file);
        });

    </script>
@endpush
@section('breadcrumb')
    <x-breadcrumb :items="[
        ['label' => 'Home', 'url' => url('/hr')],
        ['label' => 'Employees', 'url' => route('employee.index')],
        ['label' => isset($employee) ? 'Edit Employee' : 'Add Employee']
    ]"/>
@endsection
