<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use DateTime;
use Illuminate\Http\Request;
use DB;

class ChartController extends Controller
{
    public function revenue()
    {
        DB::enableQueryLog();
        $data = DB::table('bills')
            ->addSelect(DB::raw('DATE_FORMAT(created_at, "%e.%m") as day'))
            ->addSelect(DB::raw('SUM(total_price) AS total_price'))
            ->where('created_at', '>=', date('Y-m-d H:i:s', strtotime("- 30 days")))
            ->groupBy('day')
            ->get();

        // dd(DB::getQueryLog());
        // return $data;
        $max_date = 30;

        $today = date('d');
        // return $today;

        $arr = [];

        if ($today < $max_date) {
            $get_day_last_month = $max_date - $today;
            $last_month = date('m', strtotime("- 1 month"));
            $last_month_date = date('Y-m-d', strtotime("- 1 month"));

            $max_day_last_month = (new DateTime($last_month_date))->format('t');

            $start_day_last_month = $max_day_last_month - $get_day_last_month;

            for ($i = $start_day_last_month; $i < $max_day_last_month; $i++) {
                $key = $i . '.' . $last_month;
                if (empty($arr[$key])) {
                    $arr[$key] = 0;
                }
            }
            $start_date_this_month = 1;
        } else {
            $start_date_this_month = $today - $max_date;
        }

        $this_month = date('m');

        for ($i = $start_date_this_month; $i < $today; $i++) {
            $key = $i . '.' . $this_month;
            if (empty($arr[$key])) {
                $arr[$key] = 0;
            }
        }

        foreach ($data as $each) {
            $arr[$each->day] = $each->total_price;
        }

        // return $arr;

        $arrX = array_keys($arr);
        $arrY = array_values($arr);
        // return $arrX;

        return view('admin.chart.revenue', [
            'title' => 'Doanh thu',
            'arrX' => $arrX,
            'arrY' => $arrY,
        ]);
    }

    public function products()
    {
        $products = DB::table('products')
            ->addSelect(['products.id', 'products.name', 'products.manufacturer_id'])
            ->addSelect(DB::raw('SUM(types.sold) AS total_sold'))
            ->leftJoin('types', 'types.product_id', '=', 'products.id')
            ->groupBy('products.id')
            ->get();

        $manufacturers = DB::table('manufacturers')
            ->addSelect(['manufacturers.name', 'manufacturers.id'])
            ->get();

        $arr1 = [];
        foreach ($manufacturers as $manufacturer) {
            $arr1[$manufacturer->id] = [
                'name' => $manufacturer->name,
                'y' => 0,
                'drilldown' => $manufacturer->id
            ];
        }

        $arr2 = [];
        foreach ($products as $product) {
            if (empty($arr2[$product->manufacturer_id])) {
                $arr2[$product->manufacturer_id] = [
                    'name' => $arr1[$product->manufacturer_id]['name'],
                    'id' => $product->manufacturer_id,
                ];
            }
            $arr2[$product->manufacturer_id]['data'][] = [$product->name, (int)$product->total_sold];

            $arr1[$product->manufacturer_id]['y'] += $product->total_sold;
        }

        return view('admin.chart.products', [
            'title' => 'Sản phẩm',
            'arr1' => json_encode(array_values($arr1)),
            'arr2' => json_encode(array_values($arr2)),
        ]);
    }

    public function warehouse()
    {
        $products = DB::table('products')
            ->addSelect(['products.id', 'products.name', 'products.manufacturer_id'])
            ->addSelect(DB::raw('SUM(types.quantity) AS total_quantity'))
            ->leftJoin('types', 'types.product_id', '=', 'products.id')
            ->groupBy('products.id')
            ->get();

        $manufacturers = DB::table('manufacturers')
            ->addSelect(['manufacturers.name', 'manufacturers.id'])
            ->get();

        $arr1 = [];
        foreach ($manufacturers as $manufacturer) {
            $arr1[$manufacturer->id] = [
                'name' => $manufacturer->name,
                'y' => 0,
                'drilldown' => $manufacturer->id
            ];
        }

        $arr2 = [];
        foreach ($products as $product) {
            if (empty($arr2[$product->manufacturer_id])) {
                $arr2[$product->manufacturer_id] = [
                    'name' => $arr1[$product->manufacturer_id]['name'],
                    'id' => $product->manufacturer_id,
                ];
            }
            $arr2[$product->manufacturer_id]['data'][] = [$product->name, (int)$product->total_quantity];

            $arr1[$product->manufacturer_id]['y'] += $product->total_quantity;
        }

        return view('admin.chart.warehouse', [
            'title' => 'Sản phẩm',
            'arr1' => json_encode(array_values($arr1)),
            'arr2' => json_encode(array_values($arr2)),
        ]);
    }

    public function topUser()
    {
        $arr = (new User())
            ->addSelect('users.name')
            ->withSum('bills', 'total_price')
            ->orderBy('bills_sum_total_price', 'DESC')
            ->limit(5)
            ->get()->map(function ($user) {
                return [
                    'name' => $user->name,
                    'y' => $user->bills_sum_total_price
                ];
            });

        return view('admin.chart.top_user', [
            'title' => 'Khách hàng tiềm năng',
            'arr' => $arr
        ]);
    }
}
