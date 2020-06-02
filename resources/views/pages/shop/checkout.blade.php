@extends('layouts.app')

@section('header')
    <div class="hero-wrap hero-bread bg-light">
        <div class="container">
            <div class="row no-gutters slider-text align-items-center justify-content-center">
                <div class="col-md-9 ftco-animate text-center">
                    <p class="breadcrumbs">
                        <span class="mr-2">
                            <a href="/">Home</a>
                        </span>
                        <span class="mr-2">
                            <a href="/catalog">Shop</a>
                        </span>
                        <span>Checkout</span>
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col ftco-animate">
                    <form id="checkout" onsubmit="return proceedCheckout();" class="billing-form">
                        <h3 class="mb-4 billing-heading">Billing Details</h3>
                        <div class="row align-items-end">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="firstname">First Name</label>
                                    <input type="text" name="firstname" class="form-control" placeholder="" value="{{ old('firstname') }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="lastname">Last Name</label>
                                    <input type="text" name="lastname" class="form-control" placeholder="" value="{{ old('lastname') }}" required>
                                </div>
                            </div>
                            <div class="w-100"></div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="country">State / Country</label>
                                    <div class="select-wrap">
                                        <div class="icon"><span class="ion-ios-arrow-down"></span></div>
                                        <select name="country" id="country" class="form-control" required>
                                            <option value="">Select Country</option>
                                            <option value="Indonesia">* Indonesia</option>
                                            <option value="Singapore">Singapore</option>
                                            <option value="Malaysia">Malaysia</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="w-100"></div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="streetaddress">Street Address</label>
                                    <input type="text" name="address" class="form-control" placeholder="House number and street name" value="{{ old('firstname') }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" name="address_alt" class="form-control" placeholder="Appartment, suite, unit etc: (optional)">
                                </div>
                            </div>
                            <div class="w-100"></div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="towncity">Town / City</label>
                                    <input type="text" name="city" class="form-control" placeholder="" value="{{ old('city') }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="postcodezip">Postcode / ZIP *</label>
                                    <input type="text" name="postcode" class="form-control" placeholder="" value="{{ old('postcode') }}" required>
                                </div>
                            </div>
                            <div class="w-100"></div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="phone">Phone</label>
                                    <input type="number" name="phone" class="form-control" placeholder="" value="{{ old('phone') }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="emailaddress">Email Address</label>
                                    <input type="email" name="email" class="form-control" placeholder="" value="{{ old('email') }}" required>
                                </div>
                            </div>
                            <div class="w-100"></div>
                            {{-- <div class="col-md-12">
                                <div class="form-group mt-4">
                                    <div class="radio">
                                        <label class="mr-3"><input type="radio" name="optradio"> Create an Account? </label>
                                        <label><input type="radio" name="optradio"> Ship to different address</label>
                                    </div>
                                </div>
                            </div> --}}
                        </div>
                        <hr>
                        <div class="col">
                            <div class="row">
                                <div class="col-md-12 ftco-animate">
                                    <h3 class="mb-4 billing-heading">Order Details</h3>
                                    <p class="subheading text-uppercase font-weight-lighter">{{ Cart::count() }} item(s) in your order.</p>
                                    <div class="cart-list">
                                        <table class="table">
                                            <thead class="thead-primary">
                                                <tr class="text-center">
                                                    <th>&nbsp;</th>
                                                    <th>Product</th>
                                                    <th>Price</th>
                                                    <th>Quantity</th>
                                                    <th>Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach (Cart::content() as $item)
                                                    <tr class="text-center">
                                                        <td class="image-prod">
                                                            <img
                                                                class="img"
                                                                src="/storage/{{ $item->model->image }}"
                                                            />
                                                        </td>
                                                        <td class="product-name">
                                                            <h3>{{ $item->model->name }}</h3>
                                                        </td>
                                                        <td class="price">{{ $item->model->presetPrice() }}</td>
                                                        <td class="quantity">
                                                            <div class="input-group mb-3">
                                                                <input type="number" name="quantity" class="quantity form-control input-number text-center" value="{{ $item->qty }}" disabled>
                                                            </div>
                                                        </td>
                                                        <td class="total">{{ presetPrice($item->subtotal) }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="row justify-content-start">
                                <div class="col col-lg-5 col-md-6 mt-5 cart-wrap ftco-animate">
                                    <div class="cart-total mb-3">
                                        <h3>Order Totals</h3>
                                        <p class="d-flex">
                                            <span>Subtotal</span>
                                            <span>{{ presetPrice(Cart::subtotal()) }}</span>
                                        </p>
                                        <p class="d-flex">
                                            <span>Tax 10%</span>
                                            <span>{{ presetPrice(Cart::tax()) }}</span>
                                        </p>
                                        <hr>
                                        <p class="d-flex total-price">
                                            <span>Total</span>
                                            <span>{{ presetPrice(Cart::total()) }}</span>
                                        </p>
                                    </div>
                                    <p><button type="submit" class="btn btn-primary py-3 px-4">Place an order</button></p>
                                    <p class="text-left"><a href="{{ route('cart') }}" class="btn btn-primary py-3 px-4"><span class="icon-shopping_cart"></span> Back to My Cart</a></p>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('extra-js')
    <script
        src="https://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
        crossorigin="anonymous"></script>
    <script
        type="text/javascript"
        src="
            {{ !config('services.midtrans.isProduction') ?
                'https://app.sandbox.midtrans.com/snap/snap.js' : 'https://app.midtrans.com/snap/snap.js'
            }}
            "
        data-client-key="{{ config('services.midtrans.clientKey') }}"
    >
    </script>
    <script
        type="text/javascript"
    >
        function proceedCheckout() {
            $.post("{{ route('payment') }}",
            {
                _method: 'POST',
                _token: '{{ csrf_token() }}',
                firstname: $('input[name=firstname]').val(),
                lastname: $('input[name=lastname]').val(),
                country: $('select[name=country]').val(),
                address: $('input[name=address]').val(),
                address_type: $('input[name=address_type]').val(),
                city: $('input[name=city]').val(),
                postcode: $('input[name=postcode]').val(),
                phone: $('input[name=phone]').val(),
                email: $('input[name=email]').val()
            },
            function (data, status) {
                snap.pay(data.snap_token, {
                    // Optional
                    onSuccess: function (result) {
                        location.reload();
                    },
                    // Optional
                    onPending: function (result) {
                        location.reload();
                    },
                    // Optional
                    onError: function (result) {
                        location.reload();
                    }
                });
            });
            return false;
        }
    </script>
@endsection
