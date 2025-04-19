@extends('layouts')

@section('content')
<div class="p-6">
    <div class="bg-white rounded-lg p-6">
        <h2 class="text-2xl font-bold mb-4">Selamat datang,  {{ Auth::user()->role }} !</h2>

        @if(Auth::user()->role == 'admin')
        <div class="shadow-md p-5">
            <div class="flex flex-wrap gap-4">
                <!-- Bar Chart -->
                <div class="flex-1 min-w-[60%] h-[400px]">
                    <canvas id="salesChart" class="w-full h-full"></canvas>
                </div>
    
                <!-- Pie Chart -->
                <div class="w-full md:w-[35%] h-[400px] flex justify-center items-center">
                    <div class="w-full max-w-xs">
                        <canvas id="productChart" class="w-full h-auto"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>


    @elseif(Auth::user()->role == 'Employee')

    <div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="container mt-5">

                <!-- Card Total Penjualan -->
                <div class="bg-white shadow-md rounded-lg p-6 mt-6 text-center">
                    <div class="bg-gray-100 py-3 rounded mb-4">
                        <h6 class="text-sm text-gray-500 uppercase tracking-wide">Total Penjualan Hari Ini</h6>
                    </div>

                    <h1 class="text-4xl font-bold text-gray-800">{{ $totalSales }}</h1>
                    <p class="text-gray-500 mt-2">Jumlah total penjualan yang terjadi hari ini.</p>

                    <div class="bg-gray-100 py-2 rounded mt-6">
                        <small class="text-gray-500">Terakhir diperbarui: {{ now()->setTimezone('Asia/Jakarta')->format('d M Y H:i') }}</small>
                    </div>
                </div>

                <!-- Card Penjualan oleh Member dan Non-Member (Uncomment jika dibutuhkan) -->
                <!--
                <div class="row mt-4">
                    <div class="col-md-6">
                        <div class="bg-light p-3 rounded">
                            <h6 class="text-muted">Penjualan oleh Member</h6>
                            <h3 class="fw-bold">{{ $memberSales }}</h3>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="bg-light p-3 rounded">
                            <h6 class="text-muted">Penjualan oleh Non-Member</h6>
                            <h3 class="fw-bold">{{ $nonMemberSales }}</h3>
                        </div>
                    </div>
                </div>
                -->

            </div>
        </div>
    </div>
</div>


    @endif
</div>

<!-- Chart.js CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<!-- Chart Scripts -->
<script>
    var dates = {!! json_encode($dates ?? []) !!};
    var salesCount = {!! json_encode($salesCount ?? []) !!};
    var productNames = {!! json_encode($productNames ?? []) !!};
    var productTotals = {!! json_encode($productTotals ?? []) !!};

    // Bar Chart
    new Chart(document.getElementById('salesChart'), {
        type: 'bar',
        data: {
            labels: dates,
            datasets: [{
                label: 'Jumlah Penjualan',
                data: salesCount,
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: { beginAtZero: true }
            }
        }
    });

    // Pie Chart
    new Chart(document.getElementById('productChart'), {
        type: 'pie',
        data: {
            labels: productNames,
            datasets: [{
                label: 'Persentase Penjualan Produk',
                data: productTotals,
                backgroundColor: [
                    '#ff6384', '#36a2eb', '#ffce56',
                    '#4bc0c0', '#9966ff', '#ffa500',
                    '#8bc34a', '#795548'
                ]
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false
        }
    });


</script>
@endsection
