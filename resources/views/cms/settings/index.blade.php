@extends('cms.parent')
@section('title', 'Settings')


@section('styles')
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            @can('create setting')
                @if ($count < 1)
                    <a class="btn btn-primary mb-2" href="{{ route('settings.create') }}">Create Setting</a>
                @endif

            @endcan


            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Settings Table</h3>
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
                                <th>address</th>
                                <th>email</th>
                                <th>mobile</th>
                                <th>twitter_link</th>
                                <th>facebook_link</th>
                                <th>linkedin_link</th>
                                <th>instagram_link</th>
                                @canAny('edit setting','show setting','delete setting')
                                <th>operations</th>
                                @endcan
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($settings as $setting)
                                <tr>
                                    <td>{{ $setting->id }}</td>
                                    <td>{{ $setting->address }}</td>
                                    <td>{{ $setting->email }}</td>
                                    <td>{{ $setting->mobile }}</td>
                                    <td>{{ $setting->twitter_link }}</td>
                                    <td>{{ $setting->facebook_link }}</td>
                                    <td>{{ $setting->linkedin_link }}</td>
                                    <td>{{ $setting->instagram_link }}</td>
                                    <td>
                                        <div class="btn-group">
                                            @can('show setting')
                                                <a href="{{ route('settings.show', $setting->id) }}"
                                                    class="btn btn-success">Show</a>
                                            @endcan

                                            @can('edit setting')
                                                <a href=" {{ route('settings.edit', $setting->id) }}"
                                                    class="btn btn-warning">Edit</a>
                                            @endcan

                                            @can('delete setting')
                                                <button onclick="performDestroy({{ $setting->id }} , this)" type="button"
                                                    class="btn btn-danger">Delete</button>
                                            @endcan

                                        </div>

                                    </td>

                                </tr>
                            @endforeach


                        </tbody>
                    </table>

                    {{ $settings->links() }}

                </div>

            </div>
        </div>
    </div>


@endsection

@section('scripts')
    <script>
        function performDestroy(id, referance) {
            let url = '/cms/admin/settings/' + id
            confirmDestroy(url, referance)
            console.log(referance)
        }
    </script>
@endsection
