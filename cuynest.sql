-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 07 Jun 2025 pada 09.47
-- Versi server: 10.4.28-MariaDB
-- Versi PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cuynest`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'PC Games', 'pc-games', NULL, NULL),
(2, 'Mobile Games', 'mobile-games', NULL, NULL),
(3, 'Art Games', 'art-games', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_05_03_132110_create_products_table', 1),
(5, '2025_05_03_132112_create_product_images_table', 1),
(6, '2025_05_29_110742_create_categories_table', 1),
(7, '2025_06_01_063519_create_platforms_table', 1),
(8, '2025_06_01_063528_create_platform_product_table', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `platforms`
--

CREATE TABLE `platforms` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `platforms`
--

INSERT INTO `platforms` (`id`, `name`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'Windows', 'windows', '2025-06-01 03:48:43', '2025-06-01 03:48:43'),
(2, 'PlayStation', 'playstation', '2025-06-01 03:48:43', '2025-06-01 03:48:43'),
(3, 'Xbox', 'xbox', '2025-06-01 03:48:43', '2025-06-01 03:48:43'),
(4, 'Android', 'android', '2025-06-01 03:48:43', '2025-06-01 03:48:43'),
(5, 'iOS', 'ios', '2025-06-01 03:48:43', '2025-06-01 03:48:43'),
(6, 'Nintendo Switch', 'nintendo-switch', '2025-06-01 03:48:43', '2025-06-01 03:48:43'),
(7, 'Linux', 'linux', '2025-06-01 03:48:43', '2025-06-01 03:48:43'),
(8, 'macOS', 'macos', '2025-06-01 03:48:43', '2025-06-01 03:48:43'),
(9, 'Web', 'web', '2025-06-01 03:48:43', '2025-06-01 03:48:43'),
(10, 'VR', 'vr', '2025-06-01 03:48:43', '2025-06-01 03:48:43'),
(11, 'Steam', 'steam', '2025-06-01 03:48:43', '2025-06-01 03:48:43'),
(12, 'Epic Games Store', 'epic-games-store', '2025-06-01 03:48:43', '2025-06-01 03:48:43'),
(13, 'GOG', 'gog', '2025-06-01 03:48:43', '2025-06-01 03:48:43'),
(14, 'Origin', 'origin', '2025-06-01 03:48:43', '2025-06-01 03:48:43'),
(15, 'Uplay', 'uplay', '2025-06-01 03:48:43', '2025-06-01 03:48:43'),
(16, 'Battle.net', 'battle-net', '2025-06-01 03:48:43', '2025-06-01 03:48:43');

-- --------------------------------------------------------

--
-- Struktur dari tabel `platform_product`
--

CREATE TABLE `platform_product` (
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `platform_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `platform_product`
--

INSERT INTO `platform_product` (`product_id`, `platform_id`) VALUES
(1, 1),
(1, 3),
(1, 11),
(1, 12),
(2, 1),
(2, 3),
(2, 11),
(3, 1),
(3, 2),
(3, 3),
(3, 11),
(3, 12),
(4, 1),
(5, 4),
(5, 5),
(6, 4),
(6, 5),
(7, 1),
(7, 2),
(7, 3),
(7, 4),
(7, 5),
(7, 11),
(15, 1),
(15, 2),
(15, 3),
(15, 4),
(15, 6),
(15, 7),
(15, 8),
(15, 11);

-- --------------------------------------------------------

--
-- Struktur dari tabel `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `description` text NOT NULL,
  `feature` text DEFAULT NULL,
  `aditional` text DEFAULT NULL,
  `date` date DEFAULT NULL,
  `platform` varchar(255) DEFAULT NULL,
  `additional_info` longtext DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `products`
--

INSERT INTO `products` (`id`, `title`, `slug`, `category_id`, `image`, `description`, `feature`, `aditional`, `date`, `platform`, `additional_info`, `created_at`, `updated_at`) VALUES
(1, 'Sea Of Thieves', 'sea-of-thieves', 1, '0uzPi8jA3Y4sjpEb3iwfocnn8BkANXwe78INjJ8w.png', '<div>Ahoy, matey! Sea of Thieves adalah game petualangan bajak laut multiplayer dunia terbuka yang dikembangkan oleh Rare dan diterbitkan oleh Xbox Game Studios. Pemain menjelajahi lautan luas, mencari harta karun, bertarung melawan monster laut, dan menghadapi bajak laut lainnya dalam dunia yang penuh kejutan dan misteri.</div>', '<ul><li>Co-op Multiplayer Adventure</li><li>Shared Open World</li><li>Customization and Progression</li></ul>', '<div>Genre: Action-Adventure<br>Multiplayer Mode: Online Multiplayer (PvE dan PvP)<br>Developer: Rare Publisher: Xbox Game Studios<br>Rating: Teen (T)<br>Engine: Unreal Engine 4.&nbsp;<br><br>System Requirements (Minimum):&nbsp;</div><ul><li>OS: Windows 10 64-bit&nbsp;</li><li>Processor: Intel Q9450 @ 2.6GHz or AMD Phenom II X6 @ 3.3 GHz&nbsp;</li><li>Memory: 4 GB RAM&nbsp;</li><li>Graphics: Nvidia GeForce GTX 650 or AMD Radeon 7750&nbsp;</li><li>Storage: 50 GB available space</li></ul>', '2018-03-20', 'Steam, Epic Games, Xbox Game Pass', '<p>Genre: Action-Adventure, Multiplayer<br> Mode: Online Multiplayer (PvE dan PvP)<br> Developer: Rare <br>Publisher: Xbox Game Studios<br> Rating: Teen (T) <br>Engine: Unreal Engine 4. <br></p><p>System Requirements (Minimum):<br><ul><li>OS: Windows 10 64-bit</li><li>Processor: Intel Q9450 @ 2.6GHz or AMD Phenom II X6 @ 3.3 GHz</li><li>Memory: 4 GB RAM</li><li>Graphics: Nvidia GeForce GTX 650 or AMD Radeon 7750</li><li>Storage: 50 GB available space</li></ul></p>', '2025-06-01 03:48:43', '2025-06-01 03:54:07'),
(2, 'Palworld', 'palworld', 1, 'pc2.png', '<div>Palworld adalah game aksi-petualangan dunia terbuka di mana kamu bisa menjelajahi dunia yang penuh dengan makhluk misterius bernama \'Pals\'. Tidak hanya bertarung bersama mereka, kamu juga bisa bertani, membangun pabrik, dan menggunakan senjata api dalam petualangan bertahan hidup yang unik.</div>', '<ul><li>Tangkap dan Bertarung Bersama Pals&nbsp;</li><li>Bangun Dunia dan Bertahan Hidup&nbsp;</li><li>Crafting dan Industri&nbsp;</li><li>Eksplorasi Dunia Terbuka&nbsp;</li><li>Multiplayer Co-op dan PvP</li></ul>', '<div>Genre: Action-Adventure, Open-World, Survival, Monster-Taming<br>Mode: Single-player, Online Multiplayer, Co-op<br>Developer: Pocketpair<br>Publisher: Pocketpair<br>Rating: Teen (T)<br>Engine: Unreal Engine 4&nbsp;<br><br>System Requirements (Minimum):<br><br></div><ul><li>OS: Windows 10 64-bit</li><li>Processor: Intel Core i5-3570K or AMD FX-8350</li><li>Memory: 16 GB RAM</li><li>Graphics: NVIDIA GeForce GTX 1050 (2GB) or AMD Radeon R9 380</li><li>DirectX: Version 11</li><li>Storage: 40 GB available space</li></ul><div>System Requirements (Recommended):<br><br></div><ul><li>OS: Windows 10 64-bit</li><li>Processor: Intel Core i9-9900K or AMD Ryzen 7 3700X</li><li>Memory: 32 GB RAM</li><li>Graphics: NVIDIA GeForce RTX 2070 or AMD Radeon RX 5700 XT</li><li>DirectX: Version 11</li><li>Storage: 40 GB available space<br><br></li></ul>', '2024-01-01', 'Windows, Xbox Series X/S', '<p><strong>Developer:</strong> Pocketpair</p><p><strong>Genre:</strong> Action-Adventure, Open World Survival</p><p><strong>Engine:</strong> Unreal Engine</p><p><strong>Mode:</strong> Single-player, Online Co-op, PvP</p><p><strong>Rating:</strong> Teen (T)</p><p><strong>Fitur Lengkap:</strong><br><strong>1.</strong> Tangkap makhluk unik bernama Pals, dan gunakan mereka dalam pertempuran atau pekerjaan sehari-hari.<br><strong>2.</strong> Kumpulkan sumber daya dan bangun tempat tinggal untuk bertahan hidup dari berbagai ancaman.<br><strong>3.</strong> Kelola industri dan crafting dengan bantuan Pals untuk menghasilkan senjata dan alat penting.<br><strong>4.</strong> Jelajahi berbagai bioma dan dungeon yang tersebar di dunia terbuka.<br><strong>5.</strong> Bermain bersama teman atau bertarung melawan pemain lain secara online.</p>', '2025-06-01 03:48:43', '2025-06-01 22:44:24'),
(3, 'Grand Theft Auto V', 'grand-theft-auto-v', 1, 'pc3.jpg', '<div>Grand Theft Auto V (GTA V) adalah game aksi-petualangan dunia terbuka yang menempatkan pemain di kota fiktif Los Santos. Dengan tiga karakter utama yang bisa dimainkan, game ini menawarkan cerita yang kompleks, dunia yang sangat luas, dan kebebasan eksplorasi yang hampir tak terbatas.</div>', '<ul><li>Tiga Karakter Utama yang Bisa Diganti</li><li>Dunia Terbuka yang Sangat Luas dan Hidup</li><li>Misi Cerita Sinematik dan Menegangkan</li><li>Mode Online Multiplayer (GTA Online)</li><li>Kostumisasi Karakter, Kendaraan, dan Senjata</li></ul>', '<div>Genre: Action, Open World<br>&nbsp;Mode: Single-player, Online Multiplayer<br>&nbsp;Developer: Rockstar North<br>&nbsp;Publisher: Rockstar Games<br>&nbsp;Rating: Mature (M)<br>&nbsp;Engine: RAGE<br><br></div><div>System Requirements (Minimum):<br><br></div><ul><li>OS: Windows 7 64-bit</li><li>Processor: Intel Core 2 Quad CPU Q6600 / AMD Phenom 9850</li><li>Memory: 4 GB RAM</li><li>Graphics: NVIDIA 9800 GT / AMD HD 4870</li><li>Storage: 72 GB available space<br><br></li></ul>', '2015-04-01', 'Windows, PS3, PS4, PS5, Xbox 360, Xbox One, Xbox Series X/S', '<p><strong>Developer:</strong> Rockstar Games</p><p><strong>Genre:</strong> Action-Adventure, Open World</p><p><strong>Engine:</strong> RAGE (Rockstar Advanced Game Engine)</p><p><strong>Mode:</strong> Single-player, Multiplayer Online</p><p><strong>Rating:</strong> Mature 17+</p><p><strong>Fitur Lengkap:</strong><br><strong>1.</strong> Mainkan tiga tokoh unik: Michael, Franklin, dan Trevor dengan latar belakang dan kemampuan berbeda.<br><strong>2.</strong> Dunia terbuka Los Santos dan Blaine County dengan berbagai aktivitas sampingan dan rahasia.<br><strong>3.</strong> Misi heist dan aksi kriminal bergaya film Hollywood.<br><strong>4.</strong> GTA Online: dunia daring dengan misi, balapan, bisnis, dan komunitas pemain yang luas.<br><strong>5.</strong> Grafis ultra realistik dengan dukungan 4K dan first-person mode (di versi PC & konsol terbaru).</p>', '2025-06-01 03:48:43', '2025-06-01 22:47:43'),
(4, 'Valorant', 'valorant', 1, 'pc4.png', '<div>Valorant adalah game tactical shooter berbasis tim dari Riot Games yang menggabungkan aksi tembak-menembak bergaya CS:GO dengan kemampuan unik ala hero shooter. Pemain bertanding dalam dua tim, menyerang atau bertahan, sambil memanfaatkan kemampuan agen untuk mengontrol medan tempur.</div>', '<ul><li>Pertempuran 5v5 dengan Mode Defuse Bomb</li><li>Beragam Agen dengan Kemampuan Unik</li><li>Strategi Taktikal dan Kerja Sama Tim</li><li>Peta dengan Desain Kompetitif</li><li>Grafis Ringan dan Performa Stabil</li></ul>', '<div>Genre: Tactical Shooter<br>&nbsp;Mode: Online Multiplayer (PvP)<br>&nbsp;Developer: Riot Games<br>&nbsp;Publisher: Riot Games<br>&nbsp;Rating: Teen (T)<br>&nbsp;Engine: Unreal Engine 4<br><br></div><div>System Requirements (Minimum):<br><br></div><ul><li>OS: Windows 7/8/10 64-bit</li><li>Processor: Intel Core 2 Duo E8400</li><li>Memory: 4 GB RAM</li><li>Graphics: Intel HD 3000</li><li>Storage: 20 GB available space<br><br></li></ul>', '2020-06-01', 'Windows', '<p><strong>Developer:</strong> Riot Games</p><p><strong>Genre:</strong> Tactical Shooter, First-Person</p><p><strong>Engine:</strong> Unreal Engine 4</p><p><strong>Mode:</strong> Multiplayer Online</p><p><strong>Rating:</strong> Teen (T)</p><p><strong>Fitur Lengkap:</strong><br><strong>1.</strong> 5 lawan 5 dalam mode Plant/Defuse dengan sistem ronde.<br><strong>2.</strong> Pilih dari berbagai \'Agen\' dengan kemampuan unik: smoke, flash, trap, teleport, dll.<br><strong>3.</strong> Kombinasikan aim presisi dan penggunaan ability untuk meraih kemenangan.<br><strong>4.</strong> Map beragam dengan titik kontrol strategis dan choke points.<br><strong>5.</strong> Kompetitif dan e-sport ready dengan mode Ranked, Tournament, dan Anti-Cheat Vanguard.</p>', '2025-06-01 03:48:43', '2025-06-01 22:49:22'),
(5, 'Mobile Legends: Bang Bang', 'mobile-legends-bang-bang', 2, 'mobile1.jpg', '<div>Mobile Legends: Bang Bang adalah game MOBA 5v5 populer di platform mobile yang menekankan kerja sama tim, strategi, dan refleks cepat. Pemain memilih hero dengan peran berbeda untuk bertempur dalam arena dan menghancurkan turret musuh demi meraih kemenangan.</div>', '<ul><li>&nbsp;Pertarungan Real-Time 5v5 di Arena MOBA</li><li>Puluhan Hero dengan Role Beragam</li><li>Gameplay Cepat dan Dinamis, 10 Menit per Match</li><li>Kontrol Sentuh yang Responsif dan Mudah Dikuasai</li><li>Mode Ranked, Classic, Brawl, dan Event Khusus</li></ul>', '<div>Genre: MOBA<br>Mode: Online Multiplayer<br>Developer: Moonton<br>Publisher: Moonton<br>Rating: Everyone 10+ (E10+)<br>Engine: Unity<br><br></div><div>System Requirements (Minimum for Android):<br><br></div><ul><li>OS: Android 5.1+</li><li>Processor: Quad-core</li><li>Memory: 2 GB RAM</li><li>Storage: 4 GB available space</li></ul>', '2016-07-01', 'Android, iOS', '<p><strong>Developer:</strong> Moonton</p><p><strong>Genre:</strong> Multiplayer Online Battle Arena (MOBA)</p><p><strong>Engine:</strong> Unity</p><p><strong>Mode:</strong> Multiplayer Online</p><p><strong>Rating:</strong> Everyone 10+</p><p><strong>Fitur Lengkap:</strong><br><strong>1.</strong> Pilih dari berbagai role: Tank, Fighter, Marksman, Mage, Assassin, dan Support.<br><strong>2.</strong> Sistem draft pick kompetitif dan rotasi hero mingguan.<br><strong>3.</strong> Mode Ranked dan sistem ban/pick untuk pengalaman kompetitif.<br><strong>4.</strong> Grafis menarik dengan skin hero eksklusif dan event kolaborasi (Star Wars, Jujutsu Kaisen, dll).<br><strong>5.</strong> Sering update patch, hero baru, dan balance gameplay untuk komunitas e-sport global.</p>', '2025-06-01 03:48:43', '2025-06-01 22:57:39'),
(6, 'Clash Of Clans', 'clash-of-clans', 2, 'mobile2.png', '<div>Clash of Clans adalah game strategi mobile yang memungkinkan pemain membangun desa, melatih pasukan, dan menyerang desa pemain lain untuk mendapatkan sumber daya. Game ini menekankan pembangunan, strategi bertahan, serta penyerangan yang terencana untuk menjadi klan terkuat.</div>', '<ul><li>Bangun dan Upgrade Desa serta Pertahanan</li><li>Latih Beragam Pasukan dengan Strategi Serangan Unik</li><li>Bergabung dalam Clan dan Ikut Clan War</li><li>Mode Builder Base dan Clan GamesEvent dan Update Berkala dari Supercell\"</li></ul>', '<div>Genre: Strategy<br>Mode: Online Multiplayer<br>Developer: Supercell<br>Publisher: Supercell<br>Rating: Everyone 10+ (E10+)<br>Engine: Proprietary<br><br></div><div>System Requirements (Minimum for Android):<br><br></div><ul><li>OS: Android 5.0+</li><li>Processor: Dual-core 1.2 GHz</li><li>Memory: 1 GB RAM</li><li>Storage: 200 MB available space</li></ul>', '2012-08-01', 'Android, iOS', '<p><strong>Developer:</strong> Supercell</p><p><strong>Genre:</strong> Strategy, Base-Building</p><p><strong>Engine:</strong> Proprietary</p><p><strong>Mode:</strong> Single-player, Multiplayer Online</p><p><strong>Rating:</strong> Everyone 10+</p><p><strong>Fitur Lengkap:</strong><br><strong>1.</strong> Bangun desa yang kokoh dengan menara, meriam, dan jebakan.<br><strong>2.</strong> Latih Barbarian, Archer, Giant, dan banyak pasukan lain dengan kemampuan unik.<br><strong>3.</strong> Gabung dalam Clan, sumbangkan pasukan, dan bertempur dalam Clan War.<br><strong>4.</strong> Eksplorasi mode Builder Base untuk pengalaman permainan kedua.<br><strong>5.</strong> Nikmati update rutin, event musiman, dan tantangan mingguan yang selalu segar.</p>', '2025-06-01 03:48:43', '2025-06-01 22:58:49'),
(7, 'PlayerUnknown\'s Battlegrounds', 'playerunknown-s-battlegrounds', 1, 'mobile3.png', '<div>PUBG: Battlegrounds adalah game battle royale yang menempatkan 100 pemain dalam sebuah pulau untuk bertarung hingga hanya satu yang bertahan. Pemain harus mencari senjata, kendaraan, dan perlengkapan sambil menghindari zona berbahaya dan menyerang lawan untuk menjadi yang terakhir hidup.</div>', '<ul><li>&nbsp;Mode Battle Royale 100 Pemain</li><li>Peta Luas dan Beragam (Erangel, Miramar, Vikendi, dll)</li><li>Permainan Realistis dengan Senjata dan Kendaraan Nyata</li><li>Solo, Duo, dan Squad Mode</li><li>Cross-Platform: PC, Console, dan Mobile</li></ul>', '<div>Genre: Battle Royale<br>Mode: Online Multiplayer<br>Developer: PUBG Studios<br>Publisher: Krafton<br>Rating: Mature (M)<br>Engine: Unreal Engine 4<br><br></div><div>System Requirements (Minimum):<br><br></div><ul><li>OS: Windows 7/8/10 64-bit</li><li>Processor: Intel Core i5-4430 / AMD FX-6300</li><li>Memory: 8 GB RAM</li><li>Graphics: NVIDIA GTX 960 / AMD Radeon R7 370</li><li>Storage: 40 GB available space<br><br></li></ul>', '2018-03-01', 'Windows, PS4, Xbox One, Android, iOS', '<p><strong>Developer:</strong> PUBG Corporation / Krafton</p><p><strong>Genre:</strong> Battle Royale, Shooter</p><p><strong>Engine:</strong> Unreal Engine 4</p><p><strong>Mode:</strong> Multiplayer Online</p><p><strong>Rating:</strong> Teen / 17+</p><p><strong>Fitur Lengkap:</strong><br><strong>1.</strong> Sistem looting yang intens dengan senjata dan attachment realistis.<br><strong>2.</strong> Kendaraan untuk menjelajahi peta atau melarikan diri dari zona berbahaya.<br><strong>3.</strong> Rank dan tier yang kompetitif, termasuk sistem royale pass di PUBG Mobile.<br><strong>4.</strong> Turnamen dan mode e-sport besar dengan hadiah miliaran.<br><strong>5.</strong> Update rutin: mode zombie, event kolaborasi, skin eksklusif, dan mode arcade.</p>', '2025-06-01 03:48:43', '2025-06-01 23:00:50'),
(8, 'Genshin Impact', 'genshin-impact', 1, 'mobile4.png', 'Genshin Impact adalah game action RPG open-world dengan sistem pertarungan berbasis elemen. Pemain menjelajahi dunia fantasi bernama Teyvat, bertemu berbagai karakter unik, memecahkan teka-teki, dan bertarung melawan musuh dalam petualanan epik yang terus berkembang.', NULL, NULL, '2020-09-01', 'Windows, Android, iOS, PlayStation 4/5', '<p><strong>Developer:</strong> HoYoverse (miHoYo)</p><p><strong>Genre:</strong> Action RPG, Open World, Gacha</p><p><strong>Engine:</strong> Unity</p><p><strong>Mode:</strong> Single-player, Co-op Multiplayer Online</p><p><strong>Rating:</strong> Teen (T)</p><p><strong>Fitur Lengkap:</strong><br><strong>1.</strong> Tujuh elemen: Anemo, Geo, Electro, Dendro, Hydro, Pyro, Cryo dengan interaksi unik.<br><strong>2.</strong> Sistem party 4 karakter dengan kombinasi skill dan elemen.<br><strong>3.</strong> Dunia Teyvat terdiri dari tujuh region besar, seperti Mondstadt, Liyue, Inazuma, Sumeru, Fontaine, dll.<br><strong>4.</strong> Sistem wish (gacha) untuk mendapatkan karakter dan senjata langka.<br><strong>5.</strong> Musik orkestra, cerita mendalam, dan grafis bergaya anime kelas atas.</p>', '2025-06-01 03:48:43', '2025-06-01 03:48:43'),
(9, 'The Greedy Foxy', 'the-greedy-foxy', 2, 'mobile5.png', 'Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', NULL, NULL, '2023-09-01', 'Windows, macOS, Linux', '<p>Community-driven development with player feedback shaping future updates.</p>', '2025-06-01 03:48:43', '2025-06-01 03:48:43'),
(10, 'Assets Games', 'assets-games', 3, 'aset1.png', 'Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', NULL, NULL, '2023-09-01', 'Windows, macOS, Linux', '<p>Community-driven development with player feedback shaping future updates.</p>', '2025-06-01 03:48:43', '2025-06-01 03:48:43'),
(11, 'Assets Games', 'assets-games-1', 3, 'aset2.png', 'Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', NULL, NULL, '2023-09-01', 'Windows, macOS, Linux', '<p>Community-driven development with player feedback shaping future updates.</p>', '2025-06-01 03:48:43', '2025-06-01 03:48:43'),
(12, 'Assets Games', 'assets-games-2', 3, 'aset3.png', 'Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', NULL, NULL, '2023-09-01', 'Windows, macOS, Linux', '<p>Community-driven development with player feedback shaping future updates.</p>', '2025-06-01 03:48:43', '2025-06-01 03:48:43'),
(13, 'Assets Games', 'assets-games-3', 3, 'aset4.png', 'Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', NULL, NULL, '2023-09-01', 'Windows, macOS, Linux', '<p>Community-driven development with player feedback shaping future updates.</p>', '2025-06-01 03:48:43', '2025-06-01 03:48:43'),
(14, 'Assets Games', 'assets-games-4', 3, 'aset5.png', 'Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', NULL, NULL, '2023-09-01', 'Windows, macOS, Linux', '<p>Community-driven development with player feedback shaping future updates.</p>', '2025-06-01 03:48:43', '2025-06-01 03:48:43'),
(15, 'Stardew Valley', 'stardew-valley', 1, 'pc.png', '<div>Stardew Valley adalah game simulasi pertanian dan kehidupan pedesaan yang memungkinkan pemain meninggalkan kehidupan kota dan memulai hidup baru di sebuah desa yang tenang. Bangun pertanian, jalin hubungan sosial, jelajahi tambang, dan rasakan pengalaman hidup damai yang penuh warna.</div>', '<ul><li>Bangun dan Kembangkan Pertanian Impianmu</li><li>Interaksi Sosial dan Pernikahan dengan Penduduk Desa</li><li>Eksplorasi Tambang dan Bertarung Melawan Monster</li><li>Kegiatan Harian seperti Memancing, Memasak, dan Berkebun</li><li>Event Musiman dan Festival Menarik</li></ul>', '<div>Genre: Simulation, RPG</div><div>Mode: Single-player, Co-op Multiplayer</div><div>Developer: ConcernedApe</div><div>Publisher: ConcernedApe</div><div>Rating: Everyone 10+ (E10+)</div><div>Engine: Microsoft XNA</div><div><br></div><div>System Requirements (Minimum):</div><div><br></div><ul><li>OS: Windows Vista or greater</li><li>Processor: 2 GHz</li><li>Memory: 2 GB RAM</li><li>Graphics: 256 MB video memory, shader model 3.0+</li><li>Storage: 500 MB available space</li></ul>', '2016-02-01', 'Windows, macOS, Linux, PS4, Xbox One, Nintendo Switch, iOS, Android', '<p><strong>Developer:</strong> ConcernedApe</p><p><strong>Genre:</strong> Simulation, RPG</p><p><strong>Engine:</strong> Microsoft XNA</p><p><strong>Mode:</strong> Single-player, Multiplayer Co-op (Online & LAN)</p><p><strong>Rating:</strong> Everyone 10+</p><p><strong>Fitur Lengkap:</strong><br><strong>1.</strong> Tanam berbagai tanaman, pelihara hewan, dan kelola ladang sesuai gaya bermainmu.<br><strong>2.</strong> Jalin hubungan dengan 30+ penduduk, menikah, bahkan memiliki anak.<br><strong>3.</strong> Masuki tambang penuh monster dan kumpulkan mineral langka.<br><strong>4.</strong> Ikuti aktivitas harian: memancing, memasak, kerajinan tangan, dan banyak lagi.<br><strong>5.</strong> Nikmati festival unik tiap musim seperti Egg Festival, Dance of the Moonlight Jellies, dll.</p>', '2025-06-01 03:48:43', '2025-06-01 22:55:16'),
(16, 'Wuthering Waves', 'wuthering-waves', 1, 'hp.png', 'Wuthering Waves adalah game action RPG dunia terbuka dengan sistem pertarungan cepat dan eksplorasi yang mendalam. Berlatar di dunia post-apocalyptic yang dipenuhi misteri dan teknologi kuno, pemain menjelajahi pemandangan indah, melawan monster, dan mengungkap rahasia masa lalu.', 'Pertarungan Aksi Cepat dan Responsif\nEksplorasi Dunia Terbuka yang Kaya dan Dinamis\nCerita yang Dalam dengan Lore Misterius\nSistem Karakter dan Resonator Unik\nGrafik Berkualitas Tinggi dengan Gaya Anime', NULL, '2024-05-01', 'Windows, Android, iOS', '<p><strong>Developer:</strong> Kuro Games</p><p><strong>Genre:</strong> Action RPG, Open World</p><p><strong>Engine:</strong> Unity</p><p><strong>Mode:</strong> Single-player (Online)</p><p><strong>Rating:</strong> Teen (T)</p><p><strong>Fitur Lengkap:</strong><br><strong>1.</strong> Pertarungan real-time dengan kombinasi kombo, dodge, dan skill ult yang sinematik.<br><strong>2.</strong> Dunia luas dengan vertikalitas tinggi, bisa panjat, meluncur, dan menggunakan grappling hook.<br><strong>3.</strong> Setiap karakter (Resonator) memiliki gaya bertarung dan lore sendiri.<br><strong>4.</strong> Sistem gacha dan progresi yang mirip Genshin Impact, namun dengan nuansa lebih gelap dan dewasa.<br><strong>5.</strong> Musik atmosferik dan cutscene yang memperkuat pengalaman imersif dalam cerita.</p>', '2025-06-01 03:48:43', '2025-06-01 03:48:43');

-- --------------------------------------------------------

--
-- Struktur dari tabel `product_images`
--

CREATE TABLE `product_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `image_url` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `product_images`
--

INSERT INTO `product_images` (`id`, `product_id`, `image_url`, `created_at`, `updated_at`) VALUES
(5, 2, 'pc2.png', '2025-06-01 03:48:43', '2025-06-01 03:48:43'),
(6, 2, 'sp1.jpg', '2025-06-01 03:48:43', '2025-06-01 03:48:43'),
(7, 2, 'sp2.jpg', '2025-06-01 03:48:43', '2025-06-01 03:48:43'),
(8, 2, 'sp3.jpg', '2025-06-01 03:48:43', '2025-06-01 03:48:43'),
(9, 3, 'pc3.jpg', '2025-06-01 03:48:43', '2025-06-01 03:48:43'),
(10, 3, 'sg1.jpg', '2025-06-01 03:48:43', '2025-06-01 03:48:43'),
(11, 3, 'sg2.png', '2025-06-01 03:48:43', '2025-06-01 03:48:43'),
(12, 3, 'sg3.png', '2025-06-01 03:48:43', '2025-06-01 03:48:43'),
(13, 4, 'pc4.png', '2025-06-01 03:48:43', '2025-06-01 03:48:43'),
(14, 4, 'sv1.jpg', '2025-06-01 03:48:43', '2025-06-01 03:48:43'),
(15, 4, 'sv3.jpg', '2025-06-01 03:48:43', '2025-06-01 03:48:43'),
(16, 4, 'sv2.png', '2025-06-01 03:48:43', '2025-06-01 03:48:43'),
(17, 5, 'mobile1.jpg', '2025-06-01 03:48:43', '2025-06-01 03:48:43'),
(18, 5, 'sm1.png', '2025-06-01 03:48:43', '2025-06-01 03:48:43'),
(19, 5, 'sm2.png', '2025-06-01 03:48:43', '2025-06-01 03:48:43'),
(20, 5, 'sm3.png', '2025-06-01 03:48:43', '2025-06-01 03:48:43'),
(21, 6, 'mobile2.png', '2025-06-01 03:48:43', '2025-06-01 03:48:43'),
(22, 6, 'sc.png', '2025-06-01 03:48:43', '2025-06-01 03:48:43'),
(23, 6, 'sc1.png', '2025-06-01 03:48:43', '2025-06-01 03:48:43'),
(24, 6, 'sc2.png', '2025-06-01 03:48:43', '2025-06-01 03:48:43'),
(25, 7, 'mobile3.png', '2025-06-01 03:48:43', '2025-06-01 03:48:43'),
(26, 7, 'spb1.png', '2025-06-01 03:48:43', '2025-06-01 03:48:43'),
(27, 7, 'spb2.png', '2025-06-01 03:48:43', '2025-06-01 03:48:43'),
(28, 7, 'spb3.png', '2025-06-01 03:48:43', '2025-06-01 03:48:43'),
(29, 8, 'mobile4.png', '2025-06-01 03:48:43', '2025-06-01 03:48:43'),
(30, 8, 'sgi1.png', '2025-06-01 03:48:43', '2025-06-01 03:48:43'),
(31, 8, 'sgi2.png', '2025-06-01 03:48:43', '2025-06-01 03:48:43'),
(32, 8, 'sgi3.png', '2025-06-01 03:48:43', '2025-06-01 03:48:43'),
(33, 9, 'mobile5.png', '2025-06-01 03:48:43', '2025-06-01 03:48:43'),
(34, 9, 'sgf1.png', '2025-06-01 03:48:43', '2025-06-01 03:48:43'),
(35, 9, 'sgf2.png', '2025-06-01 03:48:43', '2025-06-01 03:48:43'),
(36, 9, 'sgf3.png', '2025-06-01 03:48:43', '2025-06-01 03:48:43'),
(37, 10, 'aset1.png', '2025-06-01 03:48:43', '2025-06-01 03:48:43'),
(38, 10, 'aset2.jpg', '2025-06-01 03:48:43', '2025-06-01 03:48:43'),
(39, 10, 'aset3.jpg', '2025-06-01 03:48:43', '2025-06-01 03:48:43'),
(40, 10, 'aset4.jpg', '2025-06-01 03:48:43', '2025-06-01 03:48:43'),
(41, 10, 'aset5.png', '2025-06-01 03:48:43', '2025-06-01 03:48:43'),
(42, 11, 'aset1.png', '2025-06-01 03:48:43', '2025-06-01 03:48:43'),
(43, 11, 'aset2.jpg', '2025-06-01 03:48:43', '2025-06-01 03:48:43'),
(44, 11, 'aset3.jpg', '2025-06-01 03:48:43', '2025-06-01 03:48:43'),
(45, 11, 'aset4.jpg', '2025-06-01 03:48:43', '2025-06-01 03:48:43'),
(46, 11, 'aset5.png', '2025-06-01 03:48:43', '2025-06-01 03:48:43'),
(47, 12, 'aset1.png', '2025-06-01 03:48:43', '2025-06-01 03:48:43'),
(48, 12, 'aset2.jpg', '2025-06-01 03:48:43', '2025-06-01 03:48:43'),
(49, 12, 'aset3.jpg', '2025-06-01 03:48:43', '2025-06-01 03:48:43'),
(50, 12, 'aset4.jpg', '2025-06-01 03:48:43', '2025-06-01 03:48:43'),
(51, 12, 'aset5.png', '2025-06-01 03:48:43', '2025-06-01 03:48:43'),
(52, 13, 'aset1.png', '2025-06-01 03:48:43', '2025-06-01 03:48:43'),
(53, 13, 'aset2.jpg', '2025-06-01 03:48:43', '2025-06-01 03:48:43'),
(54, 13, 'aset3.jpg', '2025-06-01 03:48:43', '2025-06-01 03:48:43'),
(55, 13, 'aset4.jpg', '2025-06-01 03:48:43', '2025-06-01 03:48:43'),
(56, 13, 'aset5.png', '2025-06-01 03:48:43', '2025-06-01 03:48:43'),
(57, 14, 'aset1.png', '2025-06-01 03:48:43', '2025-06-01 03:48:43'),
(58, 14, 'aset2.jpg', '2025-06-01 03:48:43', '2025-06-01 03:48:43'),
(59, 14, 'aset3.jpg', '2025-06-01 03:48:43', '2025-06-01 03:48:43'),
(60, 14, 'aset4.jpg', '2025-06-01 03:48:43', '2025-06-01 03:48:43'),
(61, 14, 'aset5.png', '2025-06-01 03:48:43', '2025-06-01 03:48:43'),
(62, 15, 'pc.png', '2025-06-01 03:48:43', '2025-06-01 03:48:43'),
(63, 15, 'st1.png', '2025-06-01 03:48:43', '2025-06-01 03:48:43'),
(64, 15, 'st2.png', '2025-06-01 03:48:43', '2025-06-01 03:48:43'),
(65, 15, 'st3.png', '2025-06-01 03:48:43', '2025-06-01 03:48:43'),
(66, 16, 'hp.png', '2025-06-01 03:48:43', '2025-06-01 03:48:43'),
(67, 16, 'sw1.png', '2025-06-01 03:48:43', '2025-06-01 03:48:43'),
(68, 16, 'sw2.png', '2025-06-01 03:48:43', '2025-06-01 03:48:43'),
(69, 16, 'sw3.png', '2025-06-01 03:48:43', '2025-06-01 03:48:43'),
(70, 1, '6iVPgkxlIo0y1SjqH4XnBzzijFuUimRu7ya6er0l.png', '2025-06-01 03:52:19', '2025-06-01 03:52:19'),
(71, 1, 'smizTArGRp1Mr9QItxJKzkHv10aUDI8Z0laT8G0p.png', '2025-06-01 03:52:19', '2025-06-01 03:52:19'),
(72, 1, 'N25S68BjybxOwa0jOiZYhD6GgZugh8pzHquYzp8q.jpg', '2025-06-01 03:52:19', '2025-06-01 03:52:19'),
(73, 1, 'MCU6sDmez2SqI7k6CJ2IwjfkVBQJ3IBfZEcSmTHK.jpg', '2025-06-01 03:52:19', '2025-06-01 03:52:19');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('fqXw4JPuAkI6L0JxNZymEal0aQyWABg9LjEthBIy', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoidWJiZlF5Q0RuRE1VRWRiTHJjMW42VTRHMzhJWDJaaDRCRVpMUmVtRCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==', 1749177978),
('VWdsKJtx1LZKOMFe2ROjmTAtGam6QKuTSKOxMddA', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoibXlRVlJOMHRGOWppTnFCY2ZVMzFDazdhclpzSmlCUTV1ZUlyUlpLTSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDA6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9wb3J0Zm9saW8vcGFsd29ybGQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjM6InVybCI7YToxOntzOjg6ImludGVuZGVkIjtzOjMxOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvZGFzaGJvYXJkIjt9fQ==', 1749227117);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT 0,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `email_verified_at`, `password`, `is_admin`, `remember_token`, `created_at`, `updated_at`) VALUES
(4, 'MrSumping', 'mrsumping', 'gandhigunadi7@gmail.com', NULL, '$2y$12$0wzuZ4OtNZTi/O5205NtfOShoQdW2YAiV1fQICWLvNDGw2Kc9krm2', 0, NULL, '2025-06-06 08:23:57', '2025-06-06 08:23:57');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indeks untuk tabel `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indeks untuk tabel `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_name_unique` (`name`),
  ADD UNIQUE KEY `categories_slug_unique` (`slug`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indeks untuk tabel `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indeks untuk tabel `platforms`
--
ALTER TABLE `platforms`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `platforms_name_unique` (`name`),
  ADD UNIQUE KEY `platforms_slug_unique` (`slug`);

--
-- Indeks untuk tabel `platform_product`
--
ALTER TABLE `platform_product`
  ADD PRIMARY KEY (`product_id`,`platform_id`),
  ADD KEY `platform_product_platform_id_foreign` (`platform_id`);

--
-- Indeks untuk tabel `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `products_slug_unique` (`slug`);

--
-- Indeks untuk tabel `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_images_product_id_foreign` (`product_id`);

--
-- Indeks untuk tabel `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_username_unique` (`username`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `platforms`
--
ALTER TABLE `platforms`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `platform_product`
--
ALTER TABLE `platform_product`
  ADD CONSTRAINT `platform_product_platform_id_foreign` FOREIGN KEY (`platform_id`) REFERENCES `platforms` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `platform_product_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `product_images`
--
ALTER TABLE `product_images`
  ADD CONSTRAINT `product_images_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
