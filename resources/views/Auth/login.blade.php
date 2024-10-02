<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/scss/login.scss', 'resources/js/login.js'])
    <title>Đăng nhập | Đăng kí</title>
</head>
<body>

<div class="card col-md-6 col-lg-4">
    <!-- Pills navs -->
    <ul class="nav nav-pills nav-justified mb-3" id="ex1" role="tablist">
        <li class="nav-item" role="presentation">
            <a class="nav-link active" id="tab-login" data-bs-toggle="pill" href="#pills-login" role="tab"
               aria-controls="pills-login" aria-selected="true">Login</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="tab-register" data-bs-toggle="pill" href="#pills-register" role="tab"
               aria-controls="pills-register" aria-selected="false">Register</a>
        </li>
    </ul>
    <!-- Pills navs -->

    <!-- Pills content -->
    <div class="tab-content">
        <!-- Login Tab -->
        <div class="tab-pane fade show active" id="pills-login" role="tabpanel" aria-labelledby="tab-login">
            <form>
                <div class="text-center mb-3">
                    <p>Sign in with:</p>
                    <button type="button" class="btn btn-link btn-floating mx-1">
                        <i class="fab fa-facebook-f"></i>
                    </button>
                    <button type="button" class="btn btn-link btn-floating mx-1">
                        <i class="fab fa-google"></i>
                    </button>
                    <button type="button" class="btn btn-link btn-floating mx-1">
                        <i class="fab fa-twitter"></i>
                    </button>
                    <button type="button" class="btn btn-link btn-floating mx-1">
                        <i class="fab fa-github"></i>
                    </button>
                </div>

                <p class="text-center">or:</p>

                <!-- Email input -->
                <div class="form-outline mb-4">
                    <input type="email" id="loginName" class="form-control" placeholder="Email or username" required />
                </div>

                <!-- Password input -->
                <div class="form-outline mb-4 position-relative">
                    <input type="password" id="loginPassword" class="form-control" placeholder="Password" required />
                    <i class="fas fa-eye toggle-password" onclick="togglePassword('loginPassword')"></i>
                </div>

                <!-- 2 column grid layout -->
                <div class="row mb-4">
                    <div class="col-md-6 d-flex justify-content-center">
                        <!-- Checkbox -->
                        <div class="form-check mb-3 mb-md-0">
                            <input class="form-check-input" type="checkbox" value="" id="loginCheck" checked />
                            <label class="form-check-label" for="loginCheck"> Remember me </label>
                        </div>
                    </div>

                    <div class="col-md-6 d-flex justify-content-center">
                        <!-- Simple link -->
                        <a href="#!">Forgot password?</a>
                    </div>
                </div>

                <!-- Submit button -->
                <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-primary mb-4">Sign in</button>
                </div>


                <!-- Register buttons -->
                <div class="text-center">
                    <p>Not a member? <a href="#!">Register</a></p>
                </div>
            </form>
        </div>

        <!-- Register Tab -->
        <div class="tab-pane fade" id="pills-register" role="tabpanel" aria-labelledby="tab-register">
            <form>
                <div class="text-center mb-3">
                    <p>Sign up with:</p>
                    <button type="button" class="btn btn-link btn-floating mx-1">
                        <i class="fab fa-facebook-f"></i>
                    </button>
                    <button type="button" class="btn btn-link btn-floating mx-1">
                        <i class="fab fa-google"></i>
                    </button>
                    <button type="button" class="btn btn-link btn-floating mx-1">
                        <i class="fab fa-twitter"></i>
                    </button>
                    <button type="button" class="btn btn-link btn-floating mx-1">
                        <i class="fab fa-github"></i>
                    </button>
                </div>

                <p class="text-center">or:</p>

                <!-- Name input -->
                <div class="form-outline mb-4">
                    <input type="text" id="registerName" class="form-control" placeholder="Name" required />
                </div>

                <!-- Username input -->
                <div class="form-outline mb-4">
                    <input type="text" id="registerUsername" class="form-control" placeholder="Username" required />
                </div>

                <!-- Email input -->
                <div class="form-outline mb-4">
                    <input type="email" id="registerEmail" class="form-control" placeholder="Email" required />
                </div>

                <!-- Password input -->
                <div class="form-outline mb-4 position-relative">
                    <input type="password" id="registerPassword" class="form-control" placeholder="Password" required />
                    <i class="fas fa-eye toggle-password" onclick="togglePassword('registerPassword')"></i>
                </div>

                <!-- Repeat Password input -->
                <div class="form-outline mb-4 position-relative">
                    <input type="password" id="registerRepeatPassword" class="form-control" placeholder="Repeat password" required />
                    <i class="fas fa-eye toggle-password" onclick="togglePassword('registerRepeatPassword')"></i>
                </div>

                <!-- Checkbox -->
                <div class="form-check d-flex justify-content-center mb-4">
                    <input class="form-check-input me-2" type="checkbox" value="" id="registerCheck" checked />
                    <label class="form-check-label" for="registerCheck">
                        I have read and agree to the terms
                    </label>
                </div>

                <!-- Submit button -->
                <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-primary mb-4">Sign in</button>
                </div>

            </form>
        </div>
    </div>
    <!-- Pills content -->
</div>

</body>
</html>
