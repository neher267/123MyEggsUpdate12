<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Settings\Category;
use App\Models\Hr\Product;
use App\Models\Hr\Package;
use App\Models\Settings\Gift;

class PublicController extends Controller
{
    public function index()
    {
        $results = Category::orderBy('name', 'asc')->get();
        $count = $results->count();
        $categories = $results->chunk(4);

        return view('frontend.index', compact('categories', 'count'));
    }

    public function language_change($locale)
    {
        \Session::put('locale', $locale);
        return redirect()->back();
    }


    public function gifts()
    {
        $user = request()->user();
        $claims = array();
        if($user) {
            $claims = Gift::where('points', '<=', $user->points)->orderBy('points', 'des')->get()->chunk(4);
            $gifts = Gift::where('points', '>', $user->points)->orderBy('points', 'asc')->get()->chunk(4);        
        } else {
            $gifts = Gift::orderBy('points', 'des')->get()->chunk(4);  
        }
        return view('frontend.gifts', compact('gifts', 'claims'));
    }


    public function category_types(Category $category)
    {
        $results = $category->products()->get();
        $count = $results->count();
        $products = $results->chunk(4);
        return view('frontend.category-products', compact('products', 'count'));
    }

    public function product_packages(Product $product) {
        $results = $product->packages()->orderBy('hit_count', 'dsc')->get();
        $count = $results->count();
        $packages = $results->chunk(4);
        return view('frontend.packages', compact('packages','count'));        
    }

    public function package_details($title, Package $package) {
        $images = $package->images()->where('type', 'Details')->get();
        return view('frontend.package-details', compact('images' ,'package'));        
    }  

    public function gift_details(Gift $gift) {
        $images = $gift->images()->where('type', 'Details')->get();
        return view('frontend.gift-details', compact('images' ,'gift'));        
    }  

    public function popular_packages()
    {
        return view('frontend.popular-packages');         
    }

    public function details()
    {
    	return view('frontend.details');
    }
}
