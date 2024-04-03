<?php

namespace App\Imports;


use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

use App\Models\Issues;

class IssuesImport implements ToModel, WithHeadingRow, WithValidation
{
    protected $website;

    public function __construct($website)
    {
        $this->website = $website->website;
    }

    public function model(array $row)
    {
        // print_r($row);
        // echo "<br>";
        // print_r('website: ' .  $this->website);echo "<br>";
        // print_r('Batch: ' . $row['batch']);echo "<br>";
        // print_r('Page: ' . $row['page']);echo "<br>";
        // print_r('url: ' . $row['url']);echo "<br>";
        // print_r('issue_link: ' . $row['issue_link']);echo "<br>";
        // print_r('description: ' . $row['description']);echo "<br>";
        // print_r('criterion: ' . $row['criterion']);echo "<br>";
        // print_r('issue_reference: ' . $row['issue_reference']);echo "<br>";
        // print_r('element: ' . $row['element']);echo "<br>";
        // print_r('check_type: ' . $row['check_type']);echo "<br>";
        // print_r('responsibility: ' . $row['responsibility']);echo "<br>";
        // print_r('severity: ' . $row['severity']);echo "<br>";

       

        return new Issues([

           'website'     => $this->website,
           'batch'    => $row['batch'],
           'page'    => $row['page'],
           'url'    => $row['url'],
           'issue_link'    => $row['issue_link'],
           'description'    => $row['description'],
           'criterion'    => $row['criterion'],
           'issue_reference'    => $row['issue_reference'],
           'element'    => $row['element'],
           'check_type'    => $row['check_type'],
           'responsibility'    => $row['responsibility'],
           'severity'    => $row['severity'],
           'complexity' => $row['complexity'],
           'date' => $row['date'],
 
        ]);
    }

    public function rules(): array
{
    return [
        'website' => function ($attribute, $value, $onFailure) {
            if (is_null($value)) { // Use is_null with parentheses
                $onFailure('Website cannot be null');
            }
        }
    ];
}
}
