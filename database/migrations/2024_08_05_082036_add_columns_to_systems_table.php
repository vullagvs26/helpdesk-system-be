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
            $table->string('code_name')->nullable();
            $table->string('owner')->nullable();
            $table->string('release')->nullable();
            $table->string('type')->nullable();
            $table->string('deployment')->nullable();
            $table->string('language')->nullable();
            $table->string('framework')->nullable();
            $table->string('database')->nullable();
            $table->string('support_section')->nullable();
            $table->string('support_developer')->nullable();
            $table->string('support_primary')->nullable();
            $table->string('support_secondary')->nullable();
            $table->string('support_tertiary')->nullable();
            $table->date('originay_date')->nullable();
            $table->date('portal_date')->nullable();
            $table->string('prod_path')->nullable();
            $table->string('prod_webserver')->nullable();
            $table->string('prod_database')->nullable();
            $table->string('dev_url')->nullable();
            $table->string('dev_web')->nullable();
            $table->string('dev_database')->nullable();
            $table->string('back_up_url')->nullable();
            $table->string('back_up_web')->nullable();
            $table->string('back_up_database')->nullable();
            $table->string('git_name')->nullable();
            $table->string('git_server')->nullable();
            $table->string('ssi_status')->nullable();
            $table->text('ssi_remarks')->nullable();
            $table->text('ongoing_activity')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('systems', function (Blueprint $table) {
            $table->dropColumn([
                'code_name', 'owner', 'release', 'type', 'deployment', 
                'language', 'framework', 'database', 'support_section', 'support_developer',  'support_primary', 
                'support_secondary', 'support_tertiary', 'originay_date', 'portal_date', 
                'prod_path', 'prod_webserver', 'prod_database', 'dev_url', 'dev_web', 
                'dev_database', 'back_up_url', 'back_up_web', 'back_up_database', 'git_name', 
                'git_server', 'ssi_status', 'ssi_remarks', 'ongoing_activity'
            ]);
        });
    }
};
