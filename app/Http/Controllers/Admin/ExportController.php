<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Period;
use App\Services\ExportService;

class ExportController extends Controller
{
    protected ExportService $exportService;

    public function __construct(ExportService $exportService)
    {
        $this->exportService = $exportService;
    }

    public function submissions(Period $period)
    {
        return $this->exportService->exportSubmissions($period);
    }

    public function ranking(Period $period)
    {
        return $this->exportService->exportRanking($period);
    }
}
