<?php

use App\Models\Operation;
use App\Models\Charge;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class OperationsAndChargesExport implements FromCollection, WithHeadings
{
    protected $operations;
    protected $charges;

    public function __construct($operations, $charges)
    {
        $this->operations = $operations;
        $this->charges = $charges;
    }

    public function headings(): array
    {
        return [
            'Category',
            'Operations',
            'Charges'
        ];
    }

    public function collection()
    {
        $collection = [];

        foreach ($this->operations as $operation) {
            $category = $operation->category->name;
            $operations = $operation->montant;
            $charges = 0;

            foreach ($this->charges as $charge) {
                if ($charge->id_cat == $operation->id_cat) {
                    $charges = $charge->montant;
                }
            }

            $collection[] = [
                'Category' => $category,
                'Operations' => $operations,
                'Charges' => $charges
            ];
        }

        return collect($collection);
    }
}
