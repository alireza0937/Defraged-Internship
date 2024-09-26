<?php

use App\Models\cameraConfig;
use App\Models\GroupConfig;
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
        Schema::create('group_cameras', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(GroupConfig::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(cameraConfig::class)->unique()->constrained()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('group_cameras');
    }
};
