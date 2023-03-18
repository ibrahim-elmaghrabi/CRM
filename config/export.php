<?php

return [
    'exporters' => [
        'json' => \App\Services\Export\ExportJson::class,
        'html' => \App\Services\Export\ExportHTML::class,
        'pdf'  => \App\Services\Export\ExportPDF::class,


    ]
    ];