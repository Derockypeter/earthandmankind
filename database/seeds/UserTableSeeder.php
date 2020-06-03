<?php

use Illuminate\Database\Seeder;
use App\User;
class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Truncate to create fresh user
        // User::truncate();

        $admin = new User;
        $admin->firstname = 'Mankind';
        $admin->lastname = 'Organization';
        $admin->state = 'Administrative';
        $admin->country = 'Administrative';
        $admin->city = 'Administrative';
        $admin->gender = 'M';
        $admin->DOB = '1992-5-20';
        $admin->phone = '+2348027737007';
        $admin->is_admin = true;
        $admin->email = 'mankind@mail.org';
        $admin->password = bcrypt('administrative_priviledges');
        $admin->save();
        
    }
}
