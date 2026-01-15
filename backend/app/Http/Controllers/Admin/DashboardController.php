<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Shirt;
use App\Models\Team;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index() {
        return view('admin.dashboard', [
            'usersCount' => User::count(),
            'ordersCount' => Order::count(),
            'shirtsCount' => Shirt::count(),
            'teamsCount' => Team::count(),
            'totalRevenue' => Order::sum('total_price'),
            'latestOrders' => Order::with('user')->latest()->take(5)->get()
        ]);
    }
}
