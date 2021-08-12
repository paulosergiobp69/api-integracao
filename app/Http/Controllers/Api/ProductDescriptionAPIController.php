<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateProductDescriptionAPIRequest;
use App\Http\Requests\API\UpdateProductDescriptionAPIRequest;
use App\Models\ProductDescription;
use App\Repositories\ProductDescriptionRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class ProductDescriptionController
 * @package App\Http\Controllers\API
 */

class ProductDescriptionAPIController extends AppBaseController
{
    /** @var  ProductDescriptionRepository */
    private $productDescriptionRepository;

    public function __construct(ProductDescriptionRepository $productDescriptionRepo)
    {
        $this->productDescriptionRepository = $productDescriptionRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/productDescriptions",
     *      summary="Obtenha uma lista das descrições do produto.",
     *      security={{ "EngepecasAuth": {} }}, 
     *      tags={"ProductDescription"},
     *      description="Obtenha todas as descrições do produto ",
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
     *          default="id, hrd_D002_id, product_utilization_id, description, description_detail"
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
     *                  @SWG\Items(ref="#/definitions/ProductDescription")
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
        $productDescriptions = $this->productDescriptionRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($productDescriptions->toArray(), 'Descrições do produto recuperadas com sucesso.');
    }

    /**
     * @param CreateProductDescriptionAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/productDescriptions",
     *      summary="Armazene uma Descrição do Produto recém-criada no armazenamento.",
     *      security={{ "EngepecasAuth": {} }}, 
     *      tags={"ProductDescription"},
     *      description="Store ProductDescription",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Descrição do produto que deve ser armazenada.",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/ProductDescription")
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
     *                  ref="#/definitions/ProductDescription"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateProductDescriptionAPIRequest $request)
    {
        $input = $request->all();

        $productDescription = $this->productDescriptionRepository->create($input);

        return $this->sendResponse($productDescription->toArray(), 'Descrição do produto salva com sucesso.');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/productDescriptions/{id}",
     *      summary="Exibir a descrição do produto especificada.",
     *      security={{ "EngepecasAuth": {} }}, 
     *      tags={"ProductDescription"},
     *      description="Obter Descrição do Produto ",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="Id de Produto Descrição.",
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
     *                  ref="#/definitions/ProductDescription"
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
        /** @var ProductDescription $productDescription */
        $productDescription = $this->productDescriptionRepository->find($id);

        if (empty($productDescription)) {
            return $this->sendError('Descrição do produto não encontrada.');
        }

        return $this->sendResponse($productDescription->toArray(), 'Descrição do produto recuperada com sucesso.');
    }

    /**
     * @param int $id
     * @param UpdateProductDescriptionAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/productDescriptions/{id}",
     *      summary="Atualize a Descrição do Produto especificada no armazenamento.",
     *      security={{ "EngepecasAuth": {} }}, 
     *      tags={"ProductDescription"},
     *      description="Atualizar Descrição do Produto.",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="Id da Descrição do Produto.",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Descrição do produto que deve ser atualizada.",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/ProductDescription")
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
     *                  ref="#/definitions/ProductDescription"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateProductDescriptionAPIRequest $request)
    {
        $input = $request->all();

        /** @var ProductDescription $productDescription */
        $productDescription = $this->productDescriptionRepository->find($id);

        if (empty($productDescription)) {
            return $this->sendError('Descrição do produto não encontrada.');
        }

        $productDescription = $this->productDescriptionRepository->update($input, $id);

        return $this->sendResponse($productDescription->toArray(), 'Descrição do produto atualizada com sucesso.');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/productDescriptions/{id}",
     *      summary="Remova a Descrição Do Produto especificada do armazenamento ",
     *      security={{ "EngepecasAuth": {} }}, 
     *      tags={"ProductDescription"},
     *      description="Excluir Descrição do Produto ",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="Id da Descrição do Produto",
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
        /** @var ProductDescription $productDescription */
        $productDescription = $this->productDescriptionRepository->find($id);

        if (empty($productDescription)) {
            return $this->sendError('Descrição do produto não encontrada.');
        }

        $productDescription->delete();

        return $this->sendSuccess('Descrição do produto excluída com sucesso.');
    }
}
