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
     * Display a listing of the Arno.
     * GET|HEAD /arnos
     *
     * @param Request $request
     * @return Response
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
     * Store a newly created Arno in storage.
     * POST /arnos
     *
     * @param CreateArnoAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateArnoAPIRequest $request)
    {
        $input = $request->all();

        $arno = $this->arnoRepository->create($input);

        return $this->sendResponse($arno->toArray(), 'Arno saved successfully');
    }

    /**
     * Display the specified Arno.
     * GET|HEAD /arnos/{id}
     *
     * @param int $id
     *
     * @return Response
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
     * Update the specified Arno in storage.
     * PUT/PATCH /arnos/{id}
     *
     * @param int $id
     * @param UpdateArnoAPIRequest $request
     *
     * @return Response
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
     * Remove the specified Arno from storage.
     * DELETE /arnos/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
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
