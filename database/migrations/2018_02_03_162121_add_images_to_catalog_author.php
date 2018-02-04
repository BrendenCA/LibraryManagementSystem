<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddImagesToCatalogAuthor extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('catalog', function ($table) {
        $table->string('image');
      });

      Schema::table('author', function ($table) {
        $table->string('image');
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
        $table->dropColumn('image');
      });

      Schema::table('author', function ($table) {
        $table->dropColumn('image');
      });
    }
}
