<?= $this->extend('layout') ?>
<?= $this->section('content') ?>
<!-- Hero Section -->
<section class="bg-white py-20">
  <div class="max-w-7xl mx-auto px-4 text-center">
    <div class="mb-8">
      <div class="w-20 h-20 bg-blue-600 rounded-xl flex items-center justify-center mx-auto mb-6">
        <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
          </path>
        </svg>
      </div>

      <h1 class="text-4xl md:text-5xl font-bold text-gray-800 mb-4">
        Selamat Datang di <span class="text-blue-600">Kreasi Buku</span>
      </h1>

      <p class="text-xl text-gray-600 mb-8 max-w-2xl mx-auto">
        Platform perpustakaan digital yang memudahkan Anda menemukan dan meminjam buku favorit
      </p>
    </div>

    <!-- Search Bar -->
    <div class="mt-12 max-w-2xl mx-auto">
      <form action="/buku" method="get"
        class="bg-white shadow-lg rounded-lg flex items-center p-2 border border-gray-200">
        <div class="flex-1 flex items-center px-4">
          <svg class="w-5 h-5 text-gray-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
          </svg>
          <input type="text" name="keyword" class="flex-1 py-3 outline-none text-lg bg-transparent placeholder-gray-500"
            placeholder="Cari buku, penulis, atau ISBN...">
        </div>
        <button class="bg-blue-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-blue-700 transition-colors">
          Cari
        </button>
      </form>
    </div>
  </div>
</section>

<!-- Featured Books -->
<section class="py-16 bg-white">
  <div class="max-w-7xl mx-auto px-4">
    <div class="text-center mb-12">
      <h2 class="text-3xl font-bold text-gray-800 mb-4">Buku Pilihan</h2>
      <p class="text-gray-600">Koleksi buku terbaik yang direkomendasikan</p>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
      <?php if (!empty($featuredBooks)): ?>
        <?php foreach ($featuredBooks as $b): ?>
          <div
            class="bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow border border-gray-200 overflow-hidden">
            <?php if ($b['cover']): ?>
              <div class="relative">
                <img src="/writable/uploads/<?= esc($b['cover']) ?>" alt="cover" class="aspect-[3/4] w-full object-cover">
                <?php if ($b['year'] == date('Y')): ?>
                  <span class="absolute top-2 right-2 bg-green-500 text-white text-xs px-2 py-1 rounded-full">Baru</span>
                <?php endif; ?>
              </div>
            <?php else: ?>
              <div class="h-48 w-full flex items-center justify-center bg-gray-100 text-gray-400">
                <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                  </path>
                </svg>
              </div>
            <?php endif; ?>
            <div class="p-4">
              <h3 class="font-semibold text-lg mb-2 truncate" title="<?= esc($b['title']) ?>"><?= esc($b['title']) ?></h3>
              <div class="flex items-center gap-2 mb-2">
                <span class="bg-blue-100 text-blue-700 text-xs px-2 py-1 rounded-full"><?= esc($b['year']) ?></span>
                <span class="text-gray-600 text-sm">Oleh <?= esc($b['author']) ?></span>
              </div>
              <div class="w-full h-full">
                <p class="text-gray-700 text-sm line-clamp-3"><?= esc($b['description']) ?></p>
              </div>
              <div class="flex gap-2 mt-5">
                <a href="/buku/detail/<?= $b['id'] ?>"
                  class="flex-1 bg-blue-600 text-white px-3 py-2 rounded-lg text-sm font-medium hover:bg-blue-700 transition-colors text-center">Detail</a>
                <?php if (session('role') === 'user'): ?>
                  <a href="/loan/borrow/<?= $b['id'] ?>"
                    class="flex-1 bg-green-600 text-white px-3 py-2 rounded-lg text-sm font-medium hover:bg-green-700 transition-colors text-center">Pinjam</a>
                <?php endif; ?>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      <?php else: ?>
        <div class="col-span-full text-center text-gray-500 py-16">
          <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
            <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
              </path>
            </svg>
          </div>
          <p>Belum ada buku yang tersedia</p>
        </div>
      <?php endif; ?>
    </div>
  </div>
</section>

<!-- Footer -->
<footer class="bg-gray-800 text-white py-8">
  <div class="max-w-7xl mx-auto px-4">
    <div class="text-center">
      <div class="flex items-center justify-center space-x-3 mb-4">
        <div class="w-10 h-10 bg-blue-600 rounded-lg flex items-center justify-center">
          <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
            </path>
          </svg>
        </div>
        <h3 class="text-xl font-bold">KreasiBuku</h3>
      </div>
      <p class="text-gray-400 mb-4">Platform perpustakaan digital untuk semua</p>
      <div class="border-t border-gray-700 pt-4">
        <p class="text-gray-400 text-sm">
          &copy; <?= date('Y') ?> KreasiBuku. All rights reserved.
          Developed by <span class="text-blue-400 font-semibold">Ridwan Mubarok</span>
        </p>
      </div>
    </div>
  </div>
</footer>
<?= $this->endSection() ?>