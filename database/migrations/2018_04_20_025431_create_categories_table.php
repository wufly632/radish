<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title',255)->unique()->comment('分类的标题');
            $table->string('name',255)->unique()->comment('分类的名称');
            $table->string('name_en',255)->unique()->comment('分类的名称-英文');
            $table->integer('parent_id')->comment('分类的父id');
            $table->integer('sort')->default(100)->comment("排序");
            $table->tinyInteger('is_show')->default(1)->comment("是否显示 1-显示 0-隐藏");
            $table->string('icon',50)->comment("字体图标");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
    }
}
