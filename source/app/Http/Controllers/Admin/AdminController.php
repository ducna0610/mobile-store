<?php

namespace App\Http\Controllers\Admin;

use App\Enums\AdminRoleEnum;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Manufacturer;
use App\Models\Product;
use App\Models\Type;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class AdminController extends Controller
{
    const _PER_PAGE = 10;

    public function __construct()
    {
        // -- CHUAN --
        $this->model = Admin::query();
        $this->table = (new Admin())->getTable();

        // share mọi view
        // $arrAdminRole = AdminRoleEnum::getArrayView();
        // View::share('arrAdminRole', $arrAdminRole);

        // View::share('title', ucwords($this->title));
    }

    public function index()
    {
        $title = 'Admin';

        $roles = AdminRoleEnum::asArray();

        return view('admin.index', compact('title'));
    }


    public function showProfile()
    {
        $user = Auth::guard('admin')->user();
        // return $user;
        // $user['dob'] = date_format(DateTime::createFromFormat('Y-m-d H:i:s', $user->dob), 'd-m-Y');

        return view('admin.profile.index', [
            'user' => $user,
            'title' => 'Profile',
        ]);
    }

    public function editProfile()
    // public function editProfile(EditProfileRequest $request)
    {
        dd(request()->all());
        $data = $request->validated();

        $dob = (new DateTime($request->dob));
        $data['dob'] = $dob;

        $user = auth()->user();
        $user->fill($data);
        $user->save();

        return back()->with('success', 'Cập nhật thành công!');
    }
}
