<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class Product extends Model
{
    protected $table = 'products';
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'image',
        'active',
        'manufacturer_id',
    ];

    public function manufacturer()
    {
        return $this->belongsTo(Manufacturer::class);
    }

    public function types()
    {
        return $this->hasMany(Type::class);
    }

    public function image()
    {
        return $this->hasOne(Image::class);
    }

    public function bills()
    {
        return $this->hasManyThrough(Bill::class, Type::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'rates')->withPivot('star', 'comment')->withTimestamps();
    }

    public function getAll($q = null, $manufacturer_id = null, $star = 1, $arr_price = [], $sortName = null, $sortType = 'asc')
    {
        DB::enableQueryLog();

        $query = DB::table($this->table)
            ->addSelect('products.*')
            ->addSelect(DB::raw('MIN(types.price) AS price'))
            // ->addSelect(DB::raw('COALESCE(AVG(rates.star), 5) AS star'))
            ->addSelect(DB::raw('IFNULL(AVG(rates.star), 5) AS star'))
            ->addSelect(DB::raw('COUNT(distinct types.id) AS specifications'))
            ->addSelect(DB::raw('SUM(sold) AS total_sold'))
            ->addSelect(DB::raw('
            (SELECT COUNT(*) FROM rates WHERE rates.product_id = products.id)
             AS rates'))
            ->where('active', '=', 1)
            ->join('types', 'types.product_id', '=', 'products.id')
            ->leftJoin('rates', 'rates.product_id', '=', 'products.id')
            ->where(function ($query) use ($q) {
                $query->orWhere('name', 'like', '%' . $q . '%')
                    ->orWhere('price', 'like', '%' . $q . '%')
                    ->orWhere('star', 'like', '%' . $q . '%');
            })
            ->groupBy('products.id');

        if ($manufacturer_id) {
            $query = $query->where('manufacturer_id', '=', $manufacturer_id);
        }

        if ($arr_price) {
            $query = $query->whereBetween('price', $arr_price);
        }

        if ($sortName) {
            $query = $query->orderBy($sortName, $sortType);
        }

        if ($star) {
            $query = $query
                ->having('star', '>=', $star);
        }

        $products = $query
            ->paginate(8)->withQueryString();

        // dd($products);

        // dd(DB::getQueryLog());
        return $products;
    }
}
