@extends('layouts.app')

@section('content')
    <fieldset class="border p-2 rounded">

        <legend class="float-none w-auto px-2 fs-6">
            Search Employee
        </legend>

        {{--        <input type="text" class="form-control-sm ">--}}
        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <button type="button" id="seacrhEmp" class="btn btn-primary btn-sm">
                Search
            </button>
        </div>

    </fieldset>
    <fieldset class="border p-2 rounded">
        <legend class="float-none w-auto px-2 fs-6">
            Leave Application
        </legend>

        <div class="container">
            <div class="row mt-3">
                <div class="col-4">
                    <input type="text" class="form-control bg-light text-dark" id="employeeId" name="employeeId"
                           value=""
                           hidden=""
                    >
                    <label class="col-form-label mb-0" for="employeeName"> Employee Name</label>
                    <input type="text" class="form-control bg-light text-dark" id="employeeName" name="employeeName"
                           value=""
                           readonly>
                </div>
                <div class="col-4">
                    <input type="text" class="form-control bg-light text-dark" id="departmentId" name="departmentId"
                           value="" hidden="">
                    <label class="col-form-label mb-0" for="departmentName"> Department</label>
                    <input type="text" class="form-control bg-light text-dark" id="departmentName" name="departmentName"
                           value="" readonly>
                </div>
                <div class="col-4">
                    <input type="text" class="form-control bg-light text-dark" id="jobId" name="jobId" value=""
                           hidden="">
                    <label class="col-form-label small" for="jobTitle"> Designation</label>
                    <input type="text" class="form-control bg-light text-dark" id="jobTitle" name="jobTitle" value=""
                           readonly>
                </div>
            </div>
        </div>
    </fieldset>
    {{-- -----Seach List Modal------}}
    <div class="modal fade" id="employeeModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Select Employee</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <table class="table table-bordered table-sm">
                        <thead>
                        <tr CLASS="text-center">
                            <th>Name</th>
                            <th>Department</th>
                            <th>Designation</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody id="employeeTable">
                        <!-- Dynamic Data -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection


@push('scripts')
    <script>
        $(document).ready(function () {

            $('#seacrhEmp').click(function () {
                // console.log("Button clicked");

                $.ajax({
                    url: "{{route('leave.emp-search')}}",
                    type: 'GET',

                    success: function (data) {
                        //    console.log("Data:", data);
                        let rows = '';
                        data.forEach(emp => {
                            rows += `
                                <tr>
                                    <td>${emp.first_name}</td>
                                    <td>${emp.department_name}</td>
                                    <td>${emp.job_title}</td>
                                    <td class="text-center">
                                        <button class="btn btn-success btn-sm selectEmp"
                                                data-employee-id="${emp.employee_id}"
                                                data-first-name="${emp.first_name}"
                                                data-last-name="${emp.last_name}"
                                                data-department-id="${emp.department_id}"
                                                data-department-name="${emp.department_name}"
                                                data-job-id="${emp.job_id}"
                                                data-job-title="${emp.job_title}">
                                            Select
                                        </button>
                                    </td>
                                </tr> `;
                        });

                        $('#employeeTable').html(rows);

                        let modal = new bootstrap.Modal(document.getElementById('employeeModal'));
                        modal.show();
                    },

                    error: function (err) {
                        console.log("Error:", err.responseText);
                    }
                });
            });

            // --- Modal open Hide---
            $(document).on('click', '.selectEmp', function () {

                $('#employeeId').val($(this).data('employeeId'));
                $('#employeeName').val($(this).data('firstName') + ' ' + $(this).data('lastName'));
                $('#departmentId').val($(this).data('departmentId'));
                $('#departmentName').val($(this).data('departmentName'));
                $('#jobId').val($(this).data('jobId'));
                $('#jobTitle').val($(this).data('jobTitle'));

                bootstrap.Modal.getInstance(document.getElementById('employeeModal')).hide();
            });

            // $(document).on('click', '.selectEmp', function () {
            //
            //     $('#employeeId').val($(this).data('employee_id'));
            //     $('#employeeName').val($(this).data('first_name'));
            //     $('#departmentID').val($(this).data('department_id'));
            //     $('#departmentName').val($(this).data('department_name'));
            //     $('#jobID').val($(this).data('job_id'));
            //     $('#jobTitle').val($(this).data('job_title'));
            //
            //     // Hide modal
            //     let modalEl = document.getElementById('employeeModal');
            //     let modal = bootstrap.Modal.getInstance(modalEl);
            //     modal.hide();
            // });

        });
    </script>
@endpush
