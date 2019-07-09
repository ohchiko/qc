<?php

use Illuminate\Database\Seeder;

class MaterialsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('materials')->insert([
            'name' => 'Kayu Jati',
            'batch' => 'MTRL0001',
            'user_id' => App\User::firstOrFail()->id,
        ]);
    }
}
