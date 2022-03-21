<?php

namespace EscolaLms\FakturowniaIntegration\Http\Controllers\Swagger;

use EscolaLms\FakturowniaIntegration\Http\Requests\InvoicesReadRequest;
use Illuminate\Http\Response;

interface InvoicesApiContract
{
    /**
     * @OA\Get(
     *     path="/api/invoices/{id}",
     *     summary="Get invoice PDF identified by a given id identifier of order",
     *     tags={"FakturowniaIntegration"},
     *     security={
     *         {"passport": {}},
     *     },
     *     @OA\Parameter(
     *         name="id",
     *         description="id of Order",
     *         @OA\Schema(
     *            type="integer",
     *         ),
     *         required=true,
     *         in="path"
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="",
     *      ),
     *     @OA\Response(
     *          response=401,
     *          description="endpoint requires authentication",
     *     ),
     *     @OA\Response(
     *          response=403,
     *          description="user doesn't have required access rights",
     *      ),
     *     @OA\Response(
     *          response=500,
     *          description="server-side error",
     *      ),
     * )
     */
    public function read(InvoicesReadRequest $request): Response;
}
