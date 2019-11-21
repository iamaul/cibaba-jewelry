@extends('layouts.app')

@section('header')
    <div class="hero-wrap hero-bread">
        <div class="container">
            <div class="row no-gutters slider-text align-items-center justify-content-center">
                <div class="col-md-9 ftco-animate text-center">
                    <h1 class="mb-0 bread">{{ $title }}</h1>
                    <p class="breadcrumbs">
                        <span class="mr-2">
                            <a href="/">Home</a>
                        </span>
                        <span class="mr-2">
                            <a href="/catalog">Catalog</a>
                        </span>
                        <span>Product Detail</span>
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
                <div class="col-lg-6 mb-5 ftco-animate">
                    <a href="/storage/{{ $product->image }}" class="image-popup">
                        <img src="/storage/{{ $product->image }}" class="img-fluid" alt="Product Image">
                    </a>
                </div>
                <div class="col-lg-6 product-details pl-md-5 ftco-animate">
                    <h3>{{ $product->name }}</h3>
                    <p class="price">
                        <span>{{ presetPrice($product->price) }}</span>
                    </p>
                    <p class="text-justify">{!! $product->description !!}</p>
                    <div class="row mt-4">
                        <div class="col-md-6">
                            <div class="form-group d-flex">
                                <div class="select-wrap">
                                    <div class="icon">
                                        <span class="ion-ios-arrow-down"></span>
                                    </div>
                                    <select name="" id="" class="form-control">
                                        <option value="">Small</option>
                                        <option value="">Medium</option>
                                        <option value="">Large</option>
                                        <option value="">Extra Large</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        {{-- <div class="w-100"></div>
                            <div class="input-group col-md-6 d-flex mb-3">
                                <span class="input-group-btn mr-2">
                                    <button type="button" class="quantity-left-minus btn"  data-type="minus" data-field="">
                                        <i class="ion-ios-remove"></i>
                                    </button>
                                </span>
                                <input type="text" id="quantity" name="quantity" class="form-control input-number" value="1" min="1" max="100">
                                <span class="input-group-btn ml-2">
                                    <button type="button" class="quantity-right-plus btn" data-type="plus" data-field="">
                                        <i class="ion-ios-add"></i>
                                    </button>
                                </span>
                            </div>
                        </div>
                        <p><a href="cart.html" class="btn btn-primary py-3 px-5">Add to Cart</a></p> --}}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
