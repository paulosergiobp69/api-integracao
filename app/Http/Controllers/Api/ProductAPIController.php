<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateProductAPIRequest;
use App\Http\Requests\API\UpdateProductAPIRequest;
use App\Models\Product;
use App\Repositories\ProductRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;


/**
 * Class ProductController
 * @package App\Http\Controllers\API
 */

class ProductAPIController extends AppBaseController
{
    /** @var  ProductRepository */
    private $productRepository;
    protected $model;

    public function __construct(ProductRepository $productRepo,  Product $doc)
    {
        $this->productRepository = $productRepo;
        $this->model = $doc;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/products",
     *      summary="Obtenha uma lista dos produtos.",
     *      security={{ "EngepecasAuth": {} }}, 
     *      tags={"Product"},
     *      description="Obtenha todos os produtos.",
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
     *          default="id, hrd_D001_Id, product_description_id, product_line_id, product_group_id, product_utilization_id, code, reference, technical_data, application, commercial_description, unit_weight_kg, development_flag, development_date, code_formatted, reference_formatted, code_redirect"
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
     *          description="Operação Realizada com Sucesso.",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  type="array",
     *                  @SWG\Items(ref="#/definitions/Product")
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
        $products = $this->productRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($products->toArray(), 'Produto(s) recuperado(s) com sucesso.');
    }

    /**
     * @param CreateProductAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/products",
     *      summary="Salve o Produto no Banco de Dados",
     *      security={{ "EngepecasAuth": {} }}, 
     *      tags={"Product"},
     *      description="Store Product",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Produto que deve ser armazenado.",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Product")
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="Operação Realizada com Sucesso",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/Product"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateProductAPIRequest $request)
    {
        $input = $request->all();

        $product = $this->productRepository->create($input);

        return $this->sendResponse($product->toArray(), 'Product saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/products/{id}",
     *      summary="Exibir o Produto Especificado.",
     *      security={{ "EngepecasAuth": {} }}, 
     *      tags={"Product"},
     *      description="Get Product",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="Id do Produto",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="Operacao Realizada com Sucesso",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/Product"
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
        /** @var Product $product */
        $product = $this->productRepository->find($id);

        if (empty($product)) {
            return $this->sendError('Produto não encontrado.');
        }

        return $this->sendResponse($product->toArray(), 'Produto recuperado com sucesso.');
    }

    /**
     * @param int $id
     * @param UpdateProductAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/products/{id}",
     *      summary="Atualize o Produto Especificado no Banco de Dados.",
     *      security={{ "EngepecasAuth": {} }}, 
     *      tags={"Product"},
     *      description="Update Product",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="Id do Produto",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Produto que deve ser atualizado.",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Product")
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
     *                  ref="#/definitions/Product"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateProductAPIRequest $request)
    {
        $input = $request->all();

        /** @var Product $product */
        $product = $this->productRepository->find($id);

        if (empty($product)) {
            return $this->sendError('Produto não encontrado.');
        }

        $product = $this->productRepository->update($input, $id);

        return $this->sendResponse($product->toArray(), 'Produto atualizado com sucesso.');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/products/{id}",
     *      summary="Remova o produto especificado do armazenamento.",
     *      security={{ "EngepecasAuth": {} }}, 
     *      tags={"Product"},
     *      description="Excluir Produto.",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="Id do Produto.",
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
        /** @var Product $product */
        $product = $this->productRepository->find($id);

        if (empty($product)) {
            return $this->sendError('Produto não encontrado.');
        }

        $product->delete();

        return $this->sendSuccess('Produto excluído com sucesso.');
    }


    /**
     * @param string $code
     * @return Response
     *
     * @SWG\Get(
     *      path="/products/{code}/getProductDetailCode",
     *      summary="Exibir o Produto Especificado.",
     *      security={{ "EngepecasAuth": {} }}, 
     *      tags={"Product"},
     *      description="Get Product",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="code",
     *          description="Codigo do Produto",
     *          type="string",
     *          required=true,
     *          in="path"
     *      ),
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
     *          default="id, hrd_D001_Id, product_description_id, product_line_id, product_group_id, product_utilization_id, code, reference, technical_data, application, commercial_description, unit_weight_kg, development_flag, development_date, code_formatted, reference_formatted, code_redirect"
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
     *          description="Operacao Realizada com Sucesso",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/Product"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function getProductDetailCode($code)
    {
        /** @var Product $product */
        // $product = $this->productRepository->find($id);
        if (!$product = $this->model->join('product_line','product_line.id','=','product.product_line_id')
                ->join('product_utilization','product_utilization.id','=','product.product_utilization_id')
                ->join('product_group','product_group.id','=','product.product_group_id')
                ->leftjoin('product_suppliers','product_suppliers.product_id','=','product.id')
                ->where('product.code','=',$code)
                ->orderBy('product_line_id','asc')
                ->get(['product.product_line_id', 'product_line.hrd_D003_Id', 'product_line.abbreviation',
                       'product.product_utilization_id', 'product_utilization.hrd_C008_Id', 'product_utilization.type as product_utilization_type',
                       'product.product_group_id', 'product_group.hrd_D015_Id', 'product_group.name as product_group_name',
                       'product_suppliers.id', 'product_suppliers.code_supplier', 'product_suppliers.technical_data',
                       'product.reference_formatted', 'product.commercial_description', 'product.application',
                       'product.hrd_D001_Id', 'product.code_formatted', 'product.code'
                ])) {
                return $this->sendError('Nenhum registro foi encontrado!');
        } else {
            return $this->sendResponse($product->toArray(), 'Produto recuperado com sucesso.');
        }

    }

    /**
     * @param string $codeFullText
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/products/{codeFullText}/getProductDetailCodeFullText",
     *      summary="Exibir o Produto Especificado.",
     *      security={{ "EngepecasAuth": {} }}, 
     *      tags={"Product"},
     *      description="Get Product",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="codeFullText",
     *          description="Codigo do Produto",
     *          type="string",
     *          required=true,
     *          in="path"
     *      ),
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
     *          default="product.id"
     *      ),
     *      @SWG\Parameter(
     *          name="direction",
     *          description="Direção da ordenação do retorno",
     *          type="string",
     *          required=false,
     *          in="query",
     *          default="ASC"
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="Operacao Realizada com Sucesso",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/Product"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function getProductDetailCodeFullText($codeFullText, Request $request)
    {
        if (!$data = $this->model->join('product_line','product_line.id','=','product.product_line_id')
                ->join('product_utilization','product_utilization.id','=','product.product_utilization_id')
                ->join('product_group','product_group.id','=','product.product_group_id')
                ->leftjoin('product_suppliers','product_suppliers.product_id','=','product.id')
                ->whereRaw('match (product.code,product.reference_formatted,product.code_formatted) against (? in boolean mode)',[$codeFullText])
                ->orderBy($request->get('order'),$request->get('direction'))
                ->get(['product.product_line_id', 'product_line.hrd_D003_Id', 'product_line.abbreviation',
                    'product.product_utilization_id', 'product_utilization.hrd_C008_Id', 'product_utilization.type as product_utilization_type',
                    'product.product_group_id', 'product_group.hrd_D015_Id', 'product_group.name as product_group_name',
                    'product_suppliers.id', 'product_suppliers.code_supplier', 'product_suppliers.technical_data',
                    'product.reference_formatted', 'product.commercial_description', 'product.application',
                    'product.hrd_D001_Id', 'product.code_formatted', 'product.code'
                ])->take($request->get('limit'))){
            return $this->sendError('Nenhum registro foi encontrado!');
        } else {
            return $this->sendResponse($data->toArray(), 'Item da Ordem de Compra Com Item das Notas Recebidas Recuperado(s) com Sucesso.viu');
        }

    }

    

}
