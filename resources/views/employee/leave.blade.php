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
                    <input type="text" class="form-control form-control-sm" id="employeeName" name="employeeName"
                           value=""
                           readonly>
                </div>
                <div class="col-4">
                    <input type="text" class="form-control bg-light text-dark" id="departmentId" name="departmentId"
                           value="" hidden="">
                    <label class="col-form-label-sm" for="departmentName"> Department</label>
                    <input type="text" class="form-control form-control-sm" id="departmentName" name="departmentName"
                           value="" readonly>
                </div>
                <div class="col-4">
                    <input type="text" class="form-control bg-light text-dark" id="jobId" name="jobId" value=""
                           hidden="">
                    <label class="col-form-label-sm" for="jobTitle"> Designation</label>
                    <input type="text" class="form-control form-control-sm" id="jobTitle" name="jobTitle" value=""
                           readonly>
                </div>
            </div>

            <div class="row mt-0">
                <div class="col-4">
                    <label class="col-form-label-sm" for="leaveStartDate">Leave Type</label>
                    <select class="form-control form-control-sm" name="leaveType" id="leaveType">
                        <option value="">Select One</option>
                        @foreach($leaveTypes as $leaveType)
                            <option value="{{$leaveType->leave_type_id}}">{{$leaveType->leave_type_name}}</option>
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
                    <input type="date" class="form-control form-control-sm" id="leaveEndDate" name="leaveEndDate"
                           value="" required>
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
                <button type="button" id="saveLeaveBtn" class="btn btn-success btn-sm" style="width: 200px;"> Save
                </button>
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


    {{-- Data list--}}
    <div class="mt-4">
        <div class="card">
            <div class="card-header">
                <strong>Leave Application List</strong>
            </div>

            <div class="card-body">
                <table class="table table-bordered table-sm">
                    <thead class="table-light">
                    <tr>
                        <th>Employee</th>
                        <th>Leave Type</th>
                        <th>From</th>
                        <th>To</th>
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
                $('#employeeName').val($(this).data('firstName') + ' ' + $(this).data('lastName')).trigger('change');
                $('#departmentId').val($(this).data('departmentId'));
                $('#departmentName').val($(this).data('departmentName'));
                $('#jobId').val($(this).data('jobId'));
                $('#jobTitle').val($(this).data('jobTitle'));

                bootstrap.Modal.getInstance(document.getElementById('employeeModal')).hide();
            });

            // cd editor for textarea
            ClassicEditor
                .create(document.querySelector('#leaveReason'))
                .catch(error => {
                    console.error(error);
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
    </script>

    {{--    save Leave application data--}}
    <script>
        $('#saveLeaveBtn').on('click', function () {

            let data = {
                employee_id: $('#employeeId').val(),
                leave_type: $('#leaveType').val(),
                from_date: $('#leaveStartDate').val(),
                to_date: $('#leaveEndDate').val(),
                total_days: $('#totalDays').val(),
                leave_reson: $('#leaveReason').val(),
            };
            // console.log(data);
            $.ajax({
                url: "{{ route('leave.store') }}",
                type: "POST",
                data: data,

                success: function (res) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: 'Leave Saved Successfully!',
                        timer: 2000,
                        showConfirmButton: false
                    });
                    loadLeaveList();
                    // optional reset
                    // $('#leaveForm')[0].reset();
                    // $('#totalDays').val('');
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

        });
    </script>

    {{--    View Leave application data--}}
    <script>
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
                            <td>${item.first_name ?? ''}</td>
                            <td>${item.department_name ?? ''}</td>
                            <td>${item.job_title ?? ''}</td>
                            <td>${item.leave_type_name ?? ''}</td>
                            <td>${item.from_date ?? ''}</td>
                            <td>${item.to_date ?? ''}</td>
                            <td>${item.total_days ?? ''}</td>
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
    </script>





@endpush
