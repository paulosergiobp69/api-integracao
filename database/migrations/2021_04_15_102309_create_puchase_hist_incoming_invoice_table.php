<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreatePuchaseHistIncomingInvoiceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_hist_incoming_invoices', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('PHO_Id');
            $table->foreign('PHO_Id')->references('id')->on('purchase_hist_orders')->onDelete('restrict');
            $table->integer('HRD_T014_Id')->index();
            $table->integer('HRD_Quantidade')->nullable();
            $table->decimal('HRD_Valor_Custo_Unitario', 17, 5)->nullable();
            $table->string('HRD_Flag_Cancelado',1)->nullable()->comment('S => SIM CANCELADA | N => NAO CANCELADA')->index('flag_index');
            $table->timestamp('HRD_Data_Lancamento')->nullable()->comment('Data de entrada nf compra')->index('in_nfe_date_index');
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->integer('deleted_by')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
          
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('purchase_hist_incoming_invoices');
    }
}
