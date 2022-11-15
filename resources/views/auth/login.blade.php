<x-guest-layout>
    <div class="col-md-6 col-lg-7 d-flex align-items-center">
        <div class="card-body p-4 p-lg-5 text-black">
            <form action="{{route('login')}}" method="POST">
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
                <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Login into your account</h5>
                <div class="form-outline mb-4">
                    <input type="email" name="email" id="form2Example17" class="form-control form-control-lg" />
                    <label class="form-label" for="form2Example17">Email address</label>
                </div>

                <div class="form-outline mb-4">
                    <input type="password" name="password" id="form2Example27" class="form-control form-control-lg" />
                    <label class="form-label" for="form2Example27">Password</label>
                </div>

                <div class="pt-1 mb-4">
                    <button class="btn btn-dark btn-lg btn-block" type="submit">Login</button>
                </div>
                <p class="mb-5 pb-lg-2" style="color: #393f81;">Don't have an account? <a href="{{route('register')}}" style="color: #393f81;">Register here</a></p>
            </form>
        </div>
    </div>
</x-guest-layout>
