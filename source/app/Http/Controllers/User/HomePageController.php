<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Manufacturer;
use App\Models\Product;
use App\Models\Type;
use Illuminate\Http\Request;
use DB;

class HomePageController extends Controller
{
    private object $model;
    private string $table;

    private object $manufacturer;
    private object $product;

    public function __construct()
    {
        $this->manufacturer = new Manufacturer();
        $this->product = new Product();
    }

    public function index()
    {
        $manufacturers = $this->manufacturer->get(['id', 'name', 'logo']);

        if (request()->has('price')) {
            $arr_price = explode('-', request()->get('price'));
        }

        $q = request()->get('q') ?? '';

        if (request()->get('manufacturer_id') != "Tất cả") {
            $manufacturer_id = request()->get('manufacturer_id');
        }

        $star = request()->get('star');

        $arr_price = [];
        if (request()->get('price')) {
            $arr_price = explode('-', request()->get('price'));
        }

        $products = $this->product->getAll($q, $manufacturer_id, $star, $arr_price);

        if (request()->has('sort')) {
            $arr_sort = explode('-', request()->get('sort'));

            if (in_array($arr_sort[0], ['name', 'price', 'stars'])) {
                if (in_array($arr_sort[1], ['asc', 'desc'])) {
                    $products = $this->product->getAll($q, $manufacturer_id, $star, $arr_price, $arr_sort[0], $arr_sort[1]);
                }
            }
        }

        $hot_products = $this->product
            ->addSelect('products.*')
            ->addSelect(DB::raw('MIN(types.price) AS price'))
            ->addSelect(DB::raw('SUM(types.sold) AS total_sold'))
            ->addSelect(DB::raw('IFNULL(AVG(rates.star), 5) AS star'))
            ->addSelect(DB::raw('COUNT(distinct types.id) AS specifications'))
            ->addSelect(DB::raw('
                    (SELECT COUNT(*) FROM rates WHERE rates.product_id = products.id)
                    AS rates'))
            ->where('active', '=', 1)
            ->join('types', 'types.product_id', 'products.id')
            ->leftJoin('rates', 'rates.product_id', '=', 'products.id')
            ->orderBy('total_sold', 'DESC')
            ->groupBy('products.id')
            ->limit(4)
            ->get();

        // return $products;
        // return $hot_products;
        return view('user.index', [
            'manufacturers' => $manufacturers,
            'products' => $products,
            'hot_products' => $hot_products,
        ]);
    }

    public function about()
    {
        return view('user.about');
    }

    public function location()
    {
        return view('user.location');
    }

    public function detailProduct(Product $product)
    {
        $product = $product
            ->where('id', '=', $product->id)
            ->withSum('types', 'sold')
            ->addSelect(DB::raw('
                    IFNULL((SELECT AVG(star) FROM rates WHERE rates.product_id = products.id), 5)
                    AS rates_avg_star'))
            ->first();

        if ($product->active) {
            return view('user.detail_product', [
                'product' => $product,
                'type' => $product->types()->where('quantity', '>', 0)->first(),
                'list_images' => $product->image()->first()->image_names ?? 0,
            ]);
        } else {
            return back()->with('error', '...');
        }
    }
}
