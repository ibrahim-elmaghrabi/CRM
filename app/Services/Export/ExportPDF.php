<?php

namespace App\Services\Export;

use App\Repositories\Contracts\ExportContract;

class ExportPDF implements ExportContract
{
    public function export(array $data)
    {
         dd('json PDF');
    }
}