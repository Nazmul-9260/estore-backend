<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class HousekeepingTruncateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //

        // Schema::disableForeignKeyConstraints();
        // Permission::truncate();
        // Schema::enableForeignKeyConstraints();

        // Production DB Update Workaround supports all
        // Schema::disableForeignKeyConstraints();
        // DB::table('permissions')->truncate();
        // Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
