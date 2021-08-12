<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateProductReplacementAPIRequest;
use App\Http\Requests\API\UpdateProductReplacementAPIRequest;
use App\Models\ProductReplacement;
use App\Repositories\ProductReplacementRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class ProductReplacementController
 * @package App\Http\Controllers\API
 */

class ProductReplacementAPIController extends AppBaseController
{
    /** @var  ProductReplacementRepository */
    private $productReplacementRepository;

    public function __construct(ProductReplacementRepository $productReplacementRepo)
    {
        $this->productReplacementRepository = $productReplacementRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/productReplacements",
     *      summary="Obtenha uma Lista de Produto Substituto.",
     *      security={{ "EngepecasAuth": {} }},  
     *      tags={"ProductReplacement"},
     *      description="Obtenha Todas os Produto Substituto",
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
     *                  @SWG\Items(ref="#/definitions/ProductReplacement")
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
        $productReplacements = $this->productReplacementRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($productReplacements->toArray(), 'Produto(s) Substituto(s) Recuperado(s) com Sucesso.');
    }

    /**
     * @param CreateProductReplacementAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/productReplacements",
     *      summary="Armazene um Produto Substituto Recém-criado no Armazenamento ",
     *      tags={"ProductReplacement"},
     *      description="Store ProductReplacement",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Produto Substituto que deve ser armazenado ",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/ProductReplacement")
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
     *                  ref="#/definitions/ProductReplacement"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateProductReplacementAPIRequest $request)
    {
        $input = $request->all();

        $productReplacement = $this->productReplacementRepository->create($input);

        return $this->sendResponse($productReplacement->toArray(), 'Produto Substituto Salvo Com Sucesso.');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/productReplacements/{id}",
     *      summary="Exibir o Produto Substituto Especificado.",
     *      tags={"ProductReplacement"},
     *      description="Obter Produto Substituto.",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id do Produto Substituto",
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
     *                  ref="#/definitions/ProductReplacement"
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
        /** @var ProductReplacement $productReplacement */
        $productReplacement = $this->productReplacementRepository->find($id);

        if (empty($productReplacement)) {
            return $this->sendError('Produto Substituto não encontrado.');
        }

        return $this->sendResponse($productReplacement->toArray(), 'Produto Substituto Recuperada Com Sucesso.');
    }

    /**
     * @param int $id
     * @param UpdateProductReplacementAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/productReplacements/{id}",
     *      summary="Atualize o Produto Substituto Especificado no Armazenamento.",
     *      tags={"ProductReplacement"},
     *      description="Atualizar Produto Substituto.",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id do Produto Substituto",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Produto Substituto que deve ser atualizado ",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/ProductReplacement")
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="Operação realizada com sucesso",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/ProductReplacement"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateProductReplacementAPIRequest $request)
    {
        $input = $request->all();

        /** @var ProductReplacement $productReplacement */
        $productReplacement = $this->productReplacementRepository->find($id);

        if (empty($productReplacement)) {
            return $this->sendError('Produto Substituto não encontrada.');
        }

        $productReplacement = $this->productReplacementRepository->update($input, $id);

        return $this->sendResponse($productReplacement->toArray(), 'Produto Substituto Atualizado com Sucesso.');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/productReplacements/{id}",
     *      summary="Remova o Produto Substituto Especificado do Armazenamento.",
     *      tags={"ProductReplacement"},
     *      description="Exclur Produto Substituto",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id do Produto Substituto",
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
        /** @var ProductReplacement $productReplacement */
        $productReplacement = $this->productReplacementRepository->find($id);

        if (empty($productReplacement)) {
            return $this->sendError('Produto Substituto não encontrada ');
        }

        $productReplacement->delete();

        return $this->sendSuccess('Produto Substituto Excluído com Sucesso.');
    }
}
