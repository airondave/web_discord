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
            ['name' => 'QRIS', 'type' => 'qr'],
            ['name' => 'GoPay', 'type' => 'gp'],
            ['name' => 'OVO', 'type' => 'ov'],
            ['name' => 'DANA', 'type' => 'dn'],
            ['name' => 'Bank Transfer', 'type' => 'bt'],
        ];

        foreach ($paymentMethods as $method) {
            PaymentMethod::create($method);
        }

        // Create Games
        $games = [
            [
                'name' => 'Valorant',
                'game_code' => 'VALORANT',
                'publisher' => 'Riot Games',
            ],
            [
                'name' => 'Genshin Impact',
                'game_code' => 'GENSHIN',
                'publisher' => 'miHoYo',
            ],
        ];

        foreach ($games as $game) {
            Game::create($game);
        }

        // Create Topup Packages for Valorant
        $valorant = Game::where('game_code', 'VALORANT')->first();
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
        $genshin = Game::where('game_code', 'GENSHIN')->first();
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

        $this->command->info('Topup data seeded successfully!');
        $this->command->info('Created ' . count($paymentMethods) . ' payment methods');
        $this->command->info('Created ' . count($games) . ' games');
        $this->command->info('Created ' . (count($valorantPackages) + count($genshinPackages)) . ' topup packages');
    }
} 