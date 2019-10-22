<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class UserTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();

        User::create([
            'name'  => 'nilton',
            'email' => 'email@email.com',
            'password' => bcrypt(12345678),
            'dados_pessoais_id' => 1,
            'perfil_id' => 1
        ]);
    }
}
