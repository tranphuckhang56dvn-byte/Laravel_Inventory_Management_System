<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Supplier;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SupplierController extends Controller
{
    public function index(Request $request): View
    {
        $query = Supplier::withCount(['products', 'goodsReceipts']);

        if ($request->filled('keyword')) {
            $kw = $request->keyword;
            $query->where(function ($q) use ($kw) {
                $q->where('name', 'like', "%{$kw}%")
                    ->orWhere('code', 'like', "%{$kw}%")
                    ->orWhere('phone', 'like', "%{$kw}%");
            });
        }

        $suppliers = $query->latest()->paginate(10)->withQueryString();

        return view('suppliers.index', compact('suppliers'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'code' => 'required|string|max:50|unique:suppliers,code',
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'address' => 'nullable|string',
            'status' => 'boolean',
        ]);

        $validated['status'] = $request->boolean('status', true);
        Supplier::create($validated);

        return back()->with('success', 'Thêm nhà cung cấp mới thành công!');
    }

    public function update(Request $request, Supplier $supplier): RedirectResponse
    {
        $validated = $request->validate([
            'code' => 'required|string|max:50|unique:suppliers,code,'.$supplier->id,
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'address' => 'nullable|string',
            'status' => 'boolean',
        ]);

        $validated['status'] = $request->boolean('status', true);
        $supplier->update($validated);

        return back()->with('success', 'Cập nhật thông tin nhà cung cấp thành công!');
    }

    public function destroy(Supplier $supplier): RedirectResponse
    {
        if ($supplier->products()->count() > 0 || $supplier->goodsReceipts()->count() > 0) {
            return back()->with('error', 'Không thể xóa nhà cung cấp đang có sản phẩm hoặc phiếu nhập.');
        }

        $supplier->delete();

        return back()->with('success', 'Xóa nhà cung cấp thành công!');
    }
}
