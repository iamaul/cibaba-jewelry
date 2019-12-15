@extends('layouts.app')

@section('header')
    <div class="hero-wrap hero-bread">
        <div class="container">
            <div class="row no-gutters slider-text align-items-center justify-content-center">
                <div class="col-md-9 ftco-animate text-center">
                    <p class="breadcrumbs">
                        <span class="mr-2">
                            <a href="/">Home</a>
                        </span>
                        <span class="mr-2">
                            Promo
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
                    @foreach ($products as $product)
                        @if ($product->promo)
                            <div class="product">
                                <a href="{{ route('product-detail', $product->slug) }}" class="img-prod">
                                    <img class="img-fluid" src="storage/{{ $product->image }}" alt="Product Image">
                                    <span class="status">{{ $product->discount }}%</span>
                                </a>
                                <div
                                    class="text py-3 px-3 h-100"
                                    style="
                                        border-radius: 10px;
                                        width: 100%;
                                        height: auto;
                                    "
                                >
                                    <h3><a href="#">{{ $product->name }}</a></h3>
                                    <div class="d-flex">
                                        <div class="pricing">
                                            <p class="price">
                                                <span class="mr-2 price-dc">{{ presetPrice($product->price) }}</span><span class="price-sale">{{ presetPrice($product->price-($product->price*($product->discount/100))) }}</span>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endsection
