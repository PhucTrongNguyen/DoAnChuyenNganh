@extends('Layout.app')

@section('content')
<div class="container-content">
    <!-- Main Content -->
    <main class="container mt-4">
        <!-- Featured Image -->
        <section class="mb-4">
            <img src="https://via.placeholder.com/1920x480" class="img-fluid" alt="Featured product">
        </section>

        <!-- Deals of the Week -->
        <section class="deals row mb-4">
            <div class="col-lg-4">
                <div class="card">
                    <img src="https://via.placeholder.com/150" class="card-img-top" alt="Deal product">
                    <div class="card-body">
                        <h5 class="card-title">Deals of the Week</h5>
                        <p>Category: <strong>Category Name</strong></p>
                        <p>Product: <strong>Name of product</strong></p>
                        <p><strong>$49.99</strong></p>
                        <p>Available: <span>10</span></p>
                        <p>Already sold: <span>5</span></p>
                        <div class="hurry-up">
                            <p>Hurry up: Offer ends in</p>
                            <div class="timer">00:00:00</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Product Listings -->
            <div class="col-lg-8">
                <ul class="nav nav-tabs" id="productTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="feat-tab" data-bs-toggle="tab" data-bs-target="#feat" type="button" role="tab" aria-controls="feat" aria-selected="true">Featured</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="sale-tab" data-bs-toggle="tab" data-bs-target="#sale" type="button" role="tab" aria-controls="sale" aria-selected="false">Best sale</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="best-tab" data-bs-toggle="tab" data-bs-target="#best" type="button" role="tab" aria-controls="best" aria-selected="false">Best Rated</button>
                    </li>
                </ul>

                <div class="tab-content" id="productTabContent">

                    <!-- Featured Products -->
                    <div class="tab-pane fade show active" id="feat" role="tabpanel" aria-labelledby="feat-tab">
                        <div class="row row-cols-2 row-cols-md-3 g-4 mt-3">
                            @foreach($featuredProducts as $product)
                                <div class="col">
                                    <div class="card">
                                        <img src="{{ asset('images/' . $product->picture) }}" class="card-img-top" alt="{{ $product->name }}">
                                        <div class="card-body">
                                            <h5 class="card-title">${{ $product->price }}</h5>
                                            <p class="card-text">{{ $product->name }}</p>
                                        </div>
                                    </div>
                                </div>
                                @if ($loop->iteration % 12 == 0) <!-- Kiểm tra xem có đủ 12 sản phẩm không -->
                                    @break
                                @endif
                            @endforeach
                        </div>

                        <!-- Pagination Dots -->
                        <ul class="pagination-dots">
                            @for($i = 0; $i < ceil($featuredProducts->count() / 12); $i++)
                                <li class="{{ $i == 0 ? 'active' : '' }}" data-page="{{ $i }}"></li>
                            @endfor
                        </ul>
                    </div>

                    <!-- Best Sale Products -->
                    <div class="tab-pane fade" id="sale" role="tabpanel" aria-labelledby="sale-tab">
                        <div class="row row-cols-2 row-cols-md-3 g-4 mt-3">
                            @foreach($bestSaleProducts as $product)
                                <div class="col">
                                    <div class="card">
                                        <img src="{{ asset('images/' . $product->picture) }}" class="card-img-top" alt="{{ $product->name }}">
                                        <div class="card-body">
                                            <h5 class="card-title">${{ $product->price }}</h5>
                                            <p class="card-text">{{ $product->name }}</p>
                                        </div>
                                    </div>
                                </div>
                                @if ($loop->iteration % 12 == 0) <!-- Kiểm tra xem có đủ 12 sản phẩm không -->
                                    @break
                                @endif
                            @endforeach
                        </div>

                        <!-- Pagination Dots -->
                        <ul class="pagination-dots">
                            @for($i = 0; $i < ceil($bestSaleProducts->count() / 12); $i++)
                                <li class="{{ $i == 0 ? 'active' : '' }}" data-page="{{ $i }}"></li>
                            @endfor
                        </ul>
                    </div>

                    <!-- Best Rated Products -->
                    <div class="tab-pane fade" id="best" role="tabpanel" aria-labelledby="best-tab">
                        <div class="row row-cols-2 row-cols-md-3 g-4 mt-3">
                            @foreach($bestRatedProducts as $product)
                                <div class="col">
                                    <div class="card">
                                        <img src="{{ asset('images/' . $product->picture) }}" class="card-img-top" alt="{{ $product->name }}">
                                        <div class="card-body">
                                            <h5 class="card-title">${{ $product->price }}</h5>
                                            <p class="card-text">{{ $product->name }}</p>
                                        </div>
                                    </div>
                                </div>
                                @if ($loop->iteration % 12 == 0) <!-- Kiểm tra xem có đủ 12 sản phẩm không -->
                                    @break
                                @endif
                            @endforeach
                        </div>

                        <!-- Pagination Dots -->
                        <ul class="pagination-dots">
                            @for($i = 0; $i < ceil($bestRatedProducts->count() / 12); $i++)
                                <li class="{{ $i == 0 ? 'active' : '' }}" data-page="{{ $i }}"></li>
                            @endfor
                        </ul>
                    </div>

                </div>
            </div>
        </section>

        <!-- Hot New Arrivals Section -->
        <section>
            <h2>Hot New Arrivals</h2>
            <div class="row row-cols-2 row-cols-md-4 g-4 mt-3">
                @foreach($hotNewArrivals as $product)
                    <div class="col">
                        <div class="card">
                            <img src="{{ asset('images/' . $product->picture) }}" class="card-img-top" alt="{{ $product->name }}">
                            <div class="card-body">
                                <h5 class="card-title">${{ $product->price }}</h5>
                                <p class="card-text">{{ $product->name }}</p>
                            </div>
                        </div>
                    </div>
                    @if ($loop->iteration % 4 == 0) <!-- Kiểm tra xem có đủ 4 sản phẩm không -->
                        @break
                    @endif
                @endforeach
            </div>

            <!-- Pagination Dots -->
            <ul class="pagination-dots">
                @for($i = 0; $i < ceil($hotNewArrivals->count() / 4); $i++)
                    <li class="{{ $i == 0 ? 'active' : '' }}" data-page="{{ $i }}"></li>
                @endfor
            </ul>
        </section>

    </main>
</div>

@endsection
