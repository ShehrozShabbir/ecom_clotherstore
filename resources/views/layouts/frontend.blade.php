<!DOCTYPE html>
<html lang="en">
@include('partials.frontend.head')

<body>
    <!-- Page Preloder -->
    {{-- <div id="preloder">
        <div class="loader"></div>
    </div> --}}

    <!-- Offcanvas Menu Begin -->
    <div class="offcanvas-menu-overlay"></div>
    <div class="offcanvas-menu-wrapper">
        <div class="offcanvas__option">
            {{-- <div class="offcanvas__links">
                <a href="#">Sign in</a>
                <a href="#">FAQs</a>
            </div> --}}
            <div class="offcanvas__top__hover">
                <span>LKR <i class="arrow_carrot-down"></i></span>
                <ul>
                    <li>LKR</li>

                </ul>
            </div>
        </div>

        <div class="offcanvas__nav__option">
            <a href="#" class="search-switch"><img src="img/icon/search.png" alt=""></a>
            @php
                $cart_details = App\Http\Controllers\Frontend\MainController::cart_details();
                $totalProducts = $cart_details['totalProducts'];
                $totalCartPrice = $cart_details['totalCartPrice'];
            @endphp
            <a href="#" class="search-switch"><img src="img/icon/search.png" alt=""></a>
            <a href="#"><img src="img/icon/heart.png" alt=""></a>
            <a href="{{ route('cart') }}"><img src="{{ url('frontend/img/icon/Cart-PNG-File.png') }}" width="30" alt=""> </a>
            <div class="price">{{ $totalCartPrice }}</div>
        </div>
        <div id="mobile-menu-wrap"></div>
        <div class="offcanvas__text">
            <p>Free shipping, 30-day return or refund guarantee.</p>
        </div>
    </div>
    <!-- Offcanvas Menu End -->
    @include('partials.frontend.header')

 @yield('content')


    @include('partials.frontend.footer')
    @include('partials.frontend.scripts')
</body>

</html>
