<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kreasi Buku - Digital Library</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <style>
        * {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>

<body class="bg-gray-50 min-h-screen">
    <nav class="bg-blue-600 text-white px-6 py-4 shadow-lg sticky top-0 z-40">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <div class="flex items-center space-x-3">
                <div class="w-10 h-10 bg-blue-700 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                        </path>
                    </svg>
                </div>
                <div class="font-bold text-xl">
                    <a href="/">Kreasi Buku</a>
                </div>
            </div>
            <div class="flex gap-6 items-center">
                <a href="/buku" class="hover:text-blue-200 transition-colors font-medium">Daftar Buku</a>
                <?php if (session('role') === 'user'): ?>
                    <a href="/loan" class="hover:text-blue-200 transition-colors font-medium">Riwayat Pinjam</a>
                <?php endif; ?>
                <?php if (session('role') === 'admin'): ?>
                    <a href="/admin" class="hover:text-blue-200 transition-colors font-medium">Dashboard Admin</a>
                    <a href="/loan" class="hover:text-blue-200 transition-colors font-medium">Kelola Pinjam</a>
                <?php endif; ?>
                <div class="flex items-center space-x-3">
                    <div class="w-8 h-8 bg-blue-700 rounded-full flex items-center justify-center">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </div>
                    <span class="font-medium"><?= esc(session('username')) ?></span>
                    <a href="/logout"
                        class="bg-red-500 px-4 py-2 rounded-lg hover:bg-red-600 transition-colors font-medium">Logout</a>
                </div>
            </div>
        </div>
    </nav>
    <main class="min-h-screen">
        <?= $this->renderSection('content') ?>
    </main>
</body>

</html>