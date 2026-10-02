<?php

namespace App\Services;

use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\ErrorCorrectionLevel;
use Endroid\QrCode\Writer\PngWriter;
use Endroid\QrCode\Writer\SvgWriter;

class QrCodeService
{
    public function generateWarrantyUrl(string $qrToken): string
    {
        return base_url('cek-garansi/' . $qrToken);
    }

    public function generateSvg(string $data): string
    {
        $builder = new Builder(
            writer: new SvgWriter(),
            data: $data,
            errorCorrectionLevel: ErrorCorrectionLevel::High,
            size: 300,
            margin: 10
        );

        $result = $builder->build();

        return $result->getString();
    }

    public function generatePng(string $data): string
    {
        $builder = new Builder(
            writer: new PngWriter(),
            data: $data,
            errorCorrectionLevel: ErrorCorrectionLevel::High,
            size: 300,
            margin: 10
        );

        $result = $builder->build();

        return $result->getString();
    }
}
