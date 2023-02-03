@extends('cms.parent')
@section('title', 'Contacts')


@section('styles')
@endsection

@section('content')
    <div class="row">
        <div class="col-12">


            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Contacts Table</h3>
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
                                <th>Name</th>
                                <th>Email</th>
                                <th>Subject</th>
                                <th>Message</th>
                                @canAny('show contact', 'delete contact')
                                    <th>operations</th>
                                @endcan
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($contacts as $contact)
                                <tr>
                                    <td>{{ $contact->id }}</td>
                                    <td>{{ $contact->name }}</td>
                                    <td>{{ $contact->email }}</td>
                                    <td>{{ $contact->subject }}</td>
                                    <td>{{ $contact->message }}</td>
                                    <td>
                                        <div class="btn-group">
                                            @can('show contact')
                                                <a href="{{ route('contacts.show', $contact->id) }}"
                                                    class="btn btn-success">Show</a>
                                            @endcan
                                            @can('delete contact')
                                                <button onclick="performDestroy({{ $contact->id }} , this)" type="button"
                                                    class="btn btn-danger">Delete</button>
                                            @endcan

                                        </div>

                                    </td>

                                </tr>
                            @endforeach


                        </tbody>
                    </table>

                    {{ $contacts->links() }}

                </div>

            </div>
        </div>
    </div>


@endsection

@section('scripts')
    <script>
        function performDestroy(id, referance) {
            let url = '/cms/admin/contacts/' + id
            confirmDestroy(url, referance)
            console.log(referance)
        }
    </script>
@endsection
