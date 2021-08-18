<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateProductSuppliersAPIRequest;
use App\Http\Requests\API\UpdateProductSuppliersAPIRequest;
use App\Models\ProductSuppliers;
use App\Repositories\ProductSuppliersRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class ProductSuppliersController
 * @package App\Http\Controllers\API
 */

class ProductSuppliersAPIController extends AppBaseController
{
    /** @var  ProductSuppliersRepository */
    private $productSuppliersRepository;

    public function __construct(ProductSuppliersRepository $productSuppliersRepo)
    {
        $this->productSuppliersRepository = $productSuppliersRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/productSuppliers",
     *      summary="Obtenha uma lista dos fornecedores de produtos.",
     *      security={{ "EngepecasAuth": {} }},
     *      tags={"ProductSuppliers"},
     *      description="Obtenha todos os fornecedores de produtos.",
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
     *          default=" id, hrd_D049_Id, code_supplier, code_supplier_formatted, product_id, technical_dataid"
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
     *          description="Operação bem sucedida,",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  type="array",
     *                  @SWG\Items(ref="#/definitions/ProductSuppliers")
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
        $productSuppliers = $this->productSuppliersRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($productSuppliers->toArray(), 'Fornecedores de produtos recuperados com sucesso.');
    }

    /**
     * @param CreateProductSuppliersAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/productSuppliers",
     *      summary="Armazene um fornecedor de produto recém-criado no armazenamento.",
     *      tags={"ProductSuppliers"},
     *      description="Store ProductSuppliers",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Fornecedores de produtos que devem ser armazenados.",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/ProductSuppliers")
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="Operação bem sucedida.",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/ProductSuppliers"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateProductSuppliersAPIRequest $request)
    {
        $input = $request->all();

        $productSuppliers = $this->productSuppliersRepository->create($input);

        return $this->sendResponse($productSuppliers->toArray(), 'Fornecedores de produtos salvos com sucesso.');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/productSuppliers/{id}",
     *      summary="Exibir os fornecedores de produtos especificados.",
     *      tags={"ProductSuppliers"},
     *      description="Obtenha fornecedores de produtos.",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of fornecedores de produtos.",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="Operação bem sucedida.",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/ProductSuppliers"
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
        /** @var ProductSuppliers $productSuppliers */
        $productSuppliers = $this->productSuppliersRepository->find($id);

        if (empty($productSuppliers)) {
            return $this->sendError('Fornecedores de produtos não encontrados.');
        }

        return $this->sendResponse($productSuppliers->toArray(), 'Fornecedores de produtos recuperados com sucesso.');
    }

    /**
     * @param int $id
     * @param UpdateProductSuppliersAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/productSuppliers/{id}",
     *      summary="Atualizar os fornecedores de produtos especificados no armazenamento.",
     *      tags={"ProductSuppliers"},
     *      description="Atualizar fornecedores de produtos.",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id de fornecedores de produtos",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Fornecedores de produtos que devem ser atualizados.",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/ProductSuppliers")
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="Operação bem sucedida ",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/ProductSuppliers"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateProductSuppliersAPIRequest $request)
    {
        $input = $request->all();

        /** @var ProductSuppliers $productSuppliers */
        $productSuppliers = $this->productSuppliersRepository->find($id);

        if (empty($productSuppliers)) {
            return $this->sendError('Fornecedores de produtos não encontrados.');
        }

        $productSuppliers = $this->productSuppliersRepository->update($input, $id);

        return $this->sendResponse($productSuppliers->toArray(), 'Fornecedores de produtos atualizados com sucesso.');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/productSuppliers/{id}",
     *      summary="Remova os fornecedores de produtos especificados do armazenamento.",
     *      tags={"ProductSuppliers"},
     *      description="Excluir fornecedores de produtos.",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id de fornecedores de produtos.",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="Operação bem sucedida.",
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
        /** @var ProductSuppliers $productSuppliers */
        $productSuppliers = $this->productSuppliersRepository->find($id);

        if (empty($productSuppliers)) {
            return $this->sendError('Fornecedores de produtos não encontrados.');
        }

        $productSuppliers->delete();

        return $this->sendSuccess('Fornecedores de produtos excluídos com sucesso.');
    }
}
