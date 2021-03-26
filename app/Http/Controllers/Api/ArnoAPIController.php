<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateArnoAPIRequest;
use App\Http\Requests\API\UpdateArnoAPIRequest;
use App\Models\Arno;
use App\Repositories\ArnoRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class ArnoController
 * @package App\Http\Controllers\API
 */

class ArnoAPIController extends AppBaseController
{
    /** @var  ArnoRepository */
    private $arnoRepository;

    public function __construct(ArnoRepository $arnoRepo)
    {
        $this->arnoRepository = $arnoRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/arnos",
     *      summary="Obtenha uma lista dos Arnos.",
     *      tags={"Arno"},
     *      description="Seleciona Todos Arnos",
     *      produces={"application/json"},
     *      @SWG\Response(
     *          response=200,
     *          description="Operação realizada com Sucesso",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  type="array",
     *                  @SWG\Items(ref="#/definitions/Arno")
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
        $arnos = $this->arnoRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($arnos->toArray(), 'Arnos retrieved successfully');
    }

    /**
     * @param CreateArnoAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/arnos",
     *      summary="Cadastre um Arno recém-criado no armazenamentoe",
     *      tags={"Arno"},
     *      description="Store Arno",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Arno that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Arno")
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
     *                  ref="#/definitions/Arno"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateArnoAPIRequest $request)
    {
        $input = $request->all();

        $arno = $this->arnoRepository->create($input);

        return $this->sendResponse($arno->toArray(), 'Arno saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/arnos/{id}",
     *      summary="Display the specified Arno",
     *      tags={"Arno"},
     *      description="Get Arno",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Arno",
     *          type="integer",
     *          required=true,
     *          in="path"
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
     *                  ref="#/definitions/Arno"
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
        /** @var Arno $arno */
        $arno = $this->arnoRepository->find($id);

        if (empty($arno)) {
            return $this->sendError('Arno not found');
        }

        return $this->sendResponse($arno->toArray(), 'Arno retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateArnoAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/arnos/{id}",
     *      summary="Update the specified Arno in storage",
     *      tags={"Arno"},
     *      description="Update Arno",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Arno",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Arno that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Arno")
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
     *                  ref="#/definitions/Arno"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateArnoAPIRequest $request)
    {
        $input = $request->all();

        /** @var Arno $arno */
        $arno = $this->arnoRepository->find($id);

        if (empty($arno)) {
            return $this->sendError('Arno not found');
        }

        $arno = $this->arnoRepository->update($input, $id);

        return $this->sendResponse($arno->toArray(), 'Arno updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/arnos/{id}",
     *      summary="Remove the specified Arno from storage",
     *      tags={"Arno"},
     *      description="Delete Arno",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Arno",
     *          type="integer",
     *          required=true,
     *          in="path"
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
        /** @var Arno $arno */
        $arno = $this->arnoRepository->find($id);

        if (empty($arno)) {
            return $this->sendError('Arno not found');
        }

        $arno->delete();

        return $this->sendSuccess('Arno deleted successfully');
    }
}
