@extends('layouts.app')

@section('header')
    <div class="hero-wrap js-fullheight" style="background-image: url({{ asset('images/bg_header.jpg') }})">
        <div class="overlay"></div>
        <div class="container">
            <div class="row no-gutters slider-text js-fullheight align-items-center justify-content-center">
                <h3 class="v">Cibaba Jewelry</h3>
                <h3 class="vr">Since 1998</h3>
                <div class="col-md-11 ftco-animate text-left">
                    <h2>Find more jewelry creations here.</h2>
                    <h2><span>Wear Your Diamond</span></h2>
                </div>
                {{-- <div class="mouse">
                    <a href="#" class="mouse-icon">
                        <div class="mouse-wheel"><span class="ion-ios-arrow-down"></span></div>
                    </a>
                </div> --}}
            </div>
        </div>
    </div>
    <div class="goto-here"></div>
@endsection

@section('content')
    <section class="ftco-section ftco-product">
    	<div class="container">
            <div class="row justify-content-center mb-3 pb-3">
                <div class="col-md-12 heading-section text-center ftco-animate">
                    <h1 class="big">Trending</h1>
                    <h2 class="mb-4">Trending</h2>
                </div>
            </div>
    		<div class="row">
    			<div class="col-md-12">
                    <div class="product-slider owl-carousel ftco-animate">
                        @foreach ($products as $product)
                            @if ($product->trending)
                                <div class="item">
                                    <div class="product">
                                        <a href="{{ route('product-detail', $product->slug) }}" class="img-prod">
                                            <img class="img-fluid" src="storage/{{ $product->image }}" alt="">
                                        </a>
                                        <div class="text pt-3 px-3">
                                            <h3><a href="#">{{ $product->name }}</a></h3>
                                            <div class="d-flex">
                                                <div class="pricing">
                                                    <p class="price"><span>{{ presetPrice($product->price) }}</span></p>
                                                </div>
                                                {{-- <div class="rating">
                                                    <p class="text-right">
                                                        <span class="ion-ios-star-outline"></span>
                                                        <span class="ion-ios-star-outline"></span>
                                                        <span class="ion-ios-star-outline"></span>
                                                        <span class="ion-ios-star-outline"></span>
                                                        <span class="ion-ios-star-outline"></span>
                                                    </p>
                                                </div> --}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
    			</div>
    		</div>
    	</div>
    </section>

    <section class="ftco-section ftco-no-pb ftco-no-pt bg-light">
        <div class="container">
            <div class="row">
                <div class="col-md-5 p-md-5 img img-2 d-flex justify-content-center align-items-center" style="background-image: url({{ asset('images/logo/cibaba.png')}})">
                    <a href="https://vimeo.com/359439636" class="icon popup-vimeo d-flex justify-content-center align-items-center">
                        <span class="icon-play"></span>
                    </a>
                </div>
                <div class="col-md-7 py-5 wrap-about pb-md-5 ftco-animate">
                    <div class="heading-section-bold mb-5 mt-md-5">
                        <div class="ml-md-0">
                            <h2 class="mb-4">About <span>Us</span></h2>
                        </div>
                    </div>
                    <div class="pb-md-5">
                        <p class="text-justify">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus a lectus quis ex consequat dapibus. Aliquam elementum rhoncus malesuada. Nullam quis tellus dui. Etiam viverra tortor condimentum mi euismod rhoncus. Nullam feugiat augue sit amet enim sodales, id porta risus eleifend. Nullam urna urna, elementum quis molestie ut, ullamcorper id odio. Sed non purus hendrerit odio luctus feugiat ut id ex. Sed accumsan posuere eleifend. Pellentesque quis justo purus.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="ftco-section">
    	<div class="container">
            <div class="row justify-content-center mb-3 pb-3">
                <div class="col-md-12 heading-section text-center ftco-animate">
                    <h1 class="big">Products</h1>
                    <h2 class="mb-4">Our Products</h2>
                </div>
            </div>
    	</div>
    	<div class="container-fluid">
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
                                    {{-- <div class="rating">
                                        <p class="text-right">
                                            <span class="ion-ios-star-outline"></span>
                                            <span class="ion-ios-star-outline"></span>
                                            <span class="ion-ios-star-outline"></span>
                                            <span class="ion-ios-star-outline"></span>
                                            <span class="ion-ios-star-outline"></span>
                                        </p>
                                    </div> --}}
                                </div>
                                {{-- <hr>
                                <p class="bottom-area d-flex">
                                    <a href="#" class="add-to-cart"><span>Add to cart <i class="ion-ios-add ml-1"></i></span></a>
                                    <a href="#" class="ml-auto"><span><i class="ion-ios-heart-empty"></i></span></a>
                                </p> --}}
                            </div>
                        </div>
                    @empty
                        <h1 class="heading">PRODUCTS NOT AVAILABLE</h1>
                    @endforelse
    			</div>
    		</div>
    	</div>
    </section>

    {{-- <section class="ftco-section ftco-section-more img" style="background-image: url({{ asset('images/bg.jpg') }})">
    	<div class="container">
    		<div class="row justify-content-center mb-3 pb-3">
                <div class="col-md-12 heading-section ftco-animate">
          	        <h2 class="text-right">PROMO NOW!</h2>
                </div>
            </div>
    	</div>
    </section> --}}

    {{-- <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center mb-3 pb-3">
                <div class="col-md-12 heading-section text-center ftco-animate">
                    <h1 class="big">Blog</h1>
                    <h2>Recent Blog</h2>
                </div>
            </div>
            <div class="row d-flex">
                <div class="col-md-4 d-flex ftco-animate">
                    <div class="blog-entry align-self-stretch">
                        <a href="blog-single.html" class="block-20" style="background-image: url({{ asset('images/image_1.jpg') }})"></a>
                        <div class="text mt-3 d-block">
                            <h3 class="heading mt-3"><a href="#">Even the all-powerful Pointing has no control about the blind texts</a></h3>
                            <div class="meta mb-3">
                                <div><a href="#">Dec 6, 2018</a></div>
                                <div><a href="#">Admin</a></div>
                                <div><a href="#" class="meta-chat"><span class="icon-chat"></span> 3</a></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 d-flex ftco-animate">
                    <div class="blog-entry align-self-stretch">
                        <a href="blog-single.html" class="block-20" style="background-image: url({{ asset('images/image_1.jpg') }})"></a>
                        <div class="text mt-3">
                            <h3 class="heading mt-3"><a href="#">Even the all-powerful Pointing has no control about the blind texts</a></h3>
                            <div class="meta mb-3">
                                <div><a href="#">Dec 6, 2018</a></div>
                                <div><a href="#">Admin</a></div>
                                <div><a href="#" class="meta-chat"><span class="icon-chat"></span> 3</a></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 d-flex ftco-animate">
                    <div class="blog-entry align-self-stretch">
                        <a href="blog-single.html" class="block-20" style="background-image: url({{ asset('images/image_1.jpg') }})"></a>
                    <div class="text mt-3">
                        <h3 class="heading mt-3"><a href="#">Even the all-powerful Pointing has no control about the blind texts</a></h3>
                        <div class="meta mb-3">
                            <div><a href="#">Dec 6, 2018</a></div>
                            <div><a href="#">Admin</a></div>
                            <div><a href="#" class="meta-chat"><span class="icon-chat"></span> 3</a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}

    {{-- <section class="ftco-section ftco-counter img" id="section-counter" style="background-image: url({{ asset('images/bg_4.jpg') }})">
    	<div class="container">
    		<div class="row justify-content-center py-5">
    			<div class="col-md-10">
		    		<div class="row">
                        <div class="col-md-3 d-flex justify-content-center counter-wrap ftco-animate">
                            <div class="block-18 text-center">
                                <div class="text">
                                    <strong class="number" data-number="10000">0</strong>
                                    <span>Happy Customers</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 d-flex justify-content-center counter-wrap ftco-animate">
                            <div class="block-18 text-center">
                                <div class="text">
                                    <strong class="number" data-number="100">0</strong>
                                    <span>Branches</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 d-flex justify-content-center counter-wrap ftco-animate">
                            <div class="block-18 text-center">
                                <div class="text">
                                    <strong class="number" data-number="1000">0</strong>
                                    <span>Partner</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 d-flex justify-content-center counter-wrap ftco-animate">
                            <div class="block-18 text-center">
                                <div class="text">
                                    <strong class="number" data-number="100">0</strong>
                                    <span>Awards</span>
                                </div>
                            </div>
                        </div>
		            </div>
	            </div>
            </div>
    	</div>
    </section> --}}

    <section class="ftco-section ftco-services bg-light">
    	<div class="container">
            <div class="row justify-content-center mb-3 pb-3">
                <div class="col-md-12 heading-section text-center ftco-animate">
                    <h1 class="big">Services</h1>
                    <h2>We want you to express yourself</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 text-center d-flex align-self-stretch ftco-animate">
                    <div class="media block-6 services">
                        <div class="icon d-flex justify-content-center align-items-center mb-4">
            		        <span class="flaticon-002-recommended"></span>
                        </div>
                        <div class="media-body">
                            <h3 class="heading">Refund Policy</h3>
                            <p>Even the all-powerful Pointing has no control about the blind texts it is an almost unorthographic.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 text-center d-flex align-self-stretch ftco-animate">
                    <div class="media block-6 services">
                        <div class="icon d-flex justify-content-center align-items-center mb-4">
                            <span class="flaticon-001-box"></span>
                        </div>
                        <div class="media-body">
                            <h3 class="heading">Product Warranty</h3>
                            <p>Even the all-powerful Pointing has no control about the blind texts it is an almost unorthographic.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 text-center d-flex align-self-stretch ftco-animate">
                    <div class="media block-6 services">
                        <div class="icon d-flex justify-content-center align-items-center mb-4">
                            <span class="flaticon-003-medal"></span>
                        </div>
                        <div class="media-body">
                            <h3 class="heading">Superior Quality</h3>
                            <p>Even the all-powerful Pointing has no control about the blind texts it is an almost unorthographic.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- <section class="ftco-section-parallax">
        <div class="parallax-img d-flex align-items-center">
            <div class="container">
                <div class="row d-flex justify-content-center py-5">
                    <div class="col-md-7 text-center heading-section ftco-animate">
            	        <h1 class="big">Subscribe</h1>
                        <h2>Subcribe to our Newsletter</h2>
                        <div class="row d-flex justify-content-center mt-5">
                            <div class="col-md-8">
                                <form action="#" class="subscribe-form">
                                    <div class="form-group d-flex">
                                        <input type="text" class="form-control" placeholder="Enter email address">
                                        <input type="submit" value="Subscribe" class="submit px-3">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}
@endsection
