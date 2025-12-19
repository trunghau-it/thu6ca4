<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $from = $request->from
            ? Carbon::parse($request->from)->startOfDay()
            : Carbon::now()->startOfMonth();

        $to = $request->to
            ? Carbon::parse($request->to)->endOfDay()
            : Carbon::now()->endOfDay();

        // ================== PHẦN 1 ==================
        $orders = Order::whereBetween('created_at', [$from, $to])
            ->where('status', 'completed')
            ->get();

        $totalRevenue = $orders->sum('total');
        $orderCount   = $orders->count();
        $averageOrder = $orderCount > 0 ? $totalRevenue / $orderCount : 0;

        // ================== PHẦN 2 ==================
        $bestProducts = OrderItem::selectRaw('product_name, SUM(quantity) as total_qty')
            ->whereHas('order', function ($q) use ($from, $to) {
                $q->whereBetween('created_at', [$from, $to])
                  ->where('status', 'completed');
            })
            ->groupBy('product_name')
            ->orderByDesc('total_qty')
            ->limit(5)
            ->get();

        $slowProducts = OrderItem::selectRaw('product_name, SUM(quantity) as total_qty')
            ->whereHas('order', function ($q) use ($from, $to) {
                $q->whereBetween('created_at', [$from, $to])
                  ->where('status', 'completed');
            })
            ->groupBy('product_name')
            ->orderBy('total_qty')
            ->limit(5)
            ->get();

        // ================== PHẦN 3 ==================
        $ordersByDay = Order::whereBetween('created_at', [$from, $to])
            ->orderBy('created_at')
            ->get()
            ->groupBy(fn ($o) => $o->created_at->format('d/m/Y'));

        return view('admin.reports.index', compact(
            'from',
            'to',
            'totalRevenue',
            'orderCount',
            'averageOrder',
            'bestProducts',
            'slowProducts',
            'ordersByDay'
        ));
    }

    // ================== PDF ==================
    public function exportPdf(Request $request)
    {
        $data = $this->index($request)->getData();

        $pdf = Pdf::loadView('admin.reports.pdf', (array) $data);

        return $pdf->download('bao-cao-doanh-thu.pdf');
    }
}
