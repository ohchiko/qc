<?php

use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            'batch' => 'PRD0001',
            'name' => 'Rumah Kayu',
            'user_id' => App\User::firstOrFail()->id,
        ]);
    }
}
