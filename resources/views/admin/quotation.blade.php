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
                                        <th class="font-weight-bold">Unit</th>
                                        <th class="font-weight-bold">Total</th>
                                        <th class="font-weight-bold">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $count = 0;
                                    @endphp
                                    @foreach ($quotations as $item)
                                        <tr>
                                            <td>
                                                @php
                                                    $count++;
                                                    echo $count;
                                                @endphp
                                            </td>
                                            <td>{{ $item->purpose }}</td>
                                            <td>
                                                {{ $item->cattle }}
                                            </td>
                                            <td>${{$item->unit}}</td>
                                            <td>${{$item->total}}</td>
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
                                                    <form method="POST" action="{{route('admin-add-quote')}}">
                                                        @csrf
                                                        <input type="hidden" name="quote_id" value="{{$item->id}}" required>
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Add Quotation</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="card-body">

                                                            <div class="form-group">
                                                                <label for="price">Unit Price</label>
                                                                <input type="text" name="unit" id="price" class="form-control" placeholder="Enter unit price">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="price">Total Price</label>
                                                                <input type="text" name="total" id="price" class="form-control" placeholder="Enter total price">
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
                                {{$quotations->links('pagination::bootstrap-4')}}
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
