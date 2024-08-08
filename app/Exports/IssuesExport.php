<?php

namespace App\Exports;

use App\Models\Issue;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;

class IssuesExport implements FromCollection, WithMapping, WithHeadings
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

        $query = Issue::query()->with(['website','status']);

        if ($this->website_id !== null) {
            $query->where('website_id', $this->website_id);
        }
        if ($this->sortBy !== null && $this->sortOrder !== null) {
            $query->orderBy($this->sortBy, $this->sortOrder);
        }

        return $query->get();
    }

    public function headings(): array
    {
        return [
            'Website',
            'Batch',
            'Page',
            'Url',
            'Issue Link',
            'Description',
            'Status',
            'Criterion',
            'Issue Reference',
            'Element',
            'Check Type',
            'Responsibility',
            'Severity',
            'Complexity',
            'date',
        ];
    }

    /**
    * @var Issue $Issues
    */
    public function map($Issue): array
    {
        return [
            $Issue->website->title,
            $Issue->batch,
            $Issue->page,
            $Issue->url,
            $Issue->issue_link,
            $Issue->description,
            $Issue->status->status,
            $Issue->criterion,
            $Issue->issue_reference,
            $Issue->element,
            $Issue->check_type,
            $Issue->responsibility,
            $Issue->severity,
            $Issue->complexity,
            $Issue->date,
        ];
    }
}
