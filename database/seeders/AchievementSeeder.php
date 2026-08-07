<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Achievement;

class AchievementSeeder extends Seeder
{
    public function run(): void
    {
        Achievement::truncate();

        $data = [
            // ==================== 2026 ====================
            ['year'=>2026,'tournament_name'=>'SEA Games 2026 Thailand','tournament_level'=>'Internasional','achievement_type'=>'Winner','discipline'=>'Inline Speed Skating 500m','cabang_olahraga'=>'Sepatu Roda','athlete_names'=>'Daffa Putra Ramadhan'],
            ['year'=>2026,'tournament_name'=>'SEA Games 2026 Thailand','tournament_level'=>'Internasional','achievement_type'=>'Winner','discipline'=>'Inline Speed Skating 10.000m Points Race','cabang_olahraga'=>'Sepatu Roda','athlete_names'=>'Salsabila Nur Aini'],
            ['year'=>2026,'tournament_name'=>'SEA Games 2026 Thailand','tournament_level'=>'Internasional','achievement_type'=>'Runner-Up','discipline'=>'Skateboard Park Putra','cabang_olahraga'=>'Skateboard','athlete_names'=>'Reza Firmansyah'],
            ['year'=>2026,'tournament_name'=>'SEA Games 2026 Thailand','tournament_level'=>'Internasional','achievement_type'=>'Bronze','discipline'=>'Skateboard Street Putri','cabang_olahraga'=>'Skateboard','athlete_names'=>'Ayu Kartika Dewi'],
            ['year'=>2026,'tournament_name'=>'ISF World Scooter Championship 2026','tournament_level'=>'Internasional','achievement_type'=>'Bronze','discipline'=>'Scooter Park Putra','cabang_olahraga'=>'Scooter','athlete_names'=>'Rizky Hidayat'],
            ['year'=>2026,'tournament_name'=>'Asian Roller Sports Championship 2026','tournament_level'=>'Internasional','achievement_type'=>'Winner','discipline'=>'Artistic Skating Putri','cabang_olahraga'=>'Sepatu Roda','athlete_names'=>'Nadya Prameswari'],
            ['year'=>2026,'tournament_name'=>'Asian Roller Sports Championship 2026','tournament_level'=>'Internasional','achievement_type'=>'Runner-Up','discipline'=>'Roller Hockey Putra','cabang_olahraga'=>'Sepatu Roda','athlete_names'=>'Tim Roller Hockey Putra Indonesia'],
            ['year'=>2026,'tournament_name'=>'Kejurnas PORSEROSI 2026','tournament_level'=>'Nasional','achievement_type'=>'Winner','discipline'=>'Downhill Putra','cabang_olahraga'=>'Sepatu Roda','athlete_names'=>'Bagas Tri Saputra'],
            ['year'=>2026,'tournament_name'=>'Kejurnas PORSEROSI 2026','tournament_level'=>'Nasional','achievement_type'=>'Winner','discipline'=>'Scooter Street Putra','cabang_olahraga'=>'Scooter','athlete_names'=>'Alif Maulana'],

            // ==================== 2025 ====================
            ['year'=>2025,'tournament_name'=>'World Roller Games 2025','tournament_level'=>'Internasional','achievement_type'=>'Bronze','discipline'=>'Inline Speed Skating 1000m TT','cabang_olahraga'=>'Sepatu Roda','athlete_names'=>'Daffa Putra Ramadhan'],
            ['year'=>2025,'tournament_name'=>'World Roller Games 2025','tournament_level'=>'Internasional','achievement_type'=>'Winner','discipline'=>'Artistic Skating Junior Putri','cabang_olahraga'=>'Sepatu Roda','athlete_names'=>'Tiara Anggraeni'],
            ['year'=>2025,'tournament_name'=>'Asian Skateboarding Open 2025','tournament_level'=>'Internasional','achievement_type'=>'Winner','discipline'=>'Skateboard Street Putra','cabang_olahraga'=>'Skateboard','athlete_names'=>'Andi Prasetyo'],
            ['year'=>2025,'tournament_name'=>'Asian Skateboarding Open 2025','tournament_level'=>'Internasional','achievement_type'=>'Bronze','discipline'=>'Skateboard Park Putra','cabang_olahraga'=>'Skateboard','athlete_names'=>'Reza Firmansyah'],
            ['year'=>2025,'tournament_name'=>'ISF World Scooter Championship 2025','tournament_level'=>'Internasional','achievement_type'=>'Runner-Up','discipline'=>'Scooter Park Junior Putra','cabang_olahraga'=>'Scooter','athlete_names'=>'Rizky Hidayat'],
            ['year'=>2025,'tournament_name'=>'Asian Inline & Roller Hockey Championship 2025','tournament_level'=>'Internasional','achievement_type'=>'Winner','discipline'=>'Inline Hockey Putra','cabang_olahraga'=>'Sepatu Roda','athlete_names'=>'Tim Roller Hockey Putra Indonesia'],
            ['year'=>2025,'tournament_name'=>'PON XXI 2025','tournament_level'=>'Nasional','achievement_type'=>'Winner','discipline'=>'Speed Inline 300m','cabang_olahraga'=>'Sepatu Roda','athlete_names'=>'Salsabila Nur Aini (Jawa Barat)'],
            ['year'=>2025,'tournament_name'=>'PON XXI 2025','tournament_level'=>'Nasional','achievement_type'=>'Winner','discipline'=>'Skateboard Street Putra','cabang_olahraga'=>'Skateboard','athlete_names'=>'Andi Prasetyo (DKI Jakarta)'],
            ['year'=>2025,'tournament_name'=>'PON XXI 2025','tournament_level'=>'Nasional','achievement_type'=>'Runner-Up','discipline'=>'Downhill Putra','cabang_olahraga'=>'Sepatu Roda','athlete_names'=>'Bagas Tri Saputra (Jawa Tengah)'],

            // ==================== 2024 ====================
            ['year'=>2024,'tournament_name'=>'Asian Games 2024 (Hangzhou Para)','tournament_level'=>'Internasional','achievement_type'=>'Winner','discipline'=>'Inline Speed Skating 500m Putra','cabang_olahraga'=>'Sepatu Roda','athlete_names'=>'Daffa Putra Ramadhan'],
            ['year'=>2024,'tournament_name'=>'Asian Games 2024 (Hangzhou Para)','tournament_level'=>'Internasional','achievement_type'=>'Winner','discipline'=>'Inline Speed Skating Marathon Putri','cabang_olahraga'=>'Sepatu Roda','athlete_names'=>'Salsabila Nur Aini'],
            ['year'=>2024,'tournament_name'=>'Asian Games 2024 (Hangzhou Para)','tournament_level'=>'Internasional','achievement_type'=>'Bronze','discipline'=>'Skateboard Park Putra','cabang_olahraga'=>'Skateboard','athlete_names'=>'Reza Firmansyah'],
            ['year'=>2024,'tournament_name'=>'SEA Games 2024 Vietnam','tournament_level'=>'Internasional','achievement_type'=>'Winner','discipline'=>'Artistic Skating Compulsory Putri','cabang_olahraga'=>'Sepatu Roda','athlete_names'=>'Tiara Anggraeni'],
            ['year'=>2024,'tournament_name'=>'SEA Games 2024 Vietnam','tournament_level'=>'Internasional','achievement_type'=>'Runner-Up','discipline'=>'Scooter Freestyle Park Putra','cabang_olahraga'=>'Scooter','athlete_names'=>'Alif Maulana'],
            ['year'=>2024,'tournament_name'=>'SEA Games 2024 Vietnam','tournament_level'=>'Internasional','achievement_type'=>'Bronze','discipline'=>'Roller Hockey Putri','cabang_olahraga'=>'Sepatu Roda','athlete_names'=>'Tim Roller Hockey Putri Indonesia'],
            ['year'=>2024,'tournament_name'=>'World Inline Speed Skating Championship 2024','tournament_level'=>'Internasional','achievement_type'=>'Bronze','discipline'=>'1000m Time Trial Putra','cabang_olahraga'=>'Sepatu Roda','athlete_names'=>'Daffa Putra Ramadhan'],
            ['year'=>2024,'tournament_name'=>'Kejurnas PORSEROSI 2024','tournament_level'=>'Nasional','achievement_type'=>'Winner','discipline'=>'Slalom Speed Putri','cabang_olahraga'=>'Sepatu Roda','athlete_names'=>'Aulia Rahma Sari'],

            // ==================== 2023 ====================
            ['year'=>2023,'tournament_name'=>'World Roller Games 2023 Barcelona','tournament_level'=>'Internasional','achievement_type'=>'Winner','discipline'=>'Inline Speed 500m Putra','cabang_olahraga'=>'Sepatu Roda','athlete_names'=>'Daffa Putra Ramadhan'],
            ['year'=>2023,'tournament_name'=>'World Roller Games 2023 Barcelona','tournament_level'=>'Internasional','achievement_type'=>'Runner-Up','discipline'=>'Artistic Solo Dance Putri','cabang_olahraga'=>'Sepatu Roda','athlete_names'=>'Nadya Prameswari'],
            ['year'=>2023,'tournament_name'=>'World Roller Games 2023 Barcelona','tournament_level'=>'Internasional','achievement_type'=>'Bronze','discipline'=>'Skateboard Street Putra','cabang_olahraga'=>'Skateboard','athlete_names'=>'Andi Prasetyo'],
            ['year'=>2023,'tournament_name'=>'Asian Roller Sports Championship 2023','tournament_level'=>'Internasional','achievement_type'=>'Winner','discipline'=>'Inline Speed 10.000m Points Race Putri','cabang_olahraga'=>'Sepatu Roda','athlete_names'=>'Salsabila Nur Aini'],
            ['year'=>2023,'tournament_name'=>'Asian Roller Sports Championship 2023','tournament_level'=>'Internasional','achievement_type'=>'Winner','discipline'=>'Roller Hockey Putra','cabang_olahraga'=>'Sepatu Roda','athlete_names'=>'Tim Roller Hockey Putra Indonesia'],
            ['year'=>2023,'tournament_name'=>'Asian Roller Sports Championship 2023','tournament_level'=>'Internasional','achievement_type'=>'Bronze','discipline'=>'Downhill Putra','cabang_olahraga'=>'Sepatu Roda','athlete_names'=>'Bagas Tri Saputra'],
            ['year'=>2023,'tournament_name'=>'ISF Scooter World Championship 2023','tournament_level'=>'Internasional','achievement_type'=>'Runner-Up','discipline'=>'Scooter Park Senior Putra','cabang_olahraga'=>'Scooter','athlete_names'=>'Rizky Hidayat'],
            ['year'=>2023,'tournament_name'=>'Kejurnas PORSEROSI 2023','tournament_level'=>'Nasional','achievement_type'=>'Winner','discipline'=>'Speed Skating 300m Putra','cabang_olahraga'=>'Sepatu Roda','athlete_names'=>'Daffa Putra Ramadhan'],
            ['year'=>2023,'tournament_name'=>'Kejurnas PORSEROSI 2023','tournament_level'=>'Nasional','achievement_type'=>'Winner','discipline'=>'Skateboard Park Putri','cabang_olahraga'=>'Skateboard','athlete_names'=>'Ayu Kartika Dewi'],

            // ==================== 2022 ====================
            ['year'=>2022,'tournament_name'=>'SEA Games 2022 Hanoi','tournament_level'=>'Internasional','achievement_type'=>'Winner','discipline'=>'Inline Speed 500m Putra','cabang_olahraga'=>'Sepatu Roda','athlete_names'=>'Daffa Putra Ramadhan'],
            ['year'=>2022,'tournament_name'=>'SEA Games 2022 Hanoi','tournament_level'=>'Internasional','achievement_type'=>'Winner','discipline'=>'Inline Speed 300m Putri','cabang_olahraga'=>'Sepatu Roda','athlete_names'=>'Salsabila Nur Aini'],
            ['year'=>2022,'tournament_name'=>'SEA Games 2022 Hanoi','tournament_level'=>'Internasional','achievement_type'=>'Winner','discipline'=>'Skateboard Street Putra','cabang_olahraga'=>'Skateboard','athlete_names'=>'Andi Prasetyo'],
            ['year'=>2022,'tournament_name'=>'SEA Games 2022 Hanoi','tournament_level'=>'Internasional','achievement_type'=>'Runner-Up','discipline'=>'Skateboard Park Putra','cabang_olahraga'=>'Skateboard','athlete_names'=>'Reza Firmansyah'],
            ['year'=>2022,'tournament_name'=>'SEA Games 2022 Hanoi','tournament_level'=>'Internasional','achievement_type'=>'Bronze','discipline'=>'Artistic Skating Putri','cabang_olahraga'=>'Sepatu Roda','athlete_names'=>'Tiara Anggraeni'],
            ['year'=>2022,'tournament_name'=>'SEA Games 2022 Hanoi','tournament_level'=>'Internasional','achievement_type'=>'Bronze','discipline'=>'Downhill / Slalom Putra','cabang_olahraga'=>'Sepatu Roda','athlete_names'=>'Bagas Tri Saputra'],
            ['year'=>2022,'tournament_name'=>'Asian Inline Speed Skating Championship 2022','tournament_level'=>'Internasional','achievement_type'=>'Winner','discipline'=>'10.000m Points Race Putra','cabang_olahraga'=>'Sepatu Roda','athlete_names'=>'Daffa Putra Ramadhan'],
            ['year'=>2022,'tournament_name'=>'Asian Inline Speed Skating Championship 2022','tournament_level'=>'Internasional','achievement_type'=>'Bronze','discipline'=>'Marathon Putri','cabang_olahraga'=>'Sepatu Roda','athlete_names'=>'Salsabila Nur Aini'],

            // ==================== 2021 ====================
            ['year'=>2021,'tournament_name'=>'World Inline Speed Skating Championship 2021','tournament_level'=>'Internasional','achievement_type'=>'Runner-Up','discipline'=>'500m Time Trial Putra','cabang_olahraga'=>'Sepatu Roda','athlete_names'=>'Daffa Putra Ramadhan'],
            ['year'=>2021,'tournament_name'=>'World Inline Speed Skating Championship 2021','tournament_level'=>'Internasional','achievement_type'=>'Bronze','discipline'=>'1000m Time Trial Putri','cabang_olahraga'=>'Sepatu Roda','athlete_names'=>'Salsabila Nur Aini'],
            ['year'=>2021,'tournament_name'=>'Asian Roller Sports Championship 2021','tournament_level'=>'Internasional','achievement_type'=>'Winner','discipline'=>'Artistic Compulsory Figures Putri','cabang_olahraga'=>'Sepatu Roda','athlete_names'=>'Nadya Prameswari'],
            ['year'=>2021,'tournament_name'=>'Asian Roller Sports Championship 2021','tournament_level'=>'Internasional','achievement_type'=>'Runner-Up','discipline'=>'Roller Hockey Putra','cabang_olahraga'=>'Sepatu Roda','athlete_names'=>'Tim Roller Hockey Putra Indonesia'],
            ['year'=>2021,'tournament_name'=>'PON XX Papua 2021','tournament_level'=>'Nasional','achievement_type'=>'Winner','discipline'=>'Speed 300m Putra','cabang_olahraga'=>'Sepatu Roda','athlete_names'=>'Daffa Putra Ramadhan (Jawa Barat)'],
            ['year'=>2021,'tournament_name'=>'PON XX Papua 2021','tournament_level'=>'Nasional','achievement_type'=>'Winner','discipline'=>'Skateboard Street Putra','cabang_olahraga'=>'Skateboard','athlete_names'=>'Andi Prasetyo (DKI Jakarta)'],
            ['year'=>2021,'tournament_name'=>'PON XX Papua 2021','tournament_level'=>'Nasional','achievement_type'=>'Runner-Up','discipline'=>'Artistic Skating Putri','cabang_olahraga'=>'Sepatu Roda','athlete_names'=>'Tiara Anggraeni (Jawa Timur)'],

            // ==================== 2020 ====================
            ['year'=>2020,'tournament_name'=>'Asian Inline Speed Skating Championship 2020','tournament_level'=>'Internasional','achievement_type'=>'Winner','discipline'=>'10.000m Points Race Putra','cabang_olahraga'=>'Sepatu Roda','athlete_names'=>'Daffa Putra Ramadhan'],
            ['year'=>2020,'tournament_name'=>'Asian Inline Speed Skating Championship 2020','tournament_level'=>'Internasional','achievement_type'=>'Runner-Up','discipline'=>'500m Sprint Putri','cabang_olahraga'=>'Sepatu Roda','athlete_names'=>'Salsabila Nur Aini'],
            ['year'=>2020,'tournament_name'=>'Asian Artistic Skating Championship 2020','tournament_level'=>'Internasional','achievement_type'=>'Winner','discipline'=>'Solo Dance Putri','cabang_olahraga'=>'Sepatu Roda','athlete_names'=>'Nadya Prameswari'],
            ['year'=>2020,'tournament_name'=>'Asian Artistic Skating Championship 2020','tournament_level'=>'Internasional','achievement_type'=>'Bronze','discipline'=>'Compulsory Figures Putra','cabang_olahraga'=>'Sepatu Roda','athlete_names'=>'Kevin Andriansyah'],
            ['year'=>2020,'tournament_name'=>'Kejurnas PORSEROSI 2020 (Online)','tournament_level'=>'Nasional','achievement_type'=>'Winner','discipline'=>'Slalom Speed 6 Cones Putra','cabang_olahraga'=>'Sepatu Roda','athlete_names'=>'Bagas Tri Saputra'],

            // ==================== 2019 ====================
            ['year'=>2019,'tournament_name'=>'SEA Games 2019 Filipina','tournament_level'=>'Internasional','achievement_type'=>'Winner','discipline'=>'Inline Speed 500m Putra','cabang_olahraga'=>'Sepatu Roda','athlete_names'=>'Daffa Putra Ramadhan'],
            ['year'=>2019,'tournament_name'=>'SEA Games 2019 Filipina','tournament_level'=>'Internasional','achievement_type'=>'Winner','discipline'=>'Inline Speed 1000m Putri','cabang_olahraga'=>'Sepatu Roda','athlete_names'=>'Salsabila Nur Aini'],
            ['year'=>2019,'tournament_name'=>'SEA Games 2019 Filipina','tournament_level'=>'Internasional','achievement_type'=>'Runner-Up','discipline'=>'Artistic Figures Putri','cabang_olahraga'=>'Sepatu Roda','athlete_names'=>'Tiara Anggraeni'],
            ['year'=>2019,'tournament_name'=>'SEA Games 2019 Filipina','tournament_level'=>'Internasional','achievement_type'=>'Bronze','discipline'=>'Roller Hockey Putra','cabang_olahraga'=>'Sepatu Roda','athlete_names'=>'Tim Roller Hockey Putra Indonesia'],
            ['year'=>2019,'tournament_name'=>'World Roller Games 2019 Barcelona','tournament_level'=>'Internasional','achievement_type'=>'Bronze','discipline'=>'Inline Speed 500m Putra','cabang_olahraga'=>'Sepatu Roda','athlete_names'=>'Daffa Putra Ramadhan'],
            ['year'=>2019,'tournament_name'=>'World Roller Games 2019 Barcelona','tournament_level'=>'Internasional','achievement_type'=>'Runner-Up','discipline'=>'Artistic Free Skating Putri','cabang_olahraga'=>'Sepatu Roda','athlete_names'=>'Nadya Prameswari'],
            ['year'=>2019,'tournament_name'=>'Asian Roller Sports Championship 2019','tournament_level'=>'Internasional','achievement_type'=>'Winner','discipline'=>'10.000m Points Race Putra','cabang_olahraga'=>'Sepatu Roda','athlete_names'=>'Daffa Putra Ramadhan'],
            ['year'=>2019,'tournament_name'=>'Kejurnas PORSEROSI 2019','tournament_level'=>'Nasional','achievement_type'=>'Winner','discipline'=>'Speed Inline 300m Putra','cabang_olahraga'=>'Sepatu Roda','athlete_names'=>'Daffa Putra Ramadhan'],
            ['year'=>2019,'tournament_name'=>'Kejurnas PORSEROSI 2019','tournament_level'=>'Nasional','achievement_type'=>'Winner','discipline'=>'Downhill Putra','cabang_olahraga'=>'Sepatu Roda','athlete_names'=>'Bagas Tri Saputra'],

            // ==================== 2018 ====================
            ['year'=>2018,'tournament_name'=>'Asian Games 2018 Jakarta-Palembang','tournament_level'=>'Internasional','achievement_type'=>'Winner','discipline'=>'Inline Speed 500m Putra','cabang_olahraga'=>'Sepatu Roda','athlete_names'=>'Daffa Putra Ramadhan'],
            ['year'=>2018,'tournament_name'=>'Asian Games 2018 Jakarta-Palembang','tournament_level'=>'Internasional','achievement_type'=>'Winner','discipline'=>'Inline Speed 1000m Putri','cabang_olahraga'=>'Sepatu Roda','athlete_names'=>'Salsabila Nur Aini'],
            ['year'=>2018,'tournament_name'=>'Asian Games 2018 Jakarta-Palembang','tournament_level'=>'Internasional','achievement_type'=>'Winner','discipline'=>'Inline Speed 10.000m Points Race Putra','cabang_olahraga'=>'Sepatu Roda','athlete_names'=>'Daffa Putra Ramadhan'],
            ['year'=>2018,'tournament_name'=>'Asian Games 2018 Jakarta-Palembang','tournament_level'=>'Internasional','achievement_type'=>'Runner-Up','discipline'=>'Artistic Skating Free Putri','cabang_olahraga'=>'Sepatu Roda','athlete_names'=>'Tiara Anggraeni'],
            ['year'=>2018,'tournament_name'=>'Asian Games 2018 Jakarta-Palembang','tournament_level'=>'Internasional','achievement_type'=>'Bronze','discipline'=>'Roller Hockey Putra','cabang_olahraga'=>'Sepatu Roda','athlete_names'=>'Tim Roller Hockey Putra Indonesia'],
            ['year'=>2018,'tournament_name'=>'World Inline Speed Skating Championship 2018','tournament_level'=>'Internasional','achievement_type'=>'Winner','discipline'=>'500m Time Trial Putra','cabang_olahraga'=>'Sepatu Roda','athlete_names'=>'Daffa Putra Ramadhan'],
            ['year'=>2018,'tournament_name'=>'World Inline Speed Skating Championship 2018','tournament_level'=>'Internasional','achievement_type'=>'Bronze','discipline'=>'Marathon Putri','cabang_olahraga'=>'Sepatu Roda','athlete_names'=>'Salsabila Nur Aini'],
            ['year'=>2018,'tournament_name'=>'Asian Skateboarding Championship 2018','tournament_level'=>'Internasional','achievement_type'=>'Winner','discipline'=>'Skateboard Street Putra','cabang_olahraga'=>'Skateboard','athlete_names'=>'Andi Prasetyo'],
            ['year'=>2018,'tournament_name'=>'Asian Skateboarding Championship 2018','tournament_level'=>'Internasional','achievement_type'=>'Bronze','discipline'=>'Skateboard Park Putri','cabang_olahraga'=>'Skateboard','athlete_names'=>'Ayu Kartika Dewi'],
            ['year'=>2018,'tournament_name'=>'PON XIX 2018 Jawa Barat','tournament_level'=>'Nasional','achievement_type'=>'Winner','discipline'=>'Speed Inline 300m Putra','cabang_olahraga'=>'Sepatu Roda','athlete_names'=>'Daffa Putra Ramadhan (Jawa Barat)'],
            ['year'=>2018,'tournament_name'=>'PON XIX 2018 Jawa Barat','tournament_level'=>'Nasional','achievement_type'=>'Winner','discipline'=>'Artistic Skating Putri','cabang_olahraga'=>'Sepatu Roda','athlete_names'=>'Tiara Anggraeni (Jawa Timur)'],
        ];

        foreach ($data as $item) {
            Achievement::create($item);
        }
    }
}
