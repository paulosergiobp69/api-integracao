<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateH100APIRequest;
use App\Http\Requests\API\UpdateH100APIRequest;
use App\Models\H100;
use App\Repositories\H100Repository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;


/**
 * Class H100Controller
 * @package App\Http\Controllers\API
 */

class H100APIController extends AppBaseController
{
    /** @var  H100Repository */
    private $h100Repository;
    protected $model;

    public function __construct(H100Repository $h100Repo, H100 $doc)
    {
        $this->h100Repository = $h100Repo;
        $this->model = $doc;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/H100",
     *      summary="Obtenha uma lista das Ordens de Compras.",
     *      security={{ "EngepecasAuth": {} }},  
     *      tags={"H100"},
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
     *                  @SWG\Items(ref="#/definitions/H100")
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
        $H100 = $this->h100Repository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($H100->toArray(), 'Ordens de Compra recuperadas com sucesso.');
    }

    /**
     * @param CreateH100APIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/H100",
     *      summary="Ordem de Compra Criada com Sucesso",
     *      security={{ "EngepecasAuth": {} }},  
     *      tags={"H100"},
     *      description="Ordem de Compra",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Ordem de Compra que deve ser armazenada. ",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/H100")
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
     *                  ref="#/definitions/H100"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateH100APIRequest $request)
    {
        $input = $request->all();

        $h100 = $this->h100Repository->create($input);

        return $this->sendResponse($h100->toArray(), 'Ordem de Compra incluida com sucesso.');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/H100/{id}",
     *      summary="Exibir a Ordem de Compra especificada. ",
     *      security={{ "EngepecasAuth": {} }},  
     *      tags={"H100"},
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
     *                  ref="#/definitions/H100"
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
        /** @var H100 $h100 */
        $h100 = $this->h100Repository->find($id);

        if (empty($h100)) {
            return $this->sendError('Ordem de Compra não Localizada.');
        }

        return $this->sendResponse($h100->toArray(), 'Ordem de Compra recuperada com sucesso.');
    }

    /**
     * @param int $id
     * @param UpdateH100APIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/H100/{id}",
     *      summary="Atualiza a Ordem de Compra selecionada.",
     *      security={{ "EngepecasAuth": {} }},  
     *      tags={"H100"},
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
     *          description="Ordem de Compra que deve ser atualizada. ",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/H100")
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
     *                  ref="#/definitions/H100"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateH100APIRequest $request)
    {
        $input = $request->all();

        /** @var H100 $h100 */
        $h100 = $this->h100Repository->find($id);

        if (empty($h100)) {
            return $this->sendError('Ordem de Compra não localizada.');
        }

        $h100 = $this->h100Repository->update($input, $id);

        return $this->sendResponse($h100->toArray(), 'Ordem de Compra atualizada com sucesso.');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/H100/{id}",
     *      summary="Exclui Ordem de Compra.",
     *      security={{ "EngepecasAuth": {} }},  
     *      tags={"H100"},
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
        /** @var H100 $h100 */
        $h100 = $this->h100Repository->find($id);

        if (empty($h100)) {
            return $this->sendError('Ordem de Compra não Localizada.');
        }

        $h100->forceDelete();

        return $this->sendSuccess('Ordem de Compra Excluida com Sucesso.');
    }


    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/H100/{id}/H101",
     *      summary="Listar Ordem de Compra e Itens.",
     *      security={{ "EngepecasAuth": {} }},  
     *      tags={"H100"},
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
     *      path="/H100/{D009_Id},{Status}/getSaldo",
     *      summary="Retornar Saldo De Item nas Ordem de Compra.",
     *      security={{ "EngepecasAuth": {} }},  
     *      tags={"H100"},
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
