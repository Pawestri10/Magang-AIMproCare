<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\Database\BaseBuilder;

class DashboardController extends BaseController
{
    public function admin()
    {
        $db = db_connect();
        $today = date('Y-m-d');
        $soonDate = date('Y-m-d', strtotime('+30 days'));

        $unitStats = $db->table('product_units')
            ->select("
                COUNT(*) AS total_units,
                SUM(CASE WHEN status = 'Siap Dijual' THEN 1 ELSE 0 END) AS ready_units,
                SUM(CASE WHEN status = 'Terjual' THEN 1 ELSE 0 END) AS sold_units
            ")
            ->get()
            ->getRowArray();

        $warrantyStats = $db->table('warranties')
            ->select("
                SUM(
                    CASE
                        WHEN status = 'Garansi Aktif'
                        AND end_date >= '{$today}'
                        THEN 1 ELSE 0
                    END
                ) AS active_warranties,

                SUM(
                    CASE
                        WHEN status = 'Garansi Aktif'
                        AND end_date >= '{$today}'
                        AND end_date <= '{$soonDate}'
                        THEN 1 ELSE 0
                    END
                ) AS expiring_warranties,

                SUM(
                    CASE
                        WHEN end_date < '{$today}'
                        OR status = 'Garansi Berakhir'
                        THEN 1 ELSE 0
                    END
                ) AS expired_warranties
            ")
            ->get()
            ->getRowArray();

        $claimStats = $db->table('warranty_claims')
            ->select("
                SUM(
                    CASE
                        WHEN status = 'Pengajuan Baru'
                        THEN 1 ELSE 0
                    END
                ) AS new_claims,
                
                SUM(
                    CASE
                        WHEN status IN (
                            'Sedang Diverifikasi',
                            'Klaim Diterima',
                            'Barang Diterima',
                            'Sedang Diperiksa',
                            'Sedang Diproses'
                        )
                        THEN 1 ELSE 0
                    
                     END
                ) AS processing_claims
            ")
            ->get()
            ->getRowArray();

        $chartLabels = [];
        $chartValues = [];

        for ($i = 5; $i >= 0; $i--) {
            $monthDate = new \DateTimeImmutable(
                date('Y-m-01', strtotime("-{$i} months"))
            );

            $monthStart = $monthDate->format('Y-m-01');
            $monthEnd = $monthDate->format('Y-m-t');

            $count = $db->table('warranties')
                ->where('start_date >=', $monthStart)
                ->where('start_date <=', $monthEnd)
                ->countAllResults();

            $chartLabels[] = $monthDate->format('M Y');
            $chartValues[] = $count;
        }

        $bestSellingProducts = $db->table('sales')
            ->select("
                products.id,
                products.name,
                products.brand,
                products.model,
                COUNT(sales.id) AS total_sold
            ")
            ->join(
                'product_units',
                'product_units.id = sales.product_unit_id'
            )
            ->join(
                'products',
                'products.id = product_units.product_id'
            )
            ->groupBy([
                'products.id',
                'products.name',
                'products.brand',
                'products.model',

            ])
            ->orderBy('total_sold', 'DESC')
            ->limit(5)
            ->get()
            ->getResultArray();

        return view('admin/dashboard', [
            'unitStats' => $unitStats,
            'warrantyStats' => $warrantyStats,
            'claimStats' => $claimStats,
            'chartLabels' => $chartLabels,
            'chartValues' => $chartValues,
            'bestSellingProducts' => $bestSellingProducts,
        ]);
    }

    public function qc()
    {
        $db = db_connect();
        $today = date('Y-m-d');

        $unitStats = $db->table('product_units')
            ->select("
                SUM(
                    CASE
                        WHEN status = 'Menunggu QC'
                        THEN 1 ELSE 0
                    END
                ) AS waiting_units,

                SUM(
                    CASE
                        WHEN status = 'Perlu Pemeriksaan Ulang'
                        THEN 1 ELSE 0
                    END
                ) AS reinspection_units
            ")
            ->get()
            ->getRowArray();

        $inspectionStats = $db->table('qc_inspections')
            ->select("
                SUM(
                    CASE
                        WHEN inspection_date = '{$today}'
                        THEN 1 ELSE 0
                    END
                ) AS inspected_today,

                SUM(
                    CASE
                        WHEN result = 'Lolos QC'
                        THEN 1 ELSE 0
                    END
                ) AS passed_inspections,

                SUM(
                    CASE
                        WHEN result = 'Tidak Lolos QC'
                        THEN 1 ELSE 0
                    END
                ) AS failed_inspections
            ")

            ->get()
            ->getRowArray();

        $recentInspections = $db->table('qc_inspections')
            ->select("
                qc_inspections.id,
                qc_inspections.inspection_date,
                qc_inspections.result,
                qc_inspections.physical_condition,
                qc_inspections.completeness,
                users.name AS officer_name,
                product_units.serial_number,
                products.name AS product_name,
                products.brand,
                products.model
            ")
            ->join(
                'users',
                'users.id = qc_inspections.user_id'
            )
            ->join(
                'product_units',
                'product_units.id = qc_inspections.product_unit_id'
            )
            ->join(
                'products',
                'products.id = product_units.product_id'
            )
            ->orderBy('qc_inspections.inspection_date', 'DESC')
            ->orderBy('qc_inspections.id', 'DESC')
            ->limit(5)
            ->get()
            ->getResultArray();

        return view('qc/dashboard', [
            'unitStats' => $unitStats,
            'inspectionStats' => $inspectionStats,
            'recentInspections' => $recentInspections,
        ]);
    }
}
