<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserTableSeeder::class);

        DB::table('users')->delete();


        DB::table('users')->insert([
            'name' => "Gregoire Meylan",
            'email' => 'gmeylan@gmail.com',
            'password' => bcrypt('test'), //fonction de chiffrage. Bcrypt plus difficle en brutforce
            'bookmarks' => '[{id:"root", value:"Cars", open:true, data:[{ id:"1", open:true, value:"Toyota", data:[{ id:"1.1", value:"Avalon" },{ id:"1.2", value:"Corolla" },{ id:"1.3", value:"Camry" }]},{ id:"2", value:"Skoda", open:true, data:[{ id:"2.1", value:"Octavia" },{ id:"2.2", value:"Superb" }]}]}]'
        ]);

        DB::table('users')->insert([
            'name' => "Toto Titi",
            'email' => 'a@a.com',
            'password' => bcrypt('test'), //fonction de chiffrage. Bcrypt plus difficle en brutforce
        ]);
        DB::table('users')->insert([
            'name' => "Toto Titi",
            'email' => 'blahblahblah@blahblahblah.com',
            'password' => bcrypt('test'), //fonction de chiffrage. Bcrypt plus difficle en brutforce
        ]);

    }
}
