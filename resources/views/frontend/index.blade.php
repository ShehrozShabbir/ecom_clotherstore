@extends('layouts.frontend')
@section('content')
  <main>
     <!-- Hero Section Begin -->
   <section class="hero">
    <div class="hero__slider owl-carousel">
        <div class="hero__items set-bg" data-setbg="{{ url('frontend/img/hero/hero-1.jpg') }}">
            <div class="container">
                <div class="row">
                    <div class="col-xl-5 col-lg-7 col-md-8">
                        <div class="hero__text">
                            <h6>Summer Collection</h6>
                            <h2>Fall - Winter Collections 2030</h2>
                            <p>A specialist label creating luxury essentials. Ethically crafted with an unwavering
                            commitment to exceptional quality.</p>
                            <a href="#" class="primary-btn">Shop now <span class="arrow_right"></span></a>
                            <div class="hero__social">
                                <a href="#"><i class="fa fa-facebook"></i></a>
                                <a href="#"><i class="fa fa-twitter"></i></a>
                                <a href="#"><i class="fa fa-pinterest"></i></a>
                                <a href="#"><i class="fa fa-instagram"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="hero__items set-bg" data-setbg="{{ url('frontend/img/hero/hero-2.jpg') }}">
            <div class="container">
                <div class="row">
                    <div class="col-xl-5 col-lg-7 col-md-8">
                        <div class="hero__text">
                            <h6>Summer Collection</h6>
                            <h2>Fall - Winter Collections 2030</h2>
                            <p>A specialist label creating luxury essentials. Ethically crafted with an unwavering
                            commitment to exceptional quality.</p>
                            <a href="#" class="primary-btn">Shop now <span class="arrow_right"></span></a>
                            <div class="hero__social">
                                <a href="#"><i class="fa fa-facebook"></i></a>
                                <a href="#"><i class="fa fa-twitter"></i></a>
                                <a href="#"><i class="fa fa-pinterest"></i></a>
                                <a href="#"><i class="fa fa-instagram"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Hero Section End -->

<!-- Banner Section Begin -->
<section class="banner spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-7 offset-lg-4">
                <div class="banner__item">
                    <div class="banner__item__pic">
                        <img src="{{ url('frontend/img/banner/banner-1.jpg') }}" alt="">
                    </div>
                    <div class="banner__item__text">
                        <h2>Clothing Collections 2030</h2>
                        <a href="#">Shop now</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="banner__item banner__item--middle">
                    <div class="banner__item__pic">
                        <img src="{{ url('frontend/img/banner/banner-2.jpg') }}" alt="">
                    </div>
                    <div class="banner__item__text">
                        <h2>Accessories</h2>
                        <a href="#">Shop now</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-7">
                <div class="banner__item banner__item--last">
                    <div class="banner__item__pic">
                        <img style="width:448px;height:440px" src="{{ url('frontend/img/banner/banner-33.jpg') }}" alt="">
                    </div>
                    <div class="banner__item__text">
                        <h2>Women's Wear</h2>
                        <a href="#">Shop now</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Banner Section End -->

<!-- Product Section Begin -->
<section class="product spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <ul class="filter__controls">
                    <li class="active" data-filter="*">Best Sellers</li>
                    <li data-filter=".new">New Arrivals</li>
                    <li data-filter=".hot">Hot Sales</li>
                </ul>
            </div>
        </div>
        <div class="row product__filter">
            @foreach ($products as $product)
            <div class="col-lg-3 col-md-6 col-sm-6 col-md-6 col-sm-6 mix {{$product->product_label}}">
                <div class="product__item">
                    <div class="product__item__pic set-bg" data-setbg="{{ url($product->images[0]->image_path) }}">
                        <span class="label">{{ucwords($product->product_label)}}</span>
                        <ul class="product__hover">
                            <li><a href="#"><img src="{{ url('frontend/img/icon/heart.png') }}" alt=""></a></li>
                            <li><a href="{{route('shop.details',[$product->name,encrypt($product->id)])}}"><img src="{{ url('frontend/img/icon/compare.png') }}" alt=""> <span>View</span></a></li>
                        </ul>
                    </div>
                    <div class="product__item__text">
                        <h6>{{$product->name}}</h6>
                        <a onclick="adding_cart('add','{{$product->id}}',1,`{{$product->size}}`)" href="javascript:void(0)" class="add-cart">+ Add To Cart</a>
                        <h5>LKR {{$product->selling_price}}</h5>
                        {{-- <div class="product__color__select">
                            <label for="pc-1">
                                <input type="radio" id="pc-1">
                            </label>
                            <label class="active black" for="pc-2">
                                <input type="radio" id="pc-2">
                            </label>
                            <label class="grey" for="pc-3">
                                <input type="radio" id="pc-3">
                            </label>
                        </div> --}}
                    </div>
                </div>
            </div>
            @endforeach

        </div>
    </div>
</section>
<!-- Product Section End -->


<!-- Latest Blog Section Begin -->
<section class="latest spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title">
                    <span></span>
                    <h2>Hot Sale</h2>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach ($hotProducts as $product)
            <div class="col-lg-3 col-md-6 col-sm-6 col-md-6 col-sm-6 mix {{$product->product_label}}">
                <div class="product__item">
                    <div class="product__item__pic set-bg" data-setbg="{{ url($product->images[0]->image_path) }}">
                        <span class="label">{{ucwords($product->product_label)}}</span>
                        <ul class="product__hover">
                            <li><a href="#"><img src="{{ url('frontend/img/icon/heart.png') }}" alt=""></a></li>
                            <li><a href="{{route('shop.details',[$product->name,encrypt($product->id)])}}"><img src="{{ url('frontend/img/icon/compare.png') }}" alt=""> <span>View</span></a></li>
                        </ul>
                    </div>
                    <div class="product__item__text">
                        <h6>{{$product->name}}</h6>
                        <a onclick="adding_cart('add','{{$product->id}}',1,`{{$product->size}}`)" href="javascript:void(0)" class="add-cart">+ Add To Cart</a>

                        <h5>PKR {{$product->selling_price}}</h5>
                        {{-- <div class="product__color__select">
                            <label for="pc-1">
                                <input type="radio" id="pc-1">
                            </label>
                            <label class="active black" for="pc-2">
                                <input type="radio" id="pc-2">
                            </label>
                            <label class="grey" for="pc-3">
                                <input type="radio" id="pc-3">
                            </label>
                        </div> --}}
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
<!-- Latest Blog Section Begin -->
<section class="latest spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title">
                    <span>Latest Outfits</span>
                    <h2>Fashion New Trends</h2>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach ($saleProducts as $product)
            <div class="col-lg-3 col-md-6 col-sm-6 col-md-6 col-sm-6 mix {{$product->product_label}}">
                <div class="product__item">
                    <div class="product__item__pic set-bg" data-setbg="{{ url($product->images[0]->image_path) }}">
                        <span class="label">{{ucwords($product->product_label)}}</span>
                        <ul class="product__hover">
                            <li><a href="#"><img src="{{ url('frontend/img/icon/heart.png') }}" alt=""></a></li>
                            <li><a href="#"><img src="{{ url('frontend/img/icon/compare.png') }}" alt=""> <span>Compare</span></a></li>
                            <li><a href="#"><img src="{{ url('frontend/img/icon/search.png') }}" alt=""></a></li>
                        </ul>
                    </div>
                    <div class="product__item__text">
                        <h6>{{$product->name}}</h6>
                        <a onclick="adding_cart('add','{{$product->id}}',1,`{{$product->size}}`)" href="javascript:void(0)" class="add-cart">+ Add To Cart</a>

                        <h5>LKR {{$product->selling_price}}</h5>
                        {{-- <div class="product__color__select">
                            <label for="pc-1">
                                <input type="radio" id="pc-1">
                            </label>
                            <label class="active black" for="pc-2">
                                <input type="radio" id="pc-2">
                            </label>
                            <label class="grey" for="pc-3">
                                <input type="radio" id="pc-3">
                            </label>
                        </div> --}}
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
<!-- Latest Blog Section End -->
  </main>
@endsection
