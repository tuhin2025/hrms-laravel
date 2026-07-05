@extends('layouts.app')

@section('content')

    <div class="container-fluid">

        <!-- Job Entry -->
        <div class="card-body">
            <form method="POST"
                  action="{{ isset($job)
                                  ? route('job.jobs-update', $job->job_id)
                                  : route('job.jobs-store') }}">

                @csrf

                @if(isset($job))
                    @method('PUT')
                @endif
                <fieldset class="border rounded p-3">
                    <legend class="float-none w-auto px-2 text-dark fw-semibold" style="font-size:14px;">
                        <i class="fas fa-briefcase me-1"></i> Job Information
                    </legend>

                    <!-- Row 1 -->
                    <div class="row align-items-center mb-2">
                        <label class="col-md-2 col-form-label col-form-label-sm">
                            Job ID <span class="text-danger">*</span>
                        </label>

                        <div class="col-md-3">
                            <input type="text"
                                   name="job_id"
                                   id="job_id"
                                   class="form-control form-control-sm"
                                   value="{{ old('job_id', $job->job_id ?? '') }}">
                        </div>

                        <label class="col-md-2 col-form-label col-form-label-sm">
                            Job Title <span class="text-danger">*</span>
                        </label>

                        <div class="col-md-5">
                            <input type="text"
                                   name="job_title"
                                   id="job_title"
                                   class="form-control form-control-sm"
                                   value="{{ old('job_title', $job->job_title ?? '') }}">
                        </div>
                    </div>

                    <!-- Row 2 -->
                    <div class="row align-items-center mb-2">
                        <label class="col-md-2 col-form-label col-form-label-sm">
                            Minimum Salary
                        </label>

                        <div class="col-md-3">
                            <input type="text"
                                   name="min_salary"
                                   id="min_salary"
                                   class="form-control form-control-sm text-end"
                                   value="{{ old('min_salary', $job->min_salary ?? '') }}">
                        </div>

                        <label class="col-md-2 col-form-label col-form-label-sm">
                            Maximum Salary
                        </label>

                        <div class="col-md-3">
                            <input type="text"
                                   name="max_salary"
                                   id="max_salary"
                                   class="form-control form-control-sm text-end"
                                   value="{{ old('max_salary', $job->max_salary ?? '') }}">
                        </div>
                    </div>

                    <hr class="my-3">

                    <div class="text-end">
                        <button type="submit" class="btn btn-success btn-sm px-4">
                            <i class="fas fa-save"></i>
                            {{ isset($job) ? 'Update' : 'Save' }}
                        </button>
                    </div>
                </fieldset>
            </form>
        </div>

        <!-- Job List -->
        <div class="card-body">

            <fieldset class="border rounded-3 p-3">
                <legend class="float-none w-auto px-2 text-black small">
                    <i class="fas fa-briefcase me-1"></i> Job List
                </legend>

                <div class="table-responsive">

                    <table class="table table-bordered table-hover table-striped align-middle mb-0">

                        <thead class="table-primary">
                        <tr>
                            <th width="70" class="text-center">SL</th>
                            <th>Job Title</th>
                            <th class="text-end">Min Salary</th>
                            <th class="text-end">Max Salary</th>
                            <th width="140" class="text-center">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($jobs as $key => $item)
                            <tr>
                                <td class="text-center">{{ $jobs->firstItem() + $key }}</td>
                                <td>{{ $item->job_title }}</td>
                                <td class="text-end">{{ number_format($item->min_salary) }}</td>
                                <td class="text-end">{{ number_format($item->max_salary) }}</td>
                                <td class="text-center">
                                    <a href="{{ route('job.jobs-edit', $item->job_id) }}"
                                       class="btn btn-warning btn-sm">
                                        Edit
                                    </a>
                                    <form id="delete-form-{{ $item->job_id }}"
                                          action="{{ route('job.jobs-delete', $item->job_id) }}"
                                          method="POST"
                                          style="display:inline;">
                                        @csrf
                                        @method('DELETE')

                                        <button type="button"
                                                class="btn btn-danger btn-sm"
                                                onclick="confirmDelete('{{ $item->job_id }}')">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-danger">
                                    No Job Found
                                </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-end mt-3">
                    {{ $jobs->links() }}
                </div>
            </fieldset>
        </div>
    </div>
@endsection


<script>
    function confirmDelete(id) {
       // alert(id);
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
