@extends('layouts.app')
@section('title')
    Contact Us
@endsection
@section('css')
    <link href="{{ asset('assets/css/jquery.dataTables.min.css') }}" rel="stylesheet" type="text/css"/>
@endsection
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Contact Us</h1>
        </div>
        <div class="section-body">
            @include('flash::message')
            <div class="card">
                <div class="card-body">
                    @include('contact-us.table')
                </div>
            </div>
        </div>
    </section>
@endsection
@section('scripts')
    <script>
        let contactUsUrl = "{{ route('contact-us.index') }}/";
    </script>
    <script src="{{ asset('assets/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/js/custom/custom-datatable.js') }}"></script>
    <script src="{{ asset('assets/js/contact-us/contact-us.js')}}"></script>
@endsection
