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
                <div class="product-slider owl-carousel col-sm col-md-6 col-lg ftco-animate">
                    @forelse ($products as $product)
                        <div class="product">
                            <a href="{{ route('product-detail', $product->slug) }}" class="img-prod">
                                <img class="img-fluid" src="/storage/{{ $product->image }}" alt="">
                            </a>
                            <div class="text py-3 px-3">
                                <h3><a href="#">{{ $product->name }}</a></h3>
                                <div class="d-flex">
                                    <div class="pricing">
                                        <p class="price"><span>{{ presetPrice($product->price) }}</span></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <h1 class="heading">PRODUCTS NOT AVAILABLE</h1>
                    @endforelse
                </div>
            </div>
        </div>
    </section>
@endsection
