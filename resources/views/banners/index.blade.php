@extends('layouts.app')
@section('title')
    Banners
@endsection
@section('css')
    <link href="{{ asset('assets/css/jquery.dataTables.min.css') }}" rel="stylesheet" type="text/css"/>
@endsection
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Banners</h1>
            <div class="section-header-breadcrumb">
                <a class="btn btn-primary mr-2" href="{{ route('banners.create') }}"><i
                        class="fas fa-plus"></i> Add Banner</a>
            </div>
        </div>
        <div class="section-body">
            @include('flash::message')
            <div class="card">
                <div class="card-body">
                    @include('banners.table')
                </div>
            </div>
        </div>
    </section>
@endsection
@section('scripts')
    <script>
        let bannersUrl = "{{ route('banners.index') }}/";
    </script>
    <script src="{{ asset('assets/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/js/custom/custom-datatable.js') }}"></script>
    <script src="{{ asset('assets/js/banners/banners.js')}}"></script>
@endsection
