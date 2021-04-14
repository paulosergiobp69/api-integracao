<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;


class CreatePurchaseHistOrders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        ini_set('memory_limit', '2048'); 
        
        Schema::create('purchase_hist_orders', function (Blueprint $table) {
            $table->id();
            $table->integer('HRD_T011_Id')->index();
            $table->integer('HRD_T012_Id')->index();
            $table->integer('HRD_T012_D009_Id')->index();
            $table->integer('HRD_T011_C007_Id')->index();
            $table->integer('HRD_T011_C004_Id')->index();
            $table->integer('HRD_T012_Quantidade')->nullable();
            $table->integer('HRD_Quantidade_Pac')->nullable();
            $table->integer('HRD_Saldo')->nullable();
            $table->decimal('HRD_T012_Valor_Custo_Unitario', 17, 2)->nullable();
            $table->string('HRD_Status')->nullable()->comment('1 => CADASTRADO | 2 => ESTOQUE | 3 => VENDIDO | 4 => DEVOLVIDO | 5 => EXCLUIDO | 6 => TRANSFERIDO | 7 => PRÉ-VENDA')->index('status_index');
            $table->timestamp('HRD_Data_Lancamento')->nullable()->comment('Data de geracao da oredem')->index('in_orders_date_index');
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->integer('deleted_by')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });

        echo "Tabela Criada \n";
       
        $limit = 3000;
        $count = DB::connection('E003')->table('VIEW_LARA_OC_HIST')->count();
        $count = ceil($count / $limit);
        echo "Count Executado: $count \n";
        
        for ($i = 0; $i < $count; $i++) {                    
            $results = DB::connection('E003')->table('VIEW_LARA_OC_HIST AS v')->select([
                'v.T011_Id AS HRD_T011_Id',
                'v.T012_D009_Id AS HRD_T012_D009_Id',
                'v.T012_Id AS HRD_T012_Id',
                'v.T011_C007_Id AS HRD_T011_C007_Id',
                'v.T011_C004_Id AS HRD_T011_C004_Id',
                'v.T012_Quantidade AS HRD_T012_Quantidade',
                'v.T012_Valor_Custo_Unitario AS HRD_T012_Valor_Custo_Unitario',
                'v.T011_Flag_Cancelada AS HRD_Status',
                'v.T011_Data_Emissao AS HRD_Data_Lancamento'
            ])
//            ->where('T012_Flag_Integrado','N')
            ->orderBy('v.T011_Id', 'asc')
            ->limit($limit)
            ->offset($limit * $i)
            ->get();
            
            echo "       Select $i executado \n";
            
            $data = [];
            foreach ($results as $result) {
                $data[] = [
                    'HRD_T011_Id' => $result->HRD_T011_Id,
                    'HRD_T012_Id' => $result->HRD_T012_Id,
                    'HRD_T012_D009_Id' => $result->HRD_T012_D009_Id,
                    'HRD_T011_C007_Id' => $result->HRD_T011_C007_Id,
                    'HRD_T011_C004_Id' => $result->HRD_T011_C004_Id,
                    'HRD_T012_Quantidade' => $result->HRD_T012_Quantidade,
                    'HRD_T012_Valor_Custo_Unitario' => $result->HRD_T012_Valor_Custo_Unitario,
                    'HRD_Status' => $result->HRD_Status,
                    'HRD_Data_Lancamento' => $result->HRD_Data_Lancamento,
                    'created_at' => date('Y-m-d H:i:s'),
                    'created_by' => 1
                ];
            }

            $partialData = array_chunk($data, 1000, true);
            foreach ($partialData as $value) {
                try
                {
                    DB::table('purchase_hist_orders')->insert($value);

/*                  A atualização foi bloqueada pois em simulação o tempo do processamento de 812.668 registros era de 1:15:00 com a atualização durante a carga de migration, 
                    sem 00:07:00 , e a atualização via query 00:00:15, justificando a atualização posterior.

                    foreach($value as $registro){
                        DB::connection('E003')->table('T012')
                                            ->where('T012_T011_Id', $registro['HRD_T011_Id'])
                                            ->where('T012_Id', $registro['HRD_T012_Id'])
                                            ->update(array('T012_Flag_Integrado' => 'S')); 
                    }*/
                }
                catch(Exception $e)
                {
                    echo $e->getMessage();
                }

            }
            
            echo "       Insert $i executado \n";
        }
             

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('purchase_hist_orders');
    }
}
