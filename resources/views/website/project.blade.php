@extends('website.parent')
@section('title', 'Projects')

@section('styles')
@endsection

@section('content')


    <!-- Page Header Start -->
    <div class="container-fluid page-header">
        <h1 class="display-3 text-uppercase text-white mb-3">Projects</h1>
        <div class="d-inline-flex text-white">
            <h6 class="text-uppercase m-0"><a href="{{ route('home') }}">Home</a></h6>
            <h6 class="text-white m-0 px-3">/</h6>
            <h6 class="text-uppercase text-white m-0">Project</h6>
        </div>
    </div>
    <!-- Page Header Start -->


    <!-- Portfolio Start -->
    <div class="container-fluid bg-light py-6 px-5">
        <div class="text-center mx-auto mb-5" style="max-width: 600px;">
            <h1 class="display-5 text-uppercase mb-4">Some Of Our <span class="text-primary">Popular</span> Dream Projects
            </h1>
        </div>
        <div class="row gx-5">
            <div class="col-12 text-center">
                <div class="d-inline-block bg-dark-radial text-center pt-4 px-5 mb-5">
                    <ul class="list-inline mb-0" id="portfolio-flters">
                        <li class="btn btn-outline-primary bg-white p-2 active mx-2 mb-4" data-filter="*">
                            <img src="{{ asset('website/img/portfolio-1.jpg') }}" style="width: 150px; height: 100px;">
                            <div class="position-absolute top-0 start-0 end-0 bottom-0 m-2 d-flex align-items-center justify-content-center"
                                style="background: rgba(4, 15, 40, .3);">
                                <h6 class="text-white text-uppercase m-0">All</h6>
                            </div>
                        </li>
                        @foreach ($categories as $category)
                            <li class="btn btn-outline-primary bg-white p-2 mx-2 mb-4" data-filter=".{{ $category->name }}">
                                <img src="{{ asset('storage/images/category/' . $category->image) }}"
                                    style="width: 150px; height: 100px;">
                                <div class="position-absolute top-0 start-0 end-0 bottom-0 m-2 d-flex align-items-center justify-content-center"
                                    style="background: rgba(4, 15, 40, .3);">
                                    <h6 class="text-white text-uppercase m-0">{{ $category->name }}</h6>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <div class="row g-5 portfolio-container">
            @foreach ($projects as $project)
                <div class="col-xl-4 col-lg-6 col-md-6 portfolio-item {{ $project->category->name }} ">
                    <div class="position-relative portfolio-box">
                        <img style="width:600px;height:500px" class="img-fluid w-100"  src="{{ asset('storage/images/project/' . $project->image) }}" alt="">
                        <a class="portfolio-title shadow-sm" href="">
                            <p class="h4 text-uppercase">{{ $project->name}}</p>
                            <span class="text-body"><i class="fa fa-map-marker-alt text-primary me-2"></i>{{$project->location}}
                                </span>
                        </a>
                        <a class="portfolio-btn" href="img/portfolio-1.jpg" data-lightbox="portfolio">
                        </a>
                    </div>
                </div>
            @endforeach


        </div>
    </div>
    <!-- Portfolio End -->

@endsection

@section('scripts')
@endsection
