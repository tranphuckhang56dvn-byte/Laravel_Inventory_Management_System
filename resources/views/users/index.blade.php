@extends('layouts.app')

@section('title', 'Quản lý Tài khoản & Phân quyền')
@section('page_title', 'Phân Quyền Vai Trò Người Dùng (RBAC)')

@section('content')
<div class="card card-custom mb-4">
    <div class="card-body p-3 d-flex justify-content-between align-items-center">
        <div>
            <h6 class="fw-bold mb-1 text-dark"><i class="fa-solid fa-users-gear text-primary me-2"></i>Danh Sách Tài Khoản Hệ Thống</h6>
            <small class="text-muted">Quản trị viên (Admin) và Nhân viên thủ kho (Warehouse Staff)</small>
        </div>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createUserModal">
            <i class="fa-solid fa-user-plus me-1"></i> Thêm Tài Khoản Mới
        </button>
    </div>
</div>

<div class="card card-custom">
    <div class="table-responsive">
        <table class="table table-custom align-middle mb-0">
            <thead>
                <tr>
                    <th>Họ và Tên</th>
                    <th>Email đăng nhập</th>
                    <th>Số điện thoại</th>
                    <th class="text-center">Vai trò (Role)</th>
                    <th class="text-center">Phiếu đã lập (Nhập / Xuất)</th>
                    <th class="text-center">Trạng thái</th>
                    <th class="text-end">Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $u)
                    <tr>
                        <td>
                            <div class="d-flex align-items-center gap-2">
                                <div class="avatar bg-primary bg-opacity-10 text-primary rounded-circle d-flex align-items-center justify-content-center fw-bold" style="width: 36px; height: 36px;">
                                    {{ substr($u->name, 0, 1) }}
                                </div>
                                <div>
                                    <div class="fw-bold text-dark">{{ $u->name }}</div>
                                    @if($u->id === auth()->id())
                                        <span class="badge bg-info text-dark" style="font-size: 0.65rem;">Tài khoản của bạn</span>
                                    @endif
                                </div>
                            </div>
                        </td>
                        <td>
                            <span class="font-monospace text-dark">{{ $u->email }}</span>
                        </td>
                        <td>
                            <span class="text-muted">{{ $u->phone ?? 'Chưa cập nhật' }}</span>
                        </td>
                        <td class="text-center">
                            @if($u->role === 'admin')
                                <span class="badge bg-danger px-3 py-1">Quản trị viên (Admin)</span>
                            @else
                                <span class="badge bg-primary px-3 py-1">Thủ kho (Staff)</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <span class="badge badge-subtle-primary me-1">{{ $u->goods_receipts_count }} Nhập</span>
                            <span class="badge badge-subtle-info">{{ $u->goods_issues_count }} Xuất</span>
                        </td>
                        <td class="text-center">
                            <span class="badge {{ $u->status ? 'bg-success' : 'bg-secondary' }}">
                                {{ $u->status ? 'Đang hoạt động' : 'Đã khóa' }}
                            </span>
                        </td>
                        <td class="text-end">
                            <button class="btn btn-sm btn-outline-primary me-1" data-bs-toggle="modal" data-bs-target="#editUser{{ $u->id }}" title="Chỉnh sửa">
                                <i class="fa-solid fa-pen"></i>
                            </button>
                            @if($u->id !== auth()->id())
                                <form id="del-u-{{ $u->id }}" method="POST" action="{{ route('users.destroy', $u) }}" class="d-inline-block m-0">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-sm btn-outline-danger" onclick="confirmDelete('del-u-{{ $u->id }}', 'Xóa người dùng {{ $u->name }}?')" title="Xóa">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>
                            @endif

                            <!-- Modal Sửa Người Dùng -->
                            <div class="modal fade" id="editUser{{ $u->id }}" tabindex="-1">
                                <div class="modal-dialog modal-dialog-centered text-start">
                                    <form method="POST" action="{{ route('users.update', $u) }}" class="modal-content">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-header">
                                            <h6 class="modal-title fw-bold">Chỉnh sửa tài khoản: {{ $u->name }}</h6>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label class="form-label small fw-semibold">Họ và tên (*)</label>
                                                <input type="text" name="name" class="form-control" value="{{ $u->name }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label small fw-semibold">Email (*)</label>
                                                <input type="email" name="email" class="form-control" value="{{ $u->email }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label small fw-semibold">Số điện thoại</label>
                                                <input type="text" name="phone" class="form-control" value="{{ $u->phone }}">
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label small fw-semibold">Vai trò phân quyền (*)</label>
                                                <select name="role" class="form-select" required>
                                                    <option value="staff" {{ $u->role === 'staff' ? 'selected' : '' }}>Thủ kho / Nhân viên kho (Staff)</option>
                                                    <option value="admin" {{ $u->role === 'admin' ? 'selected' : '' }}>Quản trị viên toàn quyền (Admin)</option>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label small fw-semibold">Mật khẩu mới (Bỏ trống nếu không đổi)</label>
                                                <input type="password" name="password" class="form-control" placeholder="••••••••">
                                            </div>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" name="status" id="uStatus{{ $u->id }}" value="1" {{ $u->status ? 'checked' : '' }}>
                                                <label class="form-check-label small fw-semibold" for="uStatus{{ $u->id }}">Cho phép đăng nhập (Active)</label>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Đóng</button>
                                            <button type="submit" class="btn btn-sm btn-primary">Lưu thay đổi</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Thêm Người Dùng Mới -->
<div class="modal fade" id="createUserModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered text-start">
        <form method="POST" action="{{ route('users.store') }}" class="modal-content">
            @csrf
            <div class="modal-header">
                <h6 class="modal-title fw-bold"><i class="fa-solid fa-user-plus text-primary me-1"></i> Tạo Tài Khoản Mới</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label small fw-semibold">Họ và tên (*)</label>
                    <input type="text" name="name" class="form-control" placeholder="Ví dụ: Nguyễn Văn A" required>
                </div>
                <div class="mb-3">
                    <label class="form-label small fw-semibold">Email đăng nhập (*)</label>
                    <input type="email" name="email" class="form-control" placeholder="user@kho.vn" required>
                </div>
                <div class="mb-3">
                    <label class="form-label small fw-semibold">Số điện thoại</label>
                    <input type="text" name="phone" class="form-control" placeholder="090...">
                </div>
                <div class="mb-3">
                    <label class="form-label small fw-semibold">Vai trò phân quyền (*)</label>
                    <select name="role" class="form-select" required>
                        <option value="staff">Thủ kho / Nhân viên kho (Staff)</option>
                        <option value="admin">Quản trị viên toàn quyền (Admin)</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label small fw-semibold">Mật khẩu khởi tạo (*)</label>
                    <input type="password" name="password" class="form-control" placeholder="Tối thiểu 6 ký tự" required>
                </div>
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" name="status" id="newUserStatus" value="1" checked>
                    <label class="form-check-label small fw-semibold" for="newUserStatus">Kích hoạt tài khoản ngay</label>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Đóng</button>
                <button type="submit" class="btn btn-sm btn-primary"><i class="fa-solid fa-floppy-disk me-1"></i> Tạo tài khoản</button>
            </div>
        </form>
    </div>
</div>
@endsection
