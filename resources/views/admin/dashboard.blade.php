@extends('layouts.admin')

@section('title', 'Dashboard | Setaman Bogor Admin')

@section('content')
            <!-- Load libraries via CDN -->
            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>

            <div id="dashboard-report-content" class="bg-gray-50 p-2 rounded">
                <!-- Welcome Header -->
                <div class="mb-8 border-b border-dotted border-blue-400 pb-4">
                    <h2 class="text-2xl font-bold text-gray-900 mb-1">RINGKASAN DASHBOARD</h2>
                    <p class="text-sm text-gray-500">Selamat datang kembali, {{ Auth::user()->name }}. Berikut adalah performa toko hari ini.</p>
                </div>

                <!-- Stats Grid (4 Cards) -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                    <!-- Card 1 -->
                    <div class="bg-white p-6 border border-gray-200 shadow-sm rounded-lg flex flex-col justify-between hover:border-brand transition">
                        <p class="text-[10px] font-bold text-gray-500 uppercase tracking-widest mb-2">Total Pesanan</p>
                        <h3 class="text-3xl font-bold text-gray-900 mb-4">{{ number_format($totalOrders) }}</h3>
                        <p class="text-xs text-green-600 font-semibold flex items-center gap-1">
                            <i class="fas fa-shopping-bag"></i> PESANAN MASUK
                        </p>
                    </div>
                    <!-- Card 2 (Warning) -->
                    <div class="bg-white p-6 border border-red-200 shadow-sm rounded-lg flex flex-col justify-between hover:border-red-300 transition">
                        <p class="text-[10px] font-bold text-gray-500 uppercase tracking-widest mb-2">Stok Menipis</p>
                        <h3 class="text-3xl font-bold text-red-600 mb-4">{{ sprintf('%02d', $lowStockCount) }}</h3>
                        <a href="{{ route('products.index') }}" class="text-xs text-gray-700 font-bold border-b border-gray-700 hover:text-red-600 hover:border-red-600 transition pb-0.5 w-max uppercase tracking-wider pdf-exclude">
                            LIHAT DETAIL
                        </a>
                    </div>
                    <!-- Card 3 -->
                    <div class="bg-white p-6 border border-gray-200 shadow-sm rounded-lg flex flex-col justify-between hover:border-brand transition">
                        <p class="text-[10px] font-bold text-gray-500 uppercase tracking-widest mb-2">Total Produk</p>
                        <h3 class="text-3xl font-bold text-gray-900 mb-4">{{ number_format($totalProducts) }}</h3>
                        <p class="text-xs text-gray-500 font-medium flex items-center gap-1">
                            <i class="far fa-folder-open"></i> KATALOG AKTIF
                        </p>
                    </div>
                    <!-- Card 4 -->
                    <div class="bg-white p-6 border border-gray-200 shadow-sm rounded-lg flex flex-col justify-between hover:border-brand transition">
                        <p class="text-[10px] font-bold text-gray-500 uppercase tracking-widest mb-2">Total Artikel</p>
                        <h3 class="text-3xl font-bold text-gray-900 mb-4">{{ number_format($totalArticles) }}</h3>
                        <p class="text-xs text-gray-500 font-medium flex items-center gap-1">
                            <i class="far fa-file-alt"></i> KONTEN EDUKASI
                        </p>
                    </div>
                </div>

                <!-- Chart Section -->
                <div class="bg-white border border-gray-200 rounded-lg shadow-sm p-6 mb-8">
                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
                        <h3 class="text-lg font-bold text-gray-900 uppercase tracking-wide">Tren Penjualan</h3>
                        <div class="flex border border-gray-300 rounded-md overflow-hidden text-xs font-bold pdf-exclude">
                            <button id="btnWeekly" class="bg-white text-gray-600 hover:bg-gray-50 px-4 py-2 uppercase tracking-wider transition">Mingguan</button>
                            <button id="btnMonthly" class="bg-black text-white px-4 py-2 uppercase tracking-wider transition">Bulanan</button>
                        </div>
                    </div>
                    <!-- Canvas Chart -->
                    <div class="w-full h-80 relative">
                        <canvas id="salesTrendChart"></canvas>
                    </div>
                </div>

                <!-- Bottom Grid (Pesanan Terakhir & Sidebar Peringatan) -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    
                    <!-- Pesanan Terakhir (Kiri, lebih lebar) -->
                    <div class="lg:col-span-2 bg-white border border-gray-200 rounded-lg shadow-sm overflow-hidden flex flex-col">
                        <div class="p-6 border-b border-gray-200">
                            <h3 class="text-base font-bold text-gray-900 uppercase tracking-wide">Pesanan Terakhir</h3>
                        </div>
                        <!-- Table -->
                        <div class="overflow-x-auto flex-grow">
                            <table class="w-full text-left text-sm text-gray-600">
                                <thead class="bg-gray-50 text-xs uppercase font-bold text-gray-500 border-b border-gray-200">
                                    <tr>
                                        <th class="px-6 py-4">ID Pesanan</th>
                                        <th class="px-6 py-4">Pelanggan</th>
                                        <th class="px-6 py-4">Total</th>
                                        <th class="px-6 py-4">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($recentOrders as $order)
                                    <tr class="border-b border-gray-100 hover:bg-gray-50">
                                        <td class="px-6 py-4 font-mono font-medium text-gray-900">#{{ $order->order_code }}</td>
                                        <td class="px-6 py-4">{{ $order->customer_name }}</td>
                                        <td class="px-6 py-4 font-medium">Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                                        <td class="px-6 py-4">
                                            @php
                                                $statusColors = [
                                                    'pending' => 'bg-yellow-100 text-yellow-700',
                                                    'processing' => 'bg-blue-100 text-blue-700',
                                                    'shipped' => 'bg-purple-100 text-purple-700',
                                                    'completed' => 'bg-green-100 text-green-700',
                                                    'cancelled' => 'bg-red-100 text-red-700'
                                                ];
                                                $color = $statusColors[strtolower($order->status)] ?? 'bg-gray-100 text-gray-700';
                                            @endphp
                                            <span class="px-2 py-1 {{ $color }} rounded text-xs font-bold uppercase">{{ $order->status }}</span>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="4" class="px-6 py-8 text-center text-gray-500 italic">Belum ada pesanan terbaru.</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Kolom Kanan (Peringatan & Analisis) -->
                    <div class="lg:col-span-1 space-y-6">
                        
                        <!-- Peringatan Stok -->
                        <div class="bg-white border border-red-200 rounded-lg shadow-sm p-6">
                            <h3 class="text-sm font-bold text-red-600 flex items-center gap-2 uppercase tracking-wide mb-5">
                                <i class="fas fa-exclamation-triangle"></i> Peringatan Stok
                            </h3>
                            <div class="space-y-4">
                                @forelse($lowStockProducts as $product)
                                <div class="flex justify-between items-center pb-3 border-b border-gray-100">
                                    <div>
                                        <h4 class="font-bold text-gray-900 text-sm">{{ $product->name }}</h4>
                                        <p class="text-xs {{ $product->stock == 0 ? 'text-red-500' : 'text-gray-500' }}">
                                            {{ $product->stock == 0 ? 'Habis' : 'Sisa ' . $product->stock . ' unit' }}
                                        </p>
                                    </div>
                                    <a href="{{ route('products.edit', $product->id) }}" class="bg-black text-white text-[10px] font-bold uppercase tracking-wider px-3 py-1.5 rounded hover:bg-gray-800 transition pdf-exclude">Update</a>
                                </div>
                                @empty
                                <div class="text-center py-4">
                                    <p class="text-xs text-gray-500 italic">Semua stok aman.</p>
                                </div>
                                @endforelse
                            </div>
                        </div>

                        <!-- Analisis Baru (PDF Trigger Card) -->
                        <div class="bg-brand-light border border-brand/20 rounded-lg shadow-sm p-6 relative overflow-hidden pdf-exclude">
                            <i class="fas fa-chart-pie absolute -bottom-4 -right-4 text-7xl text-brand opacity-10"></i>
                            <h3 class="text-sm font-bold text-brand-dark uppercase tracking-wide mb-2 relative z-10">Laporan Dashboard</h3>
                            <p class="text-xs text-gray-600 mb-4 relative z-10 leading-relaxed">
                                Unduh rangkuman statistik, grafik tren penjualan, dan data pesanan terbaru dalam bentuk PDF.
                            </p>
                            <button id="downloadPdfBtn" class="text-xs font-bold text-brand-dark border-b border-brand-dark hover:text-brand hover:border-brand transition pb-0.5 inline-flex items-center gap-2 uppercase tracking-wider relative z-10 cursor-pointer">
                                Unduh PDF <i class="fas fa-download"></i>
                            </button>
                        </div>

                    </div>

                </div>
            </div>

            <!-- Dashboard Scripting (Chart.js & html2pdf.js) -->
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    const ctx = document.getElementById('salesTrendChart').getContext('2d');
                    
                    const monthlyLabels = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
                    const monthlyData = @json($monthlySalesData);
                    
                    const weeklyLabels = ['Minggu 1', 'Minggu 2', 'Minggu 3', 'Minggu 4'];
                    const weeklyData = @json($weeklySales);

                    // Create gradient
                    const gradient = ctx.createLinearGradient(0, 0, 0, 300);
                    gradient.addColorStop(0, 'rgba(27, 67, 50, 0.4)');
                    gradient.addColorStop(1, 'rgba(27, 67, 50, 0)');

                    let salesChart = new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels: monthlyLabels,
                            datasets: [{
                                label: 'Total Penjualan (Rp)',
                                data: monthlyData,
                                borderColor: '#1b4332',
                                borderWidth: 3,
                                backgroundColor: gradient,
                                fill: true,
                                tension: 0.4,
                                pointBackgroundColor: '#1b4332',
                                pointBorderColor: '#ffffff',
                                pointBorderWidth: 2,
                                pointRadius: 5,
                                pointHoverRadius: 7
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: {
                                legend: {
                                    display: false
                                },
                                tooltip: {
                                    callbacks: {
                                        label: function (context) {
                                            let value = context.raw || 0;
                                            return 'Penjualan: Rp ' + new Intl.NumberFormat('id-ID').format(value);
                                        }
                                    }
                                }
                            },
                            scales: {
                                y: {
                                    grid: {
                                        borderDash: [5, 5],
                                        color: 'rgba(0, 0, 0, 0.05)'
                                    },
                                    ticks: {
                                        callback: function (value) {
                                            if (value >= 1000000) {
                                                return 'Rp ' + (value / 1000000) + 'jt';
                                            }
                                            return 'Rp ' + new Intl.NumberFormat('id-ID').format(value);
                                        },
                                        font: {
                                            family: 'Inter',
                                            size: 11
                                        }
                                    }
                                },
                                x: {
                                    grid: {
                                        display: false
                                    },
                                    ticks: {
                                        font: {
                                            family: 'Inter',
                                            size: 11
                                        }
                                    }
                                }
                            }
                        }
                    });

                    const btnWeekly = document.getElementById('btnWeekly');
                    const btnMonthly = document.getElementById('btnMonthly');

                    btnWeekly.addEventListener('click', function () {
                        // Toggle button classes
                        btnWeekly.classList.remove('bg-white', 'text-gray-600');
                        btnWeekly.classList.add('bg-black', 'text-white');
                        
                        btnMonthly.classList.remove('bg-black', 'text-white');
                        btnMonthly.classList.add('bg-white', 'text-gray-600');

                        // Update chart
                        salesChart.data.labels = weeklyLabels;
                        salesChart.data.datasets[0].data = weeklyData;
                        salesChart.data.datasets[0].label = 'Total Penjualan Bulan Ini (Rp)';
                        salesChart.update();
                    });

                    btnMonthly.addEventListener('click', function () {
                        // Toggle button classes
                        btnMonthly.classList.remove('bg-white', 'text-gray-600');
                        btnMonthly.classList.add('bg-black', 'text-white');
                        
                        btnWeekly.classList.remove('bg-black', 'text-white');
                        btnWeekly.classList.add('bg-white', 'text-gray-600');

                        // Update chart
                        salesChart.data.labels = monthlyLabels;
                        salesChart.data.datasets[0].data = monthlyData;
                        salesChart.data.datasets[0].label = 'Total Penjualan (Rp)';
                        salesChart.update();
                    });

                    // PDF Download handler
                    const btnPdf = document.getElementById('downloadPdfBtn');
                    if (btnPdf) {
                        btnPdf.addEventListener('click', function () {
                            const actionButtons = document.querySelectorAll('.pdf-exclude');
                            actionButtons.forEach(btn => btn.style.display = 'none');

                            const element = document.getElementById('dashboard-report-content');
                            
                            const reportHeader = document.createElement('div');
                            reportHeader.className = 'mb-6 text-center border-b-2 border-brand pb-4 temp-pdf-header';
                            reportHeader.innerHTML = `
                                <h1 class="text-2xl font-bold text-gray-900 uppercase">LAPORAN KINERJA TOKO - SETAMAN BOGOR</h1>
                                <p class="text-sm text-gray-600">Tanggal Unduh: ${new Date().toLocaleDateString('id-ID', { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' })}</p>
                            `;
                            element.insertBefore(reportHeader, element.firstChild);

                            const opt = {
                                margin:       [10, 10, 10, 10],
                                filename:     'Laporan-Setaman-Bogor-' + new Date().toISOString().split('T')[0] + '.pdf',
                                image:        { type: 'jpeg', quality: 0.98 },
                                html2canvas:  { scale: 2, useCORS: true, logging: false },
                                jsPDF:        { unit: 'mm', format: 'a4', orientation: 'landscape' },
                                pagebreak:    { mode: ['avoid-all', 'css', 'legacy'] }
                            };

                            html2pdf().set(opt).from(element).save().then(() => {
                                // Restore elements
                                actionButtons.forEach(btn => btn.style.display = '');
                                const tempHeader = element.querySelector('.temp-pdf-header');
                                if (tempHeader) tempHeader.remove();
                            }).catch(err => {
                                console.error('Error generating PDF:', err);
                                actionButtons.forEach(btn => btn.style.display = '');
                                const tempHeader = element.querySelector('.temp-pdf-header');
                                if (tempHeader) tempHeader.remove();
                            });
                        });
                    }
                });
            </script>
@endsection