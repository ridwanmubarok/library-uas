<?= $this->extend('layout') ?>
<?= $this->section('content') ?>
<div class="max-w-7xl mx-auto p-6">
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-2"><?= $title ?></h1>
        <p class="text-gray-600">
            <?= session('role') === 'admin' ? 'Kelola semua peminjaman buku' : 'Riwayat peminjaman buku Anda' ?>
        </p>
    </div>

    <!-- Loans Table -->
    <div class="bg-white rounded-lg shadow-md border border-gray-200 overflow-hidden">
        <?php if (empty($loans)): ?>
            <div class="text-center py-16">
                <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-600 mb-2">Belum Ada Peminjaman</h3>
                <p class="text-gray-500 mb-4">
                    <?= session('role') === 'admin' ? 'Belum ada peminjaman buku yang tercatat' : 'Anda belum meminjam buku apapun' ?>
                </p>
                <?php if (session('role') === 'user'): ?>
                    <a href="/buku" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition-colors font-medium">
                        Jelajahi Buku
                    </a>
                <?php endif; ?>
            </div>
        <?php else: ?>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Buku</th>
                            <?php if (session('role') === 'admin'): ?>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Peminjam</th>
                            <?php endif; ?>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Pinjam</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Kembali</th>
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
                                <?php if (session('role') === 'admin'): ?>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        <?= esc($loan['username']) ?>
                                    </td>
                                <?php endif; ?>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    <?= date('d/m/Y', strtotime($loan['loan_date'])) ?>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    <?= $loan['return_date'] ? date('d/m/Y', strtotime($loan['return_date'])) : '-' ?>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <?php if ($loan['status'] === 'borrowed'): ?>
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                            Dipinjam
                                        </span>
                                    <?php else: ?>
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            Dikembalikan
                                        </span>
                                    <?php endif; ?>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <div class="flex gap-2">
                                        <?php if ($loan['status'] === 'borrowed'): ?>
                                            <?php if (session('role') === 'user'): ?>
                                                <?php if ($loan['return_requested']): ?>
                                                    <span class="bg-yellow-100 text-yellow-800 px-3 py-1 rounded text-xs font-medium">
                                                        Menunggu Konfirmasi
                                                    </span>
                                                <?php else: ?>
                                                    <button onclick="openReturnModal(<?= $loan['id'] ?>, '<?= esc($loan['book_title']) ?>')"
                                                            class="bg-green-600 text-white px-3 py-1 rounded text-xs hover:bg-green-700 transition-colors">
                                                        Ajukan Pengembalian
                                                    </button>
                                                <?php endif; ?>
                                            <?php else: ?>
                                                <?php if ($loan['return_requested']): ?>
                                                    <button onclick="openConfirmReturnModal(<?= $loan['id'] ?>, '<?= esc($loan['book_title']) ?>', '<?= esc($loan['username']) ?>')"
                                                            class="bg-blue-600 text-white px-3 py-1 rounded text-xs hover:bg-blue-700 transition-colors">
                                                        Konfirmasi Kembali
                                                    </button>
                                                <?php else: ?>
                                                    <button onclick="openConfirmReturnModal(<?= $loan['id'] ?>, '<?= esc($loan['book_title']) ?>', '<?= esc($loan['username']) ?>')"
                                                            class="bg-green-600 text-white px-3 py-1 rounded text-xs hover:bg-green-700 transition-colors">
                                                        Kembalikan
                                                    </button>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                        <?php if (session('role') === 'admin'): ?>
                                            <button onclick="openDeleteModal(<?= $loan['id'] ?>, '<?= esc($loan['book_title']) ?>')"
                                                    class="bg-red-500 text-white px-3 py-1 rounded text-xs hover:bg-red-600 transition-colors">
                                                Hapus
                                            </button>
                                        <?php endif; ?>
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
        <a href="/buku" class="bg-gray-500 text-white px-6 py-2 rounded-lg hover:bg-gray-600 transition-colors font-medium">
            Kembali ke Daftar Buku
        </a>
    </div>
</div>

<!-- Modal untuk Request Return (User) -->
<div id="returnModal" style="display: none;" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4" style="z-index: 9999;">
    <div class="bg-white rounded-lg shadow-xl max-w-md w-full mx-4">
        
        <div class="inline-block overflow-hidden text-left align-bottom transition-all transform bg-white rounded-lg shadow-xl sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="sm:flex sm:items-start">
                    <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-green-100 sm:mx-0 sm:h-10 sm:w-10">
                        <svg class="h-6 w-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                        <h3 class="text-lg leading-6 font-medium text-gray-900">Ajukan Pengembalian</h3>
                        <div class="mt-2">
                            <p class="text-sm text-gray-500">
                                Anda yakin ingin mengajukan pengembalian buku <strong id="returnBookTitle"></strong>?
                            </p>
                            <div class="mt-4 bg-yellow-50 border border-yellow-200 rounded-md p-3">
                                <p class="text-sm text-yellow-800">
                                    <strong>Catatan:</strong> Setelah mengajukan pengembalian, admin akan mengonfirmasi pengembalian buku Anda.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                <button type="button" id="confirmReturnBtn" 
                        class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-green-600 text-base font-medium text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 sm:ml-3 sm:w-auto sm:text-sm">
                    Ajukan Pengembalian
                </button>
                <button type="button" onclick="closeModal('returnModal')"
                        class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                    Batal
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal untuk Confirm Return (Admin) -->
<div id="confirmReturnModal" style="display: none;" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4" style="z-index: 9999;">
    <div class="bg-white rounded-lg shadow-xl max-w-md w-full mx-4">
        
        <div class="inline-block overflow-hidden text-left align-bottom transition-all transform bg-white rounded-lg shadow-xl sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="sm:flex sm:items-start">
                    <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-blue-100 sm:mx-0 sm:h-10 sm:w-10">
                        <svg class="h-6 w-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                        <h3 class="text-lg leading-6 font-medium text-gray-900">Konfirmasi Pengembalian</h3>
                        <div class="mt-2">
                            <p class="text-sm text-gray-500">
                                Konfirmasi pengembalian buku <strong id="confirmBookTitle"></strong> oleh <strong id="confirmUsername"></strong>?
                            </p>
                            <div class="mt-4 bg-blue-50 border border-blue-200 rounded-md p-3">
                                <p class="text-sm text-blue-800">
                                    <strong>Catatan:</strong> Setelah dikonfirmasi, status buku akan berubah menjadi "Dikembalikan".
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                <button type="button" id="confirmReturnAdminBtn" 
                        class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm">
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

<!-- Modal untuk Delete (Admin) -->
<div id="deleteModal" style="display: none;" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4" style="z-index: 9999;">
    <div class="bg-white rounded-lg shadow-xl max-w-md w-full mx-4">
        <div class="p-6">
            <div class="flex items-center mb-4">
                <div class="flex-shrink-0 w-10 h-10 bg-red-100 rounded-full flex items-center justify-center">
                    <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                    </svg>
                </div>
                <h3 class="ml-4 text-lg font-medium text-gray-900">Hapus Data Peminjaman</h3>
            </div>
            <div class="mb-4">
                <p class="text-sm text-gray-500 mb-4">
                    Anda yakin ingin menghapus data peminjaman buku <strong id="deleteBookTitle"></strong>?
                </p>
                <div class="bg-red-50 border border-red-200 rounded-md p-3">
                    <p class="text-sm text-red-800">
                        <strong>Peringatan:</strong> Tindakan ini tidak dapat dibatalkan. Data peminjaman akan dihapus secara permanen.
                    </p>
                </div>
            </div>
            <div class="flex justify-end space-x-3">
                <button type="button" onclick="closeModal('deleteModal')" class="px-4 py-2 text-gray-700 bg-gray-200 rounded-md hover:bg-gray-300 transition-colors">
                    Batal
                </button>
                <button type="button" id="confirmDeleteBtn" class="px-4 py-2 text-white bg-red-600 rounded-md hover:bg-red-700 transition-colors">
                    Hapus Data
                </button>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
<script>
    let currentLoanId = null;
    
    // Open return modal (User)
    function openReturnModal(loanId, bookTitle) {
        currentLoanId = loanId;
        document.getElementById('returnBookTitle').textContent = bookTitle;
        document.getElementById('returnModal').style.display = 'flex';
        document.body.style.overflow = 'hidden';
    }
    
    // Open confirm return modal (Admin)
    function openConfirmReturnModal(loanId, bookTitle, username) {
        currentLoanId = loanId;
        document.getElementById('confirmBookTitle').textContent = bookTitle;
        document.getElementById('confirmUsername').textContent = username;
        document.getElementById('confirmReturnModal').style.display = 'flex';
        document.body.style.overflow = 'hidden';
    }
    
    // Open delete modal (Admin)
    function openDeleteModal(loanId, bookTitle) {
        currentLoanId = loanId;
        document.getElementById('deleteBookTitle').textContent = bookTitle;
        document.getElementById('deleteModal').style.display = 'flex';
        document.body.style.overflow = 'hidden';
    }
    
    // Close modal
    function closeModal(modalId) {
        document.getElementById(modalId).style.display = 'none';
        document.body.style.overflow = 'auto';
        currentLoanId = null;
    }
    
    // Confirm actions
    document.getElementById('confirmReturnBtn').addEventListener('click', function() {
        if (currentLoanId) {
            window.location.href = `/loan/request-return/${currentLoanId}`;
        }
    });
    
    document.getElementById('confirmReturnAdminBtn').addEventListener('click', function() {
        if (currentLoanId) {
            window.location.href = `/loan/confirm-return/${currentLoanId}`;
        }
    });
    
    document.getElementById('confirmDeleteBtn').addEventListener('click', function() {
        if (currentLoanId) {
            window.location.href = `/loan/delete/${currentLoanId}`;
        }
    });
    
    // Close modal with Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeModal('returnModal');
            closeModal('confirmReturnModal');
            closeModal('deleteModal');
        }
    });
    
    // Close modal when clicking outside
    document.getElementById('deleteModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeModal('deleteModal');
        }
    });
    
    document.getElementById('returnModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeModal('returnModal');
        }
    });
    
    document.getElementById('confirmReturnModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeModal('confirmReturnModal');
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