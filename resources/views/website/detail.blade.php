@extends('website.parent')
@section('title', 'Detail')

@section('styles')
@endsection

@section('content')



    <!-- Page Header Start -->
    <div class="container-fluid page-header">
        <h1 class="display-3 text-uppercase text-white mb-3">Blog Detail</h1>
        <div class="d-inline-flex text-white">
            <h6 class="text-uppercase m-0"><a href="{{ route('home') }}">Home</a></h6>
            <h6 class="text-white m-0 px-3">/</h6>
            <h6 class="text-uppercase text-white m-0"> {{ $article->title }} Article Detail</h6>
        </div>
    </div>
    <!-- Page Header Start -->


    <!-- Blog Start -->
    <div class="container-fluid py-6 px-5">
        <div class="row g-5">
            <div class="col-lg-8">
                <!-- Blog Detail Start -->
                <div class="mb-5">
                    <img class="img-fluid w-100 rounded mb-5" src="{{ asset('storage/images/article/' . $article->image) }}"
                        alt="">

                    <div class="d-flex justify-content-between mb-5">
                        <div class="d-flex align-items-center">
                            <img class="rounded-circle me-2"
                                src="{{ asset('storage/images/author/' . $article->author->user->image) }}" width="35"
                                height="35" alt="">
                            <span>{{ $article->author->user->first_name . ' ' . $article->author->user->last_name }}</span>
                        </div>
                        <div class="d-flex align-items-center">
                            <span class="ms-3"><i
                                    class="far fa-calendar-alt text-primary me-2"></i>{{ $article->created_at }}</span>
                        </div>
                    </div>
                    <h1 class="text-uppercase mb-4">{{ $article->title }}</h1>
                    <p>{{ $article->paragraph_1 }}</p>
                    <p>{{ $article->paragraph_2 }}</p>
                    <p>{{ $article->paragraph_3 }}</p>
                </div>
                <!-- Blog Detail End -->





                <!-- Comment List Start -->
                <div class="mb-5">
                    <h3 class="text-uppercase mb-4">{{ $article->comments_count }} Comments</h3>
                    @foreach ($comments as $comment)
                        <div class="d-flex mb-4">
                            <img src="{{ asset('storage/images/author/' . $comment->image) }}" class="img-fluid"
                                style="width: 45px; height: 45px;">
                            <div class="ps-3">
                                <h6><span class="text-danger">{{ $comment->name }}</span>
                                    <small><i>{{ $comment->created_at }}</i></small>
                                </h6>
                                <p>{{ $comment->comment }}</p>
                            </div>
                        </div>
                    @endforeach

                </div>
                <!-- Comment List End -->


                @auth('author')
                    <!-- Comment Form Start -->
                    <div class="bg-light p-5">
                        <h3 class="text-uppercase mb-4">Leave a comment</h3>
                        <form>
                            <div class="row g-3">

                                <div class="col-12">
                                    <textarea id="comment" name="comment" class="form-control bg-white border-0" rows="5" placeholder="Comment"></textarea>
                                    <input hidden id="article_id" name="article_id" value="{{ $article->id }}" type="text">
                                </div>

                                <div class="col-12">
                                    <button onclick="PerformComment()" class="btn btn-primary w-100 py-3" type="button">Leave
                                        Your Comment</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- Comment Form End -->
                @endauth


            </div>

            <!-- Sidebar Start -->
            <div class="col-lg-4">
                <!-- Search Form Start -->
                <div class="mb-5">
                    <div class="input-group">
                        <input type="text" class="form-control p-3" placeholder="Keyword">
                        <button class="btn btn-primary px-3"><i class="fa fa-search"></i></button>
                    </div>
                </div>
                <!-- Search Form End -->

                <!-- Category Start -->
                <div class="mb-5">
                    <h3 class="text-uppercase mb-4">Categories</h3>
                    <div class="d-flex flex-column justify-content-start bg-light p-4">
                        <a class="h6 text-uppercase mb-4" href="{{ route('blogs') }}"><i
                                class="fa fa-angle-right me-2"></i>All Articles</a>
                        @foreach ($categories as $category)
                            <a class="h6 text-uppercase mb-4" href="{{ route('blog', $category->id) }}"><i
                                    class="fa fa-angle-right me-2"></i>{{ $category->name }} Articles</a>
                        @endforeach
                    </div>
                </div>
                <!-- Category End -->

                <!-- Recent Post Start -->
                <div class="mb-5">
                    <h3 class="text-uppercase mb-4">Recent Posted Articles</h3>
                    <div class="bg-light p-4">
                        @foreach ($articles as $article)
                            <div class="d-flex mb-3">
                                <img class="img-fluid" src="{{ asset('storage/images/article/' . $article->image) }}"
                                    style="width: 100px; height: 100px; object-fit: cover;" alt="">
                                <a href="{{ route('detail', $article->id) }}"
                                    class="h6 d-flex align-items-center w-100 bg-white text-uppercase px-3 mb-0">{{ $article->title }}
                                </a>
                            </div>
                        @endforeach


                    </div>
                </div>
                <!-- Recent Post End -->



            </div>
            <!-- Sidebar End -->
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
        function PerformComment() {
            let formData = new FormData();
            formData.append('comment', document.getElementById('comment').value);
            formData.append('article_id', document.getElementById('article_id').value);
            storeRoute('/cms/admin/comments', formData);
        }
    </script>
@endsection
