<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ResponseTrait;
use App\Models\Manufacturer;
use App\Models\Product;
use App\Models\Type;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    use ResponseTrait;

    public function disks($product_id)
    {
        $data = Type::select('disk')
            ->distinct()
            ->where('quantity', '>', 0)
            ->where('product_id', $product_id)
            ->get();

        return $this->successResponse($data);
    }

    public function rams($product_id)
    {
        $data = Type::select('ram')
            ->distinct()
            ->where('quantity', '>', 0)
            ->where('product_id', $product_id)
            ->where('disk', request()->get('disk'))
            ->get();

        return $this->successResponse($data);
    }

    public function colors($product_id)
    {
        $data = Type::select('color')
            ->where('quantity', '>', 0)
            ->where('product_id', $product_id)
            ->where('disk', request()->get('disk'))
            ->where('ram', request()->get('ram'))
            ->get();

        return $this->successResponse($data);
    }

    public function type($product_id)
    {
        $data = Type::where('product_id', $product_id)
            ->where('quantity', '>', 0)
            ->where('disk', request()->get('disk'))
            ->where('ram', request()->get('ram'))
            ->where('color', 'like', '%' . request()->get('color') . '%')
            ->get();

        return $this->successResponse($data);
    }
}
