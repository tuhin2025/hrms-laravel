@extends('layouts.app')

@section('content')
    <fieldset class="border p-2 rounded">

        <legend class="float-none w-auto px-2 fs-6">
            Search Employee
        </legend>

        <input type="text" class="form-control-sm ">

{{--        <div class="d-grid gap-2 d-md-flex justify-content-md-end">--}}
            <button type="button" id="seacrhEmp" class="btn btn-primary btn-sm justify-content-end">
                Search
            </button>
{{--        </div>--}}

    </fieldset>

    <div class="form-control">
        <form id="empLeaveForm" action="{{route('leave.index')}}">
            @csrf


            <div class="row mb-3">
                <input type="text" id="employee_id" class="form-control form-control-sm"
                 value="">


            </div>







        </form>


    </div>



@endsection
