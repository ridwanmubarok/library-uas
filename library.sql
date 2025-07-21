-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 21, 2025 at 02:28 PM
-- Server version: 8.0.30
-- PHP Version: 8.3.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `library`
--

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id` int UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `author` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `year` year DEFAULT NULL,
  `description` text COLLATE utf8mb4_general_ci,
  `cover` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `title`, `author`, `year`, `description`, `cover`, `created_at`, `updated_at`) VALUES
(1, 'The Stranger', 'Albert Camus', 1942, '\"The Stranger\" (L\'Étranger) karya Albert Camus adalah novel filosofis klasik dari tahun 1942. Berlatar di Aljazair Prancis, ceritanya mengikuti Meursault, seorang pria yang sangat acuh tak acuh dan apatis terhadap kehidupan serta norma sosial. Kisah dimulai saat ia menghadapi kematian ibunya tanpa emosi yang lazim, kemudian terlibat dalam pembunuhan tak terduga.\r\n\r\nNovel ini menyoroti tema absurdisme—konflik antara keinginan manusia mencari makna dan ketidakmampuan alam semesta untuk memberikannya. Melalui Meursault, Camus mengeksplorasi isolasi eksistensial, ketidakpedulian alam semesta, serta penolakan Meursault untuk berpura-pura merasakan emosi. Sikap jujurnya ini, bahkan saat merugikan dirinya, mengarah pada kehancurannya. \"The Stranger\" adalah perenungan mendalam tentang kebebasan, tanggung jawab, dan esensi manusia dalam menghadapi dunia yang irasional.', '1752666863_27c48d29ae346694dafa.png', '2025-07-16 11:54:23', '2025-07-21 14:12:02'),
(6, 'Neraka adalah Orang Lain', 'Jean-Paul Sartre', 1944, 'Neraka adalah Orang Lain\" adalah kumpulan cerpen yang mengangkat berbagai kisah tentang hubungan antarmanusia dan kompleksitasnya. Judulnya sendiri terinspirasi dari filosofi Jean-Paul Sartre, yang menyatakan bahwa penderitaan kita sering kali berasal dari pandangan, penilaian, dan ekspektasi orang lain terhadap diri kita. Melalui narasi yang tajam dan menggugah, buku ini menjelajahi bagaimana interaksi, baik yang intim maupun yang sekilas, dapat membentuk surga sekaligus neraka bagi setiap individu. Dari dilema moral hingga konflik batin yang tersembunyi, setiap cerita menawarkan cerminan mendalam tentang sifat manusia dan perjuangannya dalam menerima atau melawan pengaruh dari \"orang lain\". Sebuah bacaan yang akan membuatmu merenung tentang peran orang-orang di sekitarmu dalam membentuk identitas dan realitas pribadimu.', '1752673535_69c5eb3c91a9f97fc647.webp', '2025-07-16 13:45:35', '2025-07-16 13:48:55'),
(7, 'Madilog', 'Tan Malaka', 1943, 'Madilog: Materialisme, Dialektika, Logika (1943) adalah karya penting Tan Malaka, pemikir revolusioner Indonesia. Buku ini merupakan seruan untuk revolusi berpikir, menyajikan kerangka komprehensif materialisme (realitas adalah materi), dialektika (melihat kontradiksi & perubahan), serta logika (penalaran yang benar).\r\n\r\nTan Malaka mengkritik keras cara berpikir feodal dan mistis yang menghambat kemajuan bangsa, mendesak penerapan metode ilmiah. Ia berpendapat, kemerdekaan sejati tak hanya fisik, tapi juga intelektual—kemampuan berpikir rasional dan kritis. Buku ini mendorong pembaca mempertanyakan dogma, meneliti, dan menarik kesimpulan berdasarkan bukti logis.\r\n\r\nMadilog menjadi landasan pemikiran banyak aktivis dan intelektual, relevan hingga kini sebagai panduan berpikir analitis dan mencari kebenaran. Ini ajakan menjadi manusia merdeka secara intelektual, melihat dunia kritis dan logis demi kemajuan sejati.', '1752674055_23758fce50f88261a42d.jpg', '2025-07-16 13:54:15', '2025-07-16 13:55:13'),
(8, 'The Fall', 'Albert Camus', 1956, 'The Fall (La Chute), diterbitkan 1956, adalah salah satu karya filosofis terakhir Albert Camus. Novel singkat ini dikisahkan melalui monolog Jean-Baptiste Clamence, seorang mantan pengacara sukses yang kini hidup sebagai \"hakim-penitensi\" di sebuah bar Amsterdam. Kepada seorang asing, Clamence secara bertahap mengungkapkan kegelisahan eksistensial dan krisis moralnya yang mendalam.\r\n\r\nClamence menceritakan bagaimana citra dirinya sebagai pria berbudi luhur dan pembela keadilan runtuh setelah serangkaian insiden. Khususnya, kegagalannya menolong seorang wanita yang bunuh diri membawanya pada kesadaran pahit akan kemunafikan dan egoismenya sendiri, serta ilusi kebaikan yang selama ini ia pelihara. Ia menyadari bahwa di balik tindakan altruistiknya, ada keinginan tersembunyi untuk diakui dan dipuji.', '1752674298_38420fb5ed27d2567791.jpg', '2025-07-16 13:58:18', '2025-07-16 13:58:18'),
(9, 'The Kremlin School of Negotiation', 'Igor Ryzov', 2017, 'The Kremlin School of Negotiation karya Igor Ryzov menawarkan panduan komprehensif tentang negosiasi, yang disebut-sebut berdasarkan metode resmi Kremlin. Buku ini menggali teknik-teknik yang dikembangkan sejak era Joseph Stalin di Rusia tahun 1920-an, namun diperbarui agar relevan dan etis untuk bisnis modern.\r\n\r\nRyzov, seorang pelatih bisnis berpengalaman, membagikan strategi efektif untuk menghadapi negosiator tangguh, mempertahankan kepentingan, dan mengelola emosi—baik milik sendiri maupun lawan bicara. Pembaca akan belajar cara mengumpulkan informasi maksimal, membaca gerak-gerik lawan, serta meredakan ketegangan.', '1752674442_c4088339e7ea9b65c494.jpg', '2025-07-16 14:00:42', '2025-07-16 14:00:42'),
(10, 'Ayat Ayat Kiri', 'Vice Versa Books', 1953, 'Buku ini disusun secara tematis menjadi tiga bagian utama. Bagian pertama membahas filsafat, menggali dasar-dasar pemikiran yang membentuk ideologi kiri. Bagian kedua fokus pada ekonomi-politik, menguraikan analisis kritis terhadap sistem kapitalisme dan dinamika kekuasaan ekonomi. Terakhir, bagian ketiga mencakup tema sosialisme & kebudayaan, menyoroti visi masyarakat sosialis dan peran kebudayaan dalam transformasi sosial.', '1752674631_f4aad4e11c7e6276bb4f.jpg', '2025-07-16 14:03:51', '2025-07-16 14:03:51'),
(11, 'Aksi Massa', 'Tan Malaka', 1926, 'Aksi Massa adalah salah satu karya fundamental dan paling berpengaruh dari Tan Malaka, seorang pemikir dan pejuang revolusioner Indonesia. Ditulis pada tahun 1926 saat ia berada di pengasingan, buku ini berfungsi sebagai panduan strategis dan taktis bagi gerakan perjuangan untuk kemerdekaan dan revolusi sosial.\r\n\r\nDalam Aksi Massa, Tan Malaka menguraikan pentingnya dan cara-cara mengorganisir massa rakyat sebagai kekuatan utama untuk mencapai perubahan. Ia menekankan bahwa perjuangan tidak cukup hanya melalui elit atau perundingan di meja hijau, tetapi harus melibatkan mobilisasi kesadaran dan kekuatan kolektif dari rakyat pekerja, petani, dan kaum tertindas. Buku ini membahas berbagai aspek, mulai dari pendidikan politik, agitasi, propaganda, hingga pembentukan organisasi revolusioner yang kuat dan disiplin.', '1752674768_c3ad7bc2a9f4ccae7ad9.jpg', '2025-07-16 14:06:08', '2025-07-16 14:06:08');

-- --------------------------------------------------------

--
-- Table structure for table `loans`
--

CREATE TABLE `loans` (
  `id` int UNSIGNED NOT NULL,
  `user_id` int UNSIGNED NOT NULL,
  `book_id` int UNSIGNED NOT NULL,
  `loan_date` date NOT NULL,
  `return_date` date DEFAULT NULL,
  `status` enum('borrowed','returned') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'borrowed',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `return_requested` tinyint(1) NOT NULL DEFAULT '0',
  `return_requested_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `loans`
--

INSERT INTO `loans` (`id`, `user_id`, `book_id`, `loan_date`, `return_date`, `status`, `created_at`, `updated_at`, `return_requested`, `return_requested_at`) VALUES
(1, 2, 1, '2025-07-21', '2025-07-21', 'returned', '2025-07-21 14:12:35', '2025-07-21 14:13:08', 0, '2025-07-21 14:12:47');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint UNSIGNED NOT NULL,
  `version` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `class` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `group` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `namespace` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `time` int NOT NULL,
  `batch` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(1, '2025-06-20-000001', 'App\\Database\\Migrations\\CreateUsersTable', 'default', 'App', 1752666386, 1),
(2, '2025-06-20-000002', 'App\\Database\\Migrations\\CreateBooksTable', 'default', 'App', 1752666386, 1),
(3, '2025-06-20-000002', 'App\\Database\\Migrations\\CreateLoansTable', 'default', 'App', 1752666387, 1),
(4, '2025-07-16-000001', 'App\\Database\\Migrations\\AddReturnRequestedToLoans', 'default', 'App', 1752666387, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int UNSIGNED NOT NULL,
  `username` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `fullname` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `role` enum('admin','user') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'user',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `fullname`, `password`, `role`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'Admin Perpustakaan', '$2y$10$Kph0lRvW8rZbgZIX3SZO0eMi99bhhJj56B7B5GCrQVPaDpdCizJWu', 'admin', '2025-07-16 11:46:33', '2025-07-16 11:46:33'),
(2, 'user', 'Octavia', '$2y$10$lk3KSgcC//Jb.ZY5UImxv..9INuJSNRYV4xk7CUXEPiROwHYhCHN.', 'user', '2025-07-16 11:46:33', '2025-07-16 11:46:33');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `loans`
--
ALTER TABLE `loans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `loans_user_id_foreign` (`user_id`),
  ADD KEY `loans_book_id_foreign` (`book_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `loans`
--
ALTER TABLE `loans`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `loans`
--
ALTER TABLE `loans`
  ADD CONSTRAINT `loans_book_id_foreign` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `loans_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
