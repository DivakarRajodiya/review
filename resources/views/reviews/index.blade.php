@extends('layouts.app')
@section('title')
    Reviews
@endsection
@section('css')
    <link href="{{ asset('assets/css/jquery.dataTables.min.css') }}" rel="stylesheet" type="text/css"/>
@endsection
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Reviews</h1>
        </div>
        <div class="section-body">
            @include('flash::message')
            <div class="card">
                <div class="card-body">
                    @include('reviews.table')
                </div>
            </div>
        </div>
    </section>
@endsection
@section('scripts')
    <script>
        let reviewsUrl = "{{ route('reviews.index') }}/";
    </script>
    <script src="{{ asset('assets/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/js/custom/custom-datatable.js') }}"></script>
    <script src="{{ asset('assets/js/reviews/reviews.js')}}"></script>
@endsection
