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
        Schema::table('systems', function (Blueprint $table) {
            $table->unsignedBigInteger('developer_id')->nullable()->after('id'); 
            $table->foreign('developer_id')
                ->references('id')
                ->on('developers')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('systems', function (Blueprint $table) {
            $table->dropForeign(['developer_id']); 
            $table->dropColumn('developer_id'); 
        });
    }
};
