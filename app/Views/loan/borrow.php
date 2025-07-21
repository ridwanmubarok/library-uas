<?= $this->extend('layout') ?>
<?= $this->section('content') ?>
<div class="max-w-2xl mx-auto p-6">
    <!-- Header -->
    <div class="mb-8">
        <nav class="flex items-center gap-2 text-sm text-gray-500 mb-4">
            <a href="/buku" class="hover:text-blue-600">Daftar Buku</a>
            <span>/</span>
            <a href="/buku/detail/<?= $book['id'] ?>" class="hover:text-blue-600">Detail Buku</a>
            <span>/</span>
            <span class="text-gray-800">Pinjam Buku</span>
        </nav>
        <h1 class="text-3xl font-bold text-gray-800 mb-2">Pinjam Buku</h1>
        <p class="text-gray-600">Konfirmasi peminjaman buku</p>
    </div>

    <!-- Book Information -->
    <div class="bg-white rounded-lg shadow-md border border-gray-200 p-6 mb-6">
        <h2 class="text-xl font-bold text-gray-800 mb-4">Detail Buku</h2>
        
        <div class="md:flex gap-6">
            <!-- Book Cover -->
            <div class="md:w-1/3 mb-4 md:mb-0">
                <?php if ($book['cover']): ?>
                    <img src="/writable/uploads/<?= esc($book['cover']) ?>" alt="cover" 
                         class="w-full h-48 object-cover rounded-lg shadow-md">
                <?php else: ?>
                    <div class="w-full h-48 bg-gray-100 rounded-lg flex items-center justify-center">
                        <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Book Details -->
            <div class="md:w-2/3">
                <h3 class="text-2xl font-bold text-gray-800 mb-3"><?= esc($book['title']) ?></h3>
                
                <div class="space-y-2 mb-4">
                    <div class="flex items-center gap-2">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        <span class="text-gray-600">Penulis:</span>
                        <span class="font-semibold text-gray-800"><?= esc($book['author']) ?></span>
                    </div>
                    
                    <div class="flex items-center gap-2">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        <span class="text-gray-600">Tahun:</span>
                        <span class="bg-blue-100 text-blue-700 px-2 py-1 rounded-full text-sm font-medium"><?= esc($book['year']) ?></span>
                    </div>
                </div>

                <?php if ($book['description']): ?>
                    <div class="mb-4">
                        <h4 class="font-semibold text-gray-800 mb-2">Deskripsi</h4>
                        <p class="text-gray-600 text-sm leading-relaxed"><?= nl2br(esc($book['description'])) ?></p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Borrowing Rules -->
    <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-6 mb-6">
        <h3 class="text-lg font-semibold text-yellow-800 mb-3">Ketentuan Peminjaman</h3>
        <ul class="space-y-2 text-sm text-yellow-700">
            <li class="flex items-start gap-2">
                <svg class="w-4 h-4 mt-0.5 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                Maksimal peminjaman 3 buku per user
            </li>
            <li class="flex items-start gap-2">
                <svg class="w-4 h-4 mt-0.5 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                Masa peminjaman 14 hari
            </li>
            <li class="flex items-start gap-2">
                <svg class="w-4 h-4 mt-0.5 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                Harap kembalikan buku tepat waktu
            </li>
            <li class="flex items-start gap-2">
                <svg class="w-4 h-4 mt-0.5 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                Jaga buku dengan baik
            </li>
        </ul>
    </div>

    <!-- Confirmation Form -->
    <div class="bg-white rounded-lg shadow-md border border-gray-200 p-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Konfirmasi Peminjaman</h3>
        
        <form action="/loan/store" method="post">
            <input type="hidden" name="book_id" value="<?= $book['id'] ?>">
            
            <?php if (isset($validation) && $validation->hasErrors()): ?>
                <div class="bg-red-50 border border-red-200 rounded-lg p-4 mb-6">
                    <h4 class="text-red-800 font-semibold mb-2">Terjadi kesalahan:</h4>
                    <ul class="text-red-700 text-sm space-y-1">
                        <?php foreach ($validation->getErrors() as $error): ?>
                            <li>• <?= esc($error) ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>
            
            <div class="bg-gray-50 rounded-lg p-4 mb-6">
                <p class="text-sm text-gray-600 mb-2">Dengan meminjam buku ini, saya menyetujui:</p>
                <div class="flex items-center gap-2">
                    <input type="checkbox" id="agree" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500" required>
                    <label for="agree" class="text-sm text-gray-700">
                        Saya telah membaca dan menyetujui ketentuan peminjaman
                    </label>
                </div>
            </div>

            <div class="flex gap-4">
                <button type="submit" 
                        class="flex-1 bg-blue-600 text-white py-3 px-6 rounded-lg font-medium hover:bg-blue-700 transition-colors flex items-center justify-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    Pinjam Buku
                </button>
                <a href="/buku/detail/<?= $book['id'] ?>" 
                   class="flex-1 bg-gray-500 text-white py-3 px-6 rounded-lg font-medium hover:bg-gray-600 transition-colors text-center">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
<script>
    <?php if (session('toast')): ?>
        Toastify({
            text: "<?= esc(session('toast')) ?>",
            duration: 3000,
            gravity: "top",
            position: "right",
            backgroundColor: "#ef4444",
        }).showToast();
    <?php endif; ?>
</script>
<?= $this->endSection() ?>