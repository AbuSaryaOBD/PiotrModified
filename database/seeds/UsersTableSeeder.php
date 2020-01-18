<?php

use App\User;
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
        $userCount = max((int)$this->command->ask('User Count : ', 20),1);
        factory(User::class)->states('obd-sar')->create();
        factory(User::class, $userCount)->create();
    }
}
