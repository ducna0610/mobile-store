<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private object $model;
    private string $table;

    public function __construct()
    {
        $this->model = new User();
        $this->table = (new User())->getTable();
    }

    public function index()
    {
        $data = $this->model->latest();

        $data = $data->paginate(5)->withQueryString();

        return view('admin.user.index', [
            'title' => 'Khách hàng',
            'data' => $data,
        ]);
    }
}
