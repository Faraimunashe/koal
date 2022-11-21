<x-app-layout>
    <div class="content-wrapper">
        <div class="row purchace-popup">
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
            <div class="col-md-6 stretch-card grid-margin">
                <div class="card card-secondary">
                    <span class="card-body d-lg-flex align-items-center">
                        <p class="mb-lg-0">You can inquire about the pricing of our services here.</p>
                        <a href="{{route('user-create-booking')}}" class="btn btn-success purchase-button btn-sm my-1 my-sm-0 ml-auto">
                            Create Booking
                        </a>
                    </span>
                </div>
            </div>
            <div class="col-md-6 stretch-card grid-margin">
                <div class="card card-secondary">
                    <span class="card-body d-lg-flex align-items-center">
                        <p class="mb-lg-0">You can inquire about the pricing of our services here.</p>
                        <button type="button" class="btn btn-danger purchase-button btn-sm my-1 my-sm-0 ml-auto" data-toggle="modal" data-target="#exampleModal">
                            Get Quote
                        </button>
                    </span>
                </div>
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
                                            <td>
                                                @if ($item->payment)
                                                    <div class="badge badge-primary p-2">paid</div>
                                                @else
                                                    ${{$item->price}}
                                                @endif
                                            </td>
                                            <td>
                                                <div class="badge badge-{{get_booking_status($item->status)->badge}} p-2">{{ get_booking_status($item->status)->label }}</div>
                                            </td>
                                            <td>{{ get_abattoir($item->abattoir_id)->name }}</td>
                                            <td>
                                                @if ($item->status == 1)
                                                    @if (!$item->payment)
                                                        <button type="button" class="btn btn-inverse-primary" data-toggle="modal" data-target="#editPriceModal{{$item->id}}">
                                                            Paynow
                                                            <div></div>
                                                        </button>
                                                    @else
                                                        <a href="{{route('user-booking-details', $item->id)}}">
                                                            more ...
                                                        </a>
                                                    @endif
                                                @endif
                                            </td>
                                        </tr>
                                        <!--Edit Modal -->
                                        <div class="modal fade" id="editPriceModal{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <form method="POST" action="{{route('user-pay')}}">
                                                        @csrf
                                                        <input type="hidden" name="price" value="{{$item->price}}" required>
                                                        <input type="hidden" name="booking_id" value="{{$item->id}}" required>
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Make Payment</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <label for="phone">Phone</label>
                                                                <input type="tel" name="phone" id="phone" class="form-control" placeholder="Enter phone" required>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-success">Start payment</button>
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

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form method="POST" action="{{route('user-get-quote')}}">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Request a quote</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="unit">Service</label>
                            <input type="text" name="purpose" class="form-control" value="Slaughter" readonly>
                        </div>
                        <div class="form-group">
                            <label for="cattle">Number of Cattle</label>
                            <input type="text" name="cattle" class="form-control" placeholder="total cattle" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-warning">Request Quote</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
