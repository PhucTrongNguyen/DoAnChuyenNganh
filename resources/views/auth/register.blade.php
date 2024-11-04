<div class="position-absolute top-50 start-50 translate-middle bg-light p-5 rounded-4">
    <button class="btn btn-primary position-absolute" style="top: 10px; right: 10px;" onclick="closeRegisterForm()">
        <i class="fa-solid fa-xmark"></i>
    </button>
    <form class="" action="{{ route('register') }}" method="POST">
        {!! csrf_field() !!}
        <div class="row">
            <div class="col-6">
                <div id="err" style="color: red">
                    @if(session()->has('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif
                </div>
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input name="name" type="text" value="{{ old('name') }}" required class="form-control" id="name" aria-describedby="emailHelp">
                    @if ($errors->has('name'))
                        <span class="text-danger">{{ $errors->first('name') }}</span>
                    @endif
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email address</label>
                    <input name="email" type="email" value="{{ old('email') }}" required class="form-control" id="email" aria-describedby="emailHelp">
                    @if ($errors->has('email'))
                        <span class="text-danger">{{ $errors->first('email') }}</span>
                    @endif
                    <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input name="password" type="password" class="form-control" id="password" required>
                    @if ($errors->has('password'))
                        <span class="text-danger">{{ $errors->first('password') }}</span>
                    @endif
                </div>
                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">Repeat Password</label>
                    <input name="password_confirmation" type="password" class="form-control" id="password_confirmation">
                    @if ($errors->has('password_confirmation'))
                        <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
                    @endif
                </div>
                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                    <label class="form-check-label" for="exampleCheck1">Check me out</label>
                </div>
            </div>
            <div class="col-6 d-flex flex-column justify-content-center align-item-center">
                <button type="submit" class="btn btn-primary">Register</button>
                <p class="text-center mt-5">OR</p>
                <div class="position-relative mt-5 d-flex flex-row">

                </div>
            </div>
        </div>


    </form>

</div>