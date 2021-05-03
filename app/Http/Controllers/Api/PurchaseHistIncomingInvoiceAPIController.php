<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatePurchaseHistIncomingInvoiceAPIRequest;
use App\Http\Requests\API\UpdatePurchaseHistIncomingInvoiceAPIRequest;

use App\Models\PurchaseHistIncomingInvoice;
use App\Models\PurchaseHistOrders;
use App\Repositories\PurchaseHistIncomingInvoiceRepository;

use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;

use Response;

/**
 * Class PurchaseHistIncomingInvoiceController
 * @package App\Http\Controllers\API
 */

class PurchaseHistIncomingInvoiceAPIController extends AppBaseController
{
    /** @var  PurchaseHistIncomingInvoiceRepository */
    private $purchaseHistIncomingInvoiceRepository;
    protected $model;
    protected $PurchaseHO;
    protected $PurchaseHistOrdersAPICtrl;

    public function __construct(PurchaseHistIncomingInvoiceRepository $purchaseHistIncomingInvoiceRepo, 
                                PurchaseHistIncomingInvoice $doc,
                                PurchaseHistOrders  $PurchaseHistOrders)
    {
        $this->purchaseHistIncomingInvoiceRepository = $purchaseHistIncomingInvoiceRepo;
        $this->model = $doc;
        $this->PurchaseHO = $PurchaseHistOrders;

    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/purchaseHistIncomingInvoices",
     *      summary="Get a listing of the PurchaseHistIncomingInvoices.",
     *      security={{ "EngepecasAuth": {} }},  
     *      tags={"PurchaseHistIncomingInvoice"},
     *      description="Get all PurchaseHistIncomingInvoices",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="PHO_Id",
     *          description="Ordem de Compra",
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
     *          default="HRD_Quantidade"
     *      ),
     *      @SWG\Parameter(
     *          name="direction",
     *          description="Direção da ordenação do retorno",
     *          type="string",
     *          required=false,
     *          in="query",
     *          default="DESC"
     *      ),
     *      @SWG\Parameter(
     *          name="fields",
     *          description="Informe a seleção de campos que devem retornar da consulta separados por virgula",
     *          type="string",
     *          required=false,
     *          in="query",
     *          default="id, PHO_Id, HRD_T014_Id, HRD_Quantidade,HRD_Valor_Custo_Unitario,HRD_Flag_Cancelado,HRD_Data_Lancamento"
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
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  type="array",
     *                  @SWG\Items(ref="#/definitions/PurchaseHistIncomingInvoice")
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
        $purchaseHistIncomingInvoices = $this->purchaseHistIncomingInvoiceRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($purchaseHistIncomingInvoices->toArray(), 'Item de Nota Fiscal Recuperado(s) com Sucesso.');
    }

    /**
     * @param CreatePurchaseHistIncomingInvoiceAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/purchaseHistIncomingInvoices",
     *      summary="Store a newly created PurchaseHistIncomingInvoice in storage",
     *      security={{ "EngepecasAuth": {} }},  
     *      tags={"PurchaseHistIncomingInvoice"},
     *      description="Store PurchaseHistIncomingInvoice",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="PHO_Id",
     *          description="Ordem de Compra",
     *          type="integer",
     *          required=false,
     *          in="query"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Item de Nota Fiscal que deve ser armazenado.",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/PurchaseHistIncomingInvoice")
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
     *                  ref="#/definitions/PurchaseHistIncomingInvoice"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreatePurchaseHistIncomingInvoiceAPIRequest $request)
    {
        $input = $request->all();
        $id = $input['PHO_Id'];

        $purchaseHoSaldo = $this->getSaldoId($id,'N');

        $data = $purchaseHoSaldo->getData()->data;
        $saldo = ($data[0]->HRD_Saldo - $input['HRD_Quantidade']);

        if($saldo < 0){
            return $this->sendError('Item de Nota Fiscal não Possui Mais Saldo Para Entrada.');
        }
        $purchaseHistIncomingInvoice = $this->purchaseHistIncomingInvoiceRepository->create($input);

        $result = $this->sendResponse($purchaseHistIncomingInvoice->toArray(), 'Item de Nota Fiscal incluido com sucesso.');
        
        if($result->getData()->success == 1){
            $result_update = $this->putSaldo($id, $saldo);
        }

        return $result_update;

    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/purchaseHistIncomingInvoices/{id}",
     *      summary="Exibir a Item de Nota Fiscal especificado",
     *      security={{ "EngepecasAuth": {} }},  
     *      tags={"PurchaseHistIncomingInvoice"},
     *      description="Seleciona Item de Nota Fiscal",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="Codigo do Item de Nota Fiscal",
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
     *                  ref="#/definitions/PurchaseHistIncomingInvoice"
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
        /** @var PurchaseHistIncomingInvoice $purchaseHistIncomingInvoice */
        $purchaseHistIncomingInvoice = $this->purchaseHistIncomingInvoiceRepository->find($id);

        if (empty($purchaseHistIncomingInvoice)) {
            return $this->sendError('Item de Nota Fiscal não Localizado.');
        }

        return $this->sendResponse($purchaseHistIncomingInvoice->toArray(), 'Item de Nota Fiscal recuperado com sucesso.');
    }

    /**
     * @param int $id
     * @param UpdatePurchaseHistIncomingInvoiceAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/purchaseHistIncomingInvoices/{id}",
     *      summary="Atualiza Item de Nota Fiscal Selecionado",
     *      security={{ "EngepecasAuth": {} }},  
     *      tags={"PurchaseHistIncomingInvoice"},
     *      description="Atualiza Item de Nota Fiscal",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="Codigo de Item de Nota Fiscal",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Item de Nota Fiscal que deve ser atualizado.",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/PurchaseHistIncomingInvoice")
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="Operação realizada com sucesso",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/PurchaseHistIncomingInvoice"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdatePurchaseHistIncomingInvoiceAPIRequest $request)
    {
        $input = $request->all();

        /** @var PurchaseHistIncomingInvoice $purchaseHistIncomingInvoice */
        $purchaseHistIncomingInvoice = $this->purchaseHistIncomingInvoiceRepository->find($id);

        if (empty($purchaseHistIncomingInvoice)) {
            return $this->sendError('Item de Nota Fiscal não localizado.');
        }

        //$input['HRD_Flag_Cancelado'] = upper($input['HRD_Flag_Cancelado']);

        $purchaseHistIncomingInvoice = $this->purchaseHistIncomingInvoiceRepository->update($input, $id);

        return $this->sendResponse($purchaseHistIncomingInvoice->toArray(), 'Item de Nota Fiscal Atualizado com Sucesso');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/purchaseHistIncomingInvoices/{id}",
     *      summary="Exclusao de Item de Nota Fiscal Especifico.",
     *      security={{ "EngepecasAuth": {} }},  
     *      tags={"PurchaseHistIncomingInvoice"},
     *      description="Delete PurchaseHistIncomingInvoice",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="Codigo de Item de Nota Fiscal",
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
        /** @var PurchaseHistIncomingInvoice $purchaseHistIncomingInvoice */
        $purchaseHistIncomingInvoice = $this->purchaseHistIncomingInvoiceRepository->find($id);

        if (empty($purchaseHistIncomingInvoice)) {
            return $this->sendError(' Item de Nota Fiscal não Localizado.');
        }

        $purchaseHistIncomingInvoice->delete();

        return $this->sendSuccess('Item de Nota Fiscal Excluida com Sucesso.');
    }


    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/purchaseHistIncomingInvoices/{id}/purchaseHistOrders",
     *      summary="Listar Itens com a Ordem de Compra Especifica. ",
     *      security={{ "EngepecasAuth": {} }},  
     *      tags={"PurchaseHistIncomingInvoice"},
     *      description="Entre com o Registro.",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="Codigo da Nota de Entrada",
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
     *                  ref="#/definitions/H101"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function purchaseHistOrders($id)
    {

        if (!$data = $this->model->with('PurchaseHistOrder')->where('PHO_Id','=',$id)->get()) {
            return response()->json(['error' => 'Nenhum registro foi encontrado!'], 404);
        } else {
            return response()->json($data);
        }
    }


    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/purchaseHistIncomingInvoices/{id},{Status}/getSaldoId",
     *      summary="Retornar Saldo De Item nas Ordem de Compra.",
     *      security={{ "EngepecasAuth": {} }},  
     *      tags={"PurchaseHistIncomingInvoice"},
     *      description="Entre com o Registro.",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="Id do Produto na Ordem de Compra",
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
    public function getSaldoId($id, $Status)
    {
        $result = $this->PurchaseHO::where('id','=',$id)
                              ->where('HRD_Status','=',$Status)->get('HRD_Saldo');

        return $this->sendResponse($result->toArray(), 'Saldo do Item da Ordem de Compra Recuperado(s) com Sucesso.');
//        return response()->json($result);
//        return json_decode($result);

    }     


    public function putSaldo($id, $saldo)
    {
        $result = $this->PurchaseHO::where('id','=', $id)->update(['HRD_Saldo' => $saldo]);

        if($result <= 0){
            return $this->sendError('Houve Problemas Apenas No Processo de Atualização de Saldo de Ordem de Compra, este Não Foi Atualizado Verifique!');
        }else{
            return $this->sendResponse(array('Saldo' => $saldo), 'Ordem de Compra e Saldo Atualizado com Sucesso.');
        }
    }     


}
