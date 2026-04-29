@extends('layouts.app')

@section('content')

    <div class="card p-3 shadow-sm">

        <!-- FILTER -->
        <form method="GET" class="row mb-3">

            <div class="col-md-3">
                <select name="employee_id" class="form-control">
                    <option value="">All Employee</option>
                    @foreach($employees as $emp)
                        <option value="{{ $emp->employee_id }}">
                            {{ $emp->first_name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-3">
                <input type="date" name="from_date" class="form-control">
            </div>

            <div class="col-md-3">
                <input type="date" name="to_date" class="form-control">
            </div>

            <div class="col-md-3">
                <button class="btn btn-primary">Filter</button>
                <a href="{{ route('attendance.index') }}" class="btn btn-secondary small">Reset</a>
                <button type="button" class="btn btn-success small" data-bs-toggle="modal" data-bs-target="#attendanceModal">
                    Add Attn
                </button>
            </div>

        </form>

    </div>

    <!-- TABLE -->
    <div class="card mt-3 p-3 shadow-sm">

        <table class="table table-striped table-hover">
            <thead>
            <tr class="table-primary text-center">
                <th>Sl</th>
                <th>Employee</th>
                <th>Date</th>
                <th>Shift</th>
                <th>In Time</th>
                <th>Out Time</th>
                <th>Status</th>
            </tr>
            </thead>

            <tbody>
            @forelse($attendances as $key => $att)
                <tr class="text-center">
                    <td>{{ $attendances->firstItem() + $key }}</td>
                    <td>{{ $att->employee->first_name ?? '' }}</td>
                    <td>{{ $att->attendance_date }}</td>
                    <td>{{ $att->shift->shift_name ?? '' }}</td>
                    <td>{{ $att->check_in }}</td>
                    <td>{{ $att->check_out }}</td>
                    <td>
                        @if($att->status == 'P')
                            <span class="badge bg-success">Present</span>
                        @elseif($att->status == 'A')
                            <span class="badge bg-danger">Absent</span>
                        @elseif($att->status == 'L')
                            <span class="badge bg-warning">Leave</span>
                        @else
                            <span class="badge bg-secondary">Holiday</span>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center">No Data Found</td>
                </tr>
            @endforelse
            </tbody>
        </table>

        <div class="d-flex justify-content-end mt-3">
            {{ $attendances->appends(request()->query())->links() }}
        </div>

    </div>

    <!-- MODAL -->
    <div class="modal fade" id="attendanceModal">
        <div class="modal-dialog">
            <div class="modal-content p-3">

                <h5>Add Attendance</h5>

                <select class="form-control mb-2 employee_id">
                    <option value="">Select Employee</option>
                    @foreach($employees as $emp)
                        <option value="{{ $emp->employee_id }}">{{ $emp->first_name }}</option>
                    @endforeach
                </select>

                <select class="form-control mb-2 shift_id">
                    <option value="">Select Shift</option>
                    @foreach($shifts as $shift)
                        <option value="{{ $shift->shift_id }}">{{ $shift->shift_name }}</option>
                    @endforeach
                </select>

                <input type="date" class="form-control mb-2 from_date">
                <input type="date" class="form-control mb-2 to_date">

                <select class="form-control mb-2 status">
                    <option value="P">Present</option>
                    <option value="A">Absent</option>
                    <option value="L">Leave</option>
                </select>

                <button type="button" class="btn btn-success saveBulkAttendance">
                    Save Attendance
                </button>

            </div>
        </div>
    </div>

@endsection
@push('scripts')

    <script>
        $(document).on('click', '.saveBulkAttendance', function () {

            let data = {
                employee_id: $('.employee_id').val(),
                shift_id: $('.shift_id').val(),
                from_date: $('.from_date').val(),
                to_date: $('.to_date').val(),
                status: $('.status').val(),
                _token: '{{ csrf_token() }}'
            };

            $.ajax({
                url: "{{ route('attendance.attn-store') }}",
                type: "POST",
                data: data,

                success: function (res) {

                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: res.message,
                        timer: 2000,
                        showConfirmButton: false
                    });

                    $('#attendanceModal').modal('hide');

                    $('#attendanceModal select, #attendanceModal input').val('');

                    setTimeout(() => {
                        location.reload();
                    }, 500);
                },

                error: function (err) {

                    let msg = 'Something went wrong';

                    if (err.responseJSON && err.responseJSON.message) {
                        msg = err.responseJSON.message;
                    }

                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: msg
                    });

                    console.log(err);
                }
            });

        });
    </script>

@endpush
