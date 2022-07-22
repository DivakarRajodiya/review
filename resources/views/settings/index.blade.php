@extends('layouts.app')
@section('title')
    Settings
@endsection
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Settings</h1>
        </div>
        <div class="section-body">
            @include('flash::message')
            <div class="card">
                <div class="card-body">
                    {{ Form::open(['route' => 'settings.update', 'id'=>'editForm', 'files' => true, 'autocomplete' => 'off', 'enctype' => 'multipart/form-data']) }}
                    <div class="row">
                        @include('settings.fields')
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </section>
@endsection
@section('scripts')
    <script src="{{ asset('assets/js/settings/setting.js') }}"></script>
@endsection
