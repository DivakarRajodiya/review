@extends('layouts.app')
@section('title')
    Edit Banner
@endsection
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Edit Banner</h1>
            <div class="section-header-breadcrumb">
                <a class="btn btn-primary" href="{{ route('banners.index') }}">Back </a>
            </div>
        </div>
        <div class="section-body">
            <div class="card">
                <div class="card-body">
                    {{ Form::model($banner,['route' => ['banners.update', $banner->id], 'method' => 'PUT', 'id'=>'editForm','files' => true, 'autocomplete' => 'off']) }}
                    <div class="row">
                        @include('banners.fields')
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </section>
@endsection
@section('scripts')
    <script src="{{ asset('assets/js/banners/create_edit.js')}}"></script>
@endsection
