<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Size;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MainController extends Controller
{
    public function index()
    {

        $products = Product::take(10)->get();
        $hotProducts = Product::where('product_label', 'hot')->take(4)->get();
        $saleProducts = Product::where('product_label', 'sale')->take(4)->get();
        return view('frontend.home', compact('products', 'hotProducts', 'saleProducts'));
    }
    public function shop(Request $request)
    {
        //$q_categories=$request->query('cid');
        $perPage = 10;

        $prange = $request->query("price_range");
        $categoryProduct=$request->query('cid');
        $price_sort=$request->query('price_sort');
        if (!$price_sort) {
            $price_sort='latest';
        }
    
        if ($price_sort=="low_to_high") {
            $o_column = 'selling_price';
            $o_order = 'ASC';
        }elseif ($price_sort=='high_to_low') {
            $o_column = 'selling_price';
            $o_order = 'DESC';
        }else{
            $o_column = 'id';
            $o_order = 'ASC';
        }
        if (!$prange) {
            $prange = "0-5000";
        }
        $from = explode("-", $prange)[0];
        $to = explode("-", $prange)[1];
        $AllBrands = Brand::where('status', '1')->take(10)->get();
        $AllCategories = Category::where('status', '1')->take(10)->get();
        $Sizes = Size::where('status', '1')->take(10)->get();
        // $products = Product::where(function($query) use($q_categories){
        //     $query->whereIn('category_id',explode(',',$q_categories))->orWhereRaw("'".$q_categories."'=''");
        // })
        // ->whereBetween('selling_price',array($from,$to))->orderBy('created_at','DESC')->orderBy($o_column,$o_order)->paginate($size);
        // $saleProducts= Product::paginate(2);

        $query = Product::query();
        if ($categoryProduct) {
            $query->where('category_id', decrypt($request->input('cid')));
        }
        $brandProduct=$request->query('bid');
        if ($brandProduct) {
            $query->where('brand_id', decrypt($request->input('bid')));
        }
        if ($request->has('size')) {
            $query->where('size', $request->input('size'));
        }
        if ($request->has('main')) {
            $query->where('main_category', $request->input('main'));
        }

        if ($request->has('price_range')) {
            $query->whereBetween('discounted_price',array($from,$to));
        }
        $query->orderBy($o_column, $o_order);
        $saleProducts = $query->paginate($perPage);
        return view('frontend.shop', compact('AllBrands', 'AllCategories', 'saleProducts', 'Sizes','prange','categoryProduct','price_sort','brandProduct'));
    }
    public static function getCategory()
    {
        $menCategories = Category::where('status', '1')->where('main_category', 'men')->take(10)->get();
        $womenCategories = Category::where('status', '1')->where('main_category', 'women')->take(10)->get();
        $accesCategories = Category::where('status', '1')->where('main_category', 'accessories')->take(10)->get();
        return ['menCategories' => $menCategories, 'womenCategories' => $womenCategories, 'accesCategories' => $accesCategories];
    }

    public function shopDetails($prod_name, $prod_id)
    {
        $product = Product::find(decrypt($prod_id));
        $relatedProducts = Product::where('category_id', $product->category_id)->take(10)->get();
        return view('frontend.shop-details', compact('product', 'relatedProducts'));
    }

    public function blog()
    {
        return view('frontend.blog');
    }

    public function blogDetails()
    {
        return view('frontend.blog-details');
    }

    public function about()
    {
        return view('frontend.about');
    }

    public function checkout()
    {
        return view('frontend.checkout');
    }

    public function contact()
    {
        return view('frontend.contact');
    }

    public function cart()
    {

        return view('frontend.shopping-cart');
    }
    public static function cart_details()
    {
        if (session('cart')) {
            $totalProducts = count(session('cart'));
            $prices = collect(session('cart'))->map(function ($item) {
                return floatval($item['discountedPrice'] * $item['quantity']);
            });
            $totalCartPrice = $prices->sum();
        } else {
            $totalProducts = $totalCartPrice = 0;
        }
        return ['totalCartPrice' => $totalCartPrice, 'totalProducts' => $totalProducts];
    }
}
