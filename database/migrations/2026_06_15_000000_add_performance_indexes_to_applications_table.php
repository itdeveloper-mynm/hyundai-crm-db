<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('applications', function (Blueprint $table) {
            $table->index('deleted_at', 'applications_deleted_at_index');
            $table->index(['type', 'created_at'], 'applications_type_created_at_index');
            $table->index('updated_at', 'applications_updated_at_index');
        });
    }

    public function down(): void
    {
        Schema::table('applications', function (Blueprint $table) {
            $table->dropIndex('applications_deleted_at_index');
            $table->dropIndex('applications_type_created_at_index');
            $table->dropIndex('applications_updated_at_index');
        });
    }
};
