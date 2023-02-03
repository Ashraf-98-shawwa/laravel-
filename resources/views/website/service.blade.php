@extends('website.parent')
@section('title', 'Services')

@section('styles')
@endsection

@section('content')


    <!-- Page Header Start -->
    <div class="container-fluid page-header">
        <h1 class="display-3 text-uppercase text-white mb-3">Service</h1>
        <div class="d-inline-flex text-white">
            <h6 class="text-uppercase m-0"><a href="{{ route('home') }}">Home</a></h6>
            <h6 class="text-white m-0 px-3">/</h6>
            <h6 class="text-uppercase text-white m-0">Service</h6>
        </div>
    </div>
    <!-- Page Header Start -->


    <!-- Services Start -->
    <div class="container-fluid bg-light py-6 px-5">
        <div class="text-center mx-auto mb-5" style="max-width: 600px;">
            <h1 class="display-5 text-uppercase mb-4">We Provide <span class="text-primary">The Best</span> Construction
                Services</h1>
        </div>
        <div class="row g-5">

            @foreach ($services as $service)
                <div class="col-lg-4 col-md-6">
                    <div class="service-item bg-white d-flex flex-column align-items-center text-center">
                        <img style="width:600px; height:400px;" class="img-fluid" src="{{ asset('storage/images/service/' . $service->image) }}" alt="">
                        <div class="service-icon bg-white">
                            <i class="fa fa-3x fa-{{ $service->icon }} text-primary"></i>
                        </div>
                        <div class="px-4 pb-4">
                            <h4 class="text-uppercase mb-3">{{ $service->name }}</h4>
                            <p>{{$service->description}}</p>
                        </div>
                    </div>
                </div>
            @endforeach


        </div>
    </div>
    <!-- Services End -->



@endsection

@section('scripts')
@endsection
