@extends('layouts.app')

@section('title', 'Phiếu xuất kho: ' . $issue->code)
@section('page_title', 'Chi Tiết Phiếu Xuất Kho')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-10">
        <div class="d-flex justify-content-between align-items-center mb-3 no-print">
            <a href="{{ route('issues.index') }}" class="btn btn-sm btn-outline-secondary">
                <i class="fa-solid fa-arrow-left me-1"></i> Danh sách phiếu xuất
            </a>
            <div class="d-flex gap-2">
                <button type="button" class="btn btn-sm btn-primary" onclick="window.print()">
                    <i class="fa-solid fa-print me-1"></i> In phiếu xuất kho
                </button>
            </div>
        </div>

        <div class="card card-custom p-4 p-md-5">
            <!-- Header Phiếu -->
            <div class="row border-bottom pb-4 mb-4">
                <div class="col-sm-7">
                    <h5 class="fw-bold text-dark mb-1">CÔNG TY QUẢN LÝ KHO VẬN WMS</h5>
                    <p class="text-muted small mb-1">Địa chỉ: KCN Tân Bình, Tây Thạnh, Tân Phú, TP. Hồ Chí Minh</p>
                    <p class="text-muted small mb-0">Hotline: 028 7300 xxxx | Email: info@kho.vn</p>
                </div>
                <div class="col-sm-5 text-sm-end mt-3 mt-sm-0">
                    <h4 class="fw-bold text-danger mb-1">PHIẾU XUẤT KHO</h4>
                    <div class="font-monospace fw-bold text-secondary">Số: {{ $issue->code }}</div>
                    <div class="small text-muted">Ngày xuất: {{ $issue->issue_date->format('d/m/Y') }}</div>
                </div>
            </div>

            <!-- Thông tin khách hàng & lý do -->
            <div class="row g-3 mb-4">
                <div class="col-md-6">
                    <div class="p-3 bg-light rounded-3 h-100">
                        <h6 class="fw-bold text-dark small mb-2 text-uppercase">Khách hàng / Đơn vị nhận</h6>
                        <div class="fw-bold text-dark fs-6">{{ $issue->customer_name ?? 'Khách hàng vãng lai' }}</div>
                        <div class="small text-muted mt-1"><i class="fa-solid fa-tag me-1"></i>Lý do xuất: <span class="badge badge-subtle-info">{{ $issue->reason }}</span></div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="p-3 bg-light rounded-3 h-100">
                        <h6 class="fw-bold text-dark small mb-2 text-uppercase">Thông tin xử lý kho</h6>
                        <div class="small mb-1"><span class="text-muted">Thủ kho xuất:</span> <strong>{{ $issue->user->name }}</strong></div>
                        <div class="small mb-1"><span class="text-muted">Trạng thái:</span> <span class="badge bg-success">Đã hoàn thành</span></div>
                        <div class="small"><span class="text-muted">Ghi chú:</span> {{ $issue->note ?? 'Không có ghi chú' }}</div>
                    </div>
                </div>
            </div>

            <!-- Bảng danh sách mặt hàng xuất -->
            <div class="table-responsive mb-4">
                <table class="table table-bordered align-middle mb-0">
                    <thead class="table-light text-center">
                        <tr>
                            <th style="width: 50px;">STT</th>
                            <th style="width: 120px;">Mã SKU</th>
                            <th>Tên mặt hàng / Quy cách</th>
                            <th style="width: 80px;">ĐVT</th>
                            <th style="width: 100px;">Số lượng</th>
                            <th style="width: 140px;" class="text-end">Đơn giá bán</th>
                            <th style="width: 160px;" class="text-end">Thành tiền (VNĐ)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($issue->items as $idx => $item)
                            <tr>
                                <td class="text-center">{{ $idx + 1 }}</td>
                                <td class="font-monospace small">{{ $item->product->sku }}</td>
                                <td>
                                    <div class="fw-semibold text-dark">{{ $item->product->name }}</div>
                                    @if($item->note)
                                        <small class="text-muted">({{ $item->note }})</small>
                                    @endif
                                </td>
                                <td class="text-center">{{ $item->product->unit }}</td>
                                <td class="text-center fw-bold">{{ number_format($item->quantity) }}</td>
                                <td class="text-end">{{ number_format($item->unit_price) }} đ</td>
                                <td class="text-end fw-bold">{{ number_format($item->total_price) }} đ</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="6" class="text-end fw-bold">Tổng thanh toán:</td>
                            <td class="text-end fw-bold fs-6 text-danger">{{ number_format($issue->total_amount) }} đ</td>
                        </tr>
                    </tfoot>
                </table>
            </div>

            <!-- Ký nhận -->
            <div class="row text-center mt-5 pt-3">
                <div class="col-4">
                    <div class="fw-bold text-dark">Người nhận hàng</div>
                    <small class="text-muted">(Ký, ghi rõ họ tên)</small>
                    <div style="height: 70px;"></div>
                    <div class="fw-semibold text-dark">{{ $issue->customer_name }}</div>
                </div>
                <div class="col-4">
                    <div class="fw-bold text-dark">Thủ kho giao</div>
                    <small class="text-muted">(Ký, ghi rõ họ tên)</small>
                    <div style="height: 70px;"></div>
                    <div class="fw-semibold text-dark">{{ $issue->user->name }}</div>
                </div>
                <div class="col-4">
                    <div class="fw-bold text-dark">Kế toán trưởng</div>
                    <small class="text-muted">(Ký, đóng dấu)</small>
                    <div style="height: 70px;"></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
