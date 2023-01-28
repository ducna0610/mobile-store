<?php

namespace App\Http\Controllers\User;

use App\Enums\StatusOrderEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Bill\RateProductRequest;
use App\Models\Bill;
use App\Models\Product;
use App\Models\Type;
use Illuminate\Http\Request;

class BillController extends Controller
{
    public function showBill()
    {
        $bills = auth()->user()->bills()->latest()->get();

        foreach ($bills as $bill) {
            $bill['status'] = StatusOrderEnum::getStatusName($bill['status']);
        }

        return view('user.bill.index', [
            'bills' => $bills
        ]);
    }

    public function billDetail(Bill $bill)
    {
        $data = collect();

        foreach ($bill->types as $type) {
            $data->push($type->pivot);
        }

        foreach ($data as $item) {
            $item->type_id = Type::find($item->type_id);
        }

        $bill['status_name'] = StatusOrderEnum::getStatusName($bill['status']);

        return view('user.bill.bill_detail', [
            'bill' => $bill,
            'data' => $data,
        ]);
    }

    public function rate(Product $product, RateProductRequest $request)
    {
        if ($product->users->where('id', auth()->user()->id)->count()) {
            return back()->with('error', 'Bạn đã bình luận sản phẩm này rồi.');
        }

        $arr_type_id = [];
        $arr_status = [];

        foreach (auth()->user()->bills as $bill) {
            foreach ($bill->types as $type) {
                $arr_type_id[] = $type->id;

                if ($type->product_id == $product->id) {
                    $arr_status[] = $bill->status;
                }
            }
        }

        if (!$product->types()->whereIn('id', $arr_type_id)->count()) {
            return back()->with('error', 'Bạn chưa mua sản phẩm này.');
        }

        if (!in_array(StatusOrderEnum::DONE, $arr_status)) {
            return back()->with('error', 'Đơn hàng chưa được giao.');
        };

        $data = $request->validated();

        auth()->user()->products()->attach($product->id, $data);

        return back()->with('success', 'Đánh giá thành công!');
    }

    public function deleteRate(Product $product)
    {
        auth()->user()->products()->detach($product->id);
        return back()->with('success', 'Xóa đánh giá thành công!');
    }

    public function cancel(Bill $bill)
    {
        if ($bill->status != StatusOrderEnum::SPENDING) {
            return back()->with('error', '...');;
        }

        foreach ($bill->types as $bill_detail) {
            $type = Type::find($bill_detail->pivot->type_id);

            $type->sold -= $bill_detail->pivot->quantity;
            $type->quantity += $bill_detail->pivot->quantity;
            $type->save();
        }

        $bill->status = StatusOrderEnum::CANCEL;
        $bill->save();

        return back()->with('success', 'Hủy đơn hàng thành công!');;
    }
}
