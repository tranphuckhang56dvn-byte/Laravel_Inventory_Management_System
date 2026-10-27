<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập - Hệ Thống Quản Lý Kho WMS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 50%, #0f172a 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .login-card {
            background: #ffffff;
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.35);
            overflow: hidden;
            width: 100%;
            max-width: 440px;
        }
        .btn-primary {
            background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);
            border: none;
            padding: 12px;
            font-weight: 600;
        }
        .demo-pill {
            cursor: pointer;
            transition: all 0.2s;
            border: 1px dashed #cbd5e1;
            border-radius: 10px;
            padding: 8px 12px;
            background: #f8fafc;
        }
        .demo-pill:hover {
            background: #eff6ff;
            border-color: #3b82f6;
        }
    </style>
</head>
<body>
    <div class="login-card p-4 p-md-5">
        <div class="text-center mb-4">
            <div class="d-inline-flex p-3 rounded-circle bg-primary bg-opacity-10 text-primary mb-3">
                <i class="fa-solid fa-boxes-stacked fa-2x"></i>
            </div>
            <h4 class="fw-bold text-dark mb-1">ĐĂNG NHẬP HỆ THỐNG</h4>
            <p class="text-muted small">Quản lý Nhập - Xuất - Tồn Kho (WMS Laravel)</p>
        </div>

        @if($errors->any())
            <div class="alert alert-danger py-2 px-3 small rounded-3 mb-3">
                <i class="fa-solid fa-circle-exclamation me-1"></i> {{ $errors->first() }}
            </div>
        @endif

        @if(session('success'))
            <div class="alert alert-success py-2 px-3 small rounded-3 mb-3">
                <i class="fa-solid fa-circle-check me-1"></i> {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login.post') }}">
            @csrf
            <div class="mb-3">
                <label class="form-label small fw-semibold text-secondary">Địa chỉ Email</label>
                <div class="input-group">
                    <span class="input-group-text bg-light text-muted border-end-0"><i class="fa-regular fa-envelope"></i></span>
                    <input type="email" name="email" id="email" class="form-control border-start-0" placeholder="name@domain.com" value="{{ old('email', 'admin@kho.vn') }}" required autofocus>
                </div>
            </div>

            <div class="mb-3">
                <div class="d-flex justify-content-between align-items-center mb-1">
                    <label class="form-label small fw-semibold text-secondary mb-0">Mật khẩu</label>
                </div>
                <div class="input-group">
                    <span class="input-group-text bg-light text-muted border-end-0"><i class="fa-solid fa-lock"></i></span>
                    <input type="password" name="password" id="password" class="form-control border-start-0" placeholder="••••••••" value="admin123" required>
                </div>
            </div>

            <div class="mb-4 form-check">
                <input type="checkbox" name="remember" class="form-check-input" id="remember" checked>
                <label class="form-check-label small text-muted" for="remember">Ghi nhớ phiên đăng nhập</label>
            </div>

            <button type="submit" class="btn btn-primary w-100 rounded-3 mb-3">
                <i class="fa-solid fa-arrow-right-to-bracket me-2"></i> Đăng nhập vào hệ thống
            </button>
        </form>

        <div class="mt-4 pt-3 border-top">
            <div class="small fw-bold text-muted mb-2 text-center text-uppercase" style="font-size: 0.75rem;">
                Tài khoản Demo (Nhấp để tự động điền)
            </div>
            <div class="d-flex flex-column gap-2">
                <div class="demo-pill d-flex justify-content-between align-items-center" onclick="fillAccount('admin@kho.vn', 'admin123')">
                    <div>
                        <span class="badge bg-danger me-1">Admin</span>
                        <strong class="small">Thái Anh Kiệt (Quản trị viên)</strong>
                    </div>
                    <small class="text-primary font-monospace">admin@kho.vn</small>
                </div>
                <div class="demo-pill d-flex justify-content-between align-items-center" onclick="fillAccount('staff@kho.vn', 'staff123')">
                    <div>
                        <span class="badge bg-primary me-1">Staff</span>
                        <strong class="small">Trần Phúc Khang (Thủ kho)</strong>
                    </div>
                    <small class="text-primary font-monospace">staff@kho.vn</small>
                </div>
            </div>
        </div>

        <div class="text-center text-muted small mt-4" style="font-size: 0.72rem;">
            Đồ án chuyên ngành CNTT - Nhóm: Thái Anh Kiệt & Trần Phúc Khang (25C2-LTM1)
        </div>
    </div>

    <script>
        function fillAccount(email, pwd) {
            document.getElementById('email').value = email;
            document.getElementById('password').value = pwd;
        }
    </script>
</body>
</html>
