<?php

namespace App\Exports;

use App\Models\Violation;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ViolationExport implements FromCollection, WithMapping, WithHeadings
{
    protected $website_id;
    protected $sortBy;
    protected $sortOrder;

    public function __construct($request)
    {
        $this->website_id = $request->website_id;
        $this->sortBy = $request->exportSortBy;
        $this->sortOrder = $request->exportSortOrder;

    }

    public function collection()
    {

        $violationQuery = Violation::query()->with(['page', 'page.website', 'status']);

        if ($this->website_id !== null) {
            $websiteId = $this->website_id;
            $violationQuery = Violation::query()->whereHas('page', function ($query) use ($websiteId) {
                $query->where('website_id', $websiteId);
            })->with(['page', 'page.website']);
        }
        if ($this->sortBy !== null && $this->sortOrder !== null) {
            $violationQuery->orderBy($this->sortBy, $this->sortOrder);
        }

        return $violationQuery->get();
    }

    public function headings(): array
    {
        return [
            'Website',
            'Batch',
            'Page',
            'Violation',
            'Description',
            'Status',
            'Impact',
            'Tags',
            'Date',
        ];
    }

    /**
    * @var Violation $Issues
    */
    public function map($Violation): array
    {
        return [
            $Violation->page->website->title,
            $Violation->page->batch,
            $Violation->page->url,
            $Violation->violation,
            $Violation->description,
            $Violation->status->status,
            $Violation->impact,
            is_array($Violation->tags) ? implode(",", $Violation->tags): $Violation->tags,
            $Violation->scan_time,
        ];
    }
}
