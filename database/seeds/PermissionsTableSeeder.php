<?php

use Illuminate\Database\Seeder;
use App\Models\Permission;
use Illuminate\Support\Facades\DB;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permission = [
            /* client */
            [
                'name' => 'client-list',
                'parent' => '0',
                'display_name' => 'Просмотр клиента',
                'description' => ''
            ],
            /* master */
            [
                'name' => 'master-list',
                'parent' => '0',
                'display_name' => 'Просмотр мастеров',
                'description' => ''
            ],
            /* personal */
            [
                'name' => 'personal-list',
                'parent' => '0',
                'display_name' => 'Просмотр персонала',
                'description' => ''
            ],
            /* record */
            [
                'name' => 'record-list',
                'parent' => '0',
                'display_name' => 'Работа с записями',
                'description' => ''
            ],
            /* company */
            [
                'name' => 'company-list',
                'parent' => '0',
                'display_name' => 'Просмотр списка компаний',
                'description' => ''
            ],
            /* products */
            [
                'name' => 'product-management',
                'parent' => '0',
                'display_name' => 'Управление складом',
                'description' => ''
            ],
            /* metric */
            [
                'name' => 'metric-list',
                'parent' => '0',
                'display_name' => 'Просмотр статистики',
                'description' => ''
            ],
            [
                'name' => 'client-create',
                'parent' => '1',
                'display_name' => 'Создание новых клиентов',
                'description' => ''
            ],
            [
                'name' => 'client-edit',
                'parent' => '1',
                'display_name' => 'Изменение данных клиента',
                'description' => ''
            ],
            [
                'name' => 'client-copy',
                'parent' => '1',
                'display_name' => 'Выгрузка клиентской БД',
                'description' => ''
            ],
            [
                'name' => 'client-delete',
                'parent' => '1',
                'display_name' => 'Удаление клиента',
                'description' => ''
            ],
            /* master */
            [
                'name' => 'master-create',
                'parent' => '2',
                'display_name' => 'Создание мастера',
                'description' => ''
            ],
            [
                'name' => 'master-edit',
                'parent' => '2',
                'display_name' => 'Изменение данных мастера',
                'description' => ''
            ],
            [
                'name' => 'master-delete',
                'parent' => '2',
                'display_name' => 'Удаление мастера',
                'description' => ''
            ],
            /* personal */
            [
                'name' => 'personal-confirm',
                'parent' => '3',
                'display_name' => 'Подтвержать регистрацию',
                'description' => ''
            ],
            [
                'name' => 'personal-edit',
                'parent' => '3',
                'display_name' => 'Изменение данных персонала',
                'description' => ''
            ],
            [
                'name' => 'personal-delete',
                'parent' => '3',
                'display_name' => 'Удаление персонала',
                'description' => ''
            ],
            /* record */
            [
                'name' => 'record-delete',
                'parent' => '4',
                'display_name' => 'Удаление записей',
                'description' => ' '
            ],
            /* company */
            [
                'name' => 'company-create',
                'parent' => '5',
                'display_name' => 'Создание компании',
                'description' => ''
            ],
            [
                'name' => 'company-edit',
                'parent' => '5',
                'display_name' => 'Правка информации о компании',
                'description' => ''
            ],
            [
                'name' => 'company-delete',
                'parent' => '5',
                'display_name' => 'Удаление информации о компании',
                'description' => ''
            ],
            /* products */
            [
                'name' => 'product-category',
                'parent' => '6',
                'display_name' => 'Работа с категориями',
                'description' => ''
            ],
            [
                'name' => 'product-provider',
                'parent' => '6',
                'display_name' => 'Работа с поставщиками',
                'description' => ''
            ],
            [
                'name' => 'product-sale',
                'parent' => '6',
                'display_name' => 'Продажа товара',
                'description' => ''
            ],
            [
                'name' => 'product-history-sale',
                'parent' => '6',
                'display_name' => 'Просмотр истории продаж',
                'description' => ''
            ],
            [
                'name' => 'product-history',
                'parent' => '6',
                'display_name' => 'Просмотр истории',
                'description' => ''
            ],
            [
                'name' => 'product-delete',
                'parent' => '6',
                'display_name' => 'Удаление товаров',
                'description' => ''
            ]
        ];

        foreach ($permission as $key => $value) {
            Permission::create($value);
        }

    }
}