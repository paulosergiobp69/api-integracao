<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterPurchaseHistOrdersAjusteSaldoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('purchase_hist_orders', function (Blueprint $table) {
            $table->integer('HRD_T012_Ajuste_Saldo')->default(0)->comment('Ajuste de Quantidade de Item de Ordem de Compra');
            $table->integer('HRD_C007_Ajuste_Saldo')->default(0)->comment('Usuario Responsavel Pelo Ajuste');
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
            $table->dropColumn('HRD_T012_Ajuste_Saldo');
            $table->dropColumn('HRD_C007_Ajuste_Saldo');
        });        
    }
}
