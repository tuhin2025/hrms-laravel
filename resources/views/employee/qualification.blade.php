@extends('layouts.app')

@section('content')
    <fieldset class="border rounded">
        <legend class="float-none w-auto px-1 fs-6">
            Employee Info
        </legend>
        <div class="container-fluid">

            <div class="card shadow mt-0 mb-2">

                <div class="card-body">

                    <form id="qualificationForm" action="{{ route('employee.qualification.store') }}" method="POST">
                    @csrf

                    <!-- Employee Information -->
                        <div class="row no-gutters">
                            <div class="col-md-3 mb-3">
                                <label>Employee <span class="text-danger">*</span></label>
                                <select name="employee_id"
                                        id="employee_id"
                                        class="form-control form-control-sm"
                                        required>
                                    <option value=""> Select Employee</option>
                                    @foreach($employees as $emp)
                                        <option value="{{ $emp->employee_id }}">
                                            {{ $emp->first_name . ' ' . $emp->last_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-3 mb-3">
                                <label>Employee Name</label>

                                <input type="text"
                                       class="form-control form-control-sm"
                                       id="employee_name"
                                       readonly>
                            </div>

                            <div class="col-md-3 mb-3">
                                <label>Department</label>

                                <input type="text"
                                       class="form-control form-control-sm"
                                       id="department"
                                       readonly>
                            </div>

                            <div class="col-md-3 mb-3">
                                <label>Designation</label>

                                <input type="text"
                                       class="form-control form-control-sm"
                                       id="designation"
                                       readonly>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <label>Remarks</label>
                                <textarea
                                    class="form-control form-control-sm"
                                    rows="2"
                                    name="remarks"
                                    id="remarks">{{ old('remarks', $master->remarks ?? '') }}</textarea>
                            </div>
                        </div>

                        <fieldset class="border p-1 rounded">

                            <legend class="float-none w-auto px-1 fs-6">
                                Qualification Details
                            </legend>

                            <!-- Qualification Entry -->

                            <div class="row gx-1">
                                <div class="col-md-2">
                                    <label>Level <span class="text-danger">*</span></label>

                                    <select class="form-control form-control-sm" id="level" required>
                                        <option value="1">SSC</option>
                                        <option value="2">HSC</option>
                                        <option value="3">Bachelor</option>
                                        <option value="4">Master</option>
                                    </select>
                                </div>

                                <div class="col-md-2">
                                    <label>Subject<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control form-control-sm" id="subject" required>
                                </div>

                                <div class="col-md-3">
                                    <label>Institute<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control form-control-sm" id="institute" required>
                                </div>

                                <div class="col-md-1">
                                    <label>Year<span class="text-danger">*</span></label>

                                    <select class="form-control form-control-sm text-center" id="year" required>
                                        {{--                                        <option value="">Year</option>--}}
                                        <option value="1">2020</option>
                                        <option value="2">2021</option>
                                        <option value="3">2022</option>
                                        <option value="4">2023</option>
                                    </select>
                                </div>

                                <div class="col-md-1">
                                    <label>Result<span class="text-danger">*</span></label>
                                    <input type="number"
                                           id="result"
                                           class="form-control form-control-sm text-end"
                                           step="0.01"
                                           min="0"
                                           max="5.00" required>
                                </div>

                                <div class="col-md-3">
                                    <label>Board/University<span class="text-danger">*</span></label>

                                    <div class="d-flex align-items-center">
                                        <input type="text"
                                               class="form-control form-control-sm me-2"
                                               id="board">

                                        <button type="button"
                                                id="addBtn"
                                                class="btn btn-success btn-sm">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <table class="table table-bordered table-sm mt-3">

                                <thead>
                                <tr class="text-center">
                                    <th>SL</th>
                                    <th>Level</th>
                                    <th>Subject</th>
                                    <th>Institute</th>
                                    <th>Year</th>
                                    <th>Result</th>
                                    <th>Board</th>
                                    <th>Action</th>
                                </tr>
                                </thead>

                                <tbody id="qualificationTable">

                                </tbody>

                            </table>
                        </fieldset>

                        <div class="text-end mt-1">

                            <button type="button"
                                    class="btn btn-primary"
                                    id="saveBtn">
                                Save
                            </button>
                            {{--                            <button class="btn btn-success">--}}
                            {{--                                Update--}}
                            {{--                            </button>--}}
                            <a href="{{ url()->previous() }}"
                               class="btn btn-secondary">
                                Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </fieldset>



    <!-- Detail Grid -->
    <fieldset class="border p-1 rounded mb-3">

        <legend class="float-none w-auto px-1 fs-6">
            Qualification List
        </legend>
        <div class="table-responsive">
            <table class="table table-bordered table-sm text-center">
                <thead class="thead-dark">
                <tr class="text-center">
                    <th width="5%">SL</th>
                    <th>Level</th>
                    <th>Degree</th>
                    <th>Subject</th>
                    <th>Institute</th>
                    <th>Year</th>
                    <th>Result</th>
                    <th>Board/University</th>
                    <th width="10%">Action</th>
                </tr>

                </thead>
                <tbody id="qualificationTableList">
                <tr>

                </tr>
                </tbody>
            </table>
        </div>
    </fieldset>
@endsection

@section('breadcrumb')
    <x-breadcrumb :items="[
    ['label' => 'Home', 'url' => url('/hr')],
    ['label' => 'Qualification', 'url' => route('employee.qualification.store')]
]"/>
@endsection

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function () {


        $("#saveBtn").click(function () {

            let employee_id = $("#employee_id").val();

            if (employee_id == "") {

                Swal.fire({
                    icon: "warning",
                    title: "Validation",
                    text: "Please select an employee."
                });

                $("#employee_id").focus();
                return;
            }

            if ($("#qualificationTable tr").length == 0) {

                Swal.fire({
                    icon: "warning",
                    title: "Validation",
                    text: "Please add at least one qualification."
                });
                return;
            }
            $("#qualificationForm").submit();

        });

        let sl = 1;

        $("#addBtn").click(function () {

            // $(document).on('click', '.addBtn', function () {
            let level = $("#level").val();
            let levelText = $("#level option:selected").text();
            let subject = $("#subject").val();
            let institute = $("#institute").val();
            let year = $("#year").val();
            let result = $("#result").val();
            let board = $("#board").val();

            if (level == '' || subject == '') {

                Swal.fire({
                    icon: 'warning',
                    title: 'Required Fields',
                    text: 'Please fill all required fields.',
                    confirmButtonText: 'OK'
                });

                return;
            }

            let row = `
                <tr>

                    <td>${sl}</td>

                    <td>
                        ${levelText}
                        <input type="hidden" name="level[]" value="${level}">
                    </td>

                    <td>
                        ${subject}
                        <input type="hidden" name="subject[]" value="${subject}">
                    </td>

                    <td>
                        ${institute}
                        <input type="hidden" name="institute[]" value="${institute}">
                    </td>

                    <td>
                        ${year}
                        <input type="hidden" name="year[]" value="${year}">
                    </td>

                    <td>
                        ${result}
                        <input type="hidden" name="result[]" value="${result}">
                    </td>

                    <td>
                        ${board}
                        <input type="hidden" name="board[]" value="${board}">
                    </td>

                    <td class="text-center">
                        <button type="button"
                                class="btn btn-warning btn-sm editRow">
                            <i class="fa fa-edit"></i>
                        </button>

                        <button type="button"
                                class="btn btn-danger btn-sm removeRow">
                            <i class="fa fa-trash"></i>
                        </button>
                    </td>

                </tr>
                `;

            $("#qualificationTable").append(row);

            sl++;

            $("#level").val('');
            $("#subject").val('');
            $("#institute").val('');
            $("#year").val('');
            $("#result").val('');
            $("#board").val('');

        });


        $(document).on('click', '.editRow', function () {

            let row = $(this).closest('tr');

            $("#level").val(row.find('input[name="level[]"]').val());
            $("#subject").val(row.find('input[name="subject[]"]').val());
            $("#institute").val(row.find('input[name="institute[]"]').val());
            $("#year").val(row.find('input[name="year[]"]').val());
            $("#result").val(row.find('input[name="result[]"]').val());
            $("#board").val(row.find('input[name="board[]"]').val());

            // Remove row after loading values
            row.remove();

        });

        $(document).on('click', '.removeRow', function () {
            $(this).closest('tr').remove();
        });

    });
</script>
