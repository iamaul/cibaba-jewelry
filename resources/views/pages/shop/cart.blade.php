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
                        <span>Cart</span>
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <section class="ftco-section ftco-cart">
        <div class="container">
            @if (Cart::count() > 0)
                <div class="row">
                    <div class="col-md-12 ftco-animate">
                        <p class="subheading text-uppercase font-weight-lighter">{{ Cart::count() }} item(s) in your cart.</p>
                        <div class="cart-list">
                            <table class="table">
                                <thead class="thead-primary">
                                    <tr class="text-center">
                                        <th>&nbsp;</th>
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
                                            <td class="product-remove">
                                                <form action="{{ route('removeCartItem', $item->rowId) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-block"><span class="ion-ios-close"></span></button>
                                                </form>
                                            </td>
                                            <td class="image-prod">
                                                <img class="img" src="/storage/{{ $item->model->image }}">
                                            </td>
                                            <td class="product-name">
                                                <h3>{{ $item->model->name }}</h3>
											    <p>{!! $item->model->description !!}</p>
                                            </td>
                                            <td class="price">{{ $item->model->presetPrice() }}</td>
                                            <td class="quantity">
                                                <div class="input-group mb-3">
                                                    <input type="number" name="quantity" class="quantity form-control input-number" value="{{ $item->qty }}" min="1" data-id="{{ $item->rowId }}">
                                                </div>
                                            </td>
                                            <td class="total">{{ presetPrice($item->subtotal) }}</td>
                                        </tr><!-- END TR-->
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div
                </div>
                <div class="row mt-5 pt-3 d-flex">
		  <div class="col-md-12 d-flex">
                    <div class="cart-detail cart-total bg-light p-3 p-md-4 ftco-animate">
			<h3 class="billing-heading mb-4">Cart Total</h3>
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
                  </div>
		<p class="text-center"><a href="{{ route('checkout') }}" class="btn btn-primary py-3 px-4">Proceed to Checkout</a></p>
                                    <p class="text-left"><a href="/" class="btn btn-primary py-3 px-4"><span class="icon-shopping-bag"></span> Continue Shopping</a></p>
		</div>
            @else
                <h5 class="subheading text-uppercase text-center font-weight-lighter">
                    No items in your cart.
                </h5>
                <p class="text-center">
                    <a href="/" class="btn btn-primary py-3 px-4"><span class="icon-shopping-bag"></span> Continue Shopping</a>
                </p>
            @endif
        </div>
    </section>
@endsection

@section('extra-js')
	<script src="{{ asset('js/app.js') }}"></script>
	<script>
		(function() {
			const classname = document.querySelectorAll('.quantity');

			Array.from(classname).forEach(function(element) {
				element.addEventListener('change', function() {
					const id = element.getAttribute('data-id');
					axios.patch(`/shopping/update/cart/qty/${id}`, {
						quantity: this.value
					})
					.then(function (response) {
						// console.log(response);
						window.location.href = '{{ route('cart') }}';
					})
					.catch(function (error) {
						console.log(error);
					});
				});
			});
		})();
	</script>
@endsection
