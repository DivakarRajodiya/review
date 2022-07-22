@extends('layouts.app')
@section('title')
    Edit User
@endsection
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Edit User</h1>
            <div class="section-header-breadcrumb">
                <a class="btn btn-primary" href="{{ route('users.index') }}">Back </a>
            </div>
        </div>
        <div class="section-body">
            <div class="card">
                <div class="card-body">
                    {{ Form::model($user,['route' => ['users.update', $user->id], 'method' => 'PUT', 'id'=>'editForm','files' => true, 'autocomplete' => 'off']) }}
                    <div class="row">
                        @include('users.fields')
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </section>
@endsection
@section('scripts')
    <script src="{{ asset('assets/js/users/create_edit.js')}}"></script>
@endsection
