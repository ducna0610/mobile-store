<?php

namespace App\Http\Controllers\Admin;

use App\Enums\AdminRoleEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Employee\StoreEmployeeRequest;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index()
    {
        $data = (new Admin())
            ->where('role', '=', AdminRoleEnum::ADMIN)
            ->get();

        $data = $this->paginate($data, 10, request()->page, ['path' => request()->url(), 'query' => request()->query()]);

        return view('admin.employee.index', [
            'title' => 'Nhân viên',
            'data' => $data,
        ]);
    }

    public function create()
    {
        return view('admin.employee.create', [
            'title' => 'Thêm nhân viên',
        ]);
    }

    public function store(StoreEmployeeRequest $request)
    {
        $data = $request->validated();

        $password = Hash::make($request->password);
        $dob = $request->date('dob');

        $data['password'] = $password;
        $data['dob'] = $dob;

        Admin::create($data);

        return back()->with('success', 'Tạo tài khoản thành công.');
    }
}
