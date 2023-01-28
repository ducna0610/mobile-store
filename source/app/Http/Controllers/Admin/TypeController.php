<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Type\StoreTypeRequest;
use App\Http\Requests\Type\UpdateTypeRequest;
use App\Models\Product;
use App\Models\Type;

class TypeController extends Controller
{

    private object $model;
    private string $table;

    public function __construct()
    {
        $this->model = new Type();
        $this->table = (new Type())->getTable();
    }

    public function store(StoreTypeRequest $request, Product $product)
    {
        $data = $request->validated();

        $arrColor = explode(",", request()->colors[0]);

        foreach ($arrColor as $color) {
            $data['color'] = $color;

            $type = new Type($data);

            $product->types()->save($type);
        }

        return back()->with('success', 'Thêm thành công!');
    }

    public function edit(Type $type)
    {
        $title = 'Cập nhật cấu hình sản phẩm';
        return view('admin.type.edit', [
            'title' => $title,
            'type' => $type,
        ]);
    }

    public function update(UpdateTypeRequest $request, Type $type)
    {
        $data = $request->validated();

        $type->fill($data);
        $type->save();

        return redirect()->route('admins.products.detail', $type->product->id)->with('success', 'Cập nhật thành công!');
    }

    public function destroy(Type $type)
    {
        $type->delete();

        return back()->with('success', 'Xóa thành công!');
    }
}
