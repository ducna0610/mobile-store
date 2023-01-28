<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\EditProfileRequest;
use DateTime;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function showProfile()
    {
        $user = auth()->user();

        $num_order = $user->bills->count();

        $num_order_done = $user->bills;

        foreach ($user->bills as $bill) {
            // dd($bill->types);
        }
        // dd($num_order_done);

        $user['dob'] = date_format(DateTime::createFromFormat('Y-m-d H:i:s', $user->dob), 'd-m-Y');

        return view('user.profile.index', [
            'user' => $user,
            'num_order' => $num_order,
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
