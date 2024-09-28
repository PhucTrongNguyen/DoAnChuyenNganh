<header class="py-3">
    <div class="container d-flex justify-content-between align-items-center">
        <!-- Logo -->
        <div class="logo">
            <a href="#">
                <img src="{{ URL('images/LOGO.png') }}" width="65" alt="Logo" class="">
            </a>
        </div>

        <!-- Authentication Links -->
        <div>
            <a href="#" class="me-2 text-decoration-none text-dark btn btn-outline-secondary border-0">Login | Register</a>
        </div>
    </div>

    <!-- Search and Icons -->
    <div class="container my-3 center-search">
        <div class="d-flex justify-content-center align-items-center">
            <div id="timkiem" class="input-group me-2">
                <form action="{{ route('products.search') }}" method="GET">
                    <div class="input-group">
                        <input type="text" name="keyword" class="form-control" placeholder="Search for products" required>
                        <button class="btn btn-outline-secondary" type="submit">🔍</button>
                    </div>
                </form>
            </div>

            <span class="me-2">
                <a href="#" class="text-decoration-none text-dark btn btn-outline-secondary border-0">
                    <i class="bi bi-heart"></i>
                </a>
            </span>
            <span>
                <a href="#" class="text-decoration-none text-dark btn btn-outline-secondary border-0">
                    <i class="bi bi-cart"></i>
                </a>
            </span>
        </div>
    </div>


    <!-- Navigation -->
    <nav class="bg-secondary">
        <div class="container">
            <ul class="nav justify-content-center">
                <li class="nav-item">
                    <a class="nav-link text-white" href="#">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="#">Shop</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="#">Blog</a>
                </li>

                <!-- Categories with Dropdown -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-white" href="#" id="categoriesDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Categories
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="categoriesDropdown">
                        <li><a class="dropdown-item" href="#">Category 1</a></li>
                        <li><a class="dropdown-item" href="#">Category 2</a></li>
                        <li><a class="dropdown-item" href="#">Category 3</a></li>
                        <li><a class="dropdown-item" href="#">Category 4</a></li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a class="nav-link text-white" href="#">Contact</a>
                </li>
            </ul>

        </div>
    </nav>

</header>
