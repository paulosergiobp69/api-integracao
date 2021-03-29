<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateCorAPIRequest;
use App\Http\Requests\API\UpdateCorAPIRequest;
use App\Models\Cor;
use App\Repositories\CorRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class CorController
 * @package App\Http\Controllers\API
 */

class CorAPIController extends AppBaseController
{
    /** @var  CorRepository */
    private $corRepository;

    public function __construct(CorRepository $corRepo)
    {
        $this->corRepository = $corRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/cors",
     *      summary="Get a listing of the Cors.",
     *      tags={"Cor"},
     *      description="Get all Cors",
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
     *                  @SWG\Items(ref="#/definitions/Cor")
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
        $cors = $this->corRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($cors->toArray(), 'Cors retrieved successfully');
    }

    /**
     * @param CreateCorAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/cors",
     *      summary="Store a newly created Cor in storage",
     *      tags={"Cor"},
     *      description="Store Cor",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Cor that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Cor")
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
     *                  ref="#/definitions/Cor"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateCorAPIRequest $request)
    {
        $input = $request->all();

        $cor = $this->corRepository->create($input);

        return $this->sendResponse($cor->toArray(), 'Cor saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/cors/{id}",
     *      summary="Display the specified Cor",
     *      tags={"Cor"},
     *      description="Get Cor",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Cor",
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
     *                  ref="#/definitions/Cor"
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
        /** @var Cor $cor */
        $cor = $this->corRepository->find($id);

        if (empty($cor)) {
            return $this->sendError('Cor not found');
        }

        return $this->sendResponse($cor->toArray(), 'Cor retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateCorAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/cors/{id}",
     *      summary="Update the specified Cor in storage",
     *      tags={"Cor"},
     *      description="Update Cor",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Cor",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Cor that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Cor")
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
     *                  ref="#/definitions/Cor"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateCorAPIRequest $request)
    {
        $input = $request->all();

        /** @var Cor $cor */
        $cor = $this->corRepository->find($id);

        if (empty($cor)) {
            return $this->sendError('Cor not found');
        }

        $cor = $this->corRepository->update($input, $id);

        return $this->sendResponse($cor->toArray(), 'Cor updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/cors/{id}",
     *      summary="Remove the specified Cor from storage",
     *      tags={"Cor"},
     *      description="Delete Cor",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Cor",
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
        /** @var Cor $cor */
        $cor = $this->corRepository->find($id);

        if (empty($cor)) {
            return $this->sendError('Cor not found');
        }

        $cor->delete();

        return $this->sendSuccess('Cor deleted successfully');
    }
}
