<?php

class UserTableSeeder extends Seeder {

    public function run() {
        DB::table('users')->delete();

        User::create(array(
            'id' => 1,
            'name' => 'Santiago',
            'lastname' => 'Mendoza Ramirez',
            'email' => 'santiagomendozar@gmail.com',
            'password' => Hash::make('sanmen'),
            'status' => true,
            'email_confirmation' => 'santiagomendozar@gmail.com'
        ));

        User::create(array(
            'id' => 2,
            'name' => 'Christian',
            'lastname' => 'Dachiardi Oliveros',
            'email' => 'cristianoliveros_27@hotmail.com',
            'password' => Hash::make('colombia12345'),
            'status' => true,
            'email_confirmation' => 'cristianoliveros_27@hotmail.com'
        ));
        
        User::create(array(
            'id' => 3,
            'name' => 'Belkis',
            'lastname' => 'Buelvas Castillo',
            'email' => 'belkis_buelvas06@hotmail.com',
            'password' => Hash::make('thomas4'),
            'status' => true,
            'email_confirmation' => 'belkis_buelvas06@hotmail.com'
        ));
        
        User::create(array(
            'id' => 4,
            'name' => 'Jorge',
            'lastname' => 'Llamas Olivero',
            'email' => 'jotallamas@gmail.com',
            'password' => Hash::make('12345'),
            'status' => true,
            'email_confirmation' => 'jotallamas@gmail.com'
        ));
    }

}
