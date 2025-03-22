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
    Schema::create('responses', function (Blueprint $table) {
        $table->id();
        $table->text('content');
        $table->foreignId('ticket_id')->constrained();
        $table->foreignId('user_id')->constrained();
        $table->timestamp('edited_at')->nullable();
        $table->foreignId('edited_by')->nullable()->constrained('users');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('responses');
    }
};
