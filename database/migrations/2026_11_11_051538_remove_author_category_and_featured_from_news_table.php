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
        Schema::table('news', function (Blueprint $table): void {
            $table->dropForeign(['author_id']);
            $table->dropIndex(['is_featured']);
            $table->dropColumn(['author_id', 'category', 'is_featured']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('news', function (Blueprint $table): void {
            $table->foreignId('author_id')->nullable()->constrained('users')->restrictOnDelete();
            $table->string('category', 100)->nullable();
            $table->boolean('is_featured')->default(false)->index();
        });
    }
};
