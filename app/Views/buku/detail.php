<?= $this->extend('layout') ?>
<?= $this->section('content') ?>
<div class="max-w-4xl mx-auto p-6">
    <!-- Header -->
    <div class="mb-8">
        <nav class="flex items-center gap-2 text-sm text-gray-500 mb-4">
            <a href="/buku" class="hover:text-blue-600">Daftar Buku</a>
            <span>/</span>
            <span class="text-gray-800">Detail Buku</span>
        </nav>
        <h1 class="text-3xl font-bold text-gray-800">Detail Buku</h1>
    </div>

    <!-- Book Detail -->
    <div class="bg-white rounded-lg shadow-md border border-gray-200 overflow-hidden">
        <div class="md:flex">
            <!-- Book Cover -->
            <div class="md:w-1/3 p-6 bg-gray-50">
                <?php if ($buku['cover']): ?>
                    <img src="/writable/uploads/<?= esc($buku['cover']) ?>" alt="cover" 
                         class="w-full h-80 object-cover rounded-lg shadow-md">
                <?php else: ?>
                    <div class="w-full h-80 bg-gray-100 rounded-lg flex items-center justify-center">
                        <svg class="w-20 h-20 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Book Information -->
            <div class="md:w-2/3 p-6">
                <div class="mb-6">
                    <h2 class="text-3xl font-bold text-gray-800 mb-4"><?= esc($buku['title']) ?></h2>
                    
                    <div class="space-y-3 mb-6">
                        <div class="flex items-center gap-2">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            <span class="text-gray-600">Penulis:</span>
                            <span class="font-semibold text-gray-800"><?= esc($buku['author']) ?></span>
                        </div>
                        
                        <div class="flex items-center gap-2">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            <span class="text-gray-600">Tahun Terbit:</span>
                            <span class="bg-blue-100 text-blue-700 px-2 py-1 rounded-full text-sm font-medium"><?= esc($buku['year']) ?></span>
                        </div>
                    </div>

                    <div class="mb-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-3">Deskripsi</h3>
                        <div class="text-gray-600 leading-relaxed">
                            <?= $buku['description'] ? nl2br(esc($buku['description'])) : '<span class="text-gray-400 italic">Tidak ada deskripsi</span>' ?>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex gap-4 pt-4 border-t border-gray-200">
                        <?php if (session('role') === 'user'): ?>
                            <a href="/loan/borrow/<?= $buku['id'] ?>" class="bg-green-600 text-white px-6 py-2 rounded-lg hover:bg-green-700 transition-colors font-medium flex items-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                                Pinjam Buku
                            </a>
                        <?php endif; ?>
                        
                        <?php if (session('role') === 'admin'): ?>
                            <a href="/buku/edit/<?= $buku['id'] ?>" 
                               class="bg-yellow-500 text-white px-6 py-2 rounded-lg hover:bg-yellow-600 transition-colors font-medium flex items-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                                Edit Buku
                            </a>
                        <?php endif; ?>
                        
                        <a href="/buku" 
                           class="bg-gray-500 text-white px-6 py-2 rounded-lg hover:bg-gray-600 transition-colors font-medium flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                            </svg>
                            Kembali
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?> 