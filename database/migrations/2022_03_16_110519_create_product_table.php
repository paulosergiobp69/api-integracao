<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->integer('hrd_D001_Id')->comment('D001_Id');
            $table->integer('product_description_id')->comment('D001_D002_Id');
            $table->integer('product_line_id')->comment('D001_D003_Id');
            $table->integer('product_group_id')->comment('D001_D015_Id');
            $table->integer('product_utilization_id')->comment('D001_C008_Id');
            $table->string('code', 30)->comment('D001_Codigo_Produto');
            $table->string('reference', 30)->nullable()->comment('D001_Codigo_Referencia');
            $table->text('technical_data')->nullable()->comment('D001_Descricao_Produto');
            $table->string('application', 60)->nullable()->comment('D001_Aplicacao');
            $table->string('commercial_description', 60)->nullable()->comment('D001_Descricao_Comercial');
            $table->decimal('unit_weight_kg', 10, 3)->comment('D001_Peso_Unitario_Kg');
            $table->char('development_flag', 1)->default('N')->comment('D001_Flag_desenvolvimento');
            $table->date('development_date')->nullable()->comment('D001_Data_Desenvolvimento');
            $table->string('code_formatted', 20)->comment('D001_Codigo_Produto_Formatado');
            $table->string('reference_formatted', 23)->nullable()->comment('D001_Codigo_Referencia_Formatado');
            $table->string('code_redirect', 30)->nullable()->comment('D001_Codigo_Use');
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->integer('deleted_by')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->index(['code', 'reference_formatted', 'code_formatted'], 'code');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product');
    }
}
