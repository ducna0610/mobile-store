<?php

use App\Enums\AdminRoleEnum;
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
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('email');
            $table->text('password');
            $table->boolean('gender')->nullable();
            $table->string('phone', 10)->nullable();
            $table->string('address')->nullable();
            $table->timestamp('dob')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->tinyInteger('role')->default(AdminRoleEnum::ADMIN)->comment('AdminRoleEnum');
            $table->string('avatar')->nullable();
            $table->string('remember_token')->nullable();
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
        Schema::dropIfExists('admins');
    }
};
