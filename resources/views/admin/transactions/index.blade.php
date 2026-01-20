<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Manajemen Transaksi - Admin</title>
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .transaction-card {
            background: white;
            border-radius: 16px;
            border: 1px solid #e5e7eb;
            transition: all 0.3s ease;
        }
        
        .transaction-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.08);
        }
        
        .status-badge {
            padding: 0.375rem 1rem;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 0.375rem;
        }
        
        .status-pending { background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%); color: #92400e; }
        .status-paid { background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%); color: #065f46; }
        .status-cancelled { background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%); color: #991b1b; }
        
        .item-row {
            border-bottom: 1px solid #f3f4f6;
            transition: background 0.2s ease;
        }
        
        .item-row:hover {
            background: #f9fafb;
        }
        
        .action-btn {
            padding: 0.625rem 1.25rem;
            border-radius: 12px;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        
        .action-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.12);
        }
        
        .stat-card {
            background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
            border-radius: 16px;
            padding: 1.5rem;
            border: 1px solid #e5e7eb;
        }
        
        .fade-in {
            animation: fadeIn 0.5s ease-in;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .total-amount {
            background: linear-gradient(135deg, #1e40af 0%, #1d4ed8 100%);
            color: white;
            padding: 0.75rem 1.5rem;
            border-radius: 12px;
        }
        
        @media (max-width: 768px) {
            .transaction-header {
                flex-direction: column;
                gap: 1rem;
                text-align: center;
            }
        }
    </style>
</head>

<body class="bg-gradient-to-br from-gray-50 to-blue-50 min-h-screen">
    <!-- Header -->
    <div class="bg-gradient-to-r from-blue-600 to-blue-700 py-5 shadow-lg">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <a href="{{ route('adminDashboard') }}" 
                       class="text-white hover:text-blue-100 transition-colors">
                        <i class="fas fa-arrow-left text-lg"></i>
                    </a>
                    <div>
                        <h1 class="text-2xl font-bold text-white">Manajemen Transaksi</h1>
                        <p class="text-blue-100 text-sm mt-1">Kelola semua transaksi pelanggan</p>
                    </div>
                </div>
                <div class="text-white text-sm bg-blue-800/30 px-4 py-2 rounded-xl">
                    <i class="fas fa-receipt mr-2"></i>
                    <span>{{ $transactions->count() }} Transaksi</span>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 py-6 space-y-6">
        <!-- Stats Overview -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 fade-in">
            <div class="stat-card">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600">Menunggu Konfirmasi</p>
                        <p class="text-2xl font-bold text-gray-900">
                            {{ $transactions->where('status', 'pending')->count() }}
                        </p>
                    </div>
                    <div class="bg-yellow-100 p-3 rounded-full">
                        <i class="fas fa-clock text-yellow-600"></i>
                    </div>
                </div>
            </div>
            
            <div class="stat-card">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600">Terkonfirmasi</p>
                        <p class="text-2xl font-bold text-gray-900">
                            {{ $transactions->where('status', 'paid')->count() }}
                        </p>
                    </div>
                    <div class="bg-green-100 p-3 rounded-full">
                        <i class="fas fa-check-circle text-green-600"></i>
                    </div>
                </div>
            </div>

            <div class="stat-card">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600">Dibatalkan</p>
                        <p class="text-2xl font-bold text-gray-900">
                            {{ $transactions->where('status', 'cancelled')->count() }}
                        </p>
                    </div>
                    <div class="bg-red-100 p-3 rounded-full">
                        <i class="fas fa-check-circle text-red-600"></i>
                    </div>
                </div>
            </div>
            
            {{-- <div class="stat-card">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600">Total Pendapatan</p>
                        <p class="text-2xl font-bold text-gray-900">
                            Rp{{ number_format($transactions->where('status', 'paid')->sum('total_harga'), 0, ',', '.') }}
                        </p>
                    </div>
                    <div class="bg-blue-100 p-3 rounded-full">
                        <i class="fas fa-coins text-blue-600"></i>
                    </div>
                </div>
            </div> --}}
        </div>
        
        <!-- Total Pendapatan -->
        <div class="fade-in">
            <div class="stat-card">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600">Total Pendapatan</p>
                        <p class="text-2xl font-bold text-gray-900">
                            Rp{{ number_format($transactions->where('status', 'paid')->sum('total_harga'), 0, ',', '.') }}
                        </p>
                    </div>
                    <div class="bg-blue-100 p-3 rounded-full">
                        <i class="fas fa-coins text-blue-600"></i>
                    </div>
                </div>
                <div class="mt-2">
                    <p class="text-sm text-gray-600">Total transaksi yang telah dibayar.</p>
                </div>
            </div>
        </div>

        <!-- Success Message -->
        @if (session('success'))
        <div class="fade-in">
            <div class="bg-gradient-to-r from-green-50 to-emerald-50 border border-green-200 rounded-xl p-4 
                       flex items-center gap-3 shadow-sm">
                <div class="bg-green-100 p-2.5 rounded-lg">
                    <i class="fas fa-check-circle text-green-600"></i>
                </div>
                <div class="flex-1">
                    <p class="text-green-800 font-medium">{{ session('success') }}</p>
                </div>
                <button onclick="this.parentElement.remove()" class="text-green-600 hover:text-green-800">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
        @endif

        <!-- Transactions List -->
        <div class="space-y-4">
            @forelse($transactions as $index => $trx)
            <div class="transaction-card fade-in" style="animation-delay: {{ $index * 0.1 }}s">
                <!-- Transaction Header -->
                <div class="p-6 border-b border-gray-100">
                    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 transaction-header">
                        <div class="space-y-2">
                            <div class="flex items-center gap-3">
                                <span class="font-bold text-blue-700">#{{ $trx->id }}</span>
                                <span class="status-badge @if($trx->status === 'pending') status-pending @elseif($trx->status === 'paid') status-paid @else status-cancelled @endif">
                                    <i class="fas @if($trx->status === 'pending') fa-clock @elseif($trx->status === 'paid') fa-check-circle @else fa-times-circle @endif"></i>
                                    {{ $trx->status === 'pending' ? 'MENUNGGU' : ($trx->status === 'paid' ? 'DIKONFIRMASI' : 'DIBATALKAN') }}
                                </span>
                            </div>
                            <p class="text-sm text-gray-600 flex items-center gap-2">
                                <i class="fas fa-user text-gray-400"></i>
                                {{ $trx->user->name ?? '-' }}
                            </p>
                        </div>
                        
                        <div class="flex flex-col items-end gap-2">
                            <div class="total-amount font-bold text-lg">
                                Rp{{ number_format($trx->total_harga, 0, ',', '.') }}
                            </div>
                            <p class="text-sm text-gray-500">
                                <i class="fas fa-calendar mr-1"></i>
                                {{ $trx->created_at->format('d M Y, H:i') }}
                            </p>

                            <!-- Waktu update status -->
                            @if($trx->updated_at && $trx->updated_at->ne($trx->created_at))
                                <p class="text-xs text-blue-600 flex items-center gap-1">
                                    <i class="fas fa-sync-alt"></i>
                                    Status diperbarui: {{ $trx->updated_at->format('d M Y, H:i') }}
                                </p>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Items List -->
                <div class="p-6">
                    <h4 class="font-semibold text-gray-800 mb-4 flex items-center gap-2">
                        <i class="fas fa-boxes text-blue-600"></i>
                        Detail Pesanan
                    </h4>
                    
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm">
                            <thead>
                                <tr class="bg-gray-50">
                                    <th class="px-4 py-3 text-left font-medium text-gray-700 rounded-l-lg">Produk</th>
                                    <th class="px-4 py-3 text-left font-medium text-gray-700">Varian</th>
                                    <th class="px-4 py-3 text-center font-medium text-gray-700">Qty</th>
                                    <th class="px-4 py-3 text-right font-medium text-gray-700">Harga</th>
                                    <th class="px-4 py-3 text-right font-medium text-gray-700 rounded-r-lg">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($trx->items as $item)
                                <tr class="item-row">
                                    <td class="px-4 py-3 text-gray-900 font-medium">{{ $item->product->nama ?? '-' }}</td>
                                    <td class="px-4 py-3 text-gray-600">
                                        {{ $item->variant->warna ?? '-' }} / {{ $item->variant->ukuran ?? '-' }}
                                    </td>
                                    <td class="px-4 py-3 text-center text-gray-700 font-semibold">{{ $item->qty }}</td>
                                    <td class="px-4 py-3 text-right text-gray-700">
                                        Rp{{ number_format($item->harga, 0, ',', '.') }}
                                    </td>
                                    <td class="px-4 py-3 text-right text-gray-900 font-bold">
                                        Rp{{ number_format($item->subtotal, 0, ',', '.') }}
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Actions -->
                <div class="px-6 py-4 border-t border-gray-100 bg-gray-50 rounded-b-2xl">
                    @if ($trx->status === 'pending')
                    <div class="flex gap-3 justify-end">
                        <form method="POST" action="{{ route('admin.transactions.confirm', $trx->id) }}" class="inline">
                            @csrf @method('PUT')
                            <button type="submit" 
                                    class="action-btn bg-gradient-to-r from-green-500 to-emerald-600 text-white 
                                           hover:from-green-600 hover:to-emerald-700 flex items-center gap-2">
                                <i class="fas fa-check-circle"></i>
                                Konfirmasi Pembayaran
                            </button>
                        </form>
                        
                        <form method="POST" action="{{ route('admin.transactions.cancel', $trx->id) }}" class="inline">
                            @csrf @method('PUT')
                            <button type="submit" 
                                    class="action-btn bg-gradient-to-r from-red-500 to-red-600 text-white 
                                           hover:from-red-600 hover:to-red-700 flex items-center gap-2">
                                <i class="fas fa-ban"></i>
                                Batalkan Transaksi
                            </button>
                        </form>
                    </div>
                    @else
                    <div class="text-center py-2">
                        <span class="text-gray-400 text-sm flex items-center justify-center gap-2">
                            <i class="fas fa-info-circle"></i>
                            Transaksi ini telah {{ $trx->status === 'paid' ? 'dikonfirmasi' : 'dibatalkan' }}
                        </span>
                    </div>
                    @endif
                </div>
            </div>
            @empty
            <div class="text-center py-12 fade-in">
                <div class="mx-auto w-24 h-24 bg-gradient-to-br from-gray-100 to-gray-200 rounded-full 
                            flex items-center justify-center mb-4">
                    <i class="fas fa-receipt text-gray-400 text-3xl"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Belum ada transaksi</h3>
                <p class="text-gray-600">Belum terdapat data transaksi pelanggan.</p>
            </div>
            @endforelse
        </div>
    </div>

    <script>
        // Add fade-in animation to transaction cards
        document.addEventListener('DOMContentLoaded', function() {
            const cards = document.querySelectorAll('.transaction-card');
            cards.forEach((card, index) => {
                card.style.animationDelay = `${index * 0.1}s`;
            });
        });
        
        // Add hover effect to action buttons
        const actionButtons = document.querySelectorAll('.action-btn');
        actionButtons.forEach(btn => {
            btn.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-2px)';
            });
            
            btn.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0)';
            });
        });
    </script>
</body>
</html>