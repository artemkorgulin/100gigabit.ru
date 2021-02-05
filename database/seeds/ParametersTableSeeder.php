<?php

use Illuminate\Database\Seeder;
use App\Parameters;
use Illuminate\Support\Facades\DB;

class ParametersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $parameters = [
            [
                'title' => 'Вес',
                'unit' => 'г'
            ],
            [
                'title' => 'Ширина',
                'unit' => 'мм'
            ],
            [
                'title' => 'Высота',
                'unit' => 'мм'
            ],
            [
                'title' => 'Глубина',
                'unit' => 'мм'
            ],
            [
                'title' => 'Объем',
                'unit' => 'л'
            ],
            [
                'title' => 'Частота',
                'unit' => 'гц'
            ],
            [
                'title' => 'Объем',
                'unit' => 'мб'
            ],
            [
                'title' => 'Текст',
                'unit' => 'чх'
            ]
        ];

        foreach ($parameters as $key => $value) {
            Parameters::create($value);
        }

    }
}