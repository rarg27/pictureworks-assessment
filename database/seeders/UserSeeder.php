<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $namePool = [
            'Juan',
            'Pedro'
        ];

        for ($i = 1; $i <= 2; $i++) {
            User::updateOrCreate([
                'id' => $i
            ], [
                'name' => $namePool[$i - 1]
            ]);
        }
    }
}
