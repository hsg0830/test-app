<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNormArticlesTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('norm_articles', function (Blueprint $table) {
      $table->id();
      $table->string('title', 50)->comment('メインタイトル');
      $table->unsignedBigInteger('category_id')->comment('カテゴリーID');
      $table->text('introduction')->comment('はじめに');
      $table->timestamps();

      $table->foreign('category_id')->references('id')->on('categories');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('norm_articles');
  }
}