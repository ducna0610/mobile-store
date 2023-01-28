<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\StoreProductRequest;
use App\Http\Requests\Product\UpdateActiveProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Models\Image;
use App\Models\Manufacturer;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    private object $model;
    private string $table;

    private object $manufacturer;

    private string $IMAGE_NAME = "product.png";

    public function __construct()
    {
        $this->model = new Product();
        $this->manufacturer = new Manufacturer();
        $this->table = (new Product())->getTable();
    }

    public function index()
    {
        $title = 'Sản phẩm';

        // Xu ly sap xep
        $sortBy = request()->input('sort-by');

        $sortType = request()->input('sort-type');

        $allowSort = ['asc', 'desc'];

        if (!(empty($sortType)) && !in_array($sortType, $allowSort)) {
            $sortType = 'desc';
        }

        $sortArr = [
            'sortBy' => $sortBy,
            'sortType' => $sortType,
        ];

        $manufacturers = $this->manufacturer->get([
            'id',
            'name',
        ]);

        $data = $this->model
            ->latest()
            ->with('manufacturer:id,name');

        if (request()->has('keywords')) {
            $keywords = request()->get('keywords');
            $data->where(function ($query) use ($keywords) {
                $query->orWhere('name', 'like', '%' . $keywords . '%');

                $query->orWhere(
                    function ($q) use ($keywords) {
                        return $q->whereHas('manufacturer', function ($q) use ($keywords) {
                            return $q->where('name', 'like', '%' . $keywords . '%');
                        });
                    }
                );
            });

            // $data->where('name', 'like', '%' . request('keywords') . '%');
        };

        $id_manufacturers = $this->manufacturer->pluck('id')->toArray();

        if (request()->has('manufacturer_id') && in_array(request('manufacturer_id'), $id_manufacturers)) {
            $data->whereHas('manufacturer', function ($q) {
                return $q->where('id', request('manufacturer_id'));
            });
        };

        $data = $data->paginate();

        return view('admin.product.index', [
            'title' => $title,
            'data' => $data,
            'manufacturers' => $manufacturers,
        ]);
    }

    public function detail(Product $product)
    {
        $title = 'Chi tiết sản phẩm';

        $types = $product->types()->latest()->paginate(3);

        $image_id = $product->image()->get('id')->first()->id ?? 0;

        if ($image_id) {
            $image = Image::query()->select('image_names')->where('id', $image_id)->first();
        } else $list_images = 0;

        return view('admin.product.detail', [
            'title' => $title,
            'product' => $product,
            'image_id' => $image_id,
            'list_images' => $image->image_names ?? 0,
            'types' => $types,
        ]);
    }

    public function create()
    {
        $title = 'Thêm sản phẩm';

        $manufacturers = $this->manufacturer->get([
            'id',
            'name',
        ]);

        return view('admin.product.create', [
            'title' => $title,
            'manufacturers' => $manufacturers,
        ]);
    }

    public function store(StoreProductRequest $request)
    {
        // path: images/<maunfacturer name>/<product name>/product.png
        $manufacturer_name = Manufacturer::where('id', $request->manufacturer_id)->pluck('name')[0];

        $path = Storage::disk('public')->putFileAs('images/' . $manufacturer_name . '/' . $request->name, $request->file('image'), $this->IMAGE_NAME);

        $data = $request->validated();

        $data['image'] = $path;

        $this->model->fill($data);
        $this->model->save();

        return redirect()->route('admins.products.index')->with('success', 'Thêm thành công!');
    }

    public function updateActive(UpdateActiveProductRequest $request, Product $product)
    {
        $data = $request->validated();
        $data['active'] = $request->active === "true";

        $product->fill($data);

        $product->save();

        return 1;
    }

    function edit(Product $product)
    {
        $title = 'Cập nhật sản phẩm';

        $manufacturers = $this->manufacturer->get([
            'id',
            'name',
        ]);

        return view('admin.product.edit', [
            'title' => $title,
            'product' => $product,
            'manufacturers' => $manufacturers,
        ]);
    }

    public function update(UpdateProductRequest $request, Product $product)
    {
        // If [đổi tên]:
        // chuyển ảnh sang dir mới -> xóa dir cũ

        // If [đổi ảnh]:
        // lưu lại ảnh mới

        $old_dir = $product->manufacturer()->first()->name . $product->name;

        $path = $product->image;

        if ($old_dir != $request->name) {
            $old_path = 'images/' . $old_dir;
            $new_path = 'images/' . $product->manufacturer()->first()->name .  $request->name;
            Storage::disk('public')->move($old_path, $new_path);
            Storage::disk('public')->deleteDirectory($old_path);

            $path = $new_path . $this->IMAGE_NAME;
        }

        if (!empty($request->file('new_image'))) {
            $path = Storage::disk('public')->putFileAs('images/' . $product->manufacturer()->first()->name . '/' . $request->name, $request->file('new_image'), $this->IMAGE_NAME);
        }

        $data = $request->validated();
        $data['image'] = $path;

        $product->fill($data);
        $product->save();

        return redirect()->route('admins.products.detail', $product->id)->with('success', 'Cập nhật thành công!');
    }

    public function destroy(Product $product)
    {
        // remove dir old image 
        Storage::disk('public')->deleteDirectory('images/' . $product->manufacturer()->first()->name . '/' . $product->name);

        $product->delete();

        return redirect()->route('admins.products.index')->with('success', 'Xóa thành công!');
    }
}
