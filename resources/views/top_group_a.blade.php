@extends('layouts.app')

@section('content')
<div class="container">
    <h4 class="fw-bold mb-4">🏆 Top 10 học sinh khối A (Toán - Lý - Hóa)</h4>

    <table class="table table-striped table-bordered">
        <thead class="table-dark">
            <tr class="text-center">
                <th>Hạng</th>
                <th>Số báo danh</th>
                <th>Toán</th>
                <th>Lý</th>
                <th>Hóa</th>
                <th>Tổng điểm</th>
            </tr>
        </thead>
        <tbody>
            @foreach($students as $index => $student)
                <tr class="text-center">
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $student->registration_number }}</td>
                    <td>{{ $student->toan }}</td>
                    <td>{{ $student->vat_li }}</td>
                    <td>{{ $student->hoa_hoc }}</td>
                    <td class="fw-bold text-primary">{{ $student->total_group_a }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
