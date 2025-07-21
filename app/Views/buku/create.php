<?= $this->extend('layout') ?>
<?= $this->section('content') ?>
<div class="max-w-2xl mx-auto p-6">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-2">Tambah Buku Baru</h1>
        <p class="text-gray-600">Tambahkan buku baru ke koleksi perpustakaan</p>
    </div>

    <div class="bg-white rounded-lg shadow-md p-6 border border-gray-200">
        <form action="/buku/store" method="post" enctype="multipart/form-data" class="space-y-6">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Judul Buku <span
                        class="text-red-500">*</span></label>
                <input type="text" name="title" value="<?= old('title') ?>"
                    class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    placeholder="Masukkan judul buku">
                <?php if (isset($validation) && $validation->hasError('title')): ?>
                    <div class="text-red-500 text-sm mt-1">
                        <?= $validation->getError('title') ?>
                    </div>
                <?php endif; ?>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Penulis <span
                        class="text-red-500">*</span></label>
                <input type="text" name="author" value="<?= old('author') ?>"
                    class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    placeholder="Masukkan nama penulis">
                <?php if (isset($validation) && $validation->hasError('author')): ?>
                    <div class="text-red-500 text-sm mt-1">
                        <?= $validation->getError('author') ?>
                    </div>
                <?php endif; ?>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Tahun Terbit</label>
                <input type="number" name="year" value="<?= old('year') ?: date('Y') ?>"
                    class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    placeholder="Masukkan tahun terbit" min="1900" max="2099">
                <?php if (isset($validation) && $validation->hasError('year')): ?>
                    <div class="text-red-500 text-sm mt-1">
                        <?= $validation->getError('year') ?>
                    </div>
                <?php endif; ?>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Deskripsi</label>
                <textarea name="description" rows="4"
                    class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    placeholder="Masukkan deskripsi buku"><?= old('description') ?></textarea>
                <?php if (isset($validation) && $validation->hasError('description')): ?>
                    <div class="text-red-500 text-sm mt-1">
                        <?= $validation->getError('description') ?>
                    </div>
                <?php endif; ?>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Cover Buku</label>
                <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center">
                    <div class="mb-4">
                        <svg class="w-12 h-12 text-gray-400 mx-auto mb-2" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                            </path>
                        </svg>
                        <p class="text-gray-600">Pilih file gambar untuk cover</p>
                        <p class="text-sm text-gray-500">PNG, JPG, JPEG (Max. 2MB)</p>
                    </div>
                    <input type="file" name="cover"
                        class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100"
                        accept="image/*">

                    <?php if (isset($validation) && $validation->hasError('cover')): ?>
                        <div class="text-red-500 text-sm mt-1">
                            <?= $validation->getError('cover') ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <div class="flex gap-4 pt-4">
                <button type="submit"
                    class="flex-1 bg-blue-600 text-white py-3 px-6 rounded-lg font-medium hover:bg-blue-700 transition-colors flex items-center justify-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    Simpan Buku
                </button>
                <a href="/buku"
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
            backgroundColor: "#22c55e",
        }).showToast();
    <?php endif; ?>
</script>
<?= $this->endSection() ?>