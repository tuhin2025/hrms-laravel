@extends('layouts.app')

@section('content')

    <div class="container full-width">

        <!-- TOP: FORM -->
        <div class="row mb-3">
            <div class="col-md-12">


                <div class="card ">
                    <div class="card-header bg-info text-white">
                        {{ isset($department) ? 'Edit Department' : 'Add Department' }}
                    </div>

                    <div class="card-body">

                        <form method="POST"
                              action="{{ isset($department)
                                  ? route('hr.dept-update', $department->department_id)
                                  : route('hr.dept-store') }}">

                            @csrf

                            @if(isset($department))
                                @method('PUT')
                            @endif

                            <div class="row">

                                <!-- LEFT SIDE -->
                                <div class="col-md-6">
                                    <div class="row mb-2 align-items-center gx-1">

                                        <div class="col-4">
                                            <label class="col-form-label mb-0">Department Name: <span
                                                    class="text-danger">*</span> </label>
                                        </div>

                                        <div class="col-8">
                                            <input type="text"
                                                   name="department_name"
                                                   class="form-control form-control-sm"
                                                   value="{{ old('department_name', $department->department_name ?? '') }}"
                                                   placeholder="Enter Department Name"
                                                   required>
                                        </div>

                                    </div>
                                </div>

                                <!-- RIGHT SIDE -->
                                <div class="col-md-6">
                                    <div class="row mb-2 align-items-center gx-1">

                                        <div class="col-4">
                                            <label class="col-form-label mb-0">Job Location: <span
                                                    class="text-danger">*</span></label>
                                        </div>

                                        <div class="col-8">
                                            <select name="location_id" class="form-control form-control-sm">

                                                @php
                                                    $selectedLocation = old('location_id', $department->location_id ?? null);
                                                @endphp
                                                @foreach($locations ?? [] as $location)
                                                    <option value="{{ $location->location_id }}"
                                                        {{ $selectedLocation !== null
                                                            ? ($selectedLocation == $location->location_id ? 'selected' : '')
                                                            : ($location->street_address == 'China' ? 'selected' : '') }}>
                                                        {{ $location->street_address }}
                                                    </option>
                                                @endforeach

                                            </select>
                                        </div>

                                    </div>
                                </div>

                            </div>

                            <!-- BUTTON -->
                            <div class="d-flex justify-content-end mt-2">
                                <button type="submit" class="btn btn-success px-4">
                                    {{ isset($department) ? 'Update' : 'Save' }}
                                </button>
                            </div>

                        </form>

                    </div>
                </div>

            </div>
        </div>


        <!-- BOTTOM: TABLE -->
        <div class="row  mb-4">
            <div class="col-md-12  full-width">

                <div class="card">

                    <div class="card-header bg-info text-white">
                        Department List
                    </div>

                    <div class="card-body p-0">

                        <table class="table table-bordered mb-0">
                            <thead class="table-success table-responsive-md">
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Location</th>
                                <th width="150" class="text-center">Action</th>
                            </tr>
                            </thead>

                            <tbody>
                            @forelse($departments as $dept)
                                <tr>
                                    <td>{{ $dept->department_id }}</td>
                                    <td>{{ $dept->department_name }}</td>
                                    <td>{{ $dept->location->street_address ?? 'N/A' }}</td>
                                    <td>

                                        <a href="{{ route('hr.dept-edit', $dept->department_id) }}"
                                           class="btn btn-warning btn-sm">
                                            Edit
                                        </a>

                                        <form id="delete-form-{{ $dept->department_id }}"
                                              action="{{ route('hr.dept-delete', $dept->department_id) }}"
                                              method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')

                                            <button type="button" class="btn btn-danger btn-sm"
                                                    onclick="confirmDelete({{ $dept->department_id }})">
                                                Delete
                                            </button>
                                        </form>

                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center">
                                        No Department Found
                                    </td>
                                </tr>
                            @endforelse
                            </tbody>

                        </table>

                    </div>

                </div>

            </div>
        </div>

    </div>

@endsection

<script>
    function confirmDelete(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "This data will be deleted!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + id).submit();
            }
        });
    }
</script>
