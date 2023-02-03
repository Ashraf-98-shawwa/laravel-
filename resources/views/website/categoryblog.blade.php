@extends('website.parent')
@section('title', 'Blog')

@section('styles')
@endsection

@section('content')


    <!-- Page Header Start -->
    <div class="container-fluid page-header">
        <h1 class="display-3 text-uppercase text-white mb-3">Blog Grid</h1>
        <div class="d-inline-flex text-white">
            <h6 class="text-uppercase m-0"><a href="">Home</a></h6>
            <h6 class="text-white m-0 px-3">/</h6>
            <h6 class="text-uppercase text-white m-0">Blog Grid</h6>
        </div>
    </div>
    <!-- Page Header Start -->
    <div class="d-flex flex-column justify-content-start bg-light p-4">
        <a class="h6 text-uppercase mb-4" href="{{ route('blogs') }}"><i class="fa fa-angle-right me-2"></i>All Articles</a>
        @foreach ($categories as $category)
            <a class="h6 text-uppercase mb-4" href="{{ route('blog', $category->id) }}"><i
                    class="fa fa-angle-right me-2"></i>{{ $category->name }} Articles</a>
        @endforeach
    </div>

    <!-- Blog Start -->
    <div class="container-fluid py-6 px-5">
        <div class="text-center mx-auto mb-5" style="max-width: 600px;">
            <h1 class="display-5 text-uppercase mb-4">Latest <span class="text-primary">Articles</span> From Our <span class="text-primary"> {{ $blog->name }} </span>Blog Post
            </h1>
        </div>

        <div class="row g-5">
            @if( $articles->count() > 0)
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

            @else

            <div class="w-50 mx-auto"> <span class="text-danger">No</span> Articles sorry .. </div>
            @endif


            {{ $articles->links() }}


        </div>
    </div>
    <!-- Blog End -->

@endsection

@section('scripts')
@endsection
