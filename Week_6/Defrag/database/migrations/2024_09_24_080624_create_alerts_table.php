<?php

use App\Models\cameraConfig;
use App\Models\objectConfig;
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
        Schema::create('alerts', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(cameraConfig::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(objectConfig::class)->constrained()->cascadeOnDelete();
            $table->string("orgImageUrl");
            $table->string("imageUrl");
            $table->float("conf");
            $table->text("description");
            $table->string("status")->default("pending");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alerts');
    }
};
