<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class AlterPurchaseHistIncomingInvoiceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('purchase_hist_incoming_invoices', function (Blueprint $table) {
            $table->integer('HRD_SaldoItem')->nullable();            
            $table->string('HRD_Oculta_Coluna',1)->nullable()->comment('S => Oculta coluna Tela F3 | N => Mostra coluna Tela F3');            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('purchase_hist_incoming_invoices', function (Blueprint $table) {
            $table->integer('HRD_SaldoItem')->nullable(false)->change();
            $table->string('HRD_Oculta_coluna',1)->nullable(false)->change();
        });
    }
}
