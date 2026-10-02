<?php

namespace App\Services;

use App\Models\WarrantyModel;

class WarrantyNumberService
{
    protected WarrantyModel $warrantyModel;

    public function __construct()
    {
        $this->warrantyModel = new WarrantyModel();
    }

    public function generate(string $year): string
    {
        $prefix = 'AIM-WRT-' . $year . '-';

        $lastWarranty = $this->warrantyModel
            ->like('warranty_number', $prefix, 'after')
            ->orderBy('id', 'DESC')
            ->first();

        if ($lastWarranty) {
            $lastNumber = (int) substr(
                $lastWarranty['warranty_number'],
                -6
            );

            $nextNumber = $lastNumber + 1;
        } else {
            $nextNumber = 1;
        }

        do {
            $warrantyNumber = $prefix . str_pad(
                (string) $nextNumber,
                6,
                '0',
                STR_PAD_LEFT
            );

            $exists = $this->warrantyModel
                ->where('warranty_number', $warrantyNumber)
                ->first();

            if ($exists) {
                $nextNumber++;
            }
        } while ($exists);

        return $warrantyNumber;
    }
}
