@extends('layouts.frontend')
@section('content')
    <main>


        <!-- Shop Details Section Begin -->
        <section class="shop-details">
            <div class="product__details__pic">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="product__details__breadcrumb">
                                <a href="/">Home</a>
                                <a href="/shop">Shop</a>
                                <span>{{$product->id}}</span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-3 col-md-3">
                            <ul class="nav nav-tabs" role="tablist">
                                @foreach ($product->images as $key => $image)
                                    <li class="nav-item">
                                        <a class="nav-link @if ($loop->first) active @endif "
                                            data-toggle="tab" href="#tabs-{{ $key }}" role="tab">
                                            <div class="product__thumb__pic set-bg"
                                                data-setbg="{{ url($image->image_path) }}">
                                            </div>
                                        </a>
                                    </li>
                                @endforeach


                            </ul>
                        </div>
                        <div class="col-lg-6 col-md-9">
                            <div class="tab-content">
                                @foreach ($product->images as $key => $image)
                                <div class="tab-pane  @if ($loop->first) active @endif " id="tabs-{{ $key }}" role="tabpanel">
                                    <div class="product__details__pic__item">
                                        <img style="max-height: 350px;" src="{{ url($image->image_path) }}" alt="">
                                    </div>
                                </div>
                                @endforeach

                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="product__details__content">
                <div class="container">
                    <div class="row d-flex justify-content-center">
                        <div class="col-lg-8">
                            <div class="product__details__text">
                                <h4>{{$product->name}}</h4>
                                @php
                                    $metaData=json_decode($product->product_meta,true);
                                    $NewAmount= reset($metaData)['selling_price']-(reset($metaData)['selling_price']*$product->discount)/100;


                                @endphp
                                <h3 >{{$NewAmount}}</h3>

                                <p>{{$product->category->name}}</p>
                                <div class="product__details__option">
                                    <div class="product__details__option__size">
                                        <span>Size:</span>
                                        @foreach ($metaData as $key=> $data)
                                        <label class="@if ($loop->first) active @endif size_manage_label" for="size_{{$key}}">{{$key}}
                                            <input type="radio" value="{{$key}}" class="size_manage" id="size_{{$key}}">
                                        </label>
                                        @endforeach
                                        <input type="hidden" id="size_manage_in" value="{{key($metaData)}}">
                                        {{-- <label class="active" for="xl">xl
                                            <input type="radio" id="xl">
                                        </label>
                                        <label for="l">l
                                            <input type="radio" id="l">
                                        </label>
                                        <label for="sm">s
                                            <input type="radio" id="sm">
                                        </label> --}}
                                    </div>

                                </div>
                                <div class="product__details__cart__option">
                                    <div class="quantity">
                                        <div class="pro-qty">
                                            <input type="text" value="1" id="selected_quantity">
                                        </div>
                                    </div>
                                    @if (reset($metaData)['stock_quantity']>0)
                                    <button type="button" class="primary-btn add-cart-btns">Add to Cart</button>
                                    @else
                                    <button type="button" class="primary-btn disabled add-cart-btns">Out of Stock</button>
                                    @endif

                                </div>


                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="product__details__tab">
                                <ul class="nav nav-tabs" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-toggle="tab" href="#tabs-5"
                                            role="tab">Description</a>
                                    </li>

                                </ul>
                                <input type="hidden" name="" id="product_ids" value="{{$product->id}}">
                                <input type="hidden" name="" id="product_meta" value="{{$product->product_meta}}">
                                <input type="hidden" name="" id="product_dic" value="{{$product->discount}}">
                                <div
                                 class="tab-content">
                                    <div class="tab-pane active" id="tabs-5" role="tabpanel">
                                        <div class="product__details__tab__content">
                                            <p class="note"></p>
                                            <div class="product__details__tab__content__item">
                                                <h5>Products Infomation</h5>
                                                <p>{{$product->details}}.</p>

                                            </div>

                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Shop Details Section End -->

        <!-- Related Section Begin -->
        <section class="related spad">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <h3 class="related-title">Related Product</h3>
                    </div>
                </div>
                <div class="row">
                    @foreach ($relatedProducts as $product)
                    <div class="col-lg-3 col-md-6 col-sm-6 col-sm-6">
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
                                @php
                                $NewAmount= $product->selling_price-($product->selling_price*$product->discount)/100;
                                @endphp
                                <a onclick="adding_cart('add','{{$product->id}}',1,`{{$product->size}}`)" href="javascript:void(0)" class="add-cart">+ Add To Cart</a>
                                <h5>LKR {{$NewAmount}}</h5>@if ($product->discount>0)<h6 class="text-muted ml-2">
                                    <del>{{$product->selling_price}}</del></h6>@endif
                            </div>
                        </div>
                    </div>
                    @endforeach

                </div>
            </div>
        </section>
        <!-- Related Section End -->
    </main>
@endsection
@push('scripts')
   <script>

     $('.size_manage').click(function(){
       
        let value=$(this).val();
        $('#size_manage_in').val(value);
        var data=[];
         data=JSON.parse($('#product_meta').val());
         
         let discount=$('#product_dic').val();
         let NewAmount=data[value]['selling_price']-(data[value]['selling_price']*discount)/100;
        // console.log(data[value]['selling_price'],NewAmount,discount);
         $('.product__details__text>h3').text(NewAmount);

        if(data[value]['stock_quantity']>0){
            $('.add-cart-btns').text('Add to Cart');
            $('.add-cart-btns').prop('disabled',false);
        }else{
           // $('.add-cart-btns').prop('disabled',true);
            $('.add-cart-btns').text('Out of Stock');
        }
     });
     $('.add-cart-btns').click(function(){
      
        let newSize=$('#size_manage_in').val();
        let productID=$('#product_ids').val();
        let newQuantity=$('#selected_quantity').val();
        adding_cart('add',productID,newQuantity,newSize);
     });
   </script>
@endpush
