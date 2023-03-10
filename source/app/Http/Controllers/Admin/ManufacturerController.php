<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Manufacturer\StoreManufacturerRequest;
use App\Http\Requests\Manufacturer\UpdateManufacturerRequest;
use App\Models\Manufacturer;
use Illuminate\Support\Facades\File;

class ManufacturerController extends Controller
{
    private object $model;
    private string $table;
    private string $LOGO_NAME = "logo.png";

    public function __construct()
    {
        $this->model = new Manufacturer();
        $this->table = (new Manufacturer())->getTable();
    }

    public function index()
    {
        $title = 'Nhà sản xuất';

        $query = $this->model->latest();

        if (request()->has('keywords')) {
            $query->where('name', 'like', '%' . request()->get('keywords') . '%');
        }

        $data = $query->paginate(5)->withQueryString();

        return view('admin.manufacturer.index', [
            'title' => $title,
            'data' => $data,
        ]);
    }

    public function detail(Manufacturer $manufacturer)
    {
        $manufacturer = $manufacturer
            ->where('id', '=', $manufacturer->id)
            ->withCount('products')
            ->first();

        return view('admin.manufacturer.detail', [
            'title' => 'Chi tiết nhà sản xuất',
            'manufacturer' => $manufacturer,
        ]);
    }

    public function create()
    {
        $title = 'Thêm nhà sản xuất';

        return view('admin.manufacturer.create', [
            'title' => $title,
        ]);
    }

    public function store(StoreManufacturerRequest $request)
    {
        // path: images/<manufacturer name>/logo.png
        $path = 'images/' . $request->name . '/' . $this->LOGO_NAME;
        $request->file('logo')->move(public_path('images/' . $request->name), $this->LOGO_NAME);

        $data = $request->validated();
        $data['logo'] = $path;

        $this->model->fill($data);
        $this->model->save();

        return redirect()->route('admins.manufacturers.index')->with('success', 'Thêm thành công!');
    }

    function edit(Manufacturer $manufacturer)
    {
        $title = 'Cập nhật nhà sản xuất';

        return view('admin.manufacturer.edit', [
            'title' => $title,
            'manufacturer' => $manufacturer,
        ]);
    }

    public function update(UpdateManufacturerRequest $request, Manufacturer $manufacturer)
    {
        // If [đổi tên]:
        // chuyển ảnh sang dir mới -> xóa dir cũ

        // If [đổi ảnh]:
        // lưu lại ảnh mới

        $old_dir = $manufacturer->name;

        if ($old_dir != $request->name) {
            $old_path = 'images/' . $old_dir;
            $new_path = 'images/' . $request->name;

            File::move(
                $old_path, // old file
                $new_path // new file
            );

            $path = $new_path . '/' . $this->LOGO_NAME;
        }

        if (!empty($request->file('new_logo'))) {
            $path = 'images/' . $request->name . '/' . $this->LOGO_NAME;
            $request->file('new_logo')->move(public_path('images/' . $request->name), $this->LOGO_NAME);
        }

        $data = $request->validated();
        $data['logo'] = $path;

        $manufacturer->fill($data);
        $manufacturer->save();

        return redirect()->route('admins.manufacturers.index')->with('success', 'Cập nhật thành công!');
    }

    public function destroy(Manufacturer $manufacturer)
    {
        // remove dir old logo 
        File::deleteDirectory(public_path("images/" . $manufacturer->name));

        $manufacturer->delete();

        return back()->with('success', 'Xóa thành công!');
    }
}
