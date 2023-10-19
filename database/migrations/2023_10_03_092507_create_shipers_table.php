<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('shipers', function (Blueprint $table) {
            $table->id();
            $table->string("fullname");
            $table->string("username");
            $table->string("password");
            $table->string("email");
            $table->string("phone");
            $table->date("birthDay");
            $table->boolean("gender");
            $table->string("address");

            $table->boolean("status");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shipers');
    }
};
