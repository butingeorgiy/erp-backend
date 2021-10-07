<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CitiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cities')->insert([
            [
                'name' => 'Алматы',
                'country_id' => 1
            ],
            [
                'name' => 'Нур-Султан',
                'country_id' => 1
            ],
            [
                'name' => 'Шымкент',
                'country_id' => 1
            ],
            [
                'name' => 'Актобе',
                'country_id' => 1
            ],
            [
                'name' => 'Караганда',
                'country_id' => 1
            ],
            [
                'name' => 'Тараз',
                'country_id' => 1
            ],
            [
                'name' => 'Павлодар',
                'country_id' => 1
            ],
            [
                'name' => 'Усть-Каменогорск',
                'country_id' => 1
            ],
            [
                'name' => 'Семей',
                'country_id' => 1
            ],
            [
                'name' => 'Атырау',
                'country_id' => 1
            ],
            [
                'name' => 'Костанай',
                'country_id' => 1
            ],
            [
                'name' => 'Кызылорда',
                'country_id' => 1
            ],
            [
                'name' => 'Уральск',
                'country_id' => 1
            ],
            [
                'name' => 'Петропавловск',
                'country_id' => 1
            ],
            [
                'name' => 'Темиртау',
                'country_id' => 1
            ],
            [
                'name' => 'Актау',
                'country_id' => 1
            ],
            [
                'name' => 'Туркестан',
                'country_id' => 1
            ],
            [
                'name' => 'Кокшетау',
                'country_id' => 1
            ],
            [
                'name' => 'Талдыкорган',
                'country_id' => 1
            ],
            [
                'name' => 'Экибастуз',
                'country_id' => 1
            ],
            [
                'name' => 'Рудный',
                'country_id' => 1
            ]
        ]);
    }
}
