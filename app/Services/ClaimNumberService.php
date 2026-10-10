<?php

namespace App\Services;

use App\Models\WarrantyClaimModel;

class ClaimNumberService
{
    protected WarrantyClaimModel $warrantyClaimModel;

    public function __construct()
    {
        $this->warrantyClaimModel = new WarrantyClaimModel();
    }

    public function generate(string $year): string
    {
        $prefix = 'AIM-CLM-' . $year . '-';

        $lastClaim = $this->warrantyClaimModel
            ->like('claim_number', $prefix, 'after')
            ->orderBy('id', 'DESC')
            ->first();

        if ($lastClaim) {
            $lastNumber = (int) substr(
                $lastClaim['claim_number'],
                -6
            );

            $nextNumber = $lastNumber + 1;
        } else {
            $nextNumber = 1;
        }

        do {
            $claimNumber = $prefix . str_pad(
                (string) $nextNumber,
                6,
                '0',
                STR_PAD_LEFT
            );

            $exists = $this->warrantyClaimModel
                ->where('claim_number', $claimNumber)
                ->first();

            if ($exists) {
                $nextNumber++;
            }
        } while ($exists);

        return $claimNumber;
    }
}
