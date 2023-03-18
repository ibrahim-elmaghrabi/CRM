<?php

namespace App\Services\Export;

use App\Repositories\Contracts\ExportContract;

class ExportJson implements ExportContract
{
    public function export(array $data)
    {
        dd('json export');
    }
}