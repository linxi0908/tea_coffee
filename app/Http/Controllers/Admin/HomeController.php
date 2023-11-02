<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {

        $userCount = User::where('role_id', 2)->count();
        $orderTotal = Order::sum('total');
        $orderCount = Order::count();
        $productCount = Product::withTrashed()->count();

        $arrayDatas = [];
        $arrayDatas[] =  ['Trạng thái đơn hàng', 'Number'];
        $dataOrders = DB::table('orders')
        ->selectRaw('status, count(status) as number')
        ->groupBy('status')
        ->get();
        foreach($dataOrders as $data){
            $arrayDatas[] = [$data->status, $data->number];
        }

        $arrayDatas2 = [];
        $arrayDatas2[] = ['Ngày', 'Doanh thu'];

        $dataOrders2 = DB::table('orders')
        ->select(DB::raw('DATE_FORMAT(orders.created_at, "%d/%m") as date'), DB::raw('SUM(orders.total) as total'))
        ->groupBy('date')
        ->get();

        foreach ($dataOrders2 as $data) {
            $arrayDatas2[] = [$data->date, $data->total];
        }

        return view('admin.pages.home', [
            'arrayDatas' => $arrayDatas,
            'arrayDatas2' => $arrayDatas2,
            'userCount' => $userCount,
            'orderTotal' => $orderTotal,
            'productCount' => $productCount,
            'orderCount' => $orderCount,
        ]);
    }
}
