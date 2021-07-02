<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterPurchaseHistOrdersDataAjusteSaldoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('purchase_hist_orders', function (Blueprint $table) {
            $table->timestamp('HRD_T012_Data_Ajuste_Saldo')->nullable()->comment('Data de Ajuste de Saldo');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('purchase_hist_orders', function (Blueprint $table) {
            $table->dropColumn('HRD_T012_Data_Ajuste_Saldo');
        });        
    }
}
