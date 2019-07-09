<?php

use Illuminate\Database\Seeder;

class WorksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('works')->insert([
            'batch' => 'WO0001',
            'purchase_id' => App\Purchase::firstOrFail()->id,
            'description' => '3x Rumah Kayu',
            'user_id' => App\User::firstOrFail()->id,
        ]);
    }
}
