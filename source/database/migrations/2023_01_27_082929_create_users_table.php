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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50);
            $table->string('email');
            $table->text('password');
            $table->boolean('gender')->nullable();
            $table->timestamp('dob')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->string('phone', 10)->nullable();
            $table->string('address')->nullable();
            $table->string('remember_token')->nullable();
            $table->tinyInteger('provider')->nullable()->comment('ProviderEnum');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
