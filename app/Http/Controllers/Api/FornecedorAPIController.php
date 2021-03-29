<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateFornecedorAPIRequest;
use App\Http\Requests\API\UpdateFornecedorAPIRequest;
use App\Models\Fornecedor;
use App\Repositories\FornecedorRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class FornecedorController
 * @package App\Http\Controllers\API
 */

class FornecedorAPIController extends AppBaseController
{
    /** @var  FornecedorRepository */
    private $fornecedorRepository;

    public function __construct(FornecedorRepository $fornecedorRepo)
    {
        $this->fornecedorRepository = $fornecedorRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/fornecedors",
     *      summary="Get a listing of the Fornecedors.",
     *      security={{ "EngepecasAuth": {} }},  
     *      tags={"Fornecedor"},
     *      description="Get all Fornecedors",
     *      produces={"application/json"},
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
     *                  @SWG\Items(ref="#/definitions/Fornecedor")
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
        $fornecedors = $this->fornecedorRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($fornecedors->toArray(), 'Fornecedors retrieved successfully');
    }

    /**
     * @param CreateFornecedorAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/fornecedors",
     *      summary="Store a newly created Fornecedor in storage",
     *      security={{ "EngepecasAuth": {} }},  
     *      tags={"Fornecedor"},
     *      description="Store Fornecedor",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Fornecedor that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Fornecedor")
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
     *                  ref="#/definitions/Fornecedor"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateFornecedorAPIRequest $request)
    {
        $input = $request->all();

        $fornecedor = $this->fornecedorRepository->create($input);

        return $this->sendResponse($fornecedor->toArray(), 'Fornecedor saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/fornecedors/{id}",
     *      summary="Display the specified Fornecedor",
     *      security={{ "EngepecasAuth": {} }},  
     *      tags={"Fornecedor"},
     *      description="Get Fornecedor",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Fornecedor",
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
     *                  ref="#/definitions/Fornecedor"
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
        /** @var Fornecedor $fornecedor */
        $fornecedor = $this->fornecedorRepository->find($id);

        if (empty($fornecedor)) {
            return $this->sendError('Fornecedor not found');
        }

        return $this->sendResponse($fornecedor->toArray(), 'Fornecedor retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateFornecedorAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/fornecedors/{id}",
     *      summary="Update the specified Fornecedor in storage",
     *      security={{ "EngepecasAuth": {} }},  
     *      tags={"Fornecedor"},
     *      description="Update Fornecedor",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Fornecedor",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Fornecedor that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Fornecedor")
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
     *                  ref="#/definitions/Fornecedor"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateFornecedorAPIRequest $request)
    {
        $input = $request->all();

        /** @var Fornecedor $fornecedor */
        $fornecedor = $this->fornecedorRepository->find($id);

        if (empty($fornecedor)) {
            return $this->sendError('Fornecedor not found');
        }

        $fornecedor = $this->fornecedorRepository->update($input, $id);

        return $this->sendResponse($fornecedor->toArray(), 'Fornecedor updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/fornecedors/{id}",
     *      summary="Remove the specified Fornecedor from storage",
     *      security={{ "EngepecasAuth": {} }},  
     *      tags={"Fornecedor"},
     *      description="Delete Fornecedor",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Fornecedor",
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
        /** @var Fornecedor $fornecedor */
        $fornecedor = $this->fornecedorRepository->find($id);

        if (empty($fornecedor)) {
            return $this->sendError('Fornecedor not found');
        }

        $fornecedor->delete();

        return $this->sendSuccess('Fornecedor deleted successfully');
    }
}
