<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\Penjualan;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $sales = Penjualan::selectRaw("DATE(CONVERT_TZ(created_at, '+00:00', '+07:00')) as date, COUNT(*) as total_penjualans")
            ->groupBy('date')
            ->orderBy('date', 'ASC')
            ->get();

        $dates = $sales->pluck('date')->map(fn($date) => Carbon::parse($date)->format('d F Y'))->toArray();
        $salesCount = $sales->pluck('total_penjualans')->toArray();

        $productSales = DB::table('penjualans')
    ->join('detail_penjualans', 'penjualans.id', '=', 'detail_penjualans.penjualan_id')
    ->join('produks', 'detail_penjualans.produk_id', '=', 'produks.id')
    ->whereDate('penjualans.created_at', today()) // ⬅️ filter penjualan hari ini
    ->selectRaw('produks.nama_produk as produk_name, SUM(detail_penjualans.qty) as total_sold')
    ->groupBy('produk_name')
    ->get();


        $productNames = $productSales->pluck('produk_name')->toArray();
        $productTotals = $productSales->pluck('total_sold')->toArray();


        $totalSales = Penjualan::whereDate('created_at', today())->count();

        // Penjualan oleh Member
        $memberSales = Penjualan::whereDate('created_at', today())
                            ->whereNotNull('member_id')
                            ->count();

        // Penjualan oleh Non-Member
        $nonMemberSales = Penjualan::whereDate('created_at', today())
                            ->whereNull('member_id')
                            ->count();

        return view('dashboard', compact('dates', 'salesCount', 'productNames', 'productTotals', 'totalSales', 'memberSales', 'nonMemberSales'));
    }


}
