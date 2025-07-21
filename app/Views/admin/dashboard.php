<?= $this->extend('layout') ?>
<?= $this->section('content') ?>
<div class="max-w-7xl mx-auto p-6">
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-2">Dashboard Admin</h1>
        <p class="text-gray-600">Selamat datang di panel administrasi KreasiBuku</p>
    </div>

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-lg shadow-md p-6 border border-gray-200">
            <div class="flex items-center justify-between">
                <div>
                    <div class="text-3xl font-bold text-blue-600 mb-1"><?= $totalBook ?></div>
                    <div class="text-gray-600 font-medium">Total Buku</div>
                </div>
                <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-md p-6 border border-gray-200">
            <div class="flex items-center justify-between">
                <div>
                    <div class="text-3xl font-bold text-green-600 mb-1"><?= $totalUser ?></div>
                    <div class="text-gray-600 font-medium">Total User</div>
                </div>
                <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-md p-6 border border-gray-200">
            <div class="flex items-center justify-between">
                <div>
                    <div class="text-3xl font-bold text-purple-600 mb-1"><?= $totalBorrowed ?></div>
                    <div class="text-gray-600 font-medium">Buku Dipinjam</div>
                </div>
                <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-md p-6 border border-gray-200">
            <div class="flex items-center justify-between">
                <div>
                    <div class="text-3xl font-bold text-orange-600 mb-1"><?= $todayLoans ?></div>
                    <div class="text-gray-600 font-medium">Peminjaman Hari Ini</div>
                </div>
                <div class="w-12 h-12 bg-orange-100 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Pending Returns Alert (if any) -->
    <?php if ($pendingReturns > 0): ?>
        <div class="mb-8 bg-yellow-50 border border-yellow-200 rounded-lg p-4">
            <div class="flex items-center">
                <div class="w-8 h-8 bg-yellow-100 rounded-full flex items-center justify-center mr-3">
                    <svg class="w-5 h-5 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                    </svg>
                </div>
                <div class="flex-1">
                    <h3 class="text-sm font-medium text-yellow-800">
                        Ada <?= $pendingReturns ?> permintaan pengembalian buku yang menunggu konfirmasi
                    </h3>
                    <p class="text-sm text-yellow-700 mt-1">
                        Silakan periksa dan konfirmasi pengembalian buku tersebut.
                    </p>
                </div>
                <div class="ml-4">
                    <a href="/loan/pending-returns" class="bg-yellow-600 text-white px-4 py-2 rounded-md text-sm font-medium hover:bg-yellow-700 transition-colors">
                        Lihat Permintaan
                    </a>
                </div>
            </div>
        </div>
    <?php endif; ?>
    </div>

    <!-- Quick Actions -->
    <div class="bg-white rounded-lg shadow-md p-6 border border-gray-200 mb-8">
        <h2 class="text-xl font-bold text-gray-800 mb-4">Aksi Cepat</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <a href="/buku/create" class="bg-blue-600 text-white p-4 rounded-lg hover:bg-blue-700 transition-colors flex items-center gap-3">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
                <span class="font-medium">Tambah Buku Baru</span>
            </a>
            
            <a href="/buku" class="bg-green-600 text-white p-4 rounded-lg hover:bg-green-700 transition-colors flex items-center gap-3">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                </svg>
                <span class="font-medium">Kelola Buku</span>
            </a>
            
            <a href="/loan" class="bg-purple-600 text-white p-4 rounded-lg hover:bg-purple-700 transition-colors flex items-center gap-3">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
                <span class="font-medium">Kelola Peminjaman</span>
            </a>
        </div>
    </div>

    <!-- Recent Activity -->
    <div class="bg-white rounded-lg shadow-md p-6 border border-gray-200">
        <h2 class="text-xl font-bold text-gray-800 mb-4">Aktivitas Terbaru</h2>
        <div class="space-y-4">
            <div class="flex items-center gap-3 p-3 bg-gray-50 rounded-lg">
                <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                    <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Sistem baru KreasiBuku telah diaktifkan</p>
                    <p class="text-xs text-gray-500">Hari ini</p>
                </div>
            </div>
            
            <div class="flex items-center gap-3 p-3 bg-gray-50 rounded-lg">
                <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center">
                    <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Database berhasil diinisialisasi</p>
                    <p class="text-xs text-gray-500">Hari ini</p>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>