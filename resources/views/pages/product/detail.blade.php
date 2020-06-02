@extends('layouts.app')

@section('header')
    <div class="hero-wrap hero-bread bg-light">
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
    <section class="ftco-section">
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
                        <p>
                            <a 
                                href="#" 
                                class="add-to-cart btn btn-primary py-3 px-5"
                                data-id="{{ $product->id }}"
                                data-name="{{ $product->name }}"
                                data-price="{{ $product->price }}"
                            >
                                Add to Cart
                            </a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('extra-js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8.17.1/dist/sweetalert2.all.min.js"></script>
    <script>
        $(document).ready(function() {
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $(".add-to-cart").on('click', function(e) {
                e.stopPropagation();
                e.stopImmediatePropagation();

                const id = $(this).attr('data-id');
                const name = $(this).attr('data-name');
                const price = $(this).attr('data-price');

                $.ajax({
                    url: `/shopping/add/cart/${id}/${name}/${price}`,
                    type: 'POST',
                    data: {
                        '_token': CSRF_TOKEN,
                        id: id,
                        name: name,
                        price: price
                    },
                    dataType: 'JSON',
                    success: function(response) {
                        Swal.fire({
                            title: 'Success',
                            html: `Added <b>${response.item}</b> to your cart`,
                            type: 'success',
                            showCancelButton: true,
                            confirmButtonColor: '#b1c4d9',
                            cancelButtonColor: '#b1c4d9',
                            confirmButtonText: 'Go to My Cart',
                            cancelButtonText: 'Continue Shopping'
                        }).then((result) => {
                            if (result.value) {
                                window.location.href = '{{ route('cart') }}';
                            }
                        });
                    },
                    error: function(xhr, status, error) {
                        var errorMessage = xhr.status + ': ' + xhr.statusText
                        console.log(`An unexpected error has occurred: ${errorMessage}`);
                    }
                });
            });
        });
	</script>
@endsection
