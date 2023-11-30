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
        Schema::create('tots_user', function (Blueprint $table) {
            $table->id();
            $table->string('firstname', 100)->nullable(true);
            $table->string('lastname', 100)->nullable(true);
            $table->string('email', 250)->nullable(false)->unique();
            $table->text('photo')->nullable(true);
            $table->string('phone', 50)->nullable(true);
            $table->tinyInteger('role')->nullable(false)->default(0);
            $table->string('password')->nullable(true);
            $table->tinyInteger('status')->nullable(false)->default(0);
            $table->tinyInteger('is_notification')->nullable(false)->default(0);
            $table->text('caption')->nullable(true);
            $table->string('timezone', 10)->nullable(true);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tots_user');
    }
};
