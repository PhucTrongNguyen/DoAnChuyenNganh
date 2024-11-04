<div class="position-absolute top-50 start-50 translate-middle bg-light p-5 rounded-4">
<button class="btn btn-primary position-absolute" style="top: 10px; right: 10px;" onclick="closeLoginForm()">
<i class="fa-solid fa-xmark"></i>
</button>
    <div class="row">
        <div class="col-6">
            <form class="" action="{{route('login')}}" method="POST">
                {!! csrf_field() !!}
                <div id="err" style="color: red">
                    @if(session()->has('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email address</label>
                    <input name="email" type="email" class="form-control" id="username" aria-describedby="emailHelp">
                    <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input name="password" type="password" class="form-control" id="password">
                </div>
                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="remember" name="remember" {{old('remember') ? 'checked' : ''}}>
                    <label class="form-check-label" for="remember">{{__('Remember Me')}}</label>
                </div>

                <div class="form-group row mb-0">
                    <div class="">

                        <button type="submit" class="btn btn-primary">
                            {{__('Login')}}
                        </button>

                        <a onclick="showRegisterForm()" class="btn btn-primary" href="#">
                            {{ __('Register')}}
                        </a>
                    </div>
                </div>
            </form>
            
        </div>
        <div class="col-6">
            <img src="{{ URL('img/background_login.jpg') }}" class="img-thumbnail border-0" alt="...">
        </div>
    </div>
<!--{{ route('password.request')}}-->
</div>