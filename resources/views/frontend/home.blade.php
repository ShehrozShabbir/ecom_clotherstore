<!DOCTYPE html>
<html lang="en">
@include('partials.frontend.head')
<style>
    .vh-50{
        height: 50vh !important;
    }
</style>
<body>
    <!-- Page Preloder -->
    {{-- <div id="preloder">
        <div class="loader"></div>
    </div> --}}

    <!-- Offcanvas Menu Begin -->
    <div class="offcanvas-menu-overlay"></div>
    <div class="offcanvas-menu-wrapper">
        <div class="offcanvas__option">
            <div class="offcanvas__links">
                <a href="#">Sign in</a>
                <a href="#">FAQs</a>
            </div>
            <div class="offcanvas__top__hover">
                <span>PKR <i class="arrow_carrot-down"></i></span>
                <ul>
                    <li>PKR</li>

                </ul>
            </div>
        </div>
        <div class="offcanvas__nav__option">
            <a href="#" class="search-switch"><img src="img/icon/search.png" alt=""></a>
            <a href="#"><img src="img/icon/heart.png" alt=""></a>
            <a href="#"><img src="img/icon/cart.png" alt=""> <span>0</span></a>
            <div class="price">$0.00</div>
        </div>
        <div id="mobile-menu-wrap"></div>
        <div class="offcanvas__text">
            <p>Free shipping, 30-day return or refund guarantee.</p>
        </div>
    </div>
    <main class="container-fluid">
        <div class="row">
            <div class="col-sm-4 p-0  ">
               <div class="vh-50 bg-dark d-flex justify-content-center align-items-center">
                <a href="/shop"><h3 class="text-white">Men's <br> Collections</h3></a>
               </div>
               <div class="vh-50">
                <img src="{{url("frontend/img/banner/banner5.jpg")}}" style="height: 100%;width:100%" class="img-fluid" alt="">
               </div>
            </div>
            <div class="col-sm-4 p-0  ">
                <div class="vh-50">
                    <img src="{{url("frontend/img/banner/banner4.jpg")}}" style="height: 100%;width:100%" class="img-fluid" alt="">
                   </div>
                <div class="vh-50 bg-dark d-flex justify-content-center align-items-center">
                 <a href="/shop"><h3 class="text-white">Women's <br> Collections</h3></a>
                </div>

             </div>
             <div class="col-sm-4 p-0  ">
                <div class="vh-50 bg-dark d-flex justify-content-center align-items-center">
                 <a href="/shop"><h3 class="text-white">Accessories's <br> Collection</h3></a>
                </div>
                <div class="vh-50">
                 <img src="{{url("frontend/img/banner/banner6.jpg")}}" style="height: 100%;width:100%" class="img-fluid" alt="">
                </div>
             </div>
        </div>
    </main>
    @include('partials.frontend.scripts')
</body>

</html>
