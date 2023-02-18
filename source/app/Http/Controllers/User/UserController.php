<?php

namespace App\Http\Controllers\User;

use App\Enums\StatusOrderEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\EditProfileRequest;
use App\Models\Bill;
use DateTime;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function showProfile()
    {
        $user = auth()->user();

        $orders = (new Bill())->where('user_id', '=', $user->id)->get();

        $num_order_spending = $orders
            ->where('status', '=', StatusOrderEnum::SPENDING)
            ->count();

        $num_order_delivering = $orders
            ->where('status', '=', StatusOrderEnum::DELIVERING)
            ->count();

        $num_order_done = $orders
            ->where('status', '=', StatusOrderEnum::DONE)
            ->count();

        $num_order_cancel = $orders
            ->where('status', '=', StatusOrderEnum::DONE)
            ->count();

        $user['dob'] = date_format(DateTime::createFromFormat('Y-m-d H:i:s', $user->dob), 'd-m-Y');

        return view('user.profile.index', [
            'user' => $user,
            'num_order_spending' => $num_order_spending,
            'num_order_delivering' => $num_order_delivering,
            'num_order_done' => $num_order_done,
            'num_order_cancel' => $num_order_cancel,
        ]);
    }

    public function editProfile(EditProfileRequest $request)
    {
        $data = $request->validated();

        $dob = (new DateTime($request->dob));
        $data['dob'] = $dob;

        $user = auth()->user();
        $user->fill($data);
        $user->save();

        return back()->with('success', 'Cập nhật thành công!');
    }
}
