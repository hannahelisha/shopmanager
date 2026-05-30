@extends('layouts.main')

@section('content')

{{-- Page Title --}}
<div class="mb-4">
    <h4 class="fw-bold" style="color: #4a4a4a;">
        <i class="fas fa-tachometer-alt me-2" style="color: #e26d9f;"></i> Dashboard
    </h4>
    <p class="text-muted small">Welcome back! Here's what's happening in your shop 🍦</p>
</div>

{{-- Stats Cards --}}
<div class="row g-4 mb-4">

    {{-- Total Users --}}
    <div class="col-md-6">
        <div class="card h-100">
            <div class="card-body d-flex align-items-center gap-4 p-4">
                <div class="rounded-circle d-flex align-items-center justify-content-center"
                     style="width:65px; height:65px; background-color:#ffeef4;">
                    <i class="fas fa-users fa-2x" style="color:#e26d9f;"></i>
                </div>
                <div>
                    <p class="mb-0 text-muted small fw-600">Total Users</p>
                    <h2 class="fw-bold mb-0" style="color:#e26d9f;">{{ $totalUsers }}</h2>
                </div>
            </div>
        </div>
    </div>

    {{-- Total Products --}}
    <div class="col-md-6">
        <div class="card h-100">
            <div class="card-body d-flex align-items-center gap-4 p-4">
                <div class="rounded-circle d-flex align-items-center justify-content-center"
                     style="width:65px; height:65px; background-color:#f0f9ee;">
                    <i class="fas fa-ice-cream fa-2x" style="color:#B7D3B0;"></i>
                </div>
                <div>
                    <p class="mb-0 text-muted small">Total Products</p>
                    <h2 class="fw-bold mb-0" style="color:#B7D3B0;">{{ $totalProducts }}</h2>
                </div>
            </div>
        </div>
    </div>

</div>

{{-- Charts --}}
<div class="row g-4">

    {{-- Bar Chart --}}
    <div class="col-md-6">
        <div class="card">
            <div class="card-header text-white">
                <h5><i class="fas fa-chart-bar me-2"></i> Users vs Products</h5>
            </div>
            <div class="card-body p-4">
                <canvas id="barChart" height="250"></canvas>
            </div>
        </div>
    </div>

    {{-- Doughnut Chart --}}
    <div class="col-md-6">
        <div class="card">
            <div class="card-header text-white">
                <h5><i class="fas fa-chart-pie me-2"></i> Overview</h5>
            </div>
            <div class="card-body p-4">
                <canvas id="doughnutChart" height="250"></canvas>
            </div>
        </div>
    </div>

</div>

{{-- Chart.js --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Bar Chart
    const barCtx = document.getElementById('barChart').getContext('2d');
    new Chart(barCtx, {
        type: 'bar',
        data: {
            labels: ['Users', 'Products'],
            datasets: [{
                label: 'Total Count',
                data: [{{ $totalUsers }}, {{ $totalProducts }}],
                backgroundColor: ['#e26d9f', '#B7D3B0'],
                borderRadius: 10,
                borderWidth: 0,
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: false }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: { stepSize: 1 }
                }
            }
        }
    });

    // Doughnut Chart
    const doughnutCtx = document.getElementById('doughnutChart').getContext('2d');
    new Chart(doughnutCtx, {
        type: 'doughnut',
        data: {
            labels: ['Users', 'Products'],
            datasets: [{
                data: [{{ $totalUsers }}, {{ $totalProducts }}],
                backgroundColor: ['#e26d9f', '#B7D3B0'],
                borderWidth: 0,
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        font: { family: 'Poppins' }
                    }
                }
            }
        }
    });
</script>

@endsection