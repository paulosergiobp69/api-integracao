<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateH101APIRequest;
use App\Http\Requests\API\UpdateH101APIRequest;
use App\Models\H101;
use App\Repositories\H101Repository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class H101Controller
 * @package App\Http\Controllers\API
 */

class H101APIController extends AppBaseController
{
    /** @var  H101Repository */
    private $h101Repository;
    protected $model;


    public function __construct(H101Repository $h101Repo, H101 $doc)
    {
        $this->h101Repository = $h101Repo;
        $this->model = $doc;

    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/H101",
     *      summary="Obtenha uma lista de Registros.",
     *      security={{ "EngepecasAuth": {} }},  
     *      tags={"H101"},
     *      description="Obtenha todos os registros",
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
     *                  @SWG\Items(ref="#/definitions/H101")
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
        $h101S = $this->h101Repository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($h101S->toArray(), 'Registro recuperado com sucesso ');
    }

    /**
     * @param CreateH101APIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/H101",
     *      summary="Salve um Item de Entrada recém-criado. ",
     *      security={{ "EngepecasAuth": {} }},  
     *      tags={"H101"},
     *      description="Registro de Entrada ",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Registro que deve ser armazenado. ",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/H101")
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
    public function store(CreateH101APIRequest $request)
    {
        $input = $request->all();

        $h101 = $this->h101Repository->create($input);

        return $this->sendResponse($h101->toArray(), 'Registro salvo com sucesso. ');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/H101/{id}",
     *      summary="Exibir o registro especificado ",
     *      security={{ "EngepecasAuth": {} }},  
     *      tags={"H101"},
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
    public function show($id)
    {
        /** @var H101 $h101 */
        $h101 = $this->h101Repository->find($id);

        if (empty($h101)) {
            return $this->sendError('Nota de entrada não encontrada.');
        }

        return $this->sendResponse($h101->toArray(), 'Registro recuperado com sucesso.');
    }

    /**
     * @param int $id
     * @param UpdateH101APIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/H101/{id}",
     *      summary="Atualize o registro especificado.",
     *      security={{ "EngepecasAuth": {} }},  
     *      tags={"H101"},
     *      description="Atualize do Registro",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="Codigo do Registro",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Registro que deve ser atualizado ",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/H101")
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
    public function update($id, UpdateH101APIRequest $request)
    {
        $input = $request->all();

        /** @var H101 $h101 */
        $h101 = $this->h101Repository->find($id);

        if (empty($h101)) {
            return $this->sendError('Registro não encontrado.');
        }

        $h101 = $this->h101Repository->update($input, $id);

        return $this->sendResponse($h101->toArray(), 'Registro atualizado com sucesso.');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/H101/{id}",
     *      summary="Remova o registro especificado.",
     *      security={{ "EngepecasAuth": {} }},  
     *      tags={"H101"},
     *      description="Registro Excluido",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="Codigo do registro",
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
        /** @var H101 $h101 */
        $h101 = $this->h101Repository->find($id);

        if (empty($h101)) {
            return $this->sendError('Registro não localizado');
        }

        $h101->delete();

        return $this->sendSuccess('Registro excluido com sucesso.');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/H101/{id}/H100",
     *      summary="Listar Itens com a Ordem de Compra Especifica. ",
     *      security={{ "EngepecasAuth": {} }},  
     *      tags={"H101"},
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
    public function H100($id)
    {
        /*
        $h101 = $this->h101Repository->find($id)->with('H100');

        if (empty($h101)) {
            return $this->sendError('Nota de entrada não encontrada.');
        }

        return $this->sendResponse($h101->toArray(), 'Registro recuperado com sucesso.');
*/        

        if (!$data = $this->model->with('H100')->find($id)) {
            return response()->json(['error' => 'Nenhum registro foi encontrado!'], 404);
        } else {
            return response()->json($data);
        }

    }     


}
