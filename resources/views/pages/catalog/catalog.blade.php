@extends('layouts.app')

@section('header')
    <div class="hero-wrap hero-bread">
        <div class="container">
            <div class="row no-gutters slider-text align-items-center justify-content-center">
                <div class="col-md-9 ftco-animate text-center">
                    <h1 class="mb-0 bread">{{ request()->category }}</h1>
                    <p class="breadcrumbs">
                        <span class="mr-2">
                            <a href="/">Home</a>
                        </span>
                        <span class="mr-2">
                            Catalog
                        </span>
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <section class="ftco-section bg-light">
        <div class="container">
            <div class="row">
                <div class="swiper-container">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            @foreach ($products as $product)
                                <img
                                    src="/storage/{{ $product->image }}"
                                >
                                <div class="catalog-desc">
                                    <h3>{{ $product->name }}</h3>
                                    <p>{{ presetPrice($product->price) }}</p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <!-- Add Pagination -->
                    <div class="swiper-pagination"></div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('extra-js')
<script src="https://unpkg.com/swiper/js/swiper.js"></script>
<script src="https://unpkg.com/swiper/js/swiper.min.js"></script>
    <script>
        var swiper = new Swiper('.swiper-container', {
            direction: 'vertical',
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
        });
    </script>
@endsection
