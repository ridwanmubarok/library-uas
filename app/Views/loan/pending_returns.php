<?= $this->extend('layout') ?>
<?= $this->section('content') ?>
<div class="max-w-7xl mx-auto p-6">
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-2">Konfirmasi Pengembalian</h1>
        <p class="text-gray-600">Daftar permintaan pengembalian buku yang menunggu konfirmasi</p>
    </div>

    <!-- Pending Returns Table -->
    <div class="bg-white rounded-lg shadow-md border border-gray-200 overflow-hidden">
        <?php if (empty($loans)): ?>
            <div class="text-center py-16">
                <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-600 mb-2">Tidak Ada Permintaan Pengembalian</h3>
                <p class="text-gray-500">Semua buku yang dipinjam belum ada yang mengajukan pengembalian</p>
            </div>
        <?php else: ?>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Buku</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Peminjam</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Pinjam</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Request</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <?php foreach ($loans as $loan): ?>
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div>
                                        <div class="text-sm font-medium text-gray-900"><?= esc($loan['book_title']) ?></div>
                                        <div class="text-sm text-gray-500">oleh <?= esc($loan['book_author']) ?></div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center mr-3">
                                            <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                            </svg>
                                        </div>
                                        <div class="text-sm font-medium text-gray-900"><?= esc($loan['username']) ?></div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    <?= date('d/m/Y', strtotime($loan['loan_date'])) ?>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    <?= date('d/m/Y H:i', strtotime($loan['return_requested_at'])) ?>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                        Menunggu Konfirmasi
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <div class="flex gap-2">
                                        <button onclick="openConfirmReturnModal(<?= $loan['id'] ?>, '<?= esc($loan['book_title']) ?>', '<?= esc($loan['username']) ?>')"
                                                class="bg-green-600 text-white px-3 py-1 rounded text-xs hover:bg-green-700 transition-colors">
                                            Konfirmasi
                                        </button>
                                        <button onclick="openRejectModal(<?= $loan['id'] ?>, '<?= esc($loan['book_title']) ?>')"
                                                class="bg-red-500 text-white px-3 py-1 rounded text-xs hover:bg-red-600 transition-colors">
                                            Tolak
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>

    <!-- Back Button -->
    <div class="mt-8">
        <a href="/loan" class="bg-gray-500 text-white px-6 py-2 rounded-lg hover:bg-gray-600 transition-colors font-medium">
            Kembali ke Kelola Peminjaman
        </a>
    </div>
</div>

<!-- Modal untuk Konfirmasi Pengembalian -->
<div id="confirmReturnModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-75" onclick="closeModal('confirmReturnModal')"></div>
        
        <div class="inline-block overflow-hidden text-left align-bottom transition-all transform bg-white rounded-lg shadow-xl sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="sm:flex sm:items-start">
                    <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-green-100 sm:mx-0 sm:h-10 sm:w-10">
                        <svg class="h-6 w-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                        <h3 class="text-lg leading-6 font-medium text-gray-900">Konfirmasi Pengembalian</h3>
                        <div class="mt-2">
                            <p class="text-sm text-gray-500">
                                Konfirmasi bahwa buku <strong id="confirmBookTitle"></strong> telah dikembalikan oleh <strong id="confirmUsername"></strong>?
                            </p>
                            <div class="mt-4 bg-green-50 border border-green-200 rounded-md p-3">
                                <p class="text-sm text-green-800">
                                    <strong>Konfirmasi:</strong> Pastikan buku sudah diterima dalam kondisi baik sebelum mengonfirmasi pengembalian.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                <button type="button" id="confirmReturnBtn" 
                        class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-green-600 text-base font-medium text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 sm:ml-3 sm:w-auto sm:text-sm">
                    Konfirmasi Pengembalian
                </button>
                <button type="button" onclick="closeModal('confirmReturnModal')"
                        class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                    Batal
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal untuk Tolak Pengembalian -->
<div id="rejectModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-75" onclick="closeModal('rejectModal')"></div>
        
        <div class="inline-block overflow-hidden text-left align-bottom transition-all transform bg-white rounded-lg shadow-xl sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="sm:flex sm:items-start">
                    <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                        <svg class="h-6 w-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </div>
                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                        <h3 class="text-lg leading-6 font-medium text-gray-900">Tolak Pengembalian</h3>
                        <div class="mt-2">
                            <p class="text-sm text-gray-500">
                                Tolak permintaan pengembalian buku <strong id="rejectBookTitle"></strong>?
                            </p>
                            <div class="mt-4 bg-red-50 border border-red-200 rounded-md p-3">
                                <p class="text-sm text-red-800">
                                    <strong>Catatan:</strong> Permintaan pengembalian akan dibatalkan dan status kembali ke "Dipinjam".
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                <button type="button" id="rejectBtn" 
                        class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">
                    Tolak Pengembalian
                </button>
                <button type="button" onclick="closeModal('rejectModal')"
                        class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                    Batal
                </button>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
<script>
    let currentLoanId = null;
    
    // Open confirm return modal
    function openConfirmReturnModal(loanId, bookTitle, username) {
        currentLoanId = loanId;
        document.getElementById('confirmBookTitle').textContent = bookTitle;
        document.getElementById('confirmUsername').textContent = username;
        document.getElementById('confirmReturnModal').classList.remove('hidden');
        document.body.classList.add('overflow-hidden');
    }
    
    // Open reject modal
    function openRejectModal(loanId, bookTitle) {
        currentLoanId = loanId;
        document.getElementById('rejectBookTitle').textContent = bookTitle;
        document.getElementById('rejectModal').classList.remove('hidden');
        document.body.classList.add('overflow-hidden');
    }
    
    // Close modal
    function closeModal(modalId) {
        document.getElementById(modalId).classList.add('hidden');
        document.body.classList.remove('overflow-hidden');
        currentLoanId = null;
    }
    
    // Confirm return
    document.getElementById('confirmReturnBtn').addEventListener('click', function() {
        if (currentLoanId) {
            window.location.href = `/loan/confirm-return/${currentLoanId}`;
        }
    });
    
    // Reject return (reset return_requested flag)
    document.getElementById('rejectBtn').addEventListener('click', function() {
        if (currentLoanId) {
            // You can create a reject endpoint or handle it differently
            window.location.href = `/loan/reject-return/${currentLoanId}`;
        }
    });
    
    // Close modal with Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeModal('confirmReturnModal');
            closeModal('rejectModal');
        }
    });
    
    <?php if (session('toast')): ?>
        Toastify({
            text: "<?= esc(session('toast')) ?>",
            duration: 3000,
            gravity: "top",
            position: "right",
            backgroundColor: "#22c55e",
        }).showToast();
    <?php endif; ?>
</script>
<?= $this->endSection() ?>