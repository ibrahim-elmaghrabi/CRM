<?php

namespace App\Services\Api;

use App\Repositories\Contracts\ExportContract;
use App\Exceptions\InvalidExportFormateException;
use App\Repositories\Eloquent\CustomerRepository;

class CustomerExportService
{
    private CustomerRepository $customerRepository;

    public function __construct(CustomerRepository $customerRepository)
    {
        $this->customerRepository = $customerRepository;
    }

    public function export(string $formate)
    {
        $customers = $this->customerRepository->all();
        $handler = config('export.exporters')[$formate] ?? null ;
        if(!$handler)
        {
            throw new InvalidExportFormateException(sprintf('format is not supported', $formate));
        }

        $exporter = new $handler ;

        if($exporter instanceof ExportContract)
        {
            $exporter->export($customers->toArray());
        }
    }
}