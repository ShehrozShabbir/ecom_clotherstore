    <!-- Footer Section Begin -->
    @php
                            $mainCategories = App\Http\Controllers\Frontend\MainController::getCategory();

                            @endphp
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="footer__about">
                        <div class="footer__logo">

                            <a href="/"><img  class="img-fluid" src="{{url('logo/ESPARTA_1.png')}}" alt=""></a>

                        </div>
                         <p>Things you needed All are available here Just Shop now.</p>
                         <p>WhatsApp/Call: <b>0741 084 299</b></p>

                    </div>
                </div>
                <div class="col-lg-2 offset-lg-1 col-md-3 col-sm-6">
                    <div class="footer__widget">
                        <h6>Women</h6>
                        <ul>
                            @foreach ($mainCategories['womenCategories'] as $category)
                            <li><a href="/shop?category-name={{$category->name}}&cid={{encrypt($category->id)}}">{{$category->name}}</a></li>
                            @endforeach

                        </ul>
                    </div>
                </div>
                <div class="col-lg-2 col-md-3 col-sm-6">
                    <div class="footer__widget">
                        <h6>MEN's</h6>
                        <ul>
                            @foreach ($mainCategories['menCategories'] as $category)
                            <li><a href="/shop?category-name={{$category->name}}&cid={{encrypt($category->id)}}">{{$category->name}}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 offset-lg-1 col-md-6 col-sm-6">
                    <div class="footer__widget">
                        <h6>NewLetter</h6>
                        <div class="footer__newslatter">
                            <p>Be the first to know about new arrivals, look books, sales & promos!</p>
                            <form action="#">
                                <input type="text" placeholder="Your email">
                                <button type="submit"><span class="icon_mail_alt"></span></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="footer__copyright__text">

                        <p>Copyright ©
                            <script>
                                document.write(new Date().getFullYear());
                            </script>
                            All rights reserved
                        </p>

                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer Section End -->

    <!-- Search Begin -->
    <div class="search-model">
        <div class="h-100 d-flex align-items-center justify-content-center">
            <div class="search-close-switch">+</div>
            <form class="search-model-form">
                <input type="text" id="search-input" placeholder="Search here.....">
            </form>
        </div>
    </div>
    <!-- Search End -->
