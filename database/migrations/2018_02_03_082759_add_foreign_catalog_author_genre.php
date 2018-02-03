<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignCatalogAuthorGenre extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('catalog', function ($table) {
        $table->foreign('authorId')->references('id')->on('author')->onDelete('cascade');
        $table->foreign('genreId')->references('id')->on('genre')->onDelete('cascade');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::table('catalog', function ($table) {
        $table->dropForeign('catalog_authorId_foreign');
        $table->dropForeign('catalog_genreId_foreign');
      });
    }
}
