@extends('layouts.frontend') @section('content')
<main>
    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__text">
                        <h4>Check Out</h4>
                        <div class="breadcrumb__links">
                            <a href="/">Home</a>
                            <a href="/shop">Shop</a>
                            <span>Check Out</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Checkout Section Begin -->
    <section class="checkout spad">
        <div class="container">
            <div class="checkout__form">
                <form action="" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-lg-8 col-md-6">
                            <h6 class="checkout__title">Billing Details</h6>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Full Name<span>*</span></p>
                                        <input type="text" name="customer_name" />
                                        @error('customer_name')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Phone Number<span>*</span></p>
                                        <input name="contact_number" type="text" />
                                        @error('contact_number')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror

                                    </div>
                                </div>
                            </div>

                            <div class="checkout__input">
                                <p>Address<span>*</span></p>
                                <input
                                    type="text"
                                    name="customer_address_1"
                                    placeholder="Street Address"
                                    class="checkout__input__add"
                                />

                                <input
                                    type="text"
                                    name="customer_address_2"
                                    placeholder="Apartment, suite, unite ect (optinal)"
                                />
                                @error('customer_address_1')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="checkout__input__checkbox">
                                <label for="diff-acc">
                                    Note about your order, e.g, special noe for
                                    delivery
                                    <input type="checkbox" id="diff-acc" />
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                            <div class="checkout__input">
                                <p>Order notes</p>
                                <input
                                    type="text"
                                    name="order_notes"
                                    placeholder="Notes about your order, e.g. special notes for delivery."
                                />
                                @error('order_notes')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="checkout__order">
                                <h4 class="order__title">Your order</h4>
                                <div class="checkout__order__products">
                                    Product <span>Total</span>
                                </div>
                                <ul class="checkout__total__products">
                                    @php $total=0; $count=0; @endphp @if(session('cart'))
                                    @foreach(session('cart') as $id => $details)

                                    <li>
                                        {{ $loop->iteration }}. {{ $details["name"] }}
                                        <span
                                            >{{
                                                $details["quantity"] *
                                                    $details["discountedPrice"]
                                            }}
                                             LKR</span
                                        >
                                    </li>
                                    @php
                                    $total+=$details['discountedPrice']*$details['quantity'];
                                    @endphp @endforeach @endif
                                </ul>
                                <ul class="checkout__total__all">
                                    <li>
                                        Subtotal <span>{{ $total }} LKR</span>
                                    </li>
                                    <li>
                                        Total <span>{{ $total }} LKR</span>
                                    </li>
                                </ul>

                                <div class="checkout__input__checkbox d-none">
                                    <label for="payment">
                                        Check Payment
                                        <input type="checkbox" id="payment" />
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                <div class="checkout__input__checkbox d-none">
                                    <label for="paypal">
                                        Paypal
                                        <input type="checkbox" id="paypal" />
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                <button type="submit" class="site-btn order-btn">
                                    PLACE ORDER
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!-- Checkout Section End -->
</main>
@endsection
@push('scripts')
<script>
    $("form").on('submit',function(e) {
        e.preventDefault();
        e.stopPropagation();
        // only neccessary if something above is listening to the (default-)event too
        //form.attr('action')
        var form = $('form');
        $.ajax({
            type: 'POST',
            url: "{{route('checkout.post')}}",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            dataType:'json',
            beforeSend:function() {
                $('.order-btn').prop("disabled",true);
                $('.order-btn').text("PLACING THE ORDER");
            },
            success:function (response) {
               if(response.status=='success'){
                Swal.fire({
                    title: "Great",
                    text: response.message,
                    icon:response.status
                    });
               }else{
                Toast.fire({
                    title: response.message,
                    icon:response.status

                    });
               }
                $('.order-btn').prop("disabled",false);
                $('.order-btn').text("PLACE ORDER");

            }
        });//ajax call
    });//main
    </script>
@endpush
