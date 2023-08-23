<?php

namespace App\Exports;

use App\Models\Astrologer;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class AstrologerExport implements FromCollection,  WithHeadings, WithStyles
{

    protected $fields;

    public function __construct(array $fields)
    {
        $this->fields = $fields;
    }

    public function collection()
    {
        // Fetch and return your data as a collection
        return Astrologer::all($this->fields);
    }

    public function headings(): array
    {
        // Dynamically generate headings based on the provided fields
        return ['First Name', 'Last Name', 'Email', 'Phone', 'Country', 'State', 'City', 'Description', 'Experties', 'Language', 'Image', 'Experience', 'Education', 'Father Name', 'Pin Code', 'Dob Place', 'Dob Time', 'Dob Date', 'Gender'];
    }

    public function styles(Worksheet $sheet)
    {
        // Apply bold formatting to the heading row
        $sheet->getStyle('A1:S1')->getFont()->setBold(true);
    }
}
