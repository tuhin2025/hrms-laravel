@extends('layouts.app')

@section('content')
    <fieldset class="border p-2 rounded">

        <legend class="float-none w-auto px-2 fs-6">
            Search Employee
        </legend>

        <div class="col-8">
            <div class="row">
                <div class="col-4">
                    <label for="srcDepartmentId"> Department</label>
                    <input type="text" class="form-control form-control-sm" id="srcDepartmentId" name="srcDepartmentId"
                           placeholder="Search By Department">
                </div>
                <div class="col-4 d-flex align-items-end">
                    <button type="button" id="seacrhEmp" class="btn btn-primary btn-sm">
                        Search
                    </button>
                </div>
            </div>


            {{--        <input type="text" class="form-control-sm ">--}}
            {{--            <div class="d-grid gap-2 d-md-flex justify-content-md-end">--}}
            {{--                <button type="button" id="seacrhEmp" class="btn btn-primary btn-sm">--}}
            {{--                    Search--}}
            {{--                </button>--}}
            {{--            </div>--}}
        </div>
    </fieldset>
    <div>
        <form id="leaveForm" class="leave-form">

            <fieldset class="border p-2 rounded mt-0">
                <legend class="float-none w-auto px-2 fs-6">
                    Leave Application
                </legend>

                <div class="container">
                    <div class="row mt-0">
                        <div class="col-4">
                            <input type="text" class="form-control bg-light text-dark" id="employeeId" name="employeeId"
                                   value=""
                                   hidden=""
                            >
                            <label class="col-form-label-sm" for="employeeName"> Employee Name</label>
                            <input type="text" class="form-control form-control-sm" id="employeeName"
                                   name="employeeName"
                                   value=""
                                   readonly>
                        </div>
                        <div class="col-4">
                            <input type="text" class="form-control bg-light text-dark" id="departmentId"
                                   name="departmentId"
                                   value="" hidden="">
                            <label class="col-form-label-sm" for="departmentName"> Department</label>
                            <input type="text" class="form-control form-control-sm" id="departmentName"
                                   name="departmentName"
                                   value="" readonly>
                        </div>
                        <div class="col-4">
                            <input type="text" class="form-control bg-light text-dark" id="jobId" name="jobId" value=""
                                   hidden="">
                            <label class="col-form-label-sm" for="jobTitle"> Designation</label>
                            <input type="text" class="form-control form-control-sm" id="jobTitle" name="jobTitle"
                                   value=""
                                   readonly>
                        </div>
                    </div>

                    <div class="row mt-0">
                        <div class="col-4">
                            <label class="col-form-label-sm" for="leaveStartDate">Leave Type</label>
                            <select class="form-control form-control-sm" name="leaveType" id="leaveType">
                                <option value="">Select One</option>
                                @foreach($leaveTypes as $leaveType)
                                    <option
                                        value="{{$leaveType->leave_type_id}}">{{$leaveType->leave_type_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-3">
                            <label class="col-form-label-sm" for="leaveStartDate">Start Date</label>
                            <input type="date" class="form-control form-control-sm" id="leaveStartDate"
                                   name="leaveStartDate"
                                   value="" required>
                        </div>
                        <div class="col-3">
                            <label class="col-form-label-sm" for="leaveEndDate">End Date</label>
                            <input type="date" class="form-control form-control-sm" id="leaveEndDate"
                                   name="leaveEndDate"
                                   value="" required>
                            {{--                    <input required="" type="text" autocomplete="off" onkeydown="return false" name="leaveEndDate" id="leaveEndDate" class="form-control form-control-sm datetimepicker-input" data-target="#leaveEndDate" data-toggle="datetimepicker" value="" data-predefined-date="" placeholder="DD-MM-YYYY">--}}
                        </div>
                        <div class="col-2">
                            <label class="col-form-label-sm" for="totalDays">Total Date</label>
                            <input type="text" class="form-control form-control-sm" id="totalDays" name="totalDays"
                                   value="" disabled>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-form-label-sm">
                            <label for="leaveReason" class="form-label">Reason</label>
                            <textarea
                                class="form-control"
                                id="leaveReason"
                                name="leaveReason"
                                rows="5"
                                placeholder="Write your reason here..."></textarea>
                        </div>
                    </div>

                    <div class="d-grid justify-content-md-end mt-2 large">
                        <button type="button" id="saveLeaveBtn" class="btn btn-success btn-sm" style="width: 200px;">
                            Save
                        </button>
                    </div>
                </div>
            </fieldset>
        </form>
    </div>
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


    {{-- Data list--}}

    <fieldset class="border p-2 rounded mt-2">
        <legend class="float-none w-auto px-2 fs-6">
            Leave Application List
        </legend>
        {{--        Serach All Fields--}}
        <div class="mb-3 d-flex justify-content-end">
            <label for="leaveSearch" class="col-sm-2 col-form-label text-end">
                Search :
            </label>
            <div class="col-3">
                <input type="text" id="leaveSearch" class="form-control form-control-sm"
                       placeholder="Search employee, leave type, department, date, reason...">
            </div>
        </div>

        <div class="mt-4">
            <div class="card-body">
                <table class="table table-bordered table-sm mb-4">
                    <thead class="table-light">
                    <tr>
                        <th>Employee</th>
                        <th>Leave Type</th>
                        <th>From Date</th>
                        <th>To Date</th>
                        <th>Department</th>
                        <th>Jobtitle</th>
                        <th>Total Days</th>
                        <th>Reason</th>
                    </tr>
                    </thead>
                    <tbody id="leaveTable">
                    <!-- AJAX DATA -->
                    </tbody>
                </table>
            </div>
        </div>
    </fieldset>

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
                                    <td>${emp.first_name} ${emp.last_name}</td>
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
                $('#employeeName').val($(this).data('firstName') + ' ' + $(this).data('lastName')).trigger('change');
                $('#departmentId').val($(this).data('departmentId'));
                $('#departmentName').val($(this).data('departmentName'));
                $('#jobId').val($(this).data('jobId'));
                $('#jobTitle').val($(this).data('jobTitle'));

                bootstrap.Modal.getInstance(document.getElementById('employeeModal')).hide();
            });


            // Start and end date open when Employee is select
            $(document).ready(function () {

                function toggleFields() {
                    let firstName = $('#employeeName').val();

                    if (!firstName || firstName.trim() === '') {
                        $('#leaveStartDate, #leaveEndDate').prop('disabled', true);

                    } else {
                        $('#leaveStartDate, #leaveEndDate').prop('disabled', false);

                    }
                }

                $('#employeeName').on('input change', toggleFields);

                toggleFields();

            });

            // total leave days calculation

            $('#leaveStartDate, #leaveEndDate').on('change', function () {
                let startDate = $('#leaveStartDate').val();
                let endDate = $('#leaveEndDate').val();

                if (startDate !== '' && endDate !== '') {

                    let stDate = new Date(startDate);
                    let enDate = new Date(endDate);

                    let timeDiff = enDate - stDate;

                    // Convert to days
                    let days = timeDiff / (1000 * 60 * 60 * 24);

                    let totalDays = days + 1;
                    $('#totalDays').val(totalDays);
                }
            })
        });

        function loadLeaveList() {
            $.ajax({
                url: "{{ route('leave.view-data') }}",
                type: "GET",

                success: function (data) {
                    // console.log(data);
                    let rows = ''
                    data.forEach(item => {
                        rows += `
                        <tr>
                            <td>${item.first_name ?? ''} ${item.last_name ?? ''}</td>
                            <td>${item.leave_type_name ?? ''}</td>
                            <td>${item.from_date ?? ''}</td>
                            <td>${item.to_date ?? ''}</td>
                            <td>${item.department_name ?? ''}</td>
                            <td>${item.job_title ?? ''}</td>
                            <td>${item.total_days ?? ''}</td>
                            <td>${item.leave_reson ?? ''}</td>
                        </tr>`;
                    });
                    $('#leaveTable').html(rows);
                },
                error: function (err) {
                    console.log(err.responseText);
                }
            });

        }

        $(document).ready(function () {
            loadLeaveList();
        });


        // cd editor for textarea
        let leaveEditor;

        ClassicEditor
            .create(document.querySelector('#leaveReason'))
            .then(editor => {
                leaveEditor = editor;
            })
            .catch(error => {
                console.error(error);
            });

        /* function validateLeaveForm() {

             let employee_id = $('#employeeId').val();
             let leave_type = $('#leaveType').val();
             let from_date = $('#leaveStartDate').val();
             let to_date = $('#leaveEndDate').val();
             let total_days = $('#totalDays').val();
             let leave_reson = leaveEditor ? leaveEditor.getData() : '';

             if (!employee_id) return false;
             if (!leave_type) return false;
             if (!from_date) return false;
             if (!to_date) return false;
             if (new Date(from_date) > new Date(to_date)) return false;
             if (!total_days || total_days <= 0) return false;
             if (!leave_reson || leave_reson.trim() === '') return false;

             return true;
         }
         function toggleSaveButton() {
             $('#saveLeaveBtn').prop('disabled', !validateLeaveForm());
         }

         $(document).ready(function () {

             // initial state
             toggleSaveButton();

             $('#employeeId, #leaveType, #leaveStartDate, #leaveEndDate').on('change input', function () {
                 toggleSaveButton();
             });

             // CKEditor change detection
             if (leaveEditor) {
                 leaveEditor.model.document.on('change:data', () => {
                     toggleSaveButton();
                 });
             }

         }); */

        $('#saveLeaveBtn').on('click', function () {

            let employee_id = $('#employeeId').val();
            let employee_name = $('#employeeName').val();
            let leave_type = $('#leaveType').val();
            let from_date = $('#leaveStartDate').val();
            let to_date = $('#leaveEndDate').val();
            let total_days = $('#totalDays').val();
            let leave_reson = leaveEditor ? leaveEditor.getData() : '';

            // ======================
            // NULL VALIDATION
            // ======================
            if (!employee_id) {
                return Swal.fire('Error', 'Please select employee', 'error');
            }

            if (!leave_type) {
                return Swal.fire('Error', 'Please select leave type', 'error');
            }

            if (!from_date) {
                return Swal.fire('Error', 'Please select start date', 'error');
            }

            if (!to_date) {
                return Swal.fire('Error', 'Please select end date', 'error');
            }

            if (new Date(from_date) > new Date(to_date)) {
                return Swal.fire('Error', 'End date must be greater than start date', 'error');
            }

            if (!total_days || total_days <= 0) {
                return Swal.fire('Error', 'Invalid total days', 'error');
            }

            if (!leave_reson || leave_reson.trim() === '') {
                return Swal.fire('Error', 'Please enter leave reason', 'error');
            }

            // ======================
            // CONFIRMATION ALERT
            // ======================
            Swal.fire({
                title: `Mr. ${employee_name}`,
                text: `Do you want to submit?`,
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#28a745',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes!',
                cancelButtonText: 'Cancel'
            }).then((result) => {

                if (result.isConfirmed) {

                    let data = {
                        employee_id,
                        leave_type,
                        from_date,
                        to_date,
                        total_days,
                        leave_reson
                    };

                    $.ajax({
                        url: "{{ route('leave.store') }}",
                        type: "POST",
                        data: data,

                        success: function (res) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Saved!',
                                text: 'Leave submitted successfully',
                                timer: 2000,
                                showConfirmButton: false
                            });

                            loadLeaveList();

                            $('#leaveForm')[0].reset();
                            leaveEditor.setData('');
                            $('#leaveStartDate, #leaveEndDate').prop('disabled', true);
                        },

                        error: function (xhr) {

                            let message = "Something went wrong!";
                            if (xhr.responseJSON?.message) {
                                message = xhr.responseJSON.message;
                            }

                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: message
                            });

                            console.log(xhr.responseText);
                        }
                    });
                }
            });

        });

        $('#leaveSearch').on('keyup', function () {

            let value = $(this).val().toLowerCase();

            $('#leaveTable tr').filter(function () {

                $(this).toggle(
                    $(this).text().toLowerCase().indexOf(value) > -1
                );

            });

        });
    </script>

@endpush


@section('breadcrumb')
    <x-breadcrumb :items="[
    ['label' => 'Home', 'url' => url('/hr')],
    ['label' => 'leave', 'url' => route('leave.index')]
]"/>
@endsection
