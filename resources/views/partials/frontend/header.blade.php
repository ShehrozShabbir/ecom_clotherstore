    <!-- Header Section Begin -->
    <header class="header">
        <div class="header__top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-7">
                        <div class="header__top__left">
                            <p>Free shipping, 30-day return or refund guarantee.</p>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-5">
                        <div class="header__top__right">
                            <div class="header__top__links">
                                <a href="#">Sign in</a>
                                <a href="#">FAQs</a>
                            </div>
                            <div class="header__top__hover">
                                <span>PKR <i class="arrow_carrot-down"></i></span>
                                <ul>
                                    <li>PKR</li>

                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-3">
                    <div class="header__logo">
                        <a href="/"><img src="{{url('logo/fs-02.png')}}" style="width: 40px" alt=""></a>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <nav class="header__menu mobile-menu">
                        <ul>
                            @php
                            $mainCategories = App\Http\Controllers\Frontend\MainController::getCategory();

                            @endphp
                            <li class="{{ request()->routeIs('home') ? 'active' : '' }}"><a
                                    href="{{ route('home') }}">HOME</a></li>
                            <li
                                class="{{ request()->routeIs(['about', 'shop.details', 'cart', 'checkout', 'blog.details']) ? 'active' : '' }}">
                                <a href="#">MEN'S</a>
                                <ul class="dropdown">
                                    @foreach ($mainCategories['menCategories'] as $category)
                                    <li><a href="/shop?category-name={{$category->name}}&cid={{encrypt($category->id)}}">{{$category->name}}</a></li>
                                    @endforeach
                                </ul>
                            </li>
                            <li class="{{ request()->routeIs(['polo', 't-shirts']) ? 'active' : '' }}">
                                <a href="#">WOMEN'S</a>
                                <ul class="dropdown">
                                    @foreach ($mainCategories['womenCategories'] as $category)
                                    <li><a href="/shop?category-name={{$category->name}}&cid={{encrypt($category->id)}}">{{$category->name}}</a></li>
                                    @endforeach
                                </ul>
                            </li>
                            <li class="{{ request()->routeIs('accessoires') ? 'active' : '' }}">
                                <a href="#">ACCESSOIRES</a>
                                <ul class="dropdown">
                                    @foreach ($mainCategories['accesCategories'] as $category)
                                    <li><a href="/shop?category-name={{$category->name}}&cid={{encrypt($category->id)}}">{{$category->name}}</a></li>
                                    @endforeach
                                </ul>
                            </li>



                        </ul>


                    </nav>
                </div>
                <div class="col-lg-3 col-md-3">
                    <div class="header__nav__option" id="cartMenutb">
                        <a href="#" class="search-switch"><img src="img/icon/search.png" alt=""></a>
                        @php
                            $cart_details = App\Http\Controllers\Frontend\MainController::cart_details();
                            $totalProducts = $cart_details['totalProducts'];
                            $totalCartPrice = $cart_details['totalCartPrice'];
                        @endphp
                        <a href="{{ route('cart') }}"><img src="{{ url('frontend/img/icon/cart.png') }}" alt="">
                            <span>{{ $totalProducts }}</span></a>
                        <div class="price">{{ $totalCartPrice }}rs</div>
                    </div>
                </div>
            </div>
            <div class="canvas__open"><i class="fa fa-bars"></i></div>
        </div>
    </header>
    <!-- Header Section End -->
