@extends('layouts.app')
@section('title')
    Users
@endsection
@section('css')
    <link href="{{ asset('assets/css/jquery.dataTables.min.css') }}" rel="stylesheet" type="text/css"/>
@endsection
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Users</h1>
            <div class="section-header-breadcrumb">
                {{--                <a class="btn btn-primary mr-2" href="{{ route('users.create') }}"><i--}}
                {{--                        class="fas fa-plus"></i> Add User</a>--}}
            </div>
        </div>
        <div class="section-body">
            @include('flash::message')
            <div class="card">
                <div class="card-body">
                    @include('users.table')
                </div>
            </div>
        </div>
    </section>
@endsection
@section('scripts')
    <script>
        let usersUrl = "{{ route('users.index') }}/";
    </script>
    <script src="{{ asset('assets/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/js/custom/custom-datatable.js') }}"></script>
    <script src="{{ asset('assets/js/users/users.js')}}"></script>
@endsection
