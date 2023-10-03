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
        Schema::create('review_shipers', function (Blueprint $table) {
            $table->id();
            $table->integer('idShiper');
            $table->integer('idCustomer');
            $table->string('idContent');
            $table->integer('quanlity');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('review_shipers');
    }
};
