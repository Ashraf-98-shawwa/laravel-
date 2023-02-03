@extends('website.parent')
@section('title', 'Team Members')

@section('styles')
@endsection

@section('content')


    <!-- Page Header Start -->
    <div class="container-fluid page-header">
        <h1 class="display-3 text-uppercase text-white mb-3">The Team</h1>
        <div class="d-inline-flex text-white">
            <h6 class="text-uppercase m-0"><a href="{{ route('home') }}">Home</a></h6>
            <h6 class="text-white m-0 px-3">/</h6>
            <h6 class="text-uppercase text-white m-0">The Team</h6>
        </div>
    </div>
    <!-- Page Header Start -->


    <!-- Team Start -->
    <div class="container-fluid py-6 px-5">
        <div class="text-center mx-auto mb-5" style="max-width: 600px;">
            <h1 class="display-5 text-uppercase mb-4">We Are <span class="text-primary">Professional & Expert</span> Workers
            </h1>
        </div>
        <div class="row g-5">

            @foreach ($workers as $worker)
                <div class="col-xl-3 col-lg-4 col-md-6">
                    <div class="row g-0">
                        <div class="col-10" style="min-height: 300px;">
                            <div class="position-relative h-100">
                                <img class="position-absolute w-100 h-100" src="{{ asset('storage/images/worker/' . $worker->image) }}"
                                    style="object-fit: cover;">
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="h-100 d-flex flex-column align-items-center justify-content-between bg-light">
                                <a class="btn" href="{{ $worker->twitter_link }}"><i class="fab fa-twitter"></i></a>
                                <a class="btn" href="{{ $worker->facebook_link }}"><i class="fab fa-facebook-f"></i></a>
                                <a class="btn" href="{{ $worker->linkedin_link }}"><i class="fab fa-linkedin-in"></i></a>
                                <a class="btn" href="{{ $worker->instagram_link }}"><i class="fab fa-instagram"></i></a>
                                <a class="btn" href="{{ $worker->youtube_link }}"><i class="fab fa-youtube"></i></a>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="bg-light p-4">
                                <h4 class="text-uppercase">{{ $worker->name }}</h4>
                                <span>{{ $worker->position }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach


        </div>
    </div>
    <!-- Team End -->
@endsection

@section('scripts')
@endsection
