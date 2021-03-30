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
     *      summary="Obtenha uma lista de Ordem de Compra.",
     *      security={{ "EngepecasAuth": {} }},  
     *      tags={"H100"},
     *      description="Selecione todos registros",
     *      produces={"application/json"},
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
        $h100S = $this->h100Repository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($h100S->toArray(), 'Ordem de Compra recuperada com sucesso.');
    }

    /**
     * @param CreateH100APIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/H100",
     *      summary="Ordem de Compra criada.",
     *      security={{ "EngepecasAuth": {} }},  
     *      tags={"H100"},
     *      description="Ordem de Compra",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Ordem de Compra que deve ser gravada. ",
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

        return $this->sendResponse($h100->toArray(), 'Ordem de Compra salva com sucesso ');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/H100/{id}",
     *      summary="Exibir a Ordem de Compra especifica. ",
     *      security={{ "EngepecasAuth": {} }},  
     *      tags={"H100"},
     *      description="Get H100",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
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
            return $this->sendError('Ordem de Compra não encontrada.');
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
     *      summary="Atualize a Ordem de Compra.",
     *      security={{ "EngepecasAuth": {} }},  
     *      tags={"H100"},
     *      description="Atualize Ordem de Compra",
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
     *          description="Ordem de Compra que deve ser atualizado ",
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
            return $this->sendError('Ordem de Compra não encontrada.');
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
     *      description="Delete H100",
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
            return $this->sendError('Ordem de Compra nao encontrada');
        }

        $h100->delete();

        return $this->sendSuccess('Ordem de Compra excluida com sucesso.');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/H100/{id}/H101",
     *      summary="Exibir a Ordem de Compra Especificada com Itens. ",
     *      security={{ "EngepecasAuth": {} }},  
     *      tags={"H100"},
     *      description="Recupera Ordem de Compra e Itens",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
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
    public function H101($id)
    {
        if (!$data = $this->model->with('H101')->find($id)) {
            return response()->json(['error' => 'Ordem de Compra nao foi encontrado!'], 404);
        } else {
            return response()->json($data);
        }
    }     

}
