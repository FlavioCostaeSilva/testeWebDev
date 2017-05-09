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
        DB::table('products')->insert([
            'lm' => 1001,
            'name' => 'Furadeira X',
            'category' => 'Ferramentas',
            'free_shipping' => '0',
            'description' => 'Furadeira eficiente X',
            'price' => '1586.00',
        ]);

        DB::table('products')->insert([
            'lm' => 1002,
            'name' => 'Furadeira Y',
            'category' => 'Ferramentas',
            'free_shipping' => '1',
            'description' => 'Furadeira super eficiente Y',
            'price' => '78.00',
        ]);
    }
}
