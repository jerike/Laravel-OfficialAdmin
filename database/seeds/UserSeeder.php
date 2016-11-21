<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder {

    public function run()
    {
        DB::table('users')->delete();

        User::create([
            'id' => 1,
            'email' => 'laid@gmail.com',
            'uid' => 151880856,
            'username' => 'laid',
            'group_id' => 1,
        ]);

        User::create([
            'id' => 2,
            'email' => 'leeam@gmail.com',
            'uid' => 171695098,
            'username' => 'amy_lee1',
            'group_id' => 1,
        ]);

        User::create([
            'id' => 3,
            'email' => 'yangje@gmail.com',
            'uid' => 170417941,
            'username' => 'jean_yang29',
            'group_id' => 1,
        ]);

        User::create([
            'id' => 4,
            'email' => 'huangar@gmail.com',
            'uid' => 182708266,
            'username' => 'aries_huang',
            'group_id' => 1,
        ]);

        User::create([
            'id' => 5,
            'email' => 'linvic@gmail.com',
            'uid' => 204347580,
            'username' => 'vicki_lin',
            'group_id' => 1,
        ]);
    }

}