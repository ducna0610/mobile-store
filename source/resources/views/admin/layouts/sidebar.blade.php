<div class="sidebar" data-background-color="brown" data-active-color="danger">
    <!--
        Tip 1: you can change the color of the sidebar's background using: data-background-color="white | brown"
        Tip 2: you can change the color of the active button using the data-active-color="primary | info | success | warning | danger"
    -->
    <div class="logo">
        <a href="{{ route('admins.index') }}" class="simple-text logo-mini">
            @if (isSupperAdmin())
                SAD
            @else
                AD
            @endif
        </a>

        <a href="{{ route('admins.index') }}" class="simple-text logo-normal">
            @if (isSupperAdmin())
                SUPER ADMIN
            @else
                ADMIN
            @endif
        </a>
    </div>

    <div class="sidebar-wrapper">
        <div class="user">
            <div class="photo">
                <img src="{{ asset('admin/img/logo.png') }}" />
            </div>
            <div class="info">
                <a data-toggle="collapse" href="#collapseExample" class="collapsed">
                    <span>
                        {{ Auth::guard('admin')->user()->name }}
                        <b class="caret"></b>
                    </span>
                </a>
                <div class="clearfix"></div>

                <div class="collapse" id="collapseExample">
                    <ul class="nav">
                        <li>
                            <a href="{{ route('admins.showProfile') }}">
                                <span class="sidebar-mini">Mp</span>
                                <span class="sidebar-normal">My Profile</span>
                            </a>
                        </li>
                        <li>
                            <a href="#settings">
                                <span class="sidebar-mini">S</span>
                                <span class="sidebar-normal">Settings</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin-logout') }}">
                                <span class="sidebar-mini">L</span>
                                <span class="sidebar-normal">Log out</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <ul class="nav">
            <li>
                <a data-toggle="collapse" href="#dashboardOverview">
                    <i class="ti-pie-chart"></i>
                    <p>
                        Thống kê
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse" id="dashboardOverview">
                    <ul class="nav">
                        <li>
                            <a href="{{ route('admins.charts.revenue') }}">
                                <span class="sidebar-mini">DT</span>
                                <span class="sidebar-normal">Doanh thu</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admins.charts.products') }}">
                                <span class="sidebar-mini">SP</span>
                                <span class="sidebar-normal">Sản phẩm</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admins.charts.warehouse') }}">
                                <span class="sidebar-mini">TK</span>
                                <span class="sidebar-normal">Tồn kho</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admins.charts.top_user') }}">
                                <span class="sidebar-mini">KH</span>
                                <span class="sidebar-normal">Top khách hàng</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            <li>
                <a href="{{ route('admins.products.index') }}">
                    <i class="ti-package" aria-hidden="true"></i>
                    <p>Sản phẩm</p>
                </a>
            </li>

            <li>
                <a href="{{ route('admins.manufacturers.index') }}">
                    <i class="ti-truck" aria-hidden="true"></i>
                    <p>Nhà sản xuất</p>
                </a>
            </li>
            <li>
                <a href="{{ route('admins.orders.index') }}">
                    <i class="ti-receipt" aria-hidden="true"></i>
                    <p>Đơn hàng</p>
                </a>
            </li>
            @if (isSupperAdmin())
                <li>
                    <a href="{{ route('admins.orders.history') }}">
                        <i class="ti-timer" aria-hidden="true"></i>
                        <p>Lịch sử duyệt đơn</p>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admins.users.index') }}">
                        <i class="ti-heart" aria-hidden="true"></i>
                        <p>Khách hàng</p>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admins.employees.index') }}">
                        <i class="ti-user" aria-hidden="true"></i>
                        <p>Nhân viên</p>
                    </a>
                </li>
            @endif
        </ul>
    </div>
</div>
