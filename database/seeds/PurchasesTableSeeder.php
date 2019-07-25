<?php

use Illuminate\Database\Seeder;

class PurchasesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('purchases')->insert([
            'batch' => 'PO0001',
            'cust_name' => 'PT. Wood Log Indonesia',
            'description' => 'Permintaan Rumah Kayu sebanyak 3 buah',
            'user_id' => App\User::firstOrFail()->id,
        ]);
    }
}
