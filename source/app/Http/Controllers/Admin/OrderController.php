<?php

namespace App\Http\Controllers\Admin;

use App\Enums\StatusOrderEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Bill\UpdateStatusBillRequest;
use App\Models\Bill;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $data =  Bill::all();

        return view('admin.order.index', [
            'title' => 'Đơn hàng',
            'data' => $data,
            'status' => StatusOrderEnum::getArrayView(),
        ]);
    }

    public function updateStatus(Bill $bill, UpdateStatusBillRequest $request)
    {
        $data = $request->validated();
        $data['status'] = $request->get('status');

        $bill->fill($data);
        $bill->save();

        return 1;
    }
}
