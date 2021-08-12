<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateProductGroupAPIRequest;
use App\Http\Requests\API\UpdateProductGroupAPIRequest;
use App\Models\ProductGroup;
use App\Repositories\ProductGroupRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class ProductGroupController
 * @package App\Http\Controllers\API
 */

class ProductGroupAPIController extends AppBaseController
{
    /** @var  ProductGroupRepository */
    private $productGroupRepository;

    public function __construct(ProductGroupRepository $productGroupRepo)
    {
        $this->productGroupRepository = $productGroupRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/productGroups",
     *      summary="Obtenha uma lista dos grupos de produtos.",
     *      security={{ "EngepecasAuth": {} }}, 
     *      tags={"ProductGroup"},
     *      description="Obtenha todos os grupos de produtos ",
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
     *          default="id, hrd_D015_Id, product_utilization_id, name, active"
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
     *                  @SWG\Items(ref="#/definitions/ProductGroup")
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
        $productGroups = $this->productGroupRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($productGroups->toArray(), 'Grupo(s) de Produto(s) Recuperado(s) com sucesso.');
    }

    /**
     * @param CreateProductGroupAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/productGroups",
     *      summary="Armazene um Grupo de Produtos recém-criado no armazenamento.",
     *      tags={"ProductGroup"},
     *      description="Grupo de produtos da loja.",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Grupo de produtos que deve ser armazenado.",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/ProductGroup")
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
     *                  ref="#/definitions/ProductGroup"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateProductGroupAPIRequest $request)
    {
        $input = $request->all();

        $productGroup = $this->productGroupRepository->create($input);

        return $this->sendResponse($productGroup->toArray(), 'Grupo de produtos salvo com sucesso.');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/productGroups/{id}",
     *      summary="Exibir o Grupo de Produtos especificado ",
     *      tags={"ProductGroup"},
     *      description="Get ProductGroup",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of ProductGroup",
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
     *                  ref="#/definitions/ProductGroup"
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
        /** @var ProductGroup $productGroup */
        $productGroup = $this->productGroupRepository->find($id);

        if (empty($productGroup)) {
            return $this->sendError('Grupo de produtos não encontrado.');
        }

        return $this->sendResponse($productGroup->toArray(), 'Grupo de Produtos recuperado com sucesso.');
    }

    /**
     * @param int $id
     * @param UpdateProductGroupAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/productGroups/{id}",
     *      summary="Atualize o Grupo de Produtos especificado no armazenamento.",
     *      tags={"ProductGroup"},
     *      description="Update ProductGroup",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="Id do Grupo de Produtos",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Grupo de produtos que deve ser atualizado.",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/ProductGroup")
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
     *                  ref="#/definitions/ProductGroup"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateProductGroupAPIRequest $request)
    {
        $input = $request->all();

        /** @var ProductGroup $productGroup */
        $productGroup = $this->productGroupRepository->find($id);

        if (empty($productGroup)) {
            return $this->sendError('Grupo de produtos não encontrado.');
        }

        $productGroup = $this->productGroupRepository->update($input, $id);

        return $this->sendResponse($productGroup->toArray(), 'Grupo de Produtos atualizado com sucesso.');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/productGroups/{id}",
     *      summary="Remova o Grupo de Produtos especificado do armazenamento ",
     *      tags={"ProductGroup"},
     *      description="Delete ProductGroup",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of ProductGroup",
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
        /** @var ProductGroup $productGroup */
        $productGroup = $this->productGroupRepository->find($id);

        if (empty($productGroup)) {
            return $this->sendError('Product Group not found');
        }

        $productGroup->delete();

        return $this->sendSuccess('Product Group deleted successfully');
    }
}
