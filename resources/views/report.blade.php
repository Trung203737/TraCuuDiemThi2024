@extends('layouts.app')

@section('content')
<div class="container">
    <h4 class="fw-bold mb-4">📊 Báo cáo thống kê điểm theo môn học</h4>

    <canvas id="scoreChart" height="150"></canvas>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('scoreChart');

    const labels = {!! json_encode(array_keys($data)) !!};

    const gioi = {!! json_encode(array_column($data, 'gioi')) !!};
    const kha = {!! json_encode(array_column($data, 'kha')) !!};
    const tb = {!! json_encode(array_column($data, 'trungbinh')) !!};
    const yeu = {!! json_encode(array_column($data, 'yeu')) !!};

    // Map tên cột -> tên tiếng Việt
    const subjectMap = {
        toan: "Toán",
        ngu_van: "Ngữ văn",
        ngoai_ngu: "Ngoại ngữ",
        vat_li: "Vật lý",
        hoa_hoc: "Hóa học",
        sinh_hoc: "Sinh học",
        lich_su: "Lịch sử",
        dia_li: "Địa lý",
        gdcd: "Giáo dục công dân",
    };

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels.map(subject => subjectMap[subject] || subject.toUpperCase()),
            datasets: [
                {
                    label: '≥ 8 điểm (Giỏi)',
                    data: gioi,
                    backgroundColor: 'rgba(75, 192, 192, 0.8)',
                },
                {
                    label: '6 - 7.99 điểm (Khá)',
                    data: kha,
                    backgroundColor: 'rgba(54, 162, 235, 0.8)',
                },
                {
                    label: '4 - 5.99 điểm (Trung bình)',
                    data: tb,
                    backgroundColor: 'rgba(255, 206, 86, 0.8)',
                },
                {
                    label: '< 4 điểm (Yếu)',
                    data: yeu,
                    backgroundColor: 'rgba(255, 99, 132, 0.8)',
                },
            ]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    title: { display: true, text: 'Số lượng học sinh' }
                },
                x: {
                    title: { display: true, text: 'Môn học' }
                }
            }
        }
    });
</script>
@endsection
