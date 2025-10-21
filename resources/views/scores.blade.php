@extends('layouts.app')

@section('content')
<div class="card p-4">
    <h4 class="fw-bold mb-3">Tra cứu điểm thi THPT 2024</h4>

    {{-- Thông báo lỗi --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            {{ $errors->first('registration_number') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-warning">{{ session('error') }}</div>
    @endif

    <form action="{{ route('scores.search') }}" method="POST" class="row g-3">
        @csrf
        <div class="col-md-6">
            <label class="form-label">Số báo danh:</label>
            <input type="text" name="registration_number" class="form-control" placeholder="Nhập số báo danh" required>
        </div>
        <div class="col-md-3 align-self-end">
            <button class="btn btn-primary w-100">Tra cứu</button>
        </div>
    </form>
</div>

@if (isset($student))
<div class="card p-4 mt-4">
    <h5 class="fw-bold mb-3">Kết quả chi tiết</h5>

    <table class="table table-bordered">
        <thead class="table-primary">
            <tr>
                <th>Môn</th>
                <th>Điểm</th>
            </tr>
        </thead>
        <tbody>
            <tr><td>Toán</td><td>{{ $student->toan }}</td></tr>
            <tr><td>Ngữ văn</td><td>{{ $student->ngu_van }}</td></tr>
            <tr><td>Ngoại ngữ</td><td>{{ $student->ngoai_ngu }}</td></tr>
            <tr><td>Vật lý</td><td>{{ $student->vat_li }}</td></tr>
            <tr><td>Hóa học</td><td>{{ $student->hoa_hoc }}</td></tr>
            <tr><td>Sinh học</td><td>{{ $student->sinh_hoc }}</td></tr>
            <tr><td>Lịch sử</td><td>{{ $student->lich_su }}</td></tr>
            <tr><td>Địa lý</td><td>{{ $student->dia_li }}</td></tr>
            <tr><td>GDCD</td><td>{{ $student->gdcd }}</td></tr>
        </tbody>
    </table>

    <h6 class="fw-bold mt-3">Tổng điểm các khối:</h6>
    <ul>
        <li>Khối A (Toán + Lý + Hóa): <b>{{ $student->total_group_a }}</b></li>
        <li>Khối B (Toán + Hóa + Sinh): <b>{{ $student->total_group_b }}</b></li>
        <li>Khối C (Văn + Sử + Địa): <b>{{ $student->total_group_c }}</b></li>
    </ul>
</div>
@endif
@endsection
