<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatePurchaseHistOrdersAPIRequest;
use App\Http\Requests\API\UpdatePurchaseHistOrdersAPIRequest;
use App\Models\PurchaseHistOrders;
use App\Repositories\PurchaseHistOrdersRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class PurchaseHistOrdersController
 * @package App\Http\Controllers\API
 */

class PurchaseHistOrdersAPIController extends AppBaseController
{
    /** @var  PurchaseHistOrdersRepository */
    private $purchaseHistOrdersRepository;

    public function __construct(PurchaseHistOrdersRepository $purchaseHistOrdersRepo)
    {
        $this->purchaseHistOrdersRepository = $purchaseHistOrdersRepo;
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
     *          default="name"
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
     *          default="id, name, route, old_id"
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
        $purchaseHistOrders = $this->purchaseHistOrdersRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

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
     *      path="/purchaseHistOrders/{id}/H101",
     *      summary="Listar Ordem de Compra e Itens.",
     *      security={{ "EngepecasAuth": {} }},  
     *      tags={"PurchaseHistOrders"},
     *      description="Entre com o Registro.",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="Codigo da Ordem de Compra",
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
    public function H101($id)
    {
        if (!$data = $this->model->with('H101')->find($id)) {
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
     *      path="/purchaseHistOrders/{D009_Id},{Status}/getSaldo",
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
    public function getSaldo($D009_Id, $status)
    {
        $result = $this->model::where('H100_Status','=', $status)
                    ->where('H100_D009_Id','=',$D009_Id)
                    ->sum('H100_Saldo');

        return response()->json($result);
    }     

}
