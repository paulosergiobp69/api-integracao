<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateClienteAPIRequest;
use App\Http\Requests\API\UpdateClienteAPIRequest;
use App\Models\Cliente;
use App\Repositories\ClienteRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class ClienteController
 * @package App\Http\Controllers\API
 */

class ClienteAPIController extends AppBaseController
{
    /** @var  ClienteRepository */
    private $clienteRepository;

    public function __construct(ClienteRepository $clienteRepo)
    {
        $this->clienteRepository = $clienteRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/clientes",
     *      summary="Get a listing of the Clientes.",
     *      security={{ "EngepecasAuth": {} }},  
     *      tags={"Cliente"},
     *      description="Get all Clientes",
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
     *                  @SWG\Items(ref="#/definitions/Cliente")
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
        $clientes = $this->clienteRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($clientes->toArray(), 'Clientes retrieved successfully');
    }

    /**
     * @param CreateClienteAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/clientes",
     *      summary="Store a newly created Cliente in storage",
     *      security={{ "EngepecasAuth": {} }},  
     *      tags={"Cliente"},
     *      description="Store Cliente",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Cliente that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Cliente")
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
     *                  ref="#/definitions/Cliente"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateClienteAPIRequest $request)
    {
        $input = $request->all();

        $cliente = $this->clienteRepository->create($input);

        return $this->sendResponse($cliente->toArray(), 'Cliente saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/clientes/{id}",
     *      summary="Display the specified Cliente",
     *      security={{ "EngepecasAuth": {} }},  
     *      tags={"Cliente"},
     *      description="Get Cliente",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Cliente",
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
     *                  ref="#/definitions/Cliente"
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
        /** @var Cliente $cliente */
        $cliente = $this->clienteRepository->find($id);

        if (empty($cliente)) {
            return $this->sendError('Cliente not found');
        }

        return $this->sendResponse($cliente->toArray(), 'Cliente retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateClienteAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/clientes/{id}",
     *      summary="Update the specified Cliente in storage",
     *      security={{ "EngepecasAuth": {} }},  
     *      tags={"Cliente"},
     *      description="Update Cliente",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Cliente",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Cliente that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Cliente")
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
     *                  ref="#/definitions/Cliente"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateClienteAPIRequest $request)
    {
        $input = $request->all();

        /** @var Cliente $cliente */
        $cliente = $this->clienteRepository->find($id);

        if (empty($cliente)) {
            return $this->sendError('Cliente not found');
        }

        $cliente = $this->clienteRepository->update($input, $id);

        return $this->sendResponse($cliente->toArray(), 'Cliente updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/clientes/{id}",
     *      summary="Remove the specified Cliente from storage",
     *      security={{ "EngepecasAuth": {} }},  
     *      tags={"Cliente"},
     *      description="Delete Cliente",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Cliente",
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
        /** @var Cliente $cliente */
        $cliente = $this->clienteRepository->find($id);

        if (empty($cliente)) {
            return $this->sendError('Cliente not found');
        }

        $cliente->delete();

        return $this->sendSuccess('Cliente deleted successfully');
    }
}
