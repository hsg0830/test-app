<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNormSubContentsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('norm_sub_contents', function (Blueprint $table) {
      $table->id();
      $table->unsignedInteger('no')->comment('サブタイトルの通し番号');
      $table->string('title', 50)->comment('サブタイトル');
      $table->unsignedBigInteger('norm_article_id')->comment('メイン記事のID');
      $table->text('description')->comment('本文');
      $table->timestamps();

      $table->foreign('norm_article_id')->references('id')->on('norm_articles')->cascadeOnDelete();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('norm_sub_contents');
  }
}