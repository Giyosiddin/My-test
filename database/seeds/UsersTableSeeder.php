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
        $data = [
            [
                'name' => 'Автор не изветен',
                'email' => 'author_g@m.ru',
                'password' => bcrypt(str_random(16)),
            ],
            [
                'name' => 'Автор',
                'email' => 'author1@m.ru',
                'password' => bcrypt('123456'),
            ],
        ];

        DB::table('users')->insert($data);
    }
}
