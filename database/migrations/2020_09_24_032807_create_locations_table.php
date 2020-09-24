<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('locations', function (Blueprint $table) {
            $table->increments('locations_id');
            $table->string('locations_name');
            $table->text('locations_address');
            $table->string('locations_phone', 30)->nullable();
            $table->string('locations_email', 100)->nullable();
            $table->float('locations_latitude', 10, 6)->nullable();
            $table->float('locations_longitude', 10, 6)->nullable();
            $table->timestamp('locations_created_at')->useCurrent();
            $table->timestamp('locations_updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'))->nullable();
            $table->softDeletes('locations_deleted_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('locations');
    }
}
