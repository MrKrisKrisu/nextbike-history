<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBikeStatesTable extends Migration {

    public function up(): void {
        Schema::create('bike_states', function(Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('bike_id');
            $table->decimal('latitude', 9, 6);
            $table->decimal('longitude', 9, 6);
            $table->boolean('active');
            $table->string('state');
            $table->timestamps();

            $table->foreign('bike_id')
                  ->references('id')
                  ->on('bikes');
        });
    }

    public function down(): void {
        Schema::dropIfExists('bike_states');
    }
}
