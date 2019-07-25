<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            ['Administrator', 'admin@qc.loc'],
            ['Marketing', 'mkt@qc.loc'],
            ['PPIC', 'ppic@qc.loc'],
            ['Produksi', 'prd@qc.loc'],
            ['Warehouse', 'wh@qc.loc'],
        ];

        foreach ($users as $user) {
            DB::table('users')->insert([
                'name' => $user[0],
                'email' => $user[1],
                'password' => bcrypt('rahasia'),
                'api_token' => Str::random(60),
            ]);
        }
    }
}
