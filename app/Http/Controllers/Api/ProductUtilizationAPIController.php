<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateProductUtilizationAPIRequest;
use App\Http\Requests\API\UpdateProductUtilizationAPIRequest;
use App\Models\ProductUtilization;
use App\Repositories\ProductUtilizationRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class ProductUtilizationController
 * @package App\Http\Controllers\API
 */

class ProductUtilizationAPIController extends AppBaseController
{
    /** @var  ProductUtilizationRepository */
    private $productUtilizationRepository;

    public function __construct(ProductUtilizationRepository $productUtilizationRepo)
    {
        $this->productUtilizationRepository = $productUtilizationRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/productUtilizations",
     *      summary="Obtenha uma lista de Utilização de Produtos.",
     *      security={{ "EngepecasAuth": {} }},  
     *      tags={"ProductUtilization"},
     *      description="Obtenha todos as Utilizações de Produtos.",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="limit",
     *          description="Quantidade limite de exibição",
     *          type="integer",
     *          required=false,
     *          in="query",
     *          default="15"
     *      ),
     *      @SWG\Parameter(
     *          name="page",
     *          description="Página a ser exibida",
     *          type="integer",
     *          required=false,
     *          in="query",
     *          default="1"
     *      ),
     *      @SWG\Parameter(
     *          name="order",
     *          description="Ordenação do retorno",
     *          type="string",
     *          required=false,
     *          in="query",
     *          default="id"
     *      ),
     *      @SWG\Parameter(
     *          name="direction",
     *          description="Direção da ordenação do retorno",
     *          type="string",
     *          required=false,
     *          in="query",
     *          default="ASC"
     *      ),
     *      @SWG\Parameter(
     *          name="fields",
     *          description="Informe a seleção de campos que devem retornar da consulta separados por virgula",
     *          type="string",
     *          required=false,
     *          in="query",
     *          default="id, product_id, product_utilization_id, user_hrd_id, code_new, code_old, date_include, code_formatted_old, hrd_D017_Id"
     *      ),
     *      @SWG\Parameter(
     *          name="search",
     *          description="Pesquise por qualquer campo, ao usar este campo as outras consultas serão desconsideradas",
     *          type="string",
     *          required=false,
     *          in="query",
     *          default="Busca"
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
     *                  type="array",
     *                  @SWG\Items(ref="#/definitions/ProductUtilization")
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
        $productUtilizations = $this->productUtilizationRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($productUtilizations->toArray(), 'Utilizações de Produto Recuperadas com Sucesso.');
    }

    /**
     * @param CreateProductUtilizationAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/productUtilizations",
     *      summary="Armazene a Utilização de Produto Recém-criado no Armazenamento.",
     *      tags={"ProductUtilization"},
     *      description="Utilização do produto da loja. ",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Utilização do produto que deve ser armazenado.",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/ProductUtilization")
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
     *                  ref="#/definitions/ProductUtilization"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateProductUtilizationAPIRequest $request)
    {
        $input = $request->all();

        $productUtilization = $this->productUtilizationRepository->create($input);

        return $this->sendResponse($productUtilization->toArray(), 'Utilização do Produto Salva com Sucesso ');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/productUtilizations/{id}",
     *      summary="Exibir o Utilização do Produto Especificado.",
     *      tags={"ProductUtilization"},
     *      description="Obtenha a Utilização do Produto.",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id da Utilização do Produto.",
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
     *                  ref="#/definitions/ProductUtilization"
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
        /** @var ProductUtilization $productUtilization */
        $productUtilization = $this->productUtilizationRepository->find($id);

        if (empty($productUtilization)) {
            return $this->sendError('Utilização do produto não encontrada.');
        }

        return $this->sendResponse($productUtilization->toArray(), 'Utilização do Produto Recuperada Com Sucesso.');
    }

    /**
     * @param int $id
     * @param UpdateProductUtilizationAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/productUtilizations/{id}",
     *      summary="Atualizar o Utilização do Produto Especificado no Armazenamento.",
     *      tags={"ProductUtilization"},
     *      description="Atualizar a Utilização do Produto.",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Utilização do Produto",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Utilização do produto que deve ser atualizada.",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/ProductUtilization")
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
     *                  ref="#/definitions/ProductUtilization"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateProductUtilizationAPIRequest $request)
    {
        $input = $request->all();

        /** @var ProductUtilization $productUtilization */
        $productUtilization = $this->productUtilizationRepository->find($id);

        if (empty($productUtilization)) {
            return $this->sendError('Utilização do Produto não encontrada.');
        }

        $productUtilization = $this->productUtilizationRepository->update($input, $id);

        return $this->sendResponse($productUtilization->toArray(), 'Utilização do Produto atualizada com sucesso.');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/productUtilizations/{id}",
     *      summary="Remova a Utilização do Produto Especificada do Armazenamento ",
     *      tags={"ProductUtilization"},
     *      description="Excluir Utilização do Produto",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id da Utilização do Produto",
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
        /** @var ProductUtilization $productUtilization */
        $productUtilization = $this->productUtilizationRepository->find($id);

        if (empty($productUtilization)) {
            return $this->sendError('Utilização do produto não encontrada.');
        }

        $productUtilization->delete();

        return $this->sendSuccess('Utilização do Produto excluída com sucesso.');
    }
}
