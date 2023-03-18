<?php

namespace App\Services\Export;

use App\Repositories\Contracts\ExportContract;

class ExportHTML implements ExportContract
{
    public function export(array $data)
    {
         dd('HTML export');
    }
}