<?php

namespace App\Exports;

use App\Models\Issue;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;

class IssuesExport implements FromCollection, WithMapping, WithHeadings
{
    protected $website;

    public function __construct($request)
    {
        $this->website = $request->website;
    }

    public function collection()
    {

        $query = Issue::query();

        if ($this->website !== null) {
            $query->where('website', $this->website);
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
            $Issue->website,
            $Issue->batch,
            $Issue->page,
            $Issue->url,
            $Issue->issue_link,
            $Issue->description,
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
