@extends('cms.parent')
@section('title', 'Testimonials')


@section('styles')
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            @can('create testimonial')
                <a class="btn btn-primary mb-2" href="{{ route('testimonials.create') }}">Create Testimonial</a>
            @endcan

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Testimonials Table</h3>
                    <div class="card-tools">
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                            <div class="input-group-append">
                                <button type="submit" class="btn btn-default">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-2">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Client image</th>
                                <th>Client Name </th>
                                <th>Client Position </th>
                                <th>Client Testimonial </th>
                                @canAny('edit testimonial', 'show testimonial', 'delete testimonial')
                                    <th>operations</th>
                                @endcan
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($testimonials as $testimonial)
                                <tr>
                                    <td>{{ $testimonial->id }}</td>
                                    <td>
                                        <img class="img-circle img-bordered-sm"
                                            src="{{ asset('storage/images/testimonial/' . $testimonial->image) }}"
                                            width="60" height="60" alt="slider Image">
                                    </td>
                                    <td>{{ $testimonial->client_name }}</td>
                                    <td>{{ $testimonial->client_position }}</td>
                                    <td>{{ $testimonial->client_testimonial }}</td>

                                    <td>
                                        <div class="btn-group">
                                            @can('show testimonial')
                                                <a href="{{ route('testimonials.show', $testimonial->id) }}"
                                                    class="btn btn-success">Show</a>
                                            @endcan
                                            @can('edit testimonial')
                                                <a href=" {{ route('testimonials.edit', $testimonial->id) }}"
                                                    class="btn btn-warning">Edit</a>
                                            @endcan
                                            @can('delete testimonial')
                                                <button onclick="performDestroy({{ $testimonial->id }} , this)" type="button"
                                                    class="btn btn-danger">Delete</button>
                                            @endcan
                                        </div>

                                    </td>

                                </tr>
                            @endforeach


                        </tbody>
                    </table>

                    {{ $testimonials->links() }}

                </div>

            </div>
        </div>
    </div>


@endsection

@section('scripts')
    <script>
        function performDestroy(id, referance) {
            let url = '/cms/admin/testimonials/' + id
            confirmDestroy(url, referance)
            console.log(referance)
        }
    </script>
@endsection
