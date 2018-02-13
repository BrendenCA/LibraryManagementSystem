<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddBioDobToAuthor extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('author', function ($table) {
          $table->date('dob')->nullable();
          $table->mediumtext('bio')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::table('author', function ($table) {
        $table->dropColumn('bio');
        $table->dropColumn('dob');
      });
    }
}
