<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('capsules', function (Blueprint $table) {
            $table->string('capsule_id');
            $table->string('capsule_serial')->primary();
            $table->enum('capsule_status', ['active', 'retired', 'unknown', 'destroyed']);
            $table->dateTime('original_launch')->nullable();
            $table->unsignedBigInteger('original_launch_unix')->nullable();
            $table->integer('landings');
            $table->string('type');
            $table->text('details')->nullable();
            $table->integer('reuse_count');
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
        Schema::dropIfExists('capsules');
    }
};
