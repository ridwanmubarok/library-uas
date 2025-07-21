<?= $this->extend('layout') ?>
<?= $this->section('content') ?>
<div class="max-w-7xl mx-auto p-6">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-2">Daftar Buku</h1>
        <p class="text-gray-600">Koleksi buku yang tersedia di perpustakaan</p>
    </div>

    <div class="bg-white rounded-lg shadow-md p-6 mb-8">
        <div class="flex flex-col sm:flex-row justify-between items-center gap-4">
            <form method="get" class="flex gap-3 w-full sm:w-auto">
                <div class="relative flex-1 sm:w-80">
                    <div class="absolute left-3 top-1/2 transform -translate-y-1/2">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                    <input type="text" name="keyword" value="<?= esc($keyword) ?>" 
                           class="w-full border border-gray-300 rounded-lg pl-10 pr-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                           placeholder="Cari buku, penulis, atau ISBN...">
                </div>
                <button class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition-colors font-medium">
                    Cari
                </button>
            </form>
            <?php if (session('role') === 'admin'): ?>
                <a href="/buku/create"
                    class="bg-green-600 text-white px-6 py-2 rounded-lg hover:bg-green-700 transition-colors font-medium flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    Tambah Buku
                </a>
            <?php endif; ?>
        </div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        <?php if (empty($buku)): ?>
            <div class="col-span-full text-center py-16">
                <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-600 mb-2">Buku Tidak Ditemukan</h3>
                <p class="text-gray-500">Coba ubah kata kunci pencarian Anda</p>
            </div>
        <?php else: ?>
            <?php foreach ($buku as $b): ?>
                <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow border border-gray-200 overflow-hidden">
                    <?php if ($b['cover']): ?>
                        <div class="relative">
                            <img src="/writable/uploads/<?= esc($b['cover']) ?>" alt="cover"
                                class="aspect-[3/4] w-full object-cover">
                            <?php if ($b['year'] == date('Y')): ?>
                                <span class="absolute top-2 right-2 bg-green-500 text-white text-xs px-2 py-1 rounded-full">Baru</span>
                            <?php endif; ?>
                        </div>
                    <?php else: ?>
                        <div class="h-48 w-full flex items-center justify-center bg-gray-100 text-gray-400">
                            <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                            </svg>
                        </div>
                    <?php endif; ?>
                    <div class="p-4">
                        <h3 class="font-semibold text-lg mb-2 truncate" title="<?= esc($b['title']) ?>"><?= esc($b['title']) ?></h3>
                        <div class="flex items-center gap-2 mb-2">
                            <span class="bg-blue-100 text-blue-700 text-xs px-2 py-1 rounded-full font-medium"><?= esc($b['year']) ?></span>
                            <span class="text-gray-600 text-sm">Oleh <?= esc($b['author']) ?></span>
                        </div>
                        <div class="w-full h-full">
                            <p class="text-gray-700 text-sm line-clamp-3"><?= esc($b['description']) ?></p>
                        </div>
                        <div class="flex gap-2 mt-5">
                            <a href="/buku/detail/<?= $b['id'] ?>"
                                class="flex-1 bg-blue-600 text-white px-3 py-2 rounded-lg text-sm font-medium hover:bg-blue-700 transition-colors text-center">
                                Detail
                            </a>
                            <?php if (session('role') === 'user'): ?>
                                <a href="/loan/borrow/<?= $b['id'] ?>"
                                    class="flex-1 bg-green-600 text-white px-3 py-2 rounded-lg text-sm font-medium hover:bg-green-700 transition-colors text-center">
                                    Pinjam
                                </a>
                            <?php endif; ?>
                            <?php if (session('role') === 'admin'): ?>
                                <a href="/buku/edit/<?= $b['id'] ?>"
                                    class="bg-yellow-500 text-white px-3 py-2 rounded-lg text-sm font-medium hover:bg-yellow-600 transition-colors">
                                    Edit
                                </a>
                                <button onclick="openDeleteModal(<?= $b['id'] ?>, '<?= esc($b['title']) ?>')"
                                    class="bg-red-500 text-white px-3 py-2 rounded-lg text-sm font-medium hover:bg-red-600 transition-colors">
                                    Hapus
                                </button>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach ?>
        <?php endif; ?>
    </div>

    <?php if (!empty($buku)): ?>
        <div class="mt-8 flex justify-center">
            <?= $pager->links('buku', 'tailwind_pagination') ?>
        </div>
    <?php endif; ?>
</div>

<!-- Modal untuk Delete Buku -->
<div id="deleteModal" style="display: none; z-index: 9999;" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-lg shadow-xl max-w-md w-full mx-4">
        <div class="p-6">
            <div class="flex items-center mb-4">
                <div class="flex-shrink-0 w-10 h-10 bg-red-100 rounded-full flex items-center justify-center">
                    <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                    </svg>
                </div>
                <h3 class="ml-4 text-lg font-medium text-gray-900">Hapus Buku</h3>
            </div>
            <div class="mb-4">
                <p class="text-sm text-gray-500 mb-4">
                    Anda yakin ingin menghapus buku <strong id="deleteBookTitle"></strong>?
                </p>
                <div class="bg-red-50 border border-red-200 rounded-md p-3">
                    <p class="text-sm text-red-800">
                        <strong>Peringatan:</strong> Tindakan ini tidak dapat dibatalkan. Buku akan dihapus secara permanen dari sistem.
                    </p>
                </div>
            </div>
            <div class="flex justify-end space-x-3">
                <button type="button" onclick="closeDeleteModal()" class="px-4 py-2 text-gray-700 bg-gray-200 rounded-md hover:bg-gray-300 transition-colors">
                    Batal
                </button>
                <button type="button" id="confirmDeleteBtn" class="px-4 py-2 text-white bg-red-600 rounded-md hover:bg-red-700 transition-colors">
                    Hapus Buku
                </button>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
<script>
    let currentBookId = null;
    
    // Open delete modal
    function openDeleteModal(bookId, bookTitle) {
        currentBookId = bookId;
        document.getElementById('deleteBookTitle').textContent = bookTitle;
        document.getElementById('deleteModal').style.display = 'flex';
        document.body.style.overflow = 'hidden';
    }
    
    // Close delete modal
    function closeDeleteModal() {
        document.getElementById('deleteModal').style.display = 'none';
        document.body.style.overflow = 'auto';
        currentBookId = null;
    }
    
    // Confirm delete
    document.getElementById('confirmDeleteBtn').addEventListener('click', function() {
        if (currentBookId) {
            window.location.href = `/buku/delete/${currentBookId}`;
        }
    });
    
    // Close modal with Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeDeleteModal();
        }
    });
    
    // Close modal when clicking outside
    document.getElementById('deleteModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeDeleteModal();
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