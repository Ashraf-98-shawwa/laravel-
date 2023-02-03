@extends('cms.parent')
@section('title', 'Sliders')


@section('styles')
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            @can('create slider')
                <a class="btn btn-primary mb-2" href="{{ route('sliders.create') }}">Create Slider</a>
            @endcan

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Sliders Table</h3>
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
                                <th>image</th>
                                <th>heading</th>
                                <th>icon</th>
                                @canAny('edit slider', 'show slider', 'delete slider')
                                    <th>operations</th>
                                @endcan
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($sliders as $slider)
                                <tr>
                                    <td>{{ $slider->id }}</td>
                                    <td>
                                        <img class="img-circle img-bordered-sm"
                                            src="{{ asset('storage/images/slider/' . $slider->image) }}" width="60"
                                            height="60" alt="slider Image">
                                    </td>
                                    <td>{{ $slider->heading }}</td>
                                    <td>{{ $slider->icon }}</td>

                                    <td>
                                        <div class="btn-group">
                                            @can('show slider')
                                                <a href="{{ route('sliders.show', $slider->id) }}"
                                                    class="btn btn-success">Show</a>
                                            @endcan
                                            @can('edit slider')
                                                <a href=" {{ route('sliders.edit', $slider->id) }}"
                                                    class="btn btn-warning">Edit</a>
                                            @endcan
                                            @can('delete slider')
                                                <button onclick="performDestroy({{ $slider->id }} , this)" type="button"
                                                    class="btn btn-danger">Delete</button>
                                            @endcan

                                        </div>

                                    </td>

                                </tr>
                            @endforeach


                        </tbody>
                    </table>

                    {{ $sliders->links() }}

                </div>

            </div>
        </div>
    </div>


@endsection

@section('scripts')
    <script>
        function performDestroy(id, referance) {
            let url = '/cms/admin/sliders/' + id
            confirmDestroy(url, referance)
            console.log(referance)
        }
    </script>
@endsection
