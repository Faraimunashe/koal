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
                    <form method="POST" action="{{route('user-add-cow')}}">
                        @csrf
                        <input type="hidden" name="book_id" value="{{$booking->id}}" required>
                        <div class="card-body">
                            <h4 class="card-title">Add Cattle</h4>
                            <div class="input-group mb-4">
                                <select name="gender" class="form-control" required>
                                    <option selected disabled>Select Gender</option>
                                    <option value="Bull">Bull</option>
                                    <option value="Cow">Cow</option>
                                </select>
                            </div>
                            <div class="input-group mb-4">
                                <input type="text" name="color" class="form-control" placeholder="Color" required>
                            </div>
                            <div class="input-group mb-4">
                                <input type="text" name="breed" class="form-control" placeholder="Breed" required>
                            </div>
                            <div class="input-group mb-4">
                                <input type="text" name="description" class="form-control" placeholder="Weight and other special features.">
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <button type="submit" class="btn btn-outline-success btn-block btn-fw">
                                        Book
                                    </button>
                                </div>
                                <div class="col-md-6">
                                    <a href="{{route('dashboard')}}" class="btn btn-outline-danger btn-block btn-fw">
                                        Enough
                                    </a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
