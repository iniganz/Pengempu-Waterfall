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
        Schema::table('tickets', function (Blueprint $table) {
            // Kolom untuk tracking siapa yang validate
            $table->unsignedBigInteger('validated_by')->nullable()->after('used_at');
            $table->timestamp('validated_at')->nullable()->after('validated_by');
            $table->integer('scan_count')->default(0)->after('validated_at'); // Hitung berapa kali di-scan

            // Foreign key untuk user yang validate
            $table->foreign('validated_by')->references('id')->on('users')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tickets', function (Blueprint $table) {
            $table->dropForeign(['validated_by']);
            $table->dropColumn(['validated_by', 'validated_at', 'scan_count']);
        });
    }
};
