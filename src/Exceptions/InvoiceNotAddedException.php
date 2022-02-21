<?php

namespace EscolaLms\FakturowniaIntegration\Exceptions;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Throwable;

class InvoiceNotAddedException extends ModelNotFoundException
{
    public function __construct(?Throwable $previous = null)
    {
        parent::__construct(__('The invoice has not been imported'), 403, $previous);
    }
}
