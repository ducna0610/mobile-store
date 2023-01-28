<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Image;
use App\Models\Product;
use Illuminate\Support\Facades\File as File2;

class ImageController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function store_image_product(Request $request, Product $product)
    {
        $images = [];
        if ($request->hasfile('image_names')) {
            foreach ($request->file('image_names') as $image) {
                $name = time() . rand(1, 100) . '.' . $image->extension();
                $image->move(storage_path('app/public/files'), $name);
                $images[] = $name;
            }
        }

        $image = new Image();
        $image->image_names = $images;
        $product->image()->save($image);

        return back()->with('success', 'Thêm thành công!');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $input = $request->all();
        $images = [];
        $images_remove = [];
        if ($request->hasfile('image_names')) {
            foreach ($request->file('image_names') as $image) {
                $name = time() . rand(1, 100) . '.' . $image->extension();
                $image->move(storage_path('app/public/files'), $name);
                $images[] = $name;
            }
        }

        if (isset($input['images_uploaded'])) {
            $images_remove = array_diff(json_decode($input['images_uploaded_origin']), $input['images_uploaded']);
            $images = array_merge($input['images_uploaded'], $images);
        } else {
            $images_remove = json_decode($input['images_uploaded_origin']);
        }

        $image = Image::find($input['id']);
        $image->image_names = $images;
        if ($image->update()) {
            foreach ($images_remove as $image_name) {
                File2::delete(storage_path("app/public/files/" . $image_name));
            }
        }

        return back()->with('success', 'Cập nhật thành công!');
    }
}
