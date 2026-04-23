@extends('layouts.app')

@section('content')

    <div class="row">

        <!-- FORM -->
        <div class="col-md-4">

            <div class="card">
                <div class="card-header">
                    {{ isset($department) ? 'Edit Department' : 'Add Department' }}
                </div>

                <div class="card-body">

                    <form method="POST"
                          action="{{ isset($department)
                      ? route('hr.dept-update', $department->department_id)
                      : route('hr.dept-store') }}">

                        @csrf

                        <input type="text"
                               name="department_name"
                               class="form-control"
                               value="{{ $department->department_name ?? '' }}"
                               placeholder="Department Name">


                    </form>
                    <button class="btn btn-success mt-2">
                        {{ isset($department) ? 'Update' : 'Save' }}
                    </button>

                </div>
            </div>

        </div>

        <!-- TABLE -->
        <div class="col-md-8">

            <table class="table table-bordered">
                <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th width="150">Action</th>
                </tr>
                </thead>

                <tbody>
                @foreach($departments as $dept)
                    <tr>
                        <td>{{ $dept->department_id }}</td>
                        <td>{{ $dept->department_name }}</td>
                        <td>

                            <a href="{{ route('hr.dept-edit', $dept->department_id) }}"
                               class="btn btn-warning btn-sm">
                                Edit
                            </a>

                            <a href="{{ route('hr.dept-delete', $dept->department_id) }}"
                               class="btn btn-danger btn-sm"
                               onclick="return confirm('Delete?')">
                                Delete
                            </a>

                        </td>
                    </tr>
                @endforeach
                </tbody>

            </table>

        </div>

    </div>

@endsection
