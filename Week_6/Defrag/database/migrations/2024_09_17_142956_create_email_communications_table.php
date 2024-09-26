<?php

use App\Models\communicationConfig;
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
        Schema::create('email_communications', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string("emailFrom");
            $table->string("smtpHost");
            $table->string("smtpUsername");
            $table->string("smtpPassword");
            $table->foreignIdFor(communicationConfig::class)->constrained()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('email_communications');
    }
};
