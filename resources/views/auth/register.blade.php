<x-guest-layout>
    <div class="col-md-6 col-lg-7 d-flex align-items-center">
        <div class="card-body p-4 p-lg-5 text-black">
            <form action="{{route('register')}}" method="POST">
                @csrf
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Register new account</h5>
                <div class="form-outline mb-4">
                    <input type="text" name="name" id="name" class="form-control form-control-lg" />
                    <label class="form-label" for="name">Username</label>
                </div>

                <div class="form-outline mb-4">
                    <input type="email" name="email" id="email" class="form-control form-control-lg" />
                    <label class="form-label" for="email">Email address</label>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-outline mb-4">
                            <input type="password" name="password" id="password" class="form-control form-control-lg" />
                            <label class="form-label" for="password">Password</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-outline mb-4">
                            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control form-control-lg" />
                            <label class="form-label" for="password_confirmation">Confirm Password</label>
                        </div>
                    </div>
                </div>
                <div class="pt-1 mb-4">
                    <button class="btn btn-dark btn-lg btn-block" type="submit">Register</button>
                </div>
                <p class="mb-5 pb-lg-2" style="color: #393f81;">Already have an account? <a href="{{route('login')}}" style="color: #393f81;">Login here</a></p>
            </form>
        </div>
    </div>
</x-guest-layout>
