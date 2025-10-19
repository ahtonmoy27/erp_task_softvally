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
        Schema::table('users', function (Blueprint $table) {
            $table->string('role')->after('email')->default('user');
            $table->foreignId('department_id')->nullable()->constrained('departments')->nullOnDelete()->after('role');
            $table->boolean('is_on_leave')->default(false)->after('department_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
             $table->dropForeign(['department_id']);
            $table->dropColumn(['role', 'department_id', 'is_on_leave']);
        });
    }
};
