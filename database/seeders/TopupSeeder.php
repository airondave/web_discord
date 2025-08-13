<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Game;
use App\Models\TopupPackage;
use App\Models\PaymentMethod;

class TopupSeeder extends Seeder
{
    public function run()
    {
        // Create Payment Methods
        $paymentMethods = [
            ['name' => 'QRIS', 'type' => 'qris'],
            ['name' => 'Bank Transfer', 'type' => 'bank'],
        ];

        foreach ($paymentMethods as $method) {
            PaymentMethod::create($method);
        }

        // Create Games
        $games = [
            [
                'name' => 'Valorant',
                'publisher' => 'Riot Games',
            ],
            [
                'name' => 'Genshin Impact',
                'publisher' => 'miHoYo',
            ],
            [
                'name' => 'Roblox',
                'publisher' => 'Roblox Corporation',
            ],
            [
                'name' => 'Zenless Zone Zero',
                'publisher' => 'miHoYo',
            ],
            [
                'name' => 'Mobile Legends Bang Bang',
                'publisher' => 'Moonton',
            ],
            [
                'name' => 'PUBG Mobile',
                'publisher' => 'PUBG Corporation',
            ],
            [
                'name' => 'Honkai Star Rail',
                'publisher' => 'miHoYo',
            ],
            [
                'name' => 'Free Fire',
                'publisher' => 'Garena',
            ],
            [
                'name' => 'Call of Duty Mobile',
                'publisher' => 'Activision',
            ],
            [
                'name' => 'Magic Chess Go Go',
                'publisher' => 'Moonton',
            ],
        ];

        foreach ($games as $game) {
            Game::create($game);
        }

        // Create Topup Packages for Valorant
        $valorant = Game::where('name', 'Valorant')->first();
        if ($valorant) {
            $valorantPackages = [
                ['name' => '125 VP', 'amount' => 125, 'price' => 15000],
                ['name' => '420 VP', 'amount' => 420, 'price' => 50000],
                ['name' => '700 VP', 'amount' => 700, 'price' => 80000],
                ['name' => '1375 VP', 'amount' => 1375, 'price' => 150000],
                ['name' => '2400 VP', 'amount' => 2400, 'price' => 250000],
                ['name' => '4000 VP', 'amount' => 4000, 'price' => 400000],
                ['name' => '6000 VP', 'amount' => 6000, 'price' => 600000],
            ];

            foreach ($valorantPackages as $package) {
                TopupPackage::create([
                    'game_id' => $valorant->id,
                    'name' => $package['name'],
                    'amount' => $package['amount'],
                    'price' => $package['price'],
                ]);
            }
        }

        // Create Topup Packages for Genshin Impact
        $genshin = Game::where('name', 'Genshin Impact')->first();
        if ($genshin) {
            $genshinPackages = [
                ['name' => '60 Primogems', 'amount' => 60, 'price' => 15000],
                ['name' => '300 Primogems', 'amount' => 300, 'price' => 75000],
                ['name' => '980 Primogems', 'amount' => 980, 'price' => 200000],
                ['name' => '1980 Primogems', 'amount' => 1980, 'price' => 400000],
                ['name' => '3280 Primogems', 'amount' => 3280, 'price' => 650000],
                ['name' => '6480 Primogems', 'amount' => 6480, 'price' => 1200000],
            ];

            foreach ($genshinPackages as $package) {
                TopupPackage::create([
                    'game_id' => $genshin->id,
                    'name' => $package['name'],
                    'amount' => $package['amount'],
                    'price' => $package['price'],
                ]);
            }
        }

        // Create Topup Packages for Roblox
        $roblox = Game::where('name', 'Roblox')->first();
        if ($roblox) {
            $robloxPackages = [
                ['name' => '400 Robux', 'amount' => 400, 'price' => 50000],
                ['name' => '800 Robux', 'amount' => 800, 'price' => 100000],
                ['name' => '1700 Robux', 'amount' => 1700, 'price' => 200000],
                ['name' => '2000 Robux', 'amount' => 2000, 'price' => 250000],
                ['name' => '4500 Robux', 'amount' => 4500, 'price' => 500000],
            ];

            foreach ($robloxPackages as $package) {
                TopupPackage::create([
                    'game_id' => $roblox->id,
                    'name' => $package['name'],
                    'amount' => $package['amount'],
                    'price' => $package['price'],
                ]);
            }
        }

        // Create Topup Packages for Zenless Zone Zero
        $zenless = Game::where('name', 'Zenless Zone Zero')->first();
        if ($zenless) {
            $zenlessPackages = [
                ['name' => '60 Denny', 'amount' => 60, 'price' => 15000],
                ['name' => '300 Denny', 'amount' => 300, 'price' => 75000],
                ['name' => '980 Denny', 'amount' => 980, 'price' => 200000],
                ['name' => '1980 Denny', 'amount' => 1980, 'price' => 400000],
                ['name' => '3280 Denny', 'amount' => 3280, 'price' => 650000],
            ];

            foreach ($zenlessPackages as $package) {
                TopupPackage::create([
                    'game_id' => $zenless->id,
                    'name' => $package['name'],
                    'amount' => $package['amount'],
                    'price' => $package['price'],
                ]);
            }
        }

        // Create Topup Packages for Mobile Legends
        $ml = Game::where('name', 'Mobile Legends Bang Bang')->first();
        if ($ml) {
            $mlPackages = [
                ['name' => '100 Diamonds', 'amount' => 100, 'price' => 20000],
                ['name' => '310 Diamonds', 'amount' => 310, 'price' => 50000],
                ['name' => '520 Diamonds', 'amount' => 520, 'price' => 80000],
                ['name' => '1060 Diamonds', 'amount' => 1060, 'price' => 150000],
                ['name' => '2180 Diamonds', 'amount' => 2180, 'price' => 300000],
            ];

            foreach ($mlPackages as $package) {
                TopupPackage::create([
                    'game_id' => $ml->id,
                    'name' => $package['name'],
                    'amount' => $package['amount'],
                    'price' => $package['price'],
                ]);
            }
        }

        // Create Topup Packages for PUBG Mobile
        $pubg = Game::where('name', 'PUBG Mobile')->first();
        if ($pubg) {
            $pubgPackages = [
                ['name' => '60 UC', 'amount' => 60, 'price' => 15000],
                ['name' => '325 UC', 'amount' => 325, 'price' => 75000],
                ['name' => '660 UC', 'amount' => 660, 'price' => 150000],
                ['name' => '1800 UC', 'amount' => 1800, 'price' => 400000],
                ['name' => '3850 UC', 'amount' => 3850, 'price' => 800000],
            ];

            foreach ($pubgPackages as $package) {
                TopupPackage::create([
                    'game_id' => $pubg->id,
                    'name' => $package['name'],
                    'amount' => $package['amount'],
                    'price' => $package['price'],
                ]);
            }
        }

        // Create Topup Packages for Honkai Star Rail
        $honkai = Game::where('name', 'Honkai Star Rail')->first();
        if ($honkai) {
            $honkaiPackages = [
                ['name' => '60 Stellar Jade', 'amount' => 60, 'price' => 15000],
                ['name' => '300 Stellar Jade', 'amount' => 300, 'price' => 75000],
                ['name' => '980 Stellar Jade', 'amount' => 980, 'price' => 200000],
                ['name' => '1980 Stellar Jade', 'amount' => 1980, 'price' => 400000],
                ['name' => '3280 Stellar Jade', 'amount' => 3280, 'price' => 650000],
            ];

            foreach ($honkaiPackages as $package) {
                TopupPackage::create([
                    'game_id' => $honkai->id,
                    'name' => $package['name'],
                    'amount' => $package['amount'],
                    'price' => $package['price'],
                ]);
            }
        }

        // Create Topup Packages for Free Fire
        $freefire = Game::where('name', 'Free Fire')->first();
        if ($freefire) {
            $freefirePackages = [
                ['name' => '100 Diamonds', 'amount' => 100, 'price' => 20000],
                ['name' => '310 Diamonds', 'amount' => 310, 'price' => 50000],
                ['name' => '520 Diamonds', 'amount' => 520, 'price' => 80000],
                ['name' => '1060 Diamonds', 'amount' => 1060, 'price' => 150000],
                ['name' => '2180 Diamonds', 'amount' => 2180, 'price' => 300000],
            ];

            foreach ($freefirePackages as $package) {
                TopupPackage::create([
                    'game_id' => $freefire->id,
                    'name' => $package['name'],
                    'amount' => $package['amount'],
                    'price' => $package['price'],
                ]);
            }
        }

        // Create Topup Packages for Call of Duty Mobile
        $cod = Game::where('name', 'Call of Duty Mobile')->first();
        if ($cod) {
            $codPackages = [
                ['name' => '100 CP', 'amount' => 100, 'price' => 20000],
                ['name' => '310 CP', 'amount' => 310, 'price' => 50000],
                ['name' => '520 CP', 'amount' => 520, 'price' => 80000],
                ['name' => '1060 CP', 'amount' => 1060, 'price' => 150000],
                ['name' => '2180 CP', 'amount' => 2180, 'price' => 300000],
            ];

            foreach ($codPackages as $package) {
                TopupPackage::create([
                    'game_id' => $cod->id,
                    'name' => $package['name'],
                    'amount' => $package['amount'],
                    'price' => $package['price'],
                ]);
            }
        }

        // Create Topup Packages for Magic Chess Go Go
        $magicchess = Game::where('name', 'Magic Chess Go Go')->first();
        if ($magicchess) {
            $magicchessPackages = [
                ['name' => '100 Diamonds', 'amount' => 100, 'price' => 20000],
                ['name' => '310 Diamonds', 'amount' => 310, 'price' => 50000],
                ['name' => '520 Diamonds', 'amount' => 520, 'price' => 80000],
                ['name' => '1060 Diamonds', 'amount' => 1060, 'price' => 150000],
                ['name' => '2180 Diamonds', 'amount' => 2180, 'price' => 300000],
            ];

            foreach ($magicchessPackages as $package) {
                TopupPackage::create([
                    'game_id' => $magicchess->id,
                    'name' => $package['name'],
                    'amount' => $package['amount'],
                    'price' => $package['price'],
                ]);
            }
        }

        $this->command->info('Topup data seeded successfully!');
        $this->command->info('Created ' . count($paymentMethods) . ' payment methods');
        $this->command->info('Created ' . count($games) . ' games');
        $this->command->info('Created ' . (count($valorantPackages) + count($genshinPackages) + count($robloxPackages) + count($zenlessPackages) + count($mlPackages) + count($pubgPackages) + count($honkaiPackages) + count($freefirePackages) + count($codPackages) + count($magicchessPackages)) . ' topup packages');
    }
} 