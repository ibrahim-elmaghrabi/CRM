<?php

namespace App\Repositories\Eloquent;

use App\Models\Invoice;
use App\Repositories\Eloquent\BaseRepository;
use App\Repositories\Contracts\InvoiceRepositoryContract;

class InvoiceRepository extends BaseRepository implements InvoiceRepositoryContract
{
    public function __construct(Invoice $invoice)
    {
        $this->setModel($invoice);
    }
}