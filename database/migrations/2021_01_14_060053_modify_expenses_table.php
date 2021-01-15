<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyExpensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('expenses', function (Blueprint $table) {
            $table->foreignId('user_id');
            $table->foreignId('project_id');
            $table->string('purchased_from');
            $table->date('purchase_date');
            $table->foreignId('category_id');
            $table->unsignedDecimal('price', 15, 2);
            $table->string('currency');
            $table->string('bill');

            $table->dropColumn('description');
            $table->dropColumn('date');
            $table->dropColumn('cost');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
