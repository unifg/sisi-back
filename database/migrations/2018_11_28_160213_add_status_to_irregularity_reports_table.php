<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddStatusToIrregularityReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('irregularity_reports', function (Blueprint $table) {
            $table->enum('status', ['NOVO', 'EM INVESTIGACAO', 'CONCLUIDO', 'ARQUIVADA'])->default('NOVO');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('irregularity_reports', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
}
