<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Bill;
use App\Models\BillType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $billTypes = BillType::select('id')->pluck('id');
        $user = User::select('id')->where('role','user')->pluck('id');

        Bill::factory()->count(50)->create([
            'user_id'=> $user->random(),
            'type_id'=> $billTypes->random(),
        ]);
    }
}
