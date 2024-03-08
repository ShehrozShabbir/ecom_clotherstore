@extends('layouts.frontend')
@section('content')
<style>


.page-item.active .page-link{
	border-color: #111111 !important;
    background-color: #111111 !important;
}
.page-item a{

    color: #111111 !important;
}

</style>
    <main>
            <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__text">
                        <h4>Shop</h4>
                        <div class="breadcrumb__links">
                            <a href="/">Home</a>
                            <span>Shop</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Shop Section Begin -->
    <section class="shop spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="shop__sidebar">
                        <div class="shop__sidebar__search">
                            <form action="#">
                                <input type="text" placeholder="Search...">
                                <button type="submit"><span class="icon_search"></span></button>
                            </form>
                        </div>
                        <div class="shop__sidebar__accordion">
                            <div class="accordion" id="accordionExample">
                                <div class="card">
                                    <div class="card-heading">
                                        <a data-toggle="collapse" data-target="#collapseOne">Categories</a>
                                    </div>
                                    <div id="collapseOne" class="collapse show" data-parent="#accordionExample">
                                        <div class="card-body">
                                            <div class="shop__sidebar__categories">
                                                <ul class="nice-scroll">
                                                    @foreach ($AllCategories as $cat)
                                                    <li><a href="/shop?category-name={{$cat->name}}&cid={{encrypt($cat->id)}}">{{$cat->name}}</a></li>
                                                    @endforeach

                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card d-none">
                                    <div class="card-heading">
                                        <a data-toggle="collapse" data-target="#collapseTwo">Branding</a>
                                    </div>
                                    <div id="collapseTwo" class="collapse show" data-parent="#accordionExample">
                                        <div class="card-body">
                                            <div class="shop__sidebar__brand">
                                                <ul>
                                                    @foreach ($AllBrands as $brand)
                                                    <li><a href="{{$brand->id}}">{{$brand->name}}</a></li>
                                                    @endforeach

                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-heading">
                                        <a data-toggle="collapse" data-target="#collapseThree">Filter Price</a>
                                    </div>
                                    <div id="collapseThree" class="collapse show" data-parent="#accordionExample">
                                        <div class="card-body">
                                            <div class="shop__sidebar__price">
                                                <ul>
                                                    <li><a href="javascript:void(0)">0 - 1000</a></li>
                                                    <li><a href="javascript:void(0)">1000 - 2000</a></li>
                                                    <li><a href="javascript:void(0)">2000 - 3000</a></li>
                                                    <li><a href="javascript:void(0)">3000 - 4000</a></li>
                                                    <li><a href="javascript:void(0)">5000 - 6000</a></li>
                                                    <li><a href="javascript:void(0)">7000+</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-heading">
                                        <a data-toggle="collapse" data-target="#collapseFour">Size</a>
                                    </div>
                                    <div id="collapseFour" class="collapse show" data-parent="#accordionExample">
                                        <div class="card-body">
                                            <div class="shop__sidebar__size">
                                                @foreach ($Sizes as $size)
                                                <label  for="size_{{$size->id}}">{{$size->name}}
                                                    <input class="size_label" type="radio" value="{{$size->name}}" id="size_{{$size->id}}">
                                                </label>
                                                @endforeach


                                            </div>
                                        </div>
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="shop__product__option">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="shop__product__option__left">

                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="shop__product__option__right">
                                    <p>Sort by:</p>
                                    <select id="price_sort">
                                        <option value="latest">Latest</option>
                                        <option value="low_to_high">Low To High</option>
                                        <option value="high_to_low">High To Low</option>

                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        @foreach ($saleProducts as $product)
                        <div class="col-lg-4 col-md-6 col-sm-6">
                            <div class="product__item">
                                <div class="product__item__pic set-bg" data-setbg="{{ url($product->images[0]->image_path) }}">
                                    <span class="label bg-dark text-white">{{ucwords($product->category->name)}}</span>
                                    <ul class="product__hover">
                                        <li><a href="#"><img src="{{ url('frontend/img/icon/heart.png') }}" alt=""></a></li>
                                        <li><a href="{{route('shop.details',[$product->name,encrypt($product->id)])}}"><img src="{{ url('frontend/img/icon/compare.png') }}" alt=""> <span>View</span></a></li>

                                    </ul>
                                </div>
                                <div class="product__item__text">
                                    <h6>{{$product->name}}</h6>
                                    <a onclick="adding_cart('add','{{$product->id}}',1,`{{$product->size}}`)" href="javascript:void(0)" class="add-cart">+ Add To Cart</a>
                                    <h5>LKR {{$product->selling_price}}</h5>
                                </div>
                            </div>
                        </div>
                        @endforeach

                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            {!! $saleProducts->withQueryString()->links('pagination::bootstrap-5') !!}

                            <div class="product__pagination d-none">
                                <a class="active" href="#">1</a>
                                <a href="#">2</a>
                                <a href="#">3</a>
                                <span>...</span>
                                <a href="#">21</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <form action="" id="frmFilter">
            <input type="hidden" value="{{$categoryProduct}}" name="cid" id="cid">
            <input type="hidden" value="{{$prange}}" name="price_range" id="price_range">
            <input type="hidden" value="{{$price_sort}}" name="price_sort" id="price_sort_v">
            <input type="hidden" value="" name="product_size" id="product_size">
        </form>
    </section>
    <!-- Shop Section End -->
    </main>
@endsection
@push('scripts')
    <script>
        $('.size_label').click(function(){
            $('#product_size').val($(this).val());
            $("#frmFilter").submit();
        });
        $('#price_sort').change(function(){
            $('#price_sort_v').val($(this).val());
            $("#frmFilter").submit();
        });
        $('.shop__sidebar__price>ul>li a').click(function(){
            let price=$(this).text();
            let finPrice=price.replace(/\s/g, '');
            $('#price_range').val(finPrice);
            $("#frmFilter").submit();

        });

        // setTimeout(()=>{
        //             $("#frmFilter").submit();
        //         },1000);
    </script>
@endpush
