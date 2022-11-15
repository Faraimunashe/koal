<x-app-layout>
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12">
                @if (Session::has('success'))
                    <div class="alert alert-success" role="alert">
                        {{ Session::get('success') }}
                    </div>
                @endif
                @if (Session::has('error'))
                    <div class="alert alert-danger" role="alert">
                        {{ Session::get('error') }}
                    </div>
                @endif
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="d-sm-flex align-items-center mb-4">
                            <h4 class="card-title mb-sm-0">Abattoir List</h4>
                            <button type="button" class="btn btn-success ml-auto mb-3 mb-sm-0" data-toggle="modal" data-target="#exampleModal">
                                Add New
                            </button>
                        </div>
                        <div class="table-responsive border rounded p-1">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="font-weight-bold">#</th>
                                        <th class="font-weight-bold">Name</th>
                                        <th class="font-weight-bold">Address</th>
                                        <th class="font-weight-bold">City</th>
                                        <th class="font-weight-bold">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $count = 0;
                                    @endphp
                                    @foreach ($abattoirs as $item)
                                        <tr>
                                            <td>
                                                @php
                                                    $count++;
                                                    echo $count;
                                                @endphp
                                            </td>
                                            <td>{{ $item->name }}</td>
                                            <td>{{$item->address}}</td>
                                            <td>{{$item->city}}</td>
                                            <td>
                                                <button type="button" class="btn btn-inverse-primary btn-icon" data-toggle="modal" data-target="#editPriceModal{{$item->id}}">
                                                    <i class="icon-note"></i>
                                                    <div></div>
                                                </button>
                                            </td>
                                        </tr>
                                        <!--Edit Modal -->
                                        <div class="modal fade" id="editPriceModal{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <form method="POST" action="{{route('admin-edit-abattoir')}}">
                                                        @csrf
                                                        <input type="hidden" name="abattoir_id" value="{{$item->id}}" required>
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Update Abattoir</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <label for="name">Name</label>
                                                                <input type="text" name="name" id="name" class="form-control" value="{{$item->name}}" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="address">Address</label>
                                                                <input type="text" name="address" class="form-control" id="address" value="{{$item->address}}" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="city">City</label>
                                                                <input type="text" name="city" id="city" class="form-control" value="{{$item->city}}" required>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-success">Save changes</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form method="POST" action="{{route('admin-add-abattoir')}}">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add New Abattoir</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" id="name" class="form-control" placeholder="Abattoir name" required>
                        </div>
                        <div class="form-group">
                            <label for="address">Address</label>
                            <input type="text" name="address" class="form-control" id="address" placeholder="Abattoir address" required>
                        </div>
                        <div class="form-group">
                            <label for="city">City</label>
                            <input type="text" name="city" id="city" class="form-control" placeholder="City" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
