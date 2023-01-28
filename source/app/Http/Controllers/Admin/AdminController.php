<?php

namespace App\Http\Controllers\Admin;

use App\Enums\AdminRoleEnum;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Manufacturer;
use App\Models\Product;
use App\Models\Type;
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
        $arrAdminRole = AdminRoleEnum::getArrayView();
        View::share('arrAdminRole', $arrAdminRole);

        // View::share('title', ucwords($this->title));
    }

    public function index()
    {
        $title = 'Admin';

        $roles = AdminRoleEnum::asArray();

        return view('admin.index', compact('title'));
    }
}
