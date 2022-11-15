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
                    <form method="POST" action="{{route('change-password')}}">
                        @csrf
                        <div class="card-body">
                            <h4 class="card-title">Change Password</h4>
                            <p class="card-description">Hey {{Auth::user()->name}}, do you want to change your password?</p>
                            <div class="input-group">
                                <input type="password" name="old_password" class="form-control" placeholder="Current Password" required>
                            </div>
                            <div class="input-group mt-3">
                                <input type="password" name="password" class="form-control" placeholder="New Password" required>
                            </div>
                            <div class="input-group mt-3">
                                <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm New Password" required>
                            </div>
                            <button type="submit" class="btn btn-outline-success btn-block btn-fw mt-3">
                                <i class="icon-settings"></i>
                                Change Password
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
