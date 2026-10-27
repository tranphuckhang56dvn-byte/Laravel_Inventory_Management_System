<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UserController extends Controller
{
    public function index(): View
    {
        $users = User::withCount(['goodsReceipts', 'goodsIssues'])->latest()->paginate(10);

        return view('users.index', compact('users'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'phone' => 'nullable|string|max:20',
            'role' => 'required|in:admin,staff',
            'password' => 'required|string|min:6',
        ]);

        $validated['status'] = $request->boolean('status', true);
        User::create($validated);

        return back()->with('success', 'Tạo tài khoản người dùng mới thành công!');
    }

    public function update(Request $request, User $user): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,'.$user->id,
            'phone' => 'nullable|string|max:20',
            'role' => 'required|in:admin,staff',
            'password' => 'nullable|string|min:6',
        ]);

        $validated['status'] = $request->boolean('status', true);

        if (empty($validated['password'])) {
            unset($validated['password']);
        }

        $user->update($validated);

        return back()->with('success', 'Cập nhật tài khoản người dùng thành công!');
    }

    public function destroy(User $user): RedirectResponse
    {
        if ($user->id === auth()->id()) {
            return back()->with('error', 'Không thể xóa tài khoản của chính bạn!');
        }

        if ($user->goodsReceipts()->count() > 0 || $user->goodsIssues()->count() > 0) {
            return back()->with('error', 'Không thể xóa người dùng đã từng lập phiếu nhập hoặc phiếu xuất kho.');
        }

        $user->delete();

        return back()->with('success', 'Xóa tài khoản người dùng thành công.');
    }
}
