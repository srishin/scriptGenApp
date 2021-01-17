<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTriggersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('triggers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('rule_id');
            $table->boolean('enable_alert')->default(false);
            $table->text('uri')->nullable();
            $table->enum('condition',['contains', 'equals','starts_with','end_with']);
            $table->timestamps();

            $table->foreign('rule_id')
                ->references('id')
                ->on('rules')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('triggers');
    }
}
