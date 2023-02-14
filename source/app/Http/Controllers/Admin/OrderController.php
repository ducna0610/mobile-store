<?php

namespace App\Http\Controllers\Admin;

use App\Enums\StatusOrderEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Bill\UpdateStatusBillRequest;
use App\Models\Admin;
use App\Models\Bill;
use Illuminate\Http\Request;
use DB;

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
        auth()->guard('admin')->user()->bills()->attach($bill->id, $data);
        $data['status'] = $request->get('status');

        $bill->fill($data);
        $bill->save();

        return 1;
    }


    public function history()
    {
        $query = DB::table('order_confirm')
            ->latest();

        if (request()->get('bill_id')) {
            $query->where('bill_id', '=', request()->get('bill_id'));
        }

        $data = $query
            ->get()
            ->map(function ($data) {
                return collect([
                    'admin_name' => Admin::find($data->admin_id)->name,
                    'created_at' => $data->created_at,
                    'bill_id' => $data->bill_id,
                    'status' => StatusOrderEnum::getStatusName($data->status),
                ]);
            });
        $data = $this->paginate($data, 10, request()->page, ['path' => request()->url(), 'query' => request()->query()]);

        $arr_bill_id = DB::table('order_confirm')
            ->distinct('bill_id')
            ->pluck('bill_id');
        // return $data;

        return view('admin.order.history', [
            'title' => 'Lịch sử duyệt đơn',
            'data' => $data,
            'arr_bill_id' => $arr_bill_id
        ]);
    }
}
