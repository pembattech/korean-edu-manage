<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('students', function (Blueprint $table) {
        $table->decimal('total_amount_to_pay', 10, 2)->default(0);
    });
}

public function down()
{
    Schema::table('students', function (Blueprint $table) {
        $table->dropColumn('total_amount_to_pay');
    });
}

};
