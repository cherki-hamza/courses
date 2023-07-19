<?php

namespace Database\Seeders;

use App\Models\Blood;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BloodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //DB::table('Type_Blood')->delete();

        $bgs = ['O-', 'O+', 'A+', 'A-', 'B+', 'B-', 'AB+', 'AB-'];

        foreach ($bgs as  $bg) {
            Blood::create(['blod_name' => $bg]);
        }
    }
}
