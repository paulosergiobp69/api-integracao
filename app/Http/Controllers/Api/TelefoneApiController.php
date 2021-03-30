<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateTelefoneAPIRequest;
use App\Http\Requests\API\UpdateTelefoneAPIRequest;
use App\Models\Telefone;
use App\Repositories\TelefoneRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class TelefoneController
 * @package App\Http\Controllers\API
 */

class TelefoneAPIController extends AppBaseController
{
    /** @var  TelefoneRepository */
    private $telefoneRepository;

    public function __construct(TelefoneRepository $telefoneRepo)
    {
        $this->telefoneRepository = $telefoneRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/telefones",
     *      summary="Get a listing of the Telefones.",
     *      tags={"Telefone"},
     *      description="Get all Telefones",
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
     *                  @SWG\Items(ref="#/definitions/Telefone")
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
        $telefones = $this->telefoneRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($telefones->toArray(), 'Telefones retrieved successfully');
    }

    /**
     * @param CreateTelefoneAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/telefones",
     *      summary="Store a newly created Telefone in storage",
     *      tags={"Telefone"},
     *      description="Store Telefone",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Telefone that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Telefone")
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
     *                  ref="#/definitions/Telefone"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateTelefoneAPIRequest $request)
    {
        $input = $request->all();

        $telefone = $this->telefoneRepository->create($input);

        return $this->sendResponse($telefone->toArray(), 'Telefone saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/telefones/{id}",
     *      summary="Display the specified Telefone",
     *      tags={"Telefone"},
     *      description="Get Telefone",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Telefone",
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
     *                  ref="#/definitions/Telefone"
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
        /** @var Telefone $telefone */
        $telefone = $this->telefoneRepository->find($id);

        if (empty($telefone)) {
            return $this->sendError('Telefone not found');
        }

        return $this->sendResponse($telefone->toArray(), 'Telefone retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateTelefoneAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/telefones/{id}",
     *      summary="Update the specified Telefone in storage",
     *      tags={"Telefone"},
     *      description="Update Telefone",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Telefone",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Telefone that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Telefone")
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
     *                  ref="#/definitions/Telefone"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateTelefoneAPIRequest $request)
    {
        $input = $request->all();

        /** @var Telefone $telefone */
        $telefone = $this->telefoneRepository->find($id);

        if (empty($telefone)) {
            return $this->sendError('Telefone not found');
        }

        $telefone = $this->telefoneRepository->update($input, $id);

        return $this->sendResponse($telefone->toArray(), 'Telefone updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/telefones/{id}",
     *      summary="Remove the specified Telefone from storage",
     *      tags={"Telefone"},
     *      description="Delete Telefone",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Telefone",
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
        /** @var Telefone $telefone */
        $telefone = $this->telefoneRepository->find($id);

        if (empty($telefone)) {
            return $this->sendError('Telefone not found');
        }

        $telefone->delete();

        return $this->sendSuccess('Telefone deleted successfully');
    }
}
