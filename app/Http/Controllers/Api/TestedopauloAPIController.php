<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateTestedopauloAPIRequest;
use App\Http\Requests\API\UpdateTestedopauloAPIRequest;
use App\Models\Testedopaulo;
use App\Repositories\TestedopauloRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class TestedopauloController
 * @package App\Http\Controllers\API
 */

class TestedopauloAPIController extends AppBaseController
{
    /** @var  TestedopauloRepository */
    private $testedopauloRepository;

    public function __construct(TestedopauloRepository $testedopauloRepo)
    {
        $this->testedopauloRepository = $testedopauloRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/testedopaulos",
     *      summary="Get a listing of the Testedopaulos.",
     *      tags={"Testedopaulo"},
     *      description="Get all Testedopaulos",
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
     *                  @SWG\Items(ref="#/definitions/Testedopaulo")
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
        $testedopaulos = $this->testedopauloRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($testedopaulos->toArray(), 'Testedopaulos retrieved successfully');
    }

    /**
     * @param CreateTestedopauloAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/testedopaulos",
     *      summary="Store a newly created Testedopaulo in storage",
     *      tags={"Testedopaulo"},
     *      description="Store Testedopaulo",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Testedopaulo that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Testedopaulo")
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
     *                  ref="#/definitions/Testedopaulo"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateTestedopauloAPIRequest $request)
    {
        $input = $request->all();

        $testedopaulo = $this->testedopauloRepository->create($input);

        return $this->sendResponse($testedopaulo->toArray(), 'Testedopaulo saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/testedopaulos/{id}",
     *      summary="Display the specified Testedopaulo",
     *      tags={"Testedopaulo"},
     *      description="Get Testedopaulo",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Testedopaulo",
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
     *                  ref="#/definitions/Testedopaulo"
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
        /** @var Testedopaulo $testedopaulo */
        $testedopaulo = $this->testedopauloRepository->find($id);

        if (empty($testedopaulo)) {
            return $this->sendError('Testedopaulo not found');
        }

        return $this->sendResponse($testedopaulo->toArray(), 'Testedopaulo retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateTestedopauloAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/testedopaulos/{id}",
     *      summary="Update the specified Testedopaulo in storage",
     *      tags={"Testedopaulo"},
     *      description="Update Testedopaulo",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Testedopaulo",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Testedopaulo that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Testedopaulo")
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
     *                  ref="#/definitions/Testedopaulo"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateTestedopauloAPIRequest $request)
    {
        $input = $request->all();

        /** @var Testedopaulo $testedopaulo */
        $testedopaulo = $this->testedopauloRepository->find($id);

        if (empty($testedopaulo)) {
            return $this->sendError('Testedopaulo not found');
        }

        $testedopaulo = $this->testedopauloRepository->update($input, $id);

        return $this->sendResponse($testedopaulo->toArray(), 'Testedopaulo updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/testedopaulos/{id}",
     *      summary="Remove the specified Testedopaulo from storage",
     *      tags={"Testedopaulo"},
     *      description="Delete Testedopaulo",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Testedopaulo",
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
        /** @var Testedopaulo $testedopaulo */
        $testedopaulo = $this->testedopauloRepository->find($id);

        if (empty($testedopaulo)) {
            return $this->sendError('Testedopaulo not found');
        }

        $testedopaulo->delete();

        return $this->sendSuccess('Testedopaulo deleted successfully');
    }
}
