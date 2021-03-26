<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateFilmeAPIRequest;
use App\Http\Requests\API\UpdateFilmeAPIRequest;
use App\Models\Filme;
use App\Repositories\FilmeRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class FilmeController
 * @package App\Http\Controllers\API
 */

class FilmeAPIController extends AppBaseController
{
    /** @var  FilmeRepository */
    private $filmeRepository;

    public function __construct(FilmeRepository $filmeRepo)
    {
        $this->filmeRepository = $filmeRepo;
    }

    /**
     * Display a listing of the Filme.
     * GET|HEAD /filmes
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $filmes = $this->filmeRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($filmes->toArray(), 'Filmes retrieved successfully');
    }

    /**
     * Store a newly created Filme in storage.
     * POST /filmes
     *
     * @param CreateFilmeAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateFilmeAPIRequest $request)
    {
        $input = $request->all();

        $filme = $this->filmeRepository->create($input);

        return $this->sendResponse($filme->toArray(), 'Filme saved successfully');
    }

    /**
     * Display the specified Filme.
     * GET|HEAD /filmes/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Filme $filme */
        $filme = $this->filmeRepository->find($id);

        if (empty($filme)) {
            return $this->sendError('Filme not found');
        }

        return $this->sendResponse($filme->toArray(), 'Filme retrieved successfully');
    }

    /**
     * Update the specified Filme in storage.
     * PUT/PATCH /filmes/{id}
     *
     * @param int $id
     * @param UpdateFilmeAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateFilmeAPIRequest $request)
    {
        $input = $request->all();

        /** @var Filme $filme */
        $filme = $this->filmeRepository->find($id);

        if (empty($filme)) {
            return $this->sendError('Filme not found');
        }

        $filme = $this->filmeRepository->update($input, $id);

        return $this->sendResponse($filme->toArray(), 'Filme updated successfully');
    }

    /**
     * Remove the specified Filme from storage.
     * DELETE /filmes/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Filme $filme */
        $filme = $this->filmeRepository->find($id);

        if (empty($filme)) {
            return $this->sendError('Filme not found');
        }

        $filme->delete();

        return $this->sendSuccess('Filme deleted successfully');
    }
}
