<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatePurchaseHistOrdersAPIRequest;
use App\Http\Requests\API\UpdatePurchaseHistOrdersAPIRequest;
use App\Models\PurchaseHistOrders;
use App\Repositories\PurchaseHistOrdersRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Illuminate\Support\Facades\DB;
use Response;
/**
 * Class PurchaseHistOrdersController
 * @package App\Http\Controllers\API
 */

class PurchaseHistOrdersAPIController extends AppBaseController
{
    /** @var  PurchaseHistOrdersRepository */
    private $purchaseHistOrdersRepository;
    protected $model;

    public function __construct(PurchaseHistOrdersRepository $purchaseHistOrdersRepo,  PurchaseHistOrders $doc)
    {
        $this->purchaseHistOrdersRepository = $purchaseHistOrdersRepo;
        $this->model = $doc;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/purchaseHistOrders",
     *      summary="Obtenha uma lista das Ordens de Compras.",
     *      security={{ "EngepecasAuth": {} }},  
     *      tags={"PurchaseHistOrders"},
     *      description="Seleciona todas Ordens de Compras.",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="HRD_T011_Id",
     *          description="Ordem de Compra",
     *          type="integer",
     *          required=false,
     *          in="query"
     *      ),
     *      @SWG\Parameter(
     *          name="HRD_T012_Id",
     *          description="Id Nota Fiscal",
     *          type="integer",
     *          required=false,
     *          in="query"
     *      ),
     *      @SWG\Parameter(
     *          name="HRD_T012_D009_Id",
     *          description="Id Produto",
     *          type="integer",
     *          required=false,
     *          in="query"
     *      ),
     *      @SWG\Parameter(
     *          name="limit",
     *          description="Quantidade limite de exibição",
     *          type="integer",
     *          required=false,
     *          in="query",
     *          default="15"
     *      ),
     *      @SWG\Parameter(
     *          name="page",
     *          description="Página a ser exibida",
     *          type="integer",
     *          required=false,
     *          in="query",
     *          default="1"
     *      ),
     *      @SWG\Parameter(
     *          name="order",
     *          description="Ordenação do retorno",
     *          type="string",
     *          required=false,
     *          in="query",
     *          default="id"
     *      ),
     *      @SWG\Parameter(
     *          name="direction",
     *          description="Direção da ordenação do retorno",
     *          type="string",
     *          required=false,
     *          in="query",
     *          default="ASC"
     *      ),
     *      @SWG\Parameter(
     *          name="fields",
     *          description="Informe a seleção de campos que devem retornar da consulta separados por virgula",
     *          type="string",
     *          required=false,
     *          in="query",
     *          default="id, HRD_T011_Id, HRD_T012_Id, HRD_T012_D009_Id, HRD_T011_C007_Id, HRD_T011_C004_Id, HRD_T012_Quantidade, HRD_Quantidade_Pac, HRD_Saldo, HRD_T012_Valor_Custo_Unitario, HRD_Status, HRD_Nac_Imp, HRD_Data_Lancamento, HRD_T012_Ajuste_Saldo, HRD_C007_Ajuste_Saldo"
     *      ),
     *      @SWG\Parameter(
     *          name="search",
     *          description="Pesquise por qualquer campo, ao usar este campo as outras consultas serão desconsideradas",
     *          type="string",
     *          required=false,
     *          in="query",
     *          default="Busca"
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="Operação realizada com sucesso.",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  type="array",
     *                  @SWG\Items(ref="#/definitions/PurchaseHistOrders")
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function index(Request $request)
    {
        /*
        $purchaseHistOrders = $this->purchaseHistOrdersRepository->all(
            $request->except(['skip', 'limit', 'order']),
            $request->get('skip'),
            $request->get('limit')
        );
        */
        if ($request->exists('search')) {
            $purchaseHistOrders = $this->purchaseHistOrdersRepository
                ->advancedSearch($request)
                ->orderByRaw(($request->get('order') ?? 'id') . ' ' . ($request->get('direction') ?? 'DESC'))
                ->paginate($request->get('limit'));
        } else {
            $purchaseHistOrders = $this->purchaseHistOrdersRepository
            ->advancedSearch($request)
            ->orderByRaw(($request->get('order') ?? 'id') . ' ' . ($request->get('direction') ?? 'DESC'))
            ->paginate($request->get('limit'));
        }
        
        return $this->sendResponse($purchaseHistOrders->toArray(), 'Ordens de Compra recuperadas com sucesso.');
    }

    /**
     * @param CreatePurchaseHistOrdersAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/purchaseHistOrders",
     *      summary="Ordem de Compra Criada com Sucesso",
     *      security={{ "EngepecasAuth": {} }},  
     *      tags={"PurchaseHistOrders"},
     *      description="Ordem de Compra",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Ordem de Compra que deve ser armazenada.",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/PurchaseHistOrders")
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="Operação realizada com sucesso.",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/PurchaseHistOrders"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreatePurchaseHistOrdersAPIRequest $request)
    {

        $input = $request->all();

        $purchaseHistOrders = $this->purchaseHistOrdersRepository->create($input);

        return $this->sendResponse($purchaseHistOrders->toArray(), 'Ordem de Compra incluida com sucesso.');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/purchaseHistOrders/{id}",
     *      summary="Exibir a Ordem de Compra especificada.",
     *      security={{ "EngepecasAuth": {} }},  
     *      tags={"PurchaseHistOrders"},
     *      description="Seleciona Ordem de Compra.",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="Codigo da Ordem de Compra.",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="Operação realizada com sucesso.",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/PurchaseHistOrders"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function show($id)
    {
        /** @var PurchaseHistOrders $purchaseHistOrders */
        $purchaseHistOrders = $this->purchaseHistOrdersRepository->find($id);

        if (empty($purchaseHistOrders)) {
            return $this->sendError('Ordem de Compra não Localizada.');
        }

        return $this->sendResponse($purchaseHistOrders->toArray(), 'Ordem de Compra recuperada com sucesso.');
    }

    /**
     * @param int $id
     * @param UpdatePurchaseHistOrdersAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/purchaseHistOrders/{id}",
     *      summary="Atualiza a Ordem de Compra selecionada.",
     *      security={{ "EngepecasAuth": {} }},  
     *      tags={"PurchaseHistOrders"},
     *      description="Atualiza a Ordem de Compra.",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="Código da Ordem de Compra",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Ordem de Compra que deve ser atualizada.",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/PurchaseHistOrders")
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="Operação realizada com sucesso.",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/PurchaseHistOrders"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdatePurchaseHistOrdersAPIRequest $request)
    {
        $input = $request->all();

        /** @var PurchaseHistOrders $purchaseHistOrders */
        $purchaseHistOrders = $this->purchaseHistOrdersRepository->find($id);

        if (empty($purchaseHistOrders)) {
            return $this->sendError('Ordem de Compra não localizada.');
        }

        $purchaseHistOrders = $this->purchaseHistOrdersRepository->update($input, $id);

        return $this->sendResponse($purchaseHistOrders->toArray(), 'Ordem de Compra atualizada com sucesso.');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/purchaseHistOrders/{id}",
     *      summary="Exclui Ordem de Compra.",
     *      security={{ "EngepecasAuth": {} }},  
     *      tags={"PurchaseHistOrders"},
     *      description="Exclui Ordem de Compra",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="Codigo da Ordem de Compra.",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="Operação realizada com sucesso.",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  type="string"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function destroy($id)
    {
        /** @var PurchaseHistOrders $purchaseHistOrders */
        $purchaseHistOrders = $this->purchaseHistOrdersRepository->find($id);

        if (empty($purchaseHistOrders)) {
            return $this->sendError('Ordem de Compra não Localizada.');
        }

        $purchaseHistOrders->delete();

        return $this->sendSuccess('Ordem de Compra Excluida com Sucesso.');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/purchaseHistOrders/{HRD_T011_Id}/purchaseHistIncomingInvoices",
     *      summary="Listar Ordem de Compra e Itens.",
     *      security={{ "EngepecasAuth": {} }},  
     *      tags={"PurchaseHistOrders"},
     *      description="Entre com o Registro.",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="HRD_T011_Id",
     *          description="Ordem de Compra",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="Operação realizada com sucesso.",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/PurchaseHistOrders"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function purchaseHistIncomingInvoices($T011_Id)
    {
        if (!$data = $this->model->with(['purchaseHistIncomingInvoice' => function ($query) {
                                    $query->orderBy('HRD_T014_Id','asc')
                                          ->orderBy('HRD_Flag_Cancelado','asc');}])
                                ->where('HRD_T011_Id','=',$T011_Id)->get()) {
            return $this->sendError('Nenhum registro foi encontrado!');
        } else {
            //return response()->json($data);
            return $this->sendResponse($data->toArray(), 'Item da Ordem de Compra Com Item das Notas Recebidas Recuperado(s) com Sucesso.viu');

        }
    }     


    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/purchaseHistOrders/{HRD_T011_Id}/purchaseHistIncomingInvoicesJoin",
     *      summary="Listar Ordem de Compra e Itens Com Join e Ordenando Por Nota.",
     *      security={{ "EngepecasAuth": {} }},  
     *      tags={"PurchaseHistOrders"},
     *      description="Entre com o Registro.",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="HRD_T011_Id",
     *          description="Ordem de Compra",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="Operação realizada com sucesso.",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/PurchaseHistOrders"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function purchaseHistIncomingInvoicesJoin($T011_Id)
    {
        if (!$data = $this->model->leftjoin('purchase_hist_incoming_invoices','PHO_Id','=','purchase_hist_orders.id')
                ->where('HRD_T011_Id','=',$T011_Id)
                ->orderBy('PHII_Id','asc')
                ->orderBy('HRD_Flag_Cancelado','asc')
                ->get(['purchase_hist_orders.id', 'HRD_T011_Id', 'HRD_T012_Id', 'HRD_T012_D009_Id', 'HRD_T011_C007_Id', 'HRD_T011_C004_Id', 'HRD_T012_Quantidade', 
                       'HRD_Quantidade_Pac', 'HRD_Saldo', 'HRD_T012_Valor_Custo_Unitario', 'HRD_Status', 'HRD_Nac_Imp', 'purchase_hist_orders.HRD_Data_Lancamento',
                       'purchase_hist_incoming_invoices.id as PHII_Id', 'PHO_Id', 'HRD_T014_Id', 'HRD_Quantidade', 'HRD_Valor_Custo_Unitario', 'HRD_Flag_Cancelado',
                       'purchase_hist_incoming_invoices.HRD_Data_Lancamento as PHII_Data_Lancamento'])) {
                    
            return $this->sendError('Nenhum registro foi encontrado!');
        } else {
            //return response()->json($data);
            return $this->sendResponse($data->toArray(), 'Item da Ordem de Compra Com Item das Notas Recebidas Recuperado(s) com Sucesso.viu');
        }



    }     



    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/purchaseHistOrders/{D009_Id},{Status}/getSaldoTotal",
     *      summary="Retornar Saldo De Item nas Ordem de Compra.",
     *      security={{ "EngepecasAuth": {} }},  
     *      tags={"PurchaseHistOrders"},
     *      description="Entre com o Registro.",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="D009_Id",
     *          description="Codigo do Produto na Ordem de Compra",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="Status",
     *          description="Status do Produto na Ordem de Compra",
     *          type="string",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="Operação realizada com sucesso.",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/PurchaseHistOrders"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function getSaldoTotal($D009_Id, $status)
    {
        $result = $this->model::where('HRD_Status','=', $status)
                    ->where('HRD_T012_D009_Id','=',$D009_Id)
                    ->sum('HRD_Saldo');

        return response()->json($result);
    }     

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/purchaseHistOrders/{D009_Id},{Status}/getSaldoTotalAjuste",
     *      summary="Retornar Saldo De Item nas Ordem de Compra Com Ajuste.",
     *      security={{ "EngepecasAuth": {} }},  
     *      tags={"PurchaseHistOrders"},
     *      description="Entre com o Registro.",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="D009_Id",
     *          description="Codigo do Produto na Ordem de Compra",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="Status",
     *          description="Status do Produto na Ordem de Compra",
     *          type="string",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="Operação realizada com sucesso.",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/PurchaseHistOrders"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function getSaldoTotalAjuste($D009_Id, $status)
    {
/*
        $data = $this->model::where('HRD_Status','=', $status)
                    ->where('HRD_T012_D009_Id','=',$D009_Id)
                    ->select(DB::raw('sum(HRD_Saldo + HRD_T012_Ajuste_Saldo) as SaldoAjuste'))
                    ->toSql();
        dd($data);
*/
        if (!$data = $this->model::where('HRD_Status','=', $status)
                    ->where('HRD_T012_D009_Id','=',$D009_Id)
                    ->select(DB::raw('sum(HRD_Saldo + HRD_T012_Ajuste_Saldo) as SaldoApiAjuste'))
                    ->get()){

            return $this->sendError('Nenhum registro foi encontrado!');
        } else {
          //return response()->json($data);
            return $this->sendResponse($data->toArray(), 'Saldo do Item na Ordem de Compra Recuperado com Sucesso.');
        }
    }     


    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/purchaseHistOrders/{T012_Id},{T012_D009_Id},{T011_C004_Id},{T012_Valor_Custo_Unitario},{Status}/getId",
     *      summary="Retornar Saldo De Item nas Ordens de Compra.",
     *      security={{ "EngepecasAuth": {} }},  
     *      tags={"PurchaseHistOrders"},
     *      description="Entre com o Registro.",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="T012_Id",
     *          description="Id do Produto na Ordem de Compra",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="T012_D009_Id",
     *          description="Codigo do Produto na Ordem de Compra",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="T011_C004_Id",
     *          description="Codigo da Filial da Ordem de Compra",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="T012_Valor_Custo_Unitario",
     *          description="Valor de Custo do Produto da Ordem de Compra",
     *          type="number",
     *          required=false,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="Status",
     *          description="Status do Produto na Ordem de Compra",
     *          type="string",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="Operação realizada com sucesso.",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/PurchaseHistOrders"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function getId($T012_Id,$T012_D009_Id,$T011_C004_Id,$T012_Valor_Custo_Unitario,$Status)
    {
        $result = $this->model::where('HRD_T012_Id','=',$T012_Id)
                              ->where('HRD_T012_D009_Id','=',$T012_D009_Id)
                              ->where('HRD_T011_C004_Id','=',$T011_C004_Id)
                            //  ->where('HRD_T012_Valor_Custo_Unitario','=',$T012_Valor_Custo_Unitario)
                              ->where('HRD_Status','=',$Status)->get(['id','HRD_Quantidade_Pac']);

        return $this->sendResponse($result->toArray(), 'Id do Item da Ordem de Compra Recuperado(s) com Sucesso.');
    }     


    /**
     * @param int $T012_Id
     * @return Response
     *
     * @SWG\Get(
     *      path="/purchaseHistOrders/{T012_Id},{Status}/getSaldoT012Id",
     *      summary="Retornar Saldo Do Item na Ordem de Compra Especifica.",
     *      security={{ "EngepecasAuth": {} }},  
     *      tags={"PurchaseHistOrders"},
     *      description="Entre com o Registro.",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="T012_Id",
     *          description="Id da Tupla do Produto na Ordem de Compra",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="Status",
     *          description="Status do Produto na Ordem de Compra",
     *          type="string",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="Operação realizada com sucesso.",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/PurchaseHistOrders"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function getSaldoT012Id($HRD_T012_Id, $Status)
    {
        $result = $this->model::where('HRD_T012_Id','=',$HRD_T012_Id)
                              ->where('HRD_Status','=',$Status)->get('HRD_Saldo');

        return $this->sendResponse($result->toArray(), 'Saldo do Item da Ordem de Compra Recuperado(s) com Sucesso.');
//        return response()->json($result);
//        return json_decode($result);

    }     

    /**
     * @param int $T012_Id
     * @return Response
     *
     * @SWG\Get(
     *      path="/purchaseHistOrders/{T012_Id},{status}/getpurchaseHistOrdersItens",
     *      summary="Listar Itens com a Ordem de Compra Especifica. ",
     *      security={{ "EngepecasAuth": {} }},  
     *      tags={"PurchaseHistOrders"},
     *      description="Entre com o Registro.",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="T012_Id",
     *          description="Codigo do Item da Nota de Entrada",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="status",
     *          description="Status da Nota de Entrada",
     *          type="string",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="Operação realizada com sucesso.",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/PurchaseHistOrders"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function getpurchaseHistOrdersItens($T012_Id,$Status)
    {
        if (!$data = $this->model->with(['purchaseHistIncomingInvoice' => function ($query) {
                                            $query->orderBy('HRD_T014_Id');}])
                                 ->where('HRD_T012_Id','=',$T012_Id)
                                 ->where('HRD_Status','=',$Status)
                                 ->get()) {
            return response()->json(['error' => 'Nenhum registro foi encontrado!'], 404);
        } else {
            return response()->json($data);
        }
    }

    /**
     * @param int $D009_Id
     * @return Response
     *
     * @SWG\Get(
     *      path="/purchaseHistOrders/{D009_Id},{status}/getpurchaseHistOrdersProducts",
     *      summary="Listar Itens com a Ordem de Compra Por Produto Especifico. ",
     *      security={{ "EngepecasAuth": {} }},  
     *      tags={"PurchaseHistOrders"},
     *      description="Entre com o Registro.",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="D009_Id",
     *          description="Codigo do Produto Na Ordem de Compra",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="status",
     *          description="Status da Nota de Entrada",
     *          type="string",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="Operação realizada com sucesso.",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/PurchaseHistOrders"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function getpurchaseHistOrdersProducts($D009_Id,$Status)
    {
        $this->getProcessaSaldoProducts($D009_Id,$Status);
        
        if (!$data = $this->model->with(['purchaseHistIncomingInvoice' => function ($query) {
                                        $query->orderBy('HRD_T014_Id','asc');
                                    }])
                                 ->where('HRD_T012_D009_Id','=',$D009_Id)
                                 ->where('HRD_Status','=',$Status)
                                 ->orderBy('HRD_Data_Lancamento','desc')
                                 ->orderBy('HRD_T012_Id','desc')
                                 ->get()) {
            return response()->json(['error' => 'Nenhum registro foi encontrado!'], 404);
        } else {
            return response()->json($data);
        }
    }

    public function getProcessaSaldoProducts($D009_Id,$Status)
    {
        $results = DB::table('purchase_hist_orders as pho')->select([
            'pho.id as PHO_Id', 
            'pho.HRD_T011_Id', 
            'pho.HRD_T012_Id',
            'pho.HRD_T012_D009_Id',
            'pho.HRD_T011_C004_Id',
            'pho.HRD_T012_Quantidade',
            DB::raw('ifnull(pho.HRD_Quantidade_Pac,0) as HRD_Quantidade_Pac'),
            'phii.HRD_T014_Id',
             DB::raw('ifnull(phii.HRD_Quantidade,0) as phii_quantidade')
            ])
            ->leftJoin('purchase_hist_incoming_invoices as phii', 'phii.PHO_Id', 'pho.id')
            ->where('pho.HRD_T012_D009_Id', '=',$D009_Id)
            ->where('pho.HRD_Status', '=',$Status)
            ->where('phii.HRD_Flag_Cancelado', '=',$Status)
            ->whereRaw('phii.HRD_T014_Id not in (select HRD_T014_Id FROM purchase_hist_incoming_invoices as phii2 where phii2.HRD_T014_Id = phii.HRD_T014_Id and phii2.HRD_Flag_Cancelado = "S")')            
            ->orderBy('pho.HRD_Data_Lancamento', 'asc')
            ->orderBy('pho.HRD_T012_Id', 'asc')
      //      ->orderBy('phii.HRD_T014_Id', 'asc')
            ->get();

        $SaldoAnterior = 0;
        $Saldo = 0;
        $PhoIdAnterior = 0;
        $Oculta_Coluna ='N';
        $i = 0;
        foreach ($results as $result) {
            if($PhoIdAnterior != $result->PHO_Id){
                if($result->HRD_Quantidade_Pac > 0){
                    $Saldo = (($result->HRD_T012_Quantidade * $result->HRD_Quantidade_Pac)  - $result->phii_quantidade) + $SaldoAnterior;
                }else{
                    $Saldo = ($result->HRD_T012_Quantidade - $result->phii_quantidade) + $SaldoAnterior;
                }
                $Oculta_Coluna = 'N';
            }else{
                $Saldo =  (0  - $result->phii_quantidade) + $SaldoAnterior;
                $Oculta_Coluna = 'S';
            }    
            
/*

            if($i == 0){
//                echo $Saldo.' - '.$result->HRD_T012_Quantidade.' --'. $result->phii_quantidade.' -- '.$SaldoAnterior;
                echo ' passo: '.$i.' Saldo:'.$Saldo.' -T012_Quantidade:'.$result->HRD_T012_Quantidade.' -->phii_quantidade:'. $result->phii_quantidade.' -- SaldoAnterior:'.$SaldoAnterior.' OCULTA:'.$Oculta_Coluna;
                echo '<br>';
            }
            if($i == 1){
                echo ' passo: '.$i.'Saldo:'.$Saldo.' -T012_Quantidade:'.$result->HRD_T012_Quantidade.' -->phii_quantidade:'. $result->phii_quantidade.' -- SaldoAnterior:'.$SaldoAnterior.' OCULTA:'.$Oculta_Coluna;
                echo '\n>';
            }

            if($i == 2){
                echo ' passo: '.$i.'Saldo:'.$Saldo.' -T012_Quantidade:'.$result->HRD_T012_Quantidade.' -->phii_quantidade:'. $result->phii_quantidade.' -- SaldoAnterior:'.$SaldoAnterior.' OCULTA:'.$Oculta_Coluna;
                echo '<br>';

            }
            if($i == 3){
                echo ' passo: '.$i.'Saldo:'.$Saldo.' -T012_Quantidade:'.$result->HRD_T012_Quantidade.' -->phii_quantidade:'. $result->phii_quantidade.' -- SaldoAnterior:'.$SaldoAnterior.' OCULTA:'.$Oculta_Coluna;
                echo '<br>';

            }
            if($i == 4){
                echo ' passo: '.$i.'Saldo:'.$Saldo.' -T012_Quantidade:'.$result->HRD_T012_Quantidade.' -->phii_quantidade:'. $result->phii_quantidade.' -- SaldoAnterior:'.$SaldoAnterior.' OCULTA:'.$Oculta_Coluna;
                echo '<br>';

            }
            if($i == 5){
                echo ' passo: '.$i.'Saldo:'.$Saldo.' -T012_Quantidade:'.$result->HRD_T012_Quantidade.' -->phii_quantidade:'. $result->phii_quantidade.' -- SaldoAnterior:'.$SaldoAnterior.' OCULTA:'.$Oculta_Coluna;
                echo '<br>';

            }
            if($i == 6){
                echo ' passo: '.$i.'Saldo:'.$Saldo.' -T012_Quantidade:'.$result->HRD_T012_Quantidade.' -->phii_quantidade:'. $result->phii_quantidade.' -- SaldoAnterior:'.$SaldoAnterior.' OCULTA:'.$Oculta_Coluna;
                echo '<br>';
                die;

            }
            if($i == 7){
                echo ' passo: '.$i.'Saldo:'.$Saldo.' -T012_Quantidade:'.$result->HRD_T012_Quantidade.' -->phii_quantidade:'. $result->phii_quantidade.' -- SaldoAnterior:'.$SaldoAnterior.' OCULTA:'.$Oculta_Coluna;
                echo '<br>';
                die;

            }
            if($i == 8){
                echo ' passo: '.$i.'Saldo:'.$Saldo.' -T012_Quantidade:'.$result->HRD_T012_Quantidade.' -->phii_quantidade:'. $result->phii_quantidade.' -- SaldoAnterior:'.$SaldoAnterior.' OCULTA:'.$Oculta_Coluna;
                echo '<br>';
                die;

            }

            
            $i++;


            echo '<br>';
            echo $Saldo;
            echo '<br>';
*/
            if($result->HRD_T014_Id > 0){
               DB::table('purchase_hist_incoming_invoices')
                ->where('HRD_T014_Id', $result->HRD_T014_Id)
                ->where('PHO_Id', $result->PHO_Id)
                ->update(array('HRD_SaldoItem' => $Saldo,'HRD_Oculta_Coluna' => $Oculta_Coluna));         
            }
            $SaldoAnterior = $Saldo;
            $PhoIdAnterior = $result->PHO_Id;

        }
    }

}
