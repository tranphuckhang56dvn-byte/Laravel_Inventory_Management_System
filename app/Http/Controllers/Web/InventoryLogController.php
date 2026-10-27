<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\InventoryLog;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class InventoryLogController extends Controller
{
    public function index(Request $request): View
    {
        $query = InventoryLog::with(['product.category', 'user']);

        if ($request->filled('product_id')) {
            $query->where('product_id', $request->product_id);
        }

        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        if ($request->filled('user_id')) {
            $query->where('user_id', $request->user_id);
        }

        if ($request->filled('from_date')) {
            $query->whereDate('created_at', '>=', $request->from_date);
        }

        if ($request->filled('to_date')) {
            $query->whereDate('created_at', '<=', $request->to_date);
        }

        $logs = $query->latest('id')->paginate(15)->withQueryString();
        $products = Product::orderBy('name')->get();
        $users = User::orderBy('name')->get();

        return view('inventory.logs', compact('logs', 'products', 'users'));
    }
}
