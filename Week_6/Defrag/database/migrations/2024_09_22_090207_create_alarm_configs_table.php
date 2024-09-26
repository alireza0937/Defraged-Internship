<?php

use App\Models\communicationConfig;
use App\Models\GroupConfig;
use App\Models\objectConfig;
use App\Models\User;
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
        Schema::create('alarm_configs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('group_id')->constrained('group_configs')->cascadeOnDelete();
            $table->foreignId('alarm_type_id')->constrained('communication_configs')->cascadeOnDelete();
            $table->foreignId('object_id')->constrained('object_configs')->cascadeOnDelete();;
            $table->foreignIdFor(User::class)->constrained()->cascadeOnDelete();
            $table->string('alarm_name');
            $table->float('treshhold')->unsigned()->check('treshhold <= 100');
            $table->string('subject');
            $table->text('description');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alarm_configs');
    }
};
