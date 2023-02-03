@extends('website.parent')
@section('title', 'Home')

@section('styles')
@endsection

@section('content')


    <!-- Carousel Start -->
    <div class="container-fluid p-0">
        <div id="header-carousel" class="carousel slide carousel-fade" data-bs-ride="carousel">
            <div class="carousel-inner">

                @foreach ($sliders as $slider)
                    <div class="carousel-item @if ($loop->first) active @endif">
                        <img style="width:1920px;height:800px" class="w-100" src="{{ asset('storage/images/slider/' . $slider->image) }}" alt="Image">
                        <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                            <div class="p-3" style="max-width: 900px;">
                                <i class="fa fa-{{ $slider->icon }} fa-4x text-primary mb-4 d-none d-sm-block"></i>
                                <h1 class="display-2 text-uppercase text-white mb-md-4">{{ $slider->heading }}</h1>
                                <a href="{{ route('contact') }}" class="btn btn-primary py-md-3 px-md-5 mt-2">Contact</a>
                            </div>
                        </div>
                    </div>
                @endforeach



            </div>

            <button class="carousel-control-prev" type="button" data-bs-target="#header-carousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#header-carousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
    <!-- Carousel End -->


    <!-- About Start -->
    <div class="container-fluid py-6 px-5">
        <div class="row g-5">
            <div class="col-lg-7">
                <h1 class="display-5 text-uppercase mb-4">{{ $about->heading }}</h1>
                <h4 class="text-uppercase mb-3 text-body">{{ $about->paragraph_1 }}</h4>
                <p>{{ $about->paragraph_2 }}</p>
                <div class="row gx-5 py-2">
                    <div class="col-sm-6 mb-2">
                        @foreach ($features as $feature)
                            <p class="fw-bold mb-2"><i class="fa fa-check text-primary me-3"></i>{{ $feature->name }}</p>
                        @endforeach

                    </div>

                </div>
                <p class="mb-4">{{ $about->paragraph_3 }}</p>
                <img style="width:150px;height:100px;" src="{{ asset('storage/images/about/' . $about->signature) }}"
                    alt="">
            </div>
            <div class="col-lg-5 pb-5" style="min-height: 400px;">
                <div class="position-relative bg-dark-radial h-100 ms-5">
                    <img class="position-absolute w-100 h-100 mt-5 ms-n5"
                        src="{{ asset('storage/images/about/' . $about->image) }}" style="object-fit: cover;">
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->

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
                        <img style="width:600px; height:400px;" class="img-fluid"
                            src="{{ asset('storage/images/service/' . $service->image) }}" alt="">
                        <div class="service-icon bg-white">
                            <i class="fa fa-3x fa-{{ $service->icon }} text-primary"></i>
                        </div>
                        <div class="px-4 pb-4">
                            <h4 class="text-uppercase mb-3">{{ $service->name }}</h4>
                            <p>{{ $service->description }}</p>
                        </div>
                    </div>
                </div>
            @endforeach


        </div>
    </div>
    <!-- Services End -->


    <!-- Appointment Start -->
    <div class="container-fluid bg-light py-6 px-5">
        <div class="row gx-5">
            <div class="col-lg-4 mb-5 mb-lg-0">
                <div class="mb-4">
                    <h1 class="display-5 text-uppercase mb-4">Request A <span class="text-primary">Call Back</span></h1>
                </div>
                <p class="mb-5">Nonumy ipsum amet tempor takimata vero ea elitr. Diam diam ut et eos duo duo sed. Lorem
                    elitr sadipscing eos et ut et stet justo, sit dolore et voluptua labore. Ipsum erat et ea ipsum magna
                    sadipscing lorem. Sit lorem sea sanctus eos. Sanctus sit tempor dolores ipsum stet justo sit erat ea,
                    sed diam sanctus takimata sit. Et at voluptua amet erat justo amet ea ipsum eos, eirmod accusam sea sed
                    ipsum kasd ut.</p>
            </div>
            <div class="col-lg-8">
                <div class="bg-white text-center p-5">
                    <form>
                        <div class="row g-3">
                            <div class="col-12 col-sm-6">
                                <input type="text" id="name" name="name" class="form-control bg-light border-0"
                                    placeholder="Your Name" style="height: 55px;">
                            </div>
                            <div class="col-12 col-sm-6">
                                <input id="email" name="email" type="email" class="form-control bg-light border-0"
                                    placeholder="Your Email" style="height: 55px;">
                            </div>
                            <div class="col-12 col-sm-6">
                                <input type="text" id="date1" name="date" type="text"
                                    class="form-control bg-light border-0 " placeholder="Call Back Date"
                                    style="height: 55px;">
                            </div>
                            <div class="col-12 col-sm-6">
                                <input type="text" id="time1" name="time"
                                    class="form-control bg-light border-0 " placeholder="Call Back Time"
                                    style="height: 55px;">
                            </div>
                            <div class="col-12">
                                <textarea id="message" name="message" class="form-control bg-light border-0" rows="5"
                                    placeholder="Message"></textarea>
                            </div>
                            <div class="col-12">
                                <button class="btn btn-primary w-100 py-3" onclick="performStoreAppointment()"
                                    type="button">Submit
                                    Request</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Appointment End -->


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
                            <li class="btn btn-outline-primary bg-white p-2 mx-2 mb-4"
                                data-filter=".{{ $category->name }}">
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
                        <img style="width:600px;height:500px" class="img-fluid w-100"
                            src="{{ asset('storage/images/project/' . $project->image) }}" alt="">
                        <a class="portfolio-title shadow-sm" href="">
                            <p class="h4 text-uppercase">{{ $project->name }}</p>
                            <span class="text-body"><i
                                    class="fa fa-map-marker-alt text-primary me-2"></i>{{ $project->location }}
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


    <!-- Team Start -->
    <div class="container-fluid py-6 px-5">
        <div class="text-center mx-auto mb-5" style="max-width: 600px;">
            <h1 class="display-5 text-uppercase mb-4">We Are <span class="text-primary">Professional & Expert</span>
                Workers
            </h1>
        </div>
        <div class="row g-5">

            @foreach ($workers as $worker)
                <div class="col-xl-3 col-lg-4 col-md-6">
                    <div class="row g-0">
                        <div class="col-10" style="min-height: 300px;">
                            <div class="position-relative h-100">
                                <img class="position-absolute w-100 h-100"
                                    src="{{ asset('storage/images/worker/' . $worker->image) }}"
                                    style="object-fit: cover;">
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="h-100 d-flex flex-column align-items-center justify-content-between bg-light">
                                <a class="btn" href="{{ $worker->twitter_link }}"><i class="fab fa-twitter"></i></a>
                                <a class="btn" href="{{ $worker->facebook_link }}"><i
                                        class="fab fa-facebook-f"></i></a>
                                <a class="btn" href="{{ $worker->linkedin_link }}"><i
                                        class="fab fa-linkedin-in"></i></a>
                                <a class="btn" href="{{ $worker->instagram_link }}"><i
                                        class="fab fa-instagram"></i></a>
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


    <!-- Testimonial Start -->
    <div class="container-fluid bg-light py-6 px-5">
        <div class="text-center mx-auto mb-5" style="max-width: 600px;">
            <h1 class="display-5 text-uppercase mb-4">What Our <span class="text-primary">Happy Cleints</span> Say!!!</h1>
        </div>
        <div class="row gx-0 align-items-center">
            <div class="col-xl-4 col-lg-5 d-none d-lg-block">
                <img class="img-fluid w-100 h-100" src="{{ asset('website/img/testimonial.jpg') }}">
            </div>
            <div class="col-xl-8 col-lg-7 col-md-12">
                <div class="testimonial bg-light">
                    <div class="owl-carousel testimonial-carousel">
                        @foreach ($testimonials as $testimonial)
                            <div class="row gx-4 align-items-center">
                                <div class="col-xl-4 col-lg-5 col-md-5">
                                    <img class="img-fluid w-100 h-100 bg-light p-lg-3 mb-4 mb-md-0"
                                        src="{{ asset('storage/images/testimonial/' . $testimonial->image) }}"
                                        alt="">
                                </div>
                                <div class="col-xl-8 col-lg-7 col-md-7">
                                    <h4 class="text-uppercase mb-0">{{ $testimonial->client_name }}</h4>
                                    <p>{{ $testimonial->client_position }}</p>
                                    <p class="fs-5 mb-0"><i class="fa fa-2x fa-quote-left text-primary me-2"></i>
                                        {{ $testimonial->client_testimonial }}</p>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Testimonial End -->



    <!-- Blog Start -->
    <div class="container-fluid py-6 px-5">
        <div class="text-center mx-auto mb-5" style="max-width: 600px;">
            <h1 class="display-5 text-uppercase mb-4">Latest <span class="text-primary">Articles</span> From Our Blog Post
            </h1>
        </div>
        <div class="row g-5">
            @foreach ($articles as $article)
                <div class="col-lg-4 col-md-6">
                    <div class="bg-light">
                        <img class="img-fluid" style="height: 300px;"
                            src="{{ asset('storage/images/article/' . $article->image) }}" alt="">
                        <div class="p-4">
                            <div class="d-flex justify-content-between mb-4">
                                <div class="d-flex align-items-center">
                                    <img class="rounded-circle me-2"
                                        src="{{ asset('storage/images/author/' . $article->author->user->image) }}"
                                        width="35" height="35" alt="">
                                    <span>{{ $article->author->user->first_name . ' ' . $article->author->user->last_name }}</span>
                                </div>
                                <div class="d-flex align-items-center">
                                    <span class="ms-3"><i
                                            class="far fa-calendar-alt text-primary me-2"></i>{{ $article->created_at }}</span>
                                </div>
                            </div>
                            <h4 class="text-uppercase mb-3">{{ $article->title }}</h4>
                            <a class="text-uppercase fw-bold" href="{{ route('detail', $article->id) }}">Read More <i
                                    class="bi bi-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </div>
    <!-- Blog End -->


@endsection

@section('scripts')
    {{-- << needed when using ajax >> --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="{{ asset('cms/js/crud.js') }}"></script>
    <script>
        function performStoreAppointment() {
            let formData = new FormData();
            formData.append('name', document.getElementById('name').value);
            formData.append('email', document.getElementById('email').value);
            formData.append('date', document.getElementById('date1').value);
            formData.append('time', document.getElementById('time1').value);
            formData.append('message', document.getElementById('message').value);

            store('/cms/admin/requests', formData);
        }
    </script>
@endsection
