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
        Schema::create('types', function (Blueprint $table) {
            $table->id();
            $table->integer('ram');
            $table->integer('disk');
            $table->integer('pin');
            $table->string('chip');
            $table->double('price');
            $table->string('color', 50);
            $table->integer('quantity')->default(0);
            $table->integer('sold')->default(0);
            $table->foreignId('product_id')->constrained();
            $table->softDeletes();
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
        Schema::dropIfExists('types');
    }
};
