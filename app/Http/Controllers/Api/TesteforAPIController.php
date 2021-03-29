<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateTesteforAPIRequest;
use App\Http\Requests\API\UpdateTesteforAPIRequest;
use App\Models\Testefor;
use App\Repositories\TesteforRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class TesteforController
 * @package App\Http\Controllers\API
 */

class TesteforAPIController extends AppBaseController
{
    /** @var  TesteforRepository */
    private $testeforRepository;

    public function __construct(TesteforRepository $testeforRepo)
    {
        $this->testeforRepository = $testeforRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/testefors",
     *      summary="Get a listing of the Testefors.",
     *      tags={"Testefor"},
     *      description="Get all Testefors",
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
     *                  @SWG\Items(ref="#/definitions/Testefor")
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
        $testefors = $this->testeforRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($testefors->toArray(), 'Testefors retrieved successfully');
    }

    /**
     * @param CreateTesteforAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/testefors",
     *      summary="Store a newly created Testefor in storage",
     *      tags={"Testefor"},
     *      description="Store Testefor",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Testefor that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Testefor")
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
     *                  ref="#/definitions/Testefor"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateTesteforAPIRequest $request)
    {
        $input = $request->all();

        $testefor = $this->testeforRepository->create($input);

        return $this->sendResponse($testefor->toArray(), 'Testefor saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/testefors/{id}",
     *      summary="Display the specified Testefor",
     *      tags={"Testefor"},
     *      description="Get Testefor",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Testefor",
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
     *                  ref="#/definitions/Testefor"
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
        /** @var Testefor $testefor */
        $testefor = $this->testeforRepository->find($id);

        if (empty($testefor)) {
            return $this->sendError('Testefor not found');
        }

        return $this->sendResponse($testefor->toArray(), 'Testefor retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateTesteforAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/testefors/{id}",
     *      summary="Update the specified Testefor in storage",
     *      tags={"Testefor"},
     *      description="Update Testefor",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Testefor",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Testefor that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Testefor")
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
     *                  ref="#/definitions/Testefor"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateTesteforAPIRequest $request)
    {
        $input = $request->all();

        /** @var Testefor $testefor */
        $testefor = $this->testeforRepository->find($id);

        if (empty($testefor)) {
            return $this->sendError('Testefor not found');
        }

        $testefor = $this->testeforRepository->update($input, $id);

        return $this->sendResponse($testefor->toArray(), 'Testefor updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/testefors/{id}",
     *      summary="Remove the specified Testefor from storage",
     *      tags={"Testefor"},
     *      description="Delete Testefor",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Testefor",
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
        /** @var Testefor $testefor */
        $testefor = $this->testeforRepository->find($id);

        if (empty($testefor)) {
            return $this->sendError('Testefor not found');
        }

        $testefor->delete();

        return $this->sendSuccess('Testefor deleted successfully');
    }
}
