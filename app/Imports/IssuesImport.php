<?php

namespace App\Imports;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\BeforeImport;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use App\Models\Issue;

class IssuesImport implements ToModel, WithMultipleSheets, WithHeadingRow, WithValidation, WithMapping, WithEvents
{
    protected $website;
    protected $hyperlinks;
    protected $fileName;
    protected $filePath;
    protected $rowIndex;

    public function __construct($website, $file)
    {
        $this->website = $website;
        $this->fileName = $file[0];
        $this->filePath = $file[1];
        $this->hyperlinks = [];
        $this->rowIndex = 5;
    }

    public function sheets(): array
    {
        return [
            'Page issues' => $this,
        ];
    }

    public function headingRow(): int
    {
        return 4;
    }

    public function map($row): array
    {
        $rowIndex = $this->rowIndex++;
        $issueLink = $this->hyperlinks[$rowIndex];
        // echo "Processing row: {$rowIndex}, Issue Value:{$row['issue_link']} Issue link: {$row['page_url']}<br>";
        // // echo "<pre>";
        // // print_r($row);
        $timestamp = Carbon::now();

        return [
            'website_id' => $this->website,
            'batch' => $this->getBatchNumber(),
            'page' => $row['page'],
            'url' => $row['page_url'],
            'issue_link' => $issueLink,
            'issue_reference' => $row['issue_link'],
            'description' => $row['description'],
            'criterion' => $row['criterion'],
            'element' => $row['element'],
            'check_type' => $row['check_type'],
            'responsibility' => $row['responsibility'],
            'severity' => $row['severity'],
            'complexity' => $row['complexity'],
            'date' => $timestamp,
        ];
    }

    public function model(array $row)
    {
        if (empty(array_filter($row))) {
            return null;
        }

         return new Issue($row);
    }

    public function rules(): array
    {
        return [
            'website' => function ($attribute, $value, $onFailure) {
                if (is_null($value)) {
                    $onFailure('Website cannot be null');
                }
            },
        ];
    }

    public function beforeImport(BeforeImport $event)
    {
        
        $reader = new Xlsx();
        $spreadsheet = $reader->load($this->filePath);

        $worksheet = $spreadsheet->getSheetByName('Page issues');
        $highestRow = $worksheet->getHighestRow();

        for ($row = 5; $row <= $highestRow; $row++) {
            $cellAddress = "A{$row}";
            $cell = $worksheet->getCell($cellAddress);

            //  echo "Processing cell: {$cellAddress}, Value: {$cell->getValue()}<br>";

            if ($cell->hasHyperlink() && !$cell->getHyperlink()->isInternal()) {
                // echo "Cell {$cellAddress} has a hyperlink: {$cell->getHyperlink()->getUrl()}<br>";

                $this->hyperlinks[$row] = $cell->getHyperlink()->getUrl();
            } 
        }
    }


    public function registerEvents(): array
    {
        return [
            BeforeImport::class => [$this, 'beforeImport'],
        ];
    }

    protected function getBatchNumber(): string
    {
        return explode(".xlsx", explode("Batch", $this->fileName)[1])[0];
    }
}
