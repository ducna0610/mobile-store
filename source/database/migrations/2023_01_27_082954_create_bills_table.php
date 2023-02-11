<?php

use App\Enums\StatusOrderEnum;
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
        Schema::create('bills', function (Blueprint $table) {
            $table->id();
            $table->string('name_receiver');
            $table->string('phone_receiver');
            $table->string('address_receiver');
            $table->double('total_price');
            $table->string('note')->nullable();
            $table->tinyInteger('status')->default(StatusOrderEnum::SPENDING)->comment('StatusOrderEnum');
            $table->foreignId('user_id')->constrained();
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
        Schema::dropIfExists('bills');
    }
};
