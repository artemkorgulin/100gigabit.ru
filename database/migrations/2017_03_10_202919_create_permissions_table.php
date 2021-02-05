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
            $table->increments('id'); // �������������
            $table->string('name')->unique(); // ��� �� ���.
            $table->integer('parent'); // ��������
            $table->string('display_name')->nullable(); // ������������ ���
            $table->string('description')->nullable(); // ��������
            $table->index('parent'); // ������������� ������ ���� ��������
            $table->timestamps();
        });
        Schema::create('permission_user', function (Blueprint $table) {
            $table->integer('permission_id')->unsigned(); // id �����
            $table->integer('user_id')->unsigned(); // id ������������
            $table->foreign('permission_id')->references('id')->on('permissions') // ������������� ����������� �����
            ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->primary(['permission_id', 'user_id']); // �����
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
