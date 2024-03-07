<?php

use Spatie\MediaLibrary\HasMedia;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration implements HasMedia
{
    use InteractsWithMedia;
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('galleries', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('galleries');
    }
};
