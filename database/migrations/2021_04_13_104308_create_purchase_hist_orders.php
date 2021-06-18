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
            $table->decimal('HRD_T012_Valor_Custo_Unitario', 17, 5)->nullable();
            $table->string('HRD_Status',1)->nullable()->comment('S => SIM CANCELADA | N => NAO CANCELADA')->index('status_index');
            $table->string('HRD_Nac_Imp',1)->nullable()->comment('N => NACIONAL | I => IMPORTADO')->index('nac_imp_index');
            $table->timestamp('HRD_Data_Lancamento')->nullable()->comment('Data de geracao da oredem')->index('in_orders_date_index');
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->integer('deleted_by')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });

        echo "Tabela Criada \n";
       
        $limit = 3000;

        $count = DB::connection('E003')->table('T012')
        ->leftJoin('T011', 'T011.T011_Id', 'T012.T012_T011_Id')
        ->leftJoin('D009', 'D009.D009_Id', 'T012.T012_D009_Id')
        ->leftJoin('C004', 'C004.C004_Id', 'T012.T012_C004_Id')
        ->leftJoin('D049', 'D049.D049_Id', 'D009.D009_D049_Id')
        ->whereIn('T012_C004_Id', [1,2,3,4,5,8,10,12,13,14])
        ->whereRaw('ABS(T012_Quantidade_Pendente_2020(T012_Id)) > 0')
        ->whereRaw('T011.T011_Data_Emissao >= date_sub(current_date(),interval 12 month)')
        ->where('T012.T012_Flag_Cancelada', '!=','S')
        ->where('T011.T011_Flag_Cancelada', '!=','S')->count();

        echo "Count Executado: $count \n";
        $count = ceil($count / $limit);
        echo "Count Dividido em: $count \n";
        
        for ($i = 0; $i < $count; $i++) {                    
            $results = DB::connection('E003')->table('T012')->select([
                'T011.T011_Id AS HRD_T011_Id',
                'T012.T012_Id AS HRD_T012_Id',
                'T011.T011_C004_Id AS HRD_T011_C004_Id',
                'T011.T011_C007_Id AS HRD_T011_C007_Id',
                'D009.D009_Id AS HRD_T012_D009_Id', 
                'T011.T011_Data_Emissao as HRD_Data_Lancamento',
                'T012.T012_Quantidade as HRD_T012_Quantidade',
                DB::raw('T012_Quantidade_Pendente(T012_Id) as HRD_Pendente'),
                'T012.T012_Valor_Custo_Unitario AS HRD_T012_Valor_Custo_Unitario',
                'T011.T011_Flag_Cancelada AS HRD_Status'
            ])
            ->leftJoin('T011', 'T011.T011_Id', 'T012.T012_T011_Id')
            ->leftJoin('D009', 'D009.D009_Id', 'T012.T012_D009_Id')
            ->leftJoin('C004', 'C004.C004_Id', 'T012.T012_C004_Id')
            ->leftJoin('D049', 'D049.D049_Id', 'D009.D009_D049_Id')
            ->whereIn('T012_C004_Id', [1,2,3,4,5,8,10,12,13,14])
            ->whereRaw('ABS(T012_Quantidade_Pendente_2020(T012_Id)) > 0')
            ->whereRaw('T011.T011_Data_Emissao >=  date_sub(current_date(),interval 12 month)')
            ->where('T012.T012_Flag_Cancelada', '!=','S')
            ->where('T011.T011_Flag_Cancelada', '!=','S')
            ->orderBy('T011.T011_Data_Emissao', 'desc')
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
                    'HRD_Saldo' => $result->HRD_T012_Quantidade,
                    'HRD_T012_Valor_Custo_Unitario' => $result->HRD_T012_Valor_Custo_Unitario,
                    'HRD_Status' => $result->HRD_Status,
                    'HRD_Nac_Imp' =>  'N',
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

                    foreach($value as $registro){
                        DB::connection('E003')->table('T012')
                                            ->where('T012_Id', $registro['HRD_T012_Id'])
                                            ->where('T012_T011_Id', $registro['HRD_T011_Id'])
                                            ->where('T012_D009_Id', $registro['HRD_T012_D009_Id'])
                                            ->where('T012_C004_ID', $registro['HRD_T011_C004_Id'])
                                            ->update(array('T012_Flag_Integrado' => 'S')); 
                    }
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
