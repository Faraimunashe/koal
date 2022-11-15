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
                                            <td>{{ get_abattoir($item->abattoir_id)->name }}</td>
                                        </tr>
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
                <form method="POST" action="{{route('user-quote')}}">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Request a quote</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="table-responsive border rounded p-1">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th class="font-weight-bold">#</th>
                                            <th class="font-weight-bold">Name</th>
                                            <th class="font-weight-bold">Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $count = 0;
                                        @endphp
                                        @foreach (\App\Models\Price::all() as $item)
                                            <tr>
                                                <td>
                                                    @php
                                                        $count ++;
                                                        echo $count;
                                                    @endphp
                                                </td>
                                                <td>{{$item->name}}</td>
                                                <td>${{$item->amount}}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-warning">Print Quote</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
