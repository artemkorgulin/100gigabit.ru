<?php

use Illuminate\Database\Seeder;
use App\Statuses;
use Illuminate\Support\Facades\DB;

class StatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $statuses = [
            /* client */
            [
                'name' => 'Оформлен',
                'status_id' => '1',

            ],
            /* master */
            [
                'name' => 'Принят',
                'status_id' => '2',
            ],
            /* personal */
            [
                'name' => 'Обрабатывается',
                'status_id' => '3',
            ],
            /* record */
            [
                'name' => 'Выгружен из 1С',
                'status_id' => '4',
            ],
            /* company */
            [
                'name' => 'Оплачен',
                'status_id' => '5',
            ],
            /* products */
            [
                'name' => 'Загрузка',
                'status_id' => '6',
            ],
            /* metric */
            [
                'name' => 'Доставлен',
                'status_id' => '7',
            ],
            [
                'name' => 'Отгружен',
                'status_id' => '8',
            ]
        ];

        foreach ($statuses as $key => $value) {
            Statuses::create($value);
        }

    }
}