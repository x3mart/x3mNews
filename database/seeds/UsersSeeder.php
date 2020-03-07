<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert($this->getData());
    }

    protected function getData()
    {
        $data[] = [
            'name' => "123",
            'email' => "123@mail.ru",
            'email_verified_at' => now(),
            'password' => Hash::make('123'),
            'remember_token' => Str::random(10),
            'is_admin' => 1
        ];
        for ($i=1; $i < 5; $i++) {
            $data[] = [
                'name' => "123{$i}",
                'email' => "123{$i}@mail.ru",
                'email_verified_at' => now(),
                'password' => Hash::make('123'), //123
                'remember_token' => Str::random(10),
                'is_admin' => 0
            ];
        }
        return $data;
    }
}
