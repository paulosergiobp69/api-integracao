<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateProductLineAPIRequest;
use App\Http\Requests\API\UpdateProductLineAPIRequest;
use App\Models\ProductLine;
use App\Repositories\ProductLineRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class ProductLineController
 * @package App\Http\Controllers\API
 */

class ProductLineAPIController extends AppBaseController
{
    /** @var  ProductLineRepository */
    private $productLineRepository;

    public function __construct(ProductLineRepository $productLineRepo)
    {
        $this->productLineRepository = $productLineRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/productLines",
     *      summary="Get a listing of the ProductLines.",
     *      security={{ "EngepecasAuth": {} }},  
     *      tags={"ProductLine"},
     *      description="Obtenha todas as linhas de produtos.",
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
     *          default="id, hrd_D003_Id, product_utilization_id, name, abbreviation, active"
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
     *                  @SWG\Items(ref="#/definitions/ProductLine")
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
        $productLines = $this->productLineRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($productLines->toArray(), 'Linha(s) de Produto(s) Recuperada(s) Com Sucesso.');
    }

    /**
     * @param CreateProductLineAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/productLines",
     *      summary="Armazene uma Linha de Produto recém-criada no armazenamento.",
     *      tags={"ProductLine"},
     *      description="Store ProductLine",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Linha de Produto deve ser armazenada.",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/ProductLine")
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
     *                  ref="#/definitions/ProductLine"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateProductLineAPIRequest $request)
    {
        $input = $request->all();

        $productLine = $this->productLineRepository->create($input);

        return $this->sendResponse($productLine->toArray(), 'Linha de produto salva com sucesso.');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/productLines/{id}",
     *      summary="Exibir a linha de produtos especificada.",
     *      tags={"ProductLine"},
     *      description="Get ProductLine",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id de Linha de Produto.",
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
     *                  ref="#/definitions/ProductLine"
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
        /** @var ProductLine $productLine */
        $productLine = $this->productLineRepository->find($id);

        if (empty($productLine)) {
            return $this->sendError('Linha de Produto não encontrada.');
        }

        return $this->sendResponse($productLine->toArray(), 'Linha de Produto recuperada com sucesso.');
    }

    /**
     * @param int $id
     * @param UpdateProductLineAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/productLines/{id}",
     *      summary="Atualize a Linha de Produto especificado no armazenamento.",
     *      tags={"ProductLine"},
     *      description="Atualizar Linha de Produto.",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id da Linha de Produto.",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Linha de Produto que deve ser atualizado ",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/ProductLine")
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
     *                  ref="#/definitions/ProductLine"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateProductLineAPIRequest $request)
    {
        $input = $request->all();

        /** @var ProductLine $productLine */
        $productLine = $this->productLineRepository->find($id);

        if (empty($productLine)) {
            return $this->sendError('Linha de produto não encontrada.');
        }

        $productLine = $this->productLineRepository->update($input, $id);

        return $this->sendResponse($productLine->toArray(), 'Linha de produto atualizada com sucesso ');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/productLines/{id}",
     *      summary="Remova a Linha de produto especificado do armazenamento.",
     *      tags={"ProductLine"},
     *      description="Excluir Linha de Produto.",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id da Linha de Produto.",
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
        /** @var ProductLine $productLine */
        $productLine = $this->productLineRepository->find($id);

        if (empty($productLine)) {
            return $this->sendError('Linha de Produto não encontrada.');
        }

        $productLine->delete();

        return $this->sendSuccess('Linha de Produto excluída com sucesso.');
    }
}
