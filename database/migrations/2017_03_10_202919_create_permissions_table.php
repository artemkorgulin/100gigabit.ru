<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permissions', function (Blueprint $table) {
            $table->increments('id'); // идентификатор
            $table->string('name')->unique(); // имя на анг.
            $table->integer('parent'); // родитель
            $table->string('display_name')->nullable(); // Отображаемое имя
            $table->string('description')->nullable(); // описание
            $table->index('parent'); // присваиваемым индекс полю родитель
            $table->timestamps();
        });
        Schema::create('permission_user', function (Blueprint $table) {
            $table->integer('permission_id')->unsigned(); // id права
            $table->integer('user_id')->unsigned(); // id пользователя
            $table->foreign('permission_id')->references('id')->on('permissions') // устанавливаем зависимости полей
            ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->primary(['permission_id', 'user_id']); // ключи
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('permissions');
        Schema::dropIfExists('permission_user');
    }
}
