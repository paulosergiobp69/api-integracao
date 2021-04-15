<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatePurchaseHistIncomingInvoiceAPIRequest;
use App\Http\Requests\API\UpdatePurchaseHistIncomingInvoiceAPIRequest;
use App\Models\PurchaseHistIncomingInvoice;
use App\Repositories\PurchaseHistIncomingInvoiceRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class PurchaseHistIncomingInvoiceController
 * @package App\Http\Controllers\API
 */

class PurchaseHistIncomingInvoiceAPIController extends AppBaseController
{
    /** @var  PurchaseHistIncomingInvoiceRepository */
    private $purchaseHistIncomingInvoiceRepository;

    public function __construct(PurchaseHistIncomingInvoiceRepository $purchaseHistIncomingInvoiceRepo)
    {
        $this->purchaseHistIncomingInvoiceRepository = $purchaseHistIncomingInvoiceRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/purchaseHistIncomingInvoices",
     *      summary="Get a listing of the PurchaseHistIncomingInvoices.",
     *      security={{ "EngepecasAuth": {} }},  
     *      tags={"PurchaseHistIncomingInvoice"},
     *      description="Get all PurchaseHistIncomingInvoices",
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
     *                  @SWG\Items(ref="#/definitions/PurchaseHistIncomingInvoice")
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
        $purchaseHistIncomingInvoices = $this->purchaseHistIncomingInvoiceRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($purchaseHistIncomingInvoices->toArray(), 'Purchase Hist Incoming Invoices retrieved successfully');
    }

    /**
     * @param CreatePurchaseHistIncomingInvoiceAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/purchaseHistIncomingInvoices",
     *      summary="Store a newly created PurchaseHistIncomingInvoice in storage",
     *      security={{ "EngepecasAuth": {} }},  
     *      tags={"PurchaseHistIncomingInvoice"},
     *      description="Store PurchaseHistIncomingInvoice",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="PurchaseHistIncomingInvoice that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/PurchaseHistIncomingInvoice")
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
     *                  ref="#/definitions/PurchaseHistIncomingInvoice"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreatePurchaseHistIncomingInvoiceAPIRequest $request)
    {
        $input = $request->all();

        $purchaseHistIncomingInvoice = $this->purchaseHistIncomingInvoiceRepository->create($input);

        return $this->sendResponse($purchaseHistIncomingInvoice->toArray(), 'Purchase Hist Incoming Invoice saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/purchaseHistIncomingInvoices/{id}",
     *      summary="Display the specified PurchaseHistIncomingInvoice",
     *      security={{ "EngepecasAuth": {} }},  
     *      tags={"PurchaseHistIncomingInvoice"},
     *      description="Get PurchaseHistIncomingInvoice",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of PurchaseHistIncomingInvoice",
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
     *                  ref="#/definitions/PurchaseHistIncomingInvoice"
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
        /** @var PurchaseHistIncomingInvoice $purchaseHistIncomingInvoice */
        $purchaseHistIncomingInvoice = $this->purchaseHistIncomingInvoiceRepository->find($id);

        if (empty($purchaseHistIncomingInvoice)) {
            return $this->sendError('Purchase Hist Incoming Invoice not found');
        }

        return $this->sendResponse($purchaseHistIncomingInvoice->toArray(), 'Purchase Hist Incoming Invoice retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdatePurchaseHistIncomingInvoiceAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/purchaseHistIncomingInvoices/{id}",
     *      summary="Update the specified PurchaseHistIncomingInvoice in storage",
     *      security={{ "EngepecasAuth": {} }},  
     *      tags={"PurchaseHistIncomingInvoice"},
     *      description="Update PurchaseHistIncomingInvoice",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of PurchaseHistIncomingInvoice",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="PurchaseHistIncomingInvoice that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/PurchaseHistIncomingInvoice")
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
     *                  ref="#/definitions/PurchaseHistIncomingInvoice"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdatePurchaseHistIncomingInvoiceAPIRequest $request)
    {
        $input = $request->all();

        /** @var PurchaseHistIncomingInvoice $purchaseHistIncomingInvoice */
        $purchaseHistIncomingInvoice = $this->purchaseHistIncomingInvoiceRepository->find($id);

        if (empty($purchaseHistIncomingInvoice)) {
            return $this->sendError('Purchase Hist Incoming Invoice not found');
        }

        $purchaseHistIncomingInvoice = $this->purchaseHistIncomingInvoiceRepository->update($input, $id);

        return $this->sendResponse($purchaseHistIncomingInvoice->toArray(), 'PurchaseHistIncomingInvoice updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/purchaseHistIncomingInvoices/{id}",
     *      summary="Remove the specified PurchaseHistIncomingInvoice from storage",
     *      security={{ "EngepecasAuth": {} }},  
     *      tags={"PurchaseHistIncomingInvoice"},
     *      description="Delete PurchaseHistIncomingInvoice",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of PurchaseHistIncomingInvoice",
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
        /** @var PurchaseHistIncomingInvoice $purchaseHistIncomingInvoice */
        $purchaseHistIncomingInvoice = $this->purchaseHistIncomingInvoiceRepository->find($id);

        if (empty($purchaseHistIncomingInvoice)) {
            return $this->sendError('Purchase Hist Incoming Invoice not found');
        }

        $purchaseHistIncomingInvoice->delete();

        return $this->sendSuccess('Purchase Hist Incoming Invoice deleted successfully');
    }
}
