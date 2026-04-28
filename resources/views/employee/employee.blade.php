@extends('layouts.app')

@section('content')

    <div class="container mt-4">

        <!-- 🔵 Employee Info Form -->
        <div class="card mb-4 shadow-sm">
            <div class="card-header text-white d-flex justify-content-between align-items-center"
                 style="background: linear-gradient(135deg, #4e73df, #1cc88a); border-radius: 8px 8px 0 0;">

                <h5 class="mb-0 d-flex align-items-center gap-2">
                    <span style="font-size: 18px;">
                        {{ isset($employee) ? '✏️' : '➕' }}
                    </span>
                    <span>
                        {{ isset($employee) ? 'Edit Employee' : 'Add Employee' }}
                    </span>
                </h5>

                <span class="badge bg-light text-dark px-3 py-2">
                    {{ isset($employee) ? 'Edit Mode' : 'New Entry' }}
                </span>

            </div>


            <div class="card-body">
                <form id="empForm" method="POST"
                      action="{{ isset($employee) ? route('employee.emp-update',$employee->employee_id) : route('employee.emp-store') }}">

                    @csrf
                    @if(isset($employee))
                        @method('PUT')
                    @endif


                    <div class="row mb-3">
                        <div class="col-md-4">

                            <label>First Name</label>
                            @error('first_name')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                            <input type="text" name="first_name" id="first_name" class="form-control"
                                   value="{{ old('first_name', $employee->first_name ?? '') }}">

                        </div>

                        <div class="col-md-4">
                            <label>Last Name</label>
                            @error('last_name')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                            <input type="text" name="last_name" id="last_name" class="form-control"
                                   value="{{ old('last_name', $employee->last_name ?? '') }}">
                        </div>

                        <div class="col-md-4">
                            <label>Email</label>
                            <input type="email" name="email" id="email" class="form-control"
                                   value="{{ old('email', $employee->email ?? '') }}">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label>Phone</label>
                            <input type="text" name="phone_number" id="phone_number" class="form-control"
                                   value="{{ old('phone_number', $employee->phone_number ?? '') }}">
                        </div>

                        <div class="col-md-4">
                            <label>Hire Date</label>
                            <input type="date" name="hire_date" id="hire_date" class="form-control"
                                   value="{{ old('hire_date', $employee->hire_date ?? '') }}">
                        </div>
                        <div class="col-md-4">
                            <label>Job ID</label>

                            <select name="job_id" id="job_id" class="form-control">
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

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label>Salary</label>
                            <input type="number" name="salary" id='salary' class="form-control"
                                   value="{{ old('salary', $employee->salary ?? '') }}">
                        </div>

                        <div class="col-md-4">
                            <label>Manager ID</label>
                            <select name="manager_id" id="manager_id" class="form-control">
                                <option value="">Select One</option>

                                @foreach($employees as $emp)
                                    @if($emp->employee_id != ($employee->employee_id ?? 0))
                                        <option value="{{ $emp->employee_id }}"
                                            {{ old('manager_id', $employee->manager_id ?? '110') == $emp->employee_id ? 'selected' : '' }}>
                                            {{ $emp->full_name }}
                                        </option>
                                    @endif
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label>Department ID</label>

                            <select name="department_id" id="department_id" class="form-control">
                                <option value="">Select One</option>
                                @foreach($departments as $dept)
                                    <option value="{{ $dept->department_id }}"
                                        {{ old('department_id', $employee->department_id ?? '20') == $dept->department_id ? 'selected' : '' }}>
                                        {{ $dept->department_name }}
                                    </option>
                                @endforeach

                            </select>


                        </div>
                    </div>

                    <div class="text-end">
                        <button type="button" class="btn btn-success" id="submitBtn">
                            {{ isset($employee) ? 'Update' : 'Save' }}
                        </button>
                    </div>

                </form>
            </div>
        </div>

        <!--  Employee Data Table -->
        <div class="card shadow-sm">
            <div class="card-header text-white d-flex justify-content-between align-items-center"
                 style="background: linear-gradient(135deg, #4e73df, #1cc88a); border-radius: 8px 8px 0 0;">
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
                        <th>Jobs</th>
                        <th>Salary</th>
                        <th width="150">Action</th>
                    </tr>
                    </thead>

                    <tbody>

                    @foreach($employees as $key => $emp)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td class="text-start">{{ $emp->full_name }}</td>
                            <td class="text-start">{{ $emp->email }}</td>
                            <td class="text-start">{{ $emp->department->department_name ?? 'N/A' }}</td>
                            <td class="text-start">{{ $emp->job->job_title }}</td>
                            <td class="text-end">{{ $emp->salary }}</td>
                            <td>
                                <a href="{{ route('employee.emp-edit', $emp->employee_id) }}"
                                   class="btn btn-sm btn-warning">Edit</a>

                                <form action="{{ route('employee.emp-delete', $emp->employee_id) }}"
                                      method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')

                                    <button class="btn btn-sm btn-danger" type="button"
                                            onclick="confirmDelete(this)">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>

                </table>
            </div>
        </div>

    </div>

    @if(session('success'))
        <script>
            Swal.fire('Success!', '{{ session('success') }}', 'success');
        </script>
    @endif

@endsection



@push('scripts')
    <script>
        $(document).ready(function () {
            let $salaryInput = $('#salary');
            let $jobSelect = $('#job_id');
            let $hireDate = $('#hire_date');

            if (!$salaryInput.length || !$jobSelect.length || !$hireDate.length) {
                console.log("Elements not found");
                return;
            }
            const salaryMap = {
                "AD_PRES": 50000,
                "IT_PROG": 30000,
                "MK_OFF": 20000,
                "DI_OFF": 15000
            };

            let isEdit = "{{ isset($employee) ? '1' : '0' }}";
            let today = new Date().toISOString().split('T')[0];


            if (isEdit === "0" && $salaryInput.val() === "") {
                $salaryInput.val(10000);
                $hireDate.val(today);
            }
            $jobSelect.on('change', function () {
                    let selectedJob = $(this).val();
                    if (salaryMap[selectedJob]) {
                        $salaryInput.val(salaryMap[selectedJob]);
                    }

                }
            )


        });

    </script>

    {{--    <script>--}}
    {{--        document.addEventListener("DOMContentLoaded", function () {--}}
    {{--            let salaryInput = document.getElementById('salary');--}}
    {{--            let jobSelect = document.getElementById('job_id');--}}
    {{--            if (!salaryInput || !jobSelect) return;--}}
    {{--            const salaryMap = {--}}
    {{--                "AD_PRES": 50000,--}}
    {{--                "IT_PROG": 30000,--}}
    {{--                "SA_REP": 20000,--}}
    {{--                "HR_REP": 15000--}}
    {{--            };--}}

    {{--            let isEdit = "{{ isset($employee) ? '1' : '0' }}";--}}
    {{--            if (isEdit === "0" && salaryInput.value === "") {--}}
    {{--                salaryInput.value = 10000;--}}
    {{--            }--}}
    {{--            jobSelect.addEventListener('change', function () {--}}
    {{--                let selectedJob = this.value;--}}

    {{--                if (salaryMap[selectedJob]) {--}}
    {{--                    salaryInput.value = salaryMap[selectedJob];--}}
    {{--                }--}}
    {{--            });--}}
    {{--        });--}}

    {{--    </script>--}}


    <script>
        $(document).ready(function () {

            $('#submitBtn').on('click', function () {

                let firstName = $('#first_name').val().trim();
                let lastName = $('#last_name').val().trim();
                let email = $('#email').val().trim();


                let validations = [
                    { field: firstName, message: "First name required" },
                    { field: lastName, message: "Last name required" },
                    { field: email, message: "Email required" }
                ];

                for (let v of validations) {
                    if (v.field === "") {
                        Swal.fire("Error", v.message, "error");
                        return;
                    }
                }

                Swal.fire({
                    title: 'Are you sure?',
                    text: "Save?",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonText: 'Yes'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $('#empForm').submit();
                    }
                });

            });

        });
    </script>

    {{--    <script>--}}
    {{--        document.addEventListener("DOMContentLoaded", function () {--}}

    {{--            let btn = document.getElementById('submitBtn');--}}

    {{--            if (btn) {--}}

    {{--                btn.addEventListener('click', function () {--}}

    {{--                    Swal.fire({--}}
    {{--                        title: 'Are you sure?',--}}
    {{--                        text: "You want to save this data!",--}}
    {{--                        icon: 'warning',--}}
    {{--                        showCancelButton: true,--}}
    {{--                        confirmButtonColor: '#28a745',--}}
    {{--                        cancelButtonColor: '#d33',--}}
    {{--                        confirmButtonText: 'Yes, Save it!'--}}
    {{--                    }).then((result) => {--}}
    {{--                        if (result.isConfirmed) {--}}
    {{--                            document.getElementById('empForm').submit();--}}
    {{--                        }--}}
    {{--                    });--}}

    {{--                });--}}

    {{--            }--}}

    {{--        });--}}
    {{--    </script>--}}

    <script>
        function confirmDelete(button) {
            Swal.fire({
                title: 'Are you sure?',
                text: "This record will be deleted permanently!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {

                if (result.isConfirmed) {
                    button.closest('form').submit();
                }
            });
        }
    </script>

    {{--<script>--}}
    {{--    let employees = @json($job);--}}
    {{--    console.log(employees);--}}
    {{--</script>--}}

@endpush

