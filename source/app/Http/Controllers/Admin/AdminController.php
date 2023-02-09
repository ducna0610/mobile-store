<?php

namespace App\Http\Controllers\Admin;

use App\Enums\StatusOrderEnum;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Bill;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use DB;

class AdminController extends Controller
{
    const _PER_PAGE = 10;

    public function __construct()
    {
        // -- CHUAN --
        $this->model = Admin::query();
        $this->table = (new Admin())->getTable();
    }

    public function index()
    {
        // DB::enableQueryLog();
        $title = 'Trang chủ';

        $num_orders = (new Bill())
            ->where('status', '=', StatusOrderEnum::SPENDING)
            ->count();

        $num_products = DB::table('bill_detail')
            ->whereDate('created_at', Carbon::today())
            ->addSelect(DB::raw('SUM(quantity) AS num_products'))
            ->first()->num_products;

        $num_users = (new User())
            ->whereDate('created_at', Carbon::today())
            // ->whereRaw('Date(created_at) = CURDATE()')
            ->count();

        // dd(DB::getQueryLog());

        return view('admin.index', [
            'title' => $title,
            'num_orders' => $num_orders,
            'num_products' => $num_products,
            'num_users' => $num_users,
        ]);
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
