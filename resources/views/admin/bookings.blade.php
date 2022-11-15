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
                            <h4 class="card-title mb-sm-0">Booking List</h4>
                        </div>
                        <div class="table-responsive border rounded p-1">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="font-weight-bold">#</th>
                                        <th class="font-weight-bold">Purpose</th>
                                        <th class="font-weight-bold">Cattle</th>
                                        <th class="font-weight-bold">Price</th>
                                        <th class="font-weight-bold">Status</th>
                                        <th class="font-weight-bold">User</th>
                                        <th class="font-weight-bold">Abattoir</th>
                                        <th class="font-weight-bold">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $count = 0;
                                    @endphp
                                    @foreach ($bookings as $item)
                                        <tr>
                                            <td>
                                                @php
                                                    $count++;
                                                    echo $count;
                                                @endphp
                                            </td>
                                            <td>{{ $item->purpose }}</td>
                                            <td>
                                                <a href="{{route('admin-cattle', $item->id)}}">
                                                    {{count_cattle($item->id)}}
                                                </a>
                                            </td>
                                            <td>${{$item->price}}</td>
                                            <td>
                                                <div class="badge badge-{{get_booking_status($item->status)->badge}} p-2">{{ get_booking_status($item->status)->label }}</div>
                                            </td>
                                            <td>{{ get_user($item->user_id)->name }}</td>
                                            <td>{{ get_abattoir($item->abattoir_id)->name }}</td>
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
                                                    <form method="POST" action="{{route('admin-reply-booking')}}">
                                                        @csrf
                                                        <input type="hidden" name="booking_id" value="{{$item->id}}" required>
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Update Booking</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <label for="status">Status</label>
                                                                <select name="status" id="status" class="form-control" required>
                                                                    <option selected disabled>Selected Status</option>
                                                                    <option value="1">Approved</option>
                                                                    <option value="0">Rejected</option>
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="price">Price</label>
                                                                <input type="text" name="price" id="price" class="form-control" placeholder="Enter amount" required>
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
                                {{$bookings->links('pagination::bootstrap-4')}}
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
