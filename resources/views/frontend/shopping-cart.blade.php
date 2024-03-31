@extends('layouts.frontend')
@section('content')
    <main>

        <!-- Breadcrumb Section Begin -->
        <section class="breadcrumb-option">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="breadcrumb__text">
                            <h4>Shopping Cart</h4>
                            <div class="breadcrumb__links">
                                <a href="/">Home</a>
                                <a href="/shop">Shop</a>
                                <span>Shopping Cart</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Breadcrumb Section End -->

        <!-- Shopping Cart Section Begin -->
        <section class="shopping-cart spad">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="shopping__cart__table">
                            <table id="id_cart_table">
                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>Quantity</th>
                                        <th>Total</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $total = 0;
                                    @endphp
                                    @if (session('cart'))
                                        @foreach (session('cart') as $id => $details)
                                            @php
                                             $NewAmount =
                                                            $details['price'] -
                                                            ($details['price'] * $details['discount']) / 100;
                                                $total += $NewAmount * $details['quantity'];
                                            @endphp
                                            <tr>
                                                <td class="product__cart__item">
                                                    <div class="product__cart__item__pic">
                                                        <img style="width: 100px" src="{{ $details['image'] }}"
                                                            alt="">
                                                    </div>
                                                 
                                                    <div class="product__cart__item__text">
                                                        <h6>{{ $details['name'] }}</h6>
                                                        <h5>LKR {{ $NewAmount }}</h5>
                                                        @if ($details['discount'] > 0)
                                                            <h6 class="text-muted ml-2">
                                                                <del>{{ $details['price'] }}</del>
                                                            </h6>
                                                        @endif
                                                        <h6>Size : {{ $details['size'] }}</h6>
                                                    </div>
                                                </td>
                                                <td class="quantity__item">
                                                    <div class="quantity">
                                                        <div class="pro-qty-2">
                                                            <span class="fa fa-angle-left dec qtybtn"></span>
                                                            <input rowId="{{ $id }}" class="update-cart-items"
                                                                type="text" value="{{ $details['quantity'] }}">
                                                            <span class="fa fa-angle-right inc qtybtn"></span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="cart__price">{{ $details['quantity'] * $NewAmount }} LKR
                                                </td>
                                                <td class="cart__close"><i proId="{{ $id }}"
                                                        class="fa fa-close delete-product"></i></td>
                                            </tr>
                                        @endforeach
                                    @endif

                                </tbody>
                            </table>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="continue__btn">
                                    <a href="/">Continue Shopping</a>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="continue__btn update__btn">
                                    <a href="{{ route('clear.cart') }}"><i class="fa fa-spinner"></i> Clear cart</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">

                        <div class="cart__total">
                            <h6>Cart total</h6>
                            <ul id="cartMenu">
                                <li>Subtotal <span>{{ $total }} LKR</span></li>
                                <li>Total <span>{{ $total }} LKR</span></li>
                            </ul>
                            <a href="{{ route('checkout') }}" class="primary-btn">Proceed to checkout</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Shopping Cart Section End -->
    </main>
@endsection
@push('scripts')
    <script type="text/javascript">
        $(".delete-product").click(function(e) {
            e.preventDefault();

            var ele = $(this);

            if (confirm("Do you really want to delete?")) {
                $.ajax({
                    url: '{{ route('delete.cart') }}',
                    method: "DELETE",
                    data: {
                        _token: '{{ csrf_token() }}',
                        id: ele.attr("proId"),
                    },
                    success: function(response) {
                        Toast.fire({
                            icon: "success",
                            title: response,
                        });
                        $("#cartMenutb").load(location.href + " #cartMenutb > *");
                        $("#cartMenu").load(location.href + " #cartMenu > *");
                        $("#id_cart_table").load(location.href + " #id_cart_table > *");
                    }
                });
            }
        });
    </script>
@endpush
