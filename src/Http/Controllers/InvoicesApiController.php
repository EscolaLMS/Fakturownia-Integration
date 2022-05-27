<?php

namespace EscolaLms\FakturowniaIntegration\Http\Controllers;

use EscolaLms\Core\Http\Controllers\EscolaLmsBaseController;
use EscolaLms\FakturowniaIntegration\Http\Controllers\Swagger\InvoicesApiContract;
use EscolaLms\FakturowniaIntegration\Http\Requests\InvoicesReadRequest;
use EscolaLms\FakturowniaIntegration\Services\Contracts\FakturowniaIntegrationServiceContract;
use Exception;
use Illuminate\Support\Facades\Response as FacadesResponse;
use Illuminate\Http\Response;
use EscolaLms\FakturowniaIntegration\Traits\SetLocale;

class InvoicesApiController extends EscolaLmsBaseController implements InvoicesApiContract
{
    use SetLocale;

    private FakturowniaIntegrationServiceContract $invoicesService;

    public function __construct(
        FakturowniaIntegrationServiceContract $invoicesService
    ) {
        $this->invoicesService = $invoicesService;
    }

    /**
     * @throws Exception
     */
    public function read(InvoicesReadRequest $request): Response
    {
        $this->setLocale();
        $file_contents = base64_encode($this->invoicesService->getInvoicePdf($request->getOrder())->getData()['content']);

        return FacadesResponse::make($file_contents);
    }
}
