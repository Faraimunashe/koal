<x-app-layout>
    <div class="content-wrapper align-items-center">
        <div class="row">
            <div class="col-md-12">
                @if (Session::has('success'))
                    <div class="alert alert-success" role="alert">
                        {{Session::get('success')}}
                    </div>
                @endif
                @if (Session::has('error'))
                    <div class="alert alert-danger" role="alert">
                        {{Session::get('error')}}
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
            <div class="col-md-6 grid-margin stretch-card" id="pakati">
                <div class="card">
                    <form method="POST" action="{{route('user-add-book')}}">
                        @csrf
                        <div class="card-body">
                            <h4 class="card-title">Create Booking</h4>
                            <div class="input-group mb-4">
                                <input type="text" name="purpose" class="form-control" value="Slaughter" required readonly>
                            </div>
                            <div class="input-group mb-4">
                                <select name="abattoir_id" class="form-control" required>
                                    <option selected disabled>Select Abattoir</option>
                                    @foreach (\App\Models\Abattoir::all() as $item)
                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-outline-success btn-block btn-fw">
                                Book
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
