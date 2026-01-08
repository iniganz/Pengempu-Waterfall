<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Support\Str;
use App\Models\ProductImage;
use App\Models\ProductFeature;
use Illuminate\Database\Seeder;
use App\Models\ProductDescription;

class ProductSeeder extends Seeder
{
    public function run()
    {
        // 1. Sea Of Thieves
        $product = Product::create([
            'title' => 'Sea Of Thieves',
            'slug' => Str::slug('Sea Of Thieves'),
            'category_id' => '1',
            'image' => 'pc1.jpg',
            'description' => "Ahoy, matey! Sea of Thieves adalah game petualangan bajak laut multiplayer dunia terbuka yang dikembangkan oleh Rare dan diterbitkan oleh Xbox Game Studios. Pemain menjelajahi lautan luas, mencari harta karun, bertarung melawan monster laut, dan menghadapi bajak laut lainnya dalam dunia yang penuh kejutan dan misteri.",
            'date' => '2018-03-20',
            'platform' => 'Steam, Epic Games, Xbox Game Pass',
            'additional_info' => "<p>Genre: Action-Adventure, Multiplayer<br> Mode: Online Multiplayer (PvE dan PvP)<br> Developer: Rare <br>Publisher: Xbox Game Studios<br> Rating: Teen (T) <br>Engine: Unreal Engine 4. <br></p><p>System Requirements (Minimum):<br><ul><li>OS: Windows 10 64-bit</li><li>Processor: Intel Q9450 @ 2.6GHz or AMD Phenom II X6 @ 3.3 GHz</li><li>Memory: 4 GB RAM</li><li>Graphics: Nvidia GeForce GTX 650 or AMD Radeon 7750</li><li>Storage: 50 GB available space</li></ul></p>",
        ]);

        // Features
        $features = [
            "Co-op Multiplayer Adventure",
            "Shared Open World",
            "Customization and Progression"
        ];

        foreach ($features as $feature) {
            ProductFeature::create([
                'product_id' => $product->id,
                'feature' => $feature
            ]);
        }

        // Descriptions
        $descriptions = [
            "Bermain bersama teman sebagai kru kapal bajak laut dan bekerja sama untuk menavigasi, bertempur, dan mencari harta karun.",
            "Dunia laut luas dengan pemain lain yang saling berinteraksi dalam waktu nyata, menciptakan pengalaman tak terduga setiap saat.",
            "Kostumisasi karakter, kapal, dan senjata sesuai gaya bermainmu. Raih pencapaian dan reputasi melalui fraksi dan aliansi."
        ];

        foreach ($descriptions as $desc) {
            ProductDescription::create([
                'product_id' => $product->id,
                'deskripsi' => $desc
            ]);
        }

        // Images
        $images = [
            'pc1.jpg',
            'ss1.png',
            'ss2.jpg',
            'ss3.jpg'
        ];

        foreach ($images as $img) {
            ProductImage::create([
                'product_id' => $product->id,
                'image_url' => $img
            ]);
        }
        // Palworld
        $product = Product::create([
            'title' => 'Palworld',
            'slug' => Str::slug('Palworld'),
            'category_id' => '1',
            'image' => 'pc2.png',
            'description' => "Palworld adalah game aksi-petualangan dunia terbuka di mana kamu bisa menjelajahi dunia yang penuh dengan makhluk misterius bernama 'Pals'. Tidak hanya bertarung bersama mereka, kamu juga bisa bertani, membangun pabrik, dan menggunakan senjata api dalam petualangan bertahan hidup yang unik.",
            'date' => '2024-01-01',
            'platform' => 'Windows, Xbox Series X/S',
            'additional_info' => "<p><strong>Developer:</strong> Pocketpair</p><p><strong>Genre:</strong> Action-Adventure, Open World Survival</p><p><strong>Engine:</strong> Unreal Engine</p><p><strong>Mode:</strong> Single-player, Online Co-op, PvP</p><p><strong>Rating:</strong> Teen (T)</p><p><strong>Fitur Lengkap:</strong><br><strong>1.</strong> Tangkap makhluk unik bernama Pals, dan gunakan mereka dalam pertempuran atau pekerjaan sehari-hari.<br><strong>2.</strong> Kumpulkan sumber daya dan bangun tempat tinggal untuk bertahan hidup dari berbagai ancaman.<br><strong>3.</strong> Kelola industri dan crafting dengan bantuan Pals untuk menghasilkan senjata dan alat penting.<br><strong>4.</strong> Jelajahi berbagai bioma dan dungeon yang tersebar di dunia terbuka.<br><strong>5.</strong> Bermain bersama teman atau bertarung melawan pemain lain secara online.</p>",
        ]);

        $features = [
            "Tangkap dan Bertarung Bersama Pals",
            "Bangun Dunia dan Bertahan Hidup",
            "Crafting dan Industri",
            "Eksplorasi Dunia Terbuka",
            "Multiplayer Co-op dan PvP"
        ];

        foreach ($features as $f) {
            ProductFeature::create([
                'product_id' => $product->id,
                'feature' => $f
            ]);
        }

        $descriptions = [
            "Jelajahi dunia terbuka penuh misteri bersama makhluk bernama Pals.",
            "Bertani, membangun, dan bertahan hidup dari berbagai ancaman.",
            "Gunakan senjata api dan kemampuan Pals untuk eksplorasi lebih jauh."
        ];

        foreach ($descriptions as $d) {
            ProductDescription::create([
                'product_id' => $product->id,
                'deskripsi' => $d
            ]);
        }

        $images = [
            'pc2.png',
            'sp1.jpg',
            'sp2.jpg',
            'sp3.jpg'
        ];

        foreach ($images as $img) {
            ProductImage::create([
                'product_id' => $product->id,
                'image_url' => $img
            ]);
        }


        // Grand Theft Auto V
        $product = Product::create([
            'title' => 'Grand Theft Auto V',
            'slug' => Str::slug('Grand Theft Auto V'),
            'category_id' => '1',
            'image' => 'pc3.jpg',
            'description' => "Grand Theft Auto V (GTA V) adalah game aksi-petualangan dunia terbuka yang menempatkan pemain di kota fiktif Los Santos. Dengan tiga karakter utama yang bisa dimainkan, game ini menawarkan cerita yang kompleks, dunia yang sangat luas, dan kebebasan eksplorasi yang hampir tak terbatas.",
            'date' => '2015-04-01',
            'platform' => "Windows, PS3, PS4, PS5, Xbox 360, Xbox One, Xbox Series X/S",
            'additional_info' => "<p><strong>Developer:</strong> Rockstar Games</p><p><strong>Genre:</strong> Action-Adventure, Open World</p><p><strong>Engine:</strong> RAGE (Rockstar Advanced Game Engine)</p><p><strong>Mode:</strong> Single-player, Multiplayer Online</p><p><strong>Rating:</strong> Mature 17+</p><p><strong>Fitur Lengkap:</strong><br><strong>1.</strong> Mainkan tiga tokoh unik: Michael, Franklin, dan Trevor dengan latar belakang dan kemampuan berbeda.<br><strong>2.</strong> Dunia terbuka Los Santos dan Blaine County dengan berbagai aktivitas sampingan dan rahasia.<br><strong>3.</strong> Misi heist dan aksi kriminal bergaya film Hollywood.<br><strong>4.</strong> GTA Online: dunia daring dengan misi, balapan, bisnis, dan komunitas pemain yang luas.<br><strong>5.</strong> Grafis ultra realistik dengan dukungan 4K dan first-person mode (di versi PC & konsol terbaru).</p>",
        ]);

        $features = [
            "Tiga Karakter Utama yang Bisa Diganti",
            "Dunia Terbuka yang Sangat Luas dan Hidup",
            "Misi Cerita Sinematik dan Menegangkan",
            "Mode Online Multiplayer (GTA Online)",
            "Kostumisasi Karakter, Kendaraan, dan Senjata"
        ];

        foreach ($features as $f) {
            ProductFeature::create([
                'product_id' => $product->id,
                'feature' => $f
            ]);
        }

        $descriptions = [
            "Mainkan tiga karakter unik: Michael, Franklin, dan Trevor.",
            "Dunia terbuka Los Santos yang penuh dengan aktivitas dan rahasia.",
            "Grafis ultra realistis dan dukungan 4K pada versi PC."
        ];

        foreach ($descriptions as $d) {
            ProductDescription::create([
                'product_id' => $product->id,
                'deskripsi' => $d
            ]);
        }

        $images = [
            'pc3.jpg',
            'sg1.jpg',
            'sg2.png',
            'sg3.png'
        ];

        foreach ($images as $img) {
            ProductImage::create([
                'product_id' => $product->id,
                'image_url' => $img
            ]);
        }


        // Valorant
        $product = Product::create([
            'title' => 'Valorant',
            'slug' => Str::slug('Valorant'),
            'category_id' => '1',
            'image' => 'pc4.png',
            'description' => "Valorant adalah game tactical shooter berbasis tim dari Riot Games yang menggabungkan aksi tembak-menembak bergaya CS:GO dengan kemampuan unik ala hero shooter. Pemain bertanding dalam dua tim, menyerang atau bertahan, sambil memanfaatkan kemampuan agen untuk mengontrol medan tempur.",
            'date' => '2020-06-01',
            'platform' => 'Windows',
            'additional_info' => "<p><strong>Developer:</strong> Riot Games</p><p><strong>Genre:</strong> Tactical Shooter, First-Person</p><p><strong>Engine:</strong> Unreal Engine 4</p><p><strong>Mode:</strong> Multiplayer Online</p><p><strong>Rating:</strong> Teen (T)</p><p><strong>Fitur Lengkap:</strong><br><strong>1.</strong> 5 lawan 5 dalam mode Plant/Defuse dengan sistem ronde.<br><strong>2.</strong> Pilih dari berbagai 'Agen' dengan kemampuan unik: smoke, flash, trap, teleport, dll.<br><strong>3.</strong> Kombinasikan aim presisi dan penggunaan ability untuk meraih kemenangan.<br><strong>4.</strong> Map beragam dengan titik kontrol strategis dan choke points.<br><strong>5.</strong> Kompetitif dan e-sport ready dengan mode Ranked, Tournament, dan Anti-Cheat Vanguard.</p>",
        ]);

        $features = [
            "Pertempuran 5v5 dengan Mode Defuse Bomb",
            "Beragam Agen dengan Kemampuan Unik",
            "Strategi Taktikal dan Kerja Sama Tim",
            "Peta dengan Desain Kompetitif",
            "Grafis Ringan dan Performa Stabil"
        ];

        foreach ($features as $f) {
            ProductFeature::create([
                'product_id' => $product->id,
                'feature' => $f
            ]);
        }

        $descriptions = [
            "Gameplay 5v5 dengan sistem defuse bomb seperti CS:GO.",
            "Setiap agen memiliki skill unik untuk kontrol area.",
            "Didesain untuk kompetisi esports profesional."
        ];

        foreach ($descriptions as $d) {
            ProductDescription::create([
                'product_id' => $product->id,
                'deskripsi' => $d
            ]);
        }

        $images = [
            'pc4.png',
            'sv1.jpg',
            'sv3.jpg',
            'sv2.png'
        ];

        foreach ($images as $img) {
            ProductImage::create([
                'product_id' => $product->id,
                'image_url' => $img
            ]);
        }


        // Mobile Legends: Bang Bang
        $product = Product::create([
            'title' => 'Mobile Legends: Bang Bang',
            'slug' => Str::slug('Mobile Legends: Bang Bang'),
            'category_id' => '2',
            'image' => 'mobile1.jpg',
            'description' => "Mobile Legends: Bang Bang adalah game MOBA 5v5 populer di platform mobile yang menekankan kerja sama tim, strategi, dan refleks cepat. Pemain memilih hero dengan peran berbeda untuk bertempur dalam arena dan menghancurkan turret musuh demi meraih kemenangan.",
            'date' => '2016-07-01',
            'platform' => 'Android, iOS',
            'additional_info' => "<p><strong>Developer:</strong> Moonton</p><p><strong>Genre:</strong> Multiplayer Online Battle Arena (MOBA)</p><p><strong>Engine:</strong> Unity</p><p><strong>Mode:</strong> Multiplayer Online</p><p><strong>Rating:</strong> Everyone 10+</p><p><strong>Fitur Lengkap:</strong><br><strong>1.</strong> Pilih dari berbagai role: Tank, Fighter, Marksman, Mage, Assassin, dan Support.<br><strong>2.</strong> Sistem draft pick kompetitif dan rotasi hero mingguan.<br><strong>3.</strong> Mode Ranked dan sistem ban/pick untuk pengalaman kompetitif.<br><strong>4.</strong> Grafis menarik dengan skin hero eksklusif dan event kolaborasi (Star Wars, Jujutsu Kaisen, dll).<br><strong>5.</strong> Sering update patch, hero baru, dan balance gameplay untuk komunitas e-sport global.</p>",
        ]);

        $features = [
            "Pertarungan Real-Time 5v5 di Arena MOBA",
            "Puluhan Hero dengan Role Beragam",
            "Gameplay Cepat dan Dinamis, 10 Menit per Match",
            "Kontrol Sentuh yang Responsif dan Mudah Dikuasai",
            "Mode Ranked, Classic, Brawl, dan Event Khusus"
        ];

        foreach ($features as $f) {
            ProductFeature::create([
                'product_id' => $product->id,
                'feature' => $f
            ]);
        }

        $descriptions = [
            "Game MOBA 5v5 untuk platform mobile dengan kontrol intuitif.",
            "Pilih hero sesuai role: Tank, Assassin, Mage, dll.",
            "Sistem ranked dan tournament mendukung scene esports."
        ];

        foreach ($descriptions as $d) {
            ProductDescription::create([
                'product_id' => $product->id,
                'deskripsi' => $d
            ]);
        }

        $images = [
            'mobile1.jpg',
            'sm1.png',
            'sm2.png',
            'sm3.png'
        ];

        foreach ($images as $img) {
            ProductImage::create([
                'product_id' => $product->id,
                'image_url' => $img
            ]);
        }
        // 6. Clash of Clans
        $product = Product::create([
            'title' => 'Clash Of Clans',
            'slug' => Str::slug('Clash Of Clans'),
            'category_id' => '2',
            'image' => 'mobile2.png',
            'description' => "Clash of Clans adalah game strategi mobile yang memungkinkan pemain membangun desa, melatih pasukan, dan menyerang desa pemain lain untuk mendapatkan sumber daya. Game ini menekankan pembangunan, strategi bertahan, serta penyerangan yang terencana untuk menjadi klan terkuat.",
            'date' => '2012-08-01',
            'platform' => 'Android, iOS',
            'additional_info' => "<p><strong>Developer:</strong> Supercell</p><p><strong>Genre:</strong> Strategy, Base-Building</p><p><strong>Engine:</strong> Proprietary</p><p><strong>Mode:</strong> Single-player, Multiplayer Online</p><p><strong>Rating:</strong> Everyone 10+</p><p><strong>Fitur Lengkap:</strong><br><strong>1.</strong> Bangun desa yang kokoh dengan menara, meriam, dan jebakan.<br><strong>2.</strong> Latih Barbarian, Archer, Giant, dan banyak pasukan lain dengan kemampuan unik.<br><strong>3.</strong> Gabung dalam Clan, sumbangkan pasukan, dan bertempur dalam Clan War.<br><strong>4.</strong> Eksplorasi mode Builder Base untuk pengalaman permainan kedua.<br><strong>5.</strong> Nikmati update rutin, event musiman, dan tantangan mingguan yang selalu segar.</p>",
        ]);

        foreach ([
            "Bangun dan Upgrade Desa serta Pertahanan",
            "Latih Beragam Pasukan dengan Strategi Serangan Unik",
            "Bergabung dalam Clan dan Ikut Clan War",
            "Mode Builder Base dan Clan Games",
            "Event dan Update Berkala dari Supercell"
        ] as $feature) {
            ProductFeature::create(['product_id' => $product->id, 'feature' => $feature]);
        }

        foreach ([
            "Bangun desa yang kokoh dan pertahankan dari serangan.",
            "Gabung dalam Clan untuk berbagi strategi dan pasukan.",
            "Raih kemenangan dalam Clan War dengan kerja sama tim."
        ] as $deskripsi) {
            ProductDescription::create(['product_id' => $product->id, 'deskripsi' => $deskripsi]);
        }

        foreach (['mobile2.png', 'sc.png', 'sc1.png', 'sc2.png'] as $img) {
            ProductImage::create(['product_id' => $product->id, 'image_url' => $img]);
        }


        // 7. PUBG Mobile
        $product = Product::create([
            'title' => 'PlayerUnknown\'s Battlegrounds Mobile',
            'slug' => Str::slug('PlayerUnknown\'s Battlegrounds Mobile'),
            'category_id' => '2',
            'image' => 'mobile3.png',
            'description' => "PUBG: Battlegrounds adalah game battle royale yang menempatkan 100 pemain dalam sebuah pulau untuk bertarung hingga hanya satu yang bertahan. Pemain harus mencari senjata, kendaraan, dan perlengkapan sambil menghindari zona berbahaya dan menyerang lawan untuk menjadi yang terakhir hidup.",
            'date' => '2018-03-01',
            'platform' => 'Windows, PS4, Xbox One, Android, iOS',
            'additional_info' => "<p><strong>Developer:</strong> PUBG Corporation / Krafton</p><p><strong>Genre:</strong> Battle Royale, Shooter</p><p><strong>Engine:</strong> Unreal Engine 4</p><p><strong>Mode:</strong> Multiplayer Online</p><p><strong>Rating:</strong> Teen / 17+</p><p><strong>Fitur Lengkap:</strong><br><strong>1.</strong> Sistem looting yang intens dengan senjata dan attachment realistis.<br><strong>2.</strong> Kendaraan untuk menjelajahi peta atau melarikan diri dari zona berbahaya.<br><strong>3.</strong> Rank dan tier yang kompetitif, termasuk sistem royale pass di PUBG Mobile.<br><strong>4.</strong> Turnamen dan mode e-sport besar dengan hadiah miliaran.<br><strong>5.</strong> Update rutin: mode zombie, event kolaborasi, skin eksklusif, dan mode arcade.</p>",
        ]);

        foreach ([
            "Mode Battle Royale 100 Pemain",
            "Peta Luas dan Beragam (Erangel, Miramar, Vikendi, dll)",
            "Permainan Realistis dengan Senjata dan Kendaraan Nyata",
            "Solo, Duo, dan Squad Mode",
            "Cross-Platform: PC, Console, dan Mobile"
        ] as $feature) {
            ProductFeature::create(['product_id' => $product->id, 'feature' => $feature]);
        }

        foreach ([
            "Bertarung hingga satu pemain tersisa di medan tempur.",
            "Gunakan kendaraan untuk melintasi peta luas.",
            "Naikkan rank dan ikuti turnamen profesional PUBG."
        ] as $deskripsi) {
            ProductDescription::create(['product_id' => $product->id, 'deskripsi' => $deskripsi]);
        }

        foreach (['mobile3.png', 'spb1.png', 'spb2.png', 'spb3.png'] as $img) {
            ProductImage::create(['product_id' => $product->id, 'image_url' => $img]);
        }


        // 8. Genshin Impact
        $product = Product::create([
            'title' => 'Genshin Impact',
            'slug' => Str::slug('Genshin Impact'),
            'category_id' => '1',
            'image' => 'mobile4.png',
            'description' => "Genshin Impact adalah game action RPG open-world dengan sistem pertarungan berbasis elemen. Pemain menjelajahi dunia fantasi bernama Teyvat, bertemu berbagai karakter unik, memecahkan teka-teki, dan bertarung melawan musuh dalam petualanan epik yang terus berkembang.",
            'date' => '2020-09-01',
            'platform' => 'Windows, Android, iOS, PlayStation 4/5',
            'additional_info' => "<p><strong>Developer:</strong> HoYoverse (miHoYo)</p><p><strong>Genre:</strong> Action RPG, Open World, Gacha</p><p><strong>Engine:</strong> Unity</p><p><strong>Mode:</strong> Single-player, Co-op Multiplayer Online</p><p><strong>Rating:</strong> Teen (T)</p><p><strong>Fitur Lengkap:</strong><br><strong>1.</strong> Tujuh elemen: Anemo, Geo, Electro, Dendro, Hydro, Pyro, Cryo dengan interaksi unik.<br><strong>2.</strong> Sistem party 4 karakter dengan kombinasi skill dan elemen.<br><strong>3.</strong> Dunia Teyvat terdiri dari tujuh region besar, seperti Mondstadt, Liyue, Inazuma, Sumeru, Fontaine, dll.<br><strong>4.</strong> Sistem wish (gacha) untuk mendapatkan karakter dan senjata langka.<br><strong>5.</strong> Musik orkestra, cerita mendalam, dan grafis bergaya anime kelas atas.</p>",
        ]);

        foreach ([
            "Eksplorasi Dunia Terbuka yang Luas dan Indah",
            "Sistem Pertarungan Elemen dan Tim Karakter",
            "Puluhan Karakter Playable dengan Cerita Masing-Masing",
            "Event Musiman dan Update Berkala",
            "Cross-Platform (PC, Mobile, PlayStation)"
        ] as $feature) {
            ProductFeature::create(['product_id' => $product->id, 'feature' => $feature]);
        }

        foreach ([
            "Jelajahi dunia Teyvat dengan karakter-karakter unik.",
            "Kombinasikan elemen untuk efek pertarungan yang maksimal.",
            "Ikuti event musiman dan dapatkan hadiah eksklusif."
        ] as $deskripsi) {
            ProductDescription::create(['product_id' => $product->id, 'deskripsi' => $deskripsi]);
        }

        foreach (['mobile4.png', 'sgi1.png', 'sgi2.png', 'sgi3.png'] as $img) {
            ProductImage::create(['product_id' => $product->id, 'image_url' => $img]);
        }

        // 9. The Greedy Foxy
        $product = Product::create([
            'title' => 'The Greedy Foxy',
            'slug' => Str::slug('The Greedy Foxy'),
            'category_id' => '2',
            'image' => 'mobile5.png',
            'description' => "Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.",
            'date' => '2023-09-01',
            'platform' => 'Windows, macOS, Linux',
            'additional_info' => "<p>Community-driven development with player feedback shaping future updates.</p>",
        ]);

        foreach (["Strategy gameplay", "Online leaderboards", "Regular updates"] as $feature) {
            ProductFeature::create(['product_id' => $product->id, 'feature' => $feature]);
        }

        foreach (["Mainkan game strategi dengan leaderboard online.", "Ikuti pembaruan rutin dari developer."] as $deskripsi) {
            ProductDescription::create(['product_id' => $product->id, 'deskripsi' => $deskripsi]);
        }

        foreach (['mobile5.png', 'sgf1.png', 'sgf2.png', 'sgf3.png'] as $img) {
            ProductImage::create(['product_id' => $product->id, 'image_url' => $img]);
        }


        // 10-14. Assets Games (Berulang)
        for ($i = 10; $i <= 14; $i++) {
            $num = $i - 9;
            $product = Product::create([
                'title' => 'Assets Games',
                'slug' => Str::slug("Assets Games $num"),
                'category_id' => '3',
                'image' => "aset$num.png",
                'description' => "Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.",
                'date' => '2023-09-01',
                'platform' => 'Windows, macOS, Linux',
                'additional_info' => "<p>Community-driven development with player feedback shaping future updates.</p>",
            ]);

            foreach (["Strategy gameplay", "Online leaderboards", "Regular updates"] as $feature) {
                ProductFeature::create(['product_id' => $product->id, 'feature' => $feature]);
            }

            foreach (["Game strategi dengan fitur leaderboard online.", "Update rutin berdasarkan umpan balik komunitas."] as $deskripsi) {
                ProductDescription::create(['product_id' => $product->id, 'deskripsi' => $deskripsi]);
            }

            $images = [
                "aset1.png", "aset2.jpg", "aset3.jpg", "aset4.jpg", "aset5.png"
            ];
            foreach ($images as $img) {
                ProductImage::create(['product_id' => $product->id, 'image_url' => $img]);
            }
        }

        // 15. Stardew Valley
        $product = Product::create([
            'title' => 'Stardew Valley',
            'slug' => Str::slug('Stardew Valley'),
            'category_id' => '1',
            'image' => 'pc.png',
            'description' => "Stardew Valley adalah game simulasi pertanian dan kehidupan pedesaan yang memungkinkan pemain meninggalkan kehidupan kota dan memulai hidup baru di sebuah desa yang tenang. Bangun pertanian, jalin hubungan sosial, jelajahi tambang, dan rasakan pengalaman hidup damai yang penuh warna.",
            'date' => '2016-02-01',
            'platform' => 'Windows, macOS, Linux, PS4, Xbox One, Nintendo Switch, iOS, Android',
            'additional_info' => "<p><strong>Developer:</strong> ConcernedApe</p><p><strong>Genre:</strong> Simulation, RPG</p><p><strong>Engine:</strong> Microsoft XNA</p><p><strong>Mode:</strong> Single-player, Multiplayer Co-op (Online & LAN)</p><p><strong>Rating:</strong> Everyone 10+</p><p><strong>Fitur Lengkap:</strong><br><strong>1.</strong> Tanam berbagai tanaman, pelihara hewan, dan kelola ladang sesuai gaya bermainmu.<br><strong>2.</strong> Jalin hubungan dengan 30+ penduduk, menikah, bahkan memiliki anak.<br><strong>3.</strong> Masuki tambang penuh monster dan kumpulkan mineral langka.<br><strong>4.</strong> Ikuti aktivitas harian: memancing, memasak, kerajinan tangan, dan banyak lagi.<br><strong>5.</strong> Nikmati festival unik tiap musim seperti Egg Festival, Dance of the Moonlight Jellies, dll.</p>",
        ]);

        foreach ([
            "Bangun dan Kembangkan Pertanian Impianmu",
            "Interaksi Sosial dan Pernikahan dengan Penduduk Desa",
            "Eksplorasi Tambang dan Bertarung Melawan Monster",
            "Kegiatan Harian seperti Memancing, Memasak, dan Berkebun",
            "Event Musiman dan Festival Menarik"
        ] as $feature) {
            ProductFeature::create(['product_id' => $product->id, 'feature' => $feature]);
        }

        foreach ([
            "Kelola pertanian dan bangun hidup baru di desa.",
            "Berteman dan menikah dengan warga desa.",
            "Ikuti festival musiman dan acara tradisional."
        ] as $deskripsi) {
            ProductDescription::create(['product_id' => $product->id, 'deskripsi' => $deskripsi]);
        }

        foreach (['pc.png', 'st1.png', 'st2.png', 'st3.png'] as $img) {
            ProductImage::create(['product_id' => $product->id, 'image_url' => $img]);
        }

        // 16. Wuthering Waves
        $product = Product::create([
            'title' => 'Wuthering Waves',
            'slug' => Str::slug('Wuthering Waves'),
            'category_id' => '1',
            'image' => 'hp.png',
            'description' => "Wuthering Waves adalah game action RPG dunia terbuka dengan sistem pertarungan cepat dan eksplorasi yang mendalam. Berlatar di dunia post-apocalyptic yang dipenuhi misteri dan teknologi kuno, pemain menjelajahi pemandangan indah, melawan monster, dan mengungkap rahasia masa lalu.",
            'date' => '2024-05-01',
            'platform' => 'Windows, Android, iOS',
            'additional_info' => "<p><strong>Developer:</strong> Kuro Games</p><p><strong>Genre:</strong> Action RPG, Open World</p><p><strong>Engine:</strong> Unity</p><p><strong>Mode:</strong> Single-player (Online)</p><p><strong>Rating:</strong> Teen (T)</p><p><strong>Fitur Lengkap:</strong><br><strong>1.</strong> Pertarungan real-time dengan kombinasi kombo, dodge, dan skill ult yang sinematik.<br><strong>2.</strong> Dunia luas dengan vertikalitas tinggi, bisa panjat, meluncur, dan menggunakan grappling hook.<br><strong>3.</strong> Setiap karakter (Resonator) memiliki gaya bertarung dan lore sendiri.<br><strong>4.</strong> Sistem gacha dan progresi yang mirip Genshin Impact, namun dengan nuansa lebih gelap dan dewasa.<br><strong>5.</strong> Musik atmosferik dan cutscene yang memperkuat pengalaman imersif dalam cerita.</p>",
        ]);

        foreach ([
            "Pertarungan Aksi Cepat dan Responsif",
            "Eksplorasi Dunia Terbuka yang Kaya dan Dinamis",
            "Cerita yang Dalam dengan Lore Misterius",
            "Sistem Karakter dan Resonator Unik",
            "Grafik Berkualitas Tinggi dengan Gaya Anime"
        ] as $feature) {
            ProductFeature::create(['product_id' => $product->id, 'feature' => $feature]);
        }

        foreach ([
            "Bertarung dengan sistem pertarungan responsif dan dinamis.",
            "Eksplorasi dunia dengan vertikalitas tinggi.",
            "Temui karakter unik dengan alur cerita mendalam."
        ] as $deskripsi) {
            ProductDescription::create(['product_id' => $product->id, 'deskripsi' => $deskripsi]);
        }

        foreach (['hp.png', 'sw1.png', 'sw2.png', 'sw3.png'] as $img) {
            ProductImage::create(['product_id' => $product->id, 'image_url' => $img]);
        }
    }

}
