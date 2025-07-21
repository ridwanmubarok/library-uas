<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - KreasiBuku</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <style>
        * { font-family: 'Inter', sans-serif; }
    </style>
</head>

<body class="min-h-screen bg-gray-50 flex items-center justify-center">
    <div class="w-full max-w-md mx-4">
        <!-- Logo/Brand -->
        <div class="text-center mb-8">
            <div class="w-20 h-20 bg-blue-600 rounded-xl flex items-center justify-center mx-auto mb-4">
                <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                </svg>
            </div>
            <h1 class="text-3xl font-bold text-gray-800 mb-2">KreasiBuku</h1>
            <p class="text-gray-600">Platform Perpustakaan Digital</p>
        </div>
        
        <!-- Login Form -->
        <div class="bg-white rounded-2xl p-8 shadow-lg border border-gray-200">
            <div class="text-center mb-8">
                <h2 class="text-2xl font-bold text-gray-800 mb-2">Selamat Datang</h2>
                <p class="text-gray-600">Silakan masuk untuk melanjutkan</p>
            </div>
            
            <?= form_open('login/process', ['class' => 'space-y-6']) ?>
            
            <div class="space-y-2">
                <label class="text-gray-700 font-medium block">Username</label>
                <div class="relative">
                    <div class="absolute left-3 top-1/2 transform -translate-y-1/2">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </div>
                    <input type="text" name="username" 
                           class="w-full border border-gray-300 rounded-lg px-12 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                           placeholder="Masukkan username Anda" autofocus value="<?= old('username') ?>">
                </div>
                <?php if (isset($validation) && $validation->hasError('username')): ?>
                    <div class="text-red-500 text-sm mt-1">
                        <?= $validation->getError('username') ?>
                    </div>
                <?php endif; ?>
            </div>
            
            <div class="space-y-2">
                <label class="text-gray-700 font-medium block">Password</label>
                <div class="relative">
                    <div class="absolute left-3 top-1/2 transform -translate-y-1/2">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m0 0v2m0-2h2m-2 0h-2m9-5a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <input type="password" name="password" 
                           class="w-full border border-gray-300 rounded-lg px-12 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                           placeholder="Masukkan password Anda">
                </div>
                <?php if (isset($validation) && $validation->hasError('password')): ?>
                    <div class="text-red-500 text-sm mt-1">
                        <?= $validation->getError('password') ?>
                    </div>
                <?php endif; ?>
            </div>
            
            <button type="submit" 
                    class="w-full bg-blue-600 text-white py-3 rounded-lg font-semibold hover:bg-blue-700 transition-colors">
                Masuk Sekarang
            </button>
            
            <?= form_close() ?>
        </div>
        
        <!-- Footer -->
        <div class="text-center mt-8 text-gray-500 text-sm">
            <p>&copy; <?= date('Y') ?> KreasiBuku. Developed by <span class="text-blue-600 font-semibold">Ridwan Mubarok</span></p>
        </div>
    </div>
    
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
</body>

</html>