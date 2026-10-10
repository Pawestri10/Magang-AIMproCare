<?php

namespace App\Models;

use CodeIgniter\Model;

class WarrantyClaimModel extends Model
{
    protected $table            = 'warranty_claims';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;

    protected $allowedFields = [
        'warranty_id',
        'claim_number',
        'tracking_token',
        'complaint',
        'damage_started_at',
        'damage_photo_path',
        'damage_video_path',
        'whatsapp',
        'delivery_method',
        'shipping_address',
        'agreement',
        'status',
    ];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    protected $validationRules = [
        'warranty_id'         => 'required|is_natural_no_zero',
        'claim_number'        => 'required|max_length[100]',
        'tracking_token'      => 'required|exact_length[64]',
        'complaint'           => 'required',
        'damage_started_at'   => 'required|valid_date[Y-m-d]',
        'damage_photo_path'   => 'required|max_length[255]',
        'damage_video_path'   => 'permit_empty|max_length[255]',
        'whatsapp'            => 'required|max_length[25]',
        'delivery_method'     => 'required|max_length[50]',
        'shipping_address'    => 'permit_empty',
        'agreement'           => 'required',
        'status'              => 'required|in_list[Pengajuan Baru,Sedang Diverifikasi,Klaim Diterima,Klaim Ditolak,Barang Diterima,Sedang Diperiksa,Sedang Diproses,Selesai]',
    ];

    protected $validationMessages = [
        'warranty_id' => [
            'required' => 'Garansi wajib dipilih.',
            'is_natural_no_zero' => 'Garansi tidak valid.',
        ],

        'claim_number' => [
            'required' => 'Nomor klaim wajib diisi.',
            'max_length' => 'Nomor klaim maksimal 100 karakter.',
        ],

        'tracking_token' => [
            'required' => 'Token tracking klaim wajib diisi.',
            'exact_length' => 'Token tracking klaim tidak valid.',
        ],

        'complaint' => [
            'required' => 'Keluhan wajib diisi.',
        ],

        'damage_started_at' => [
            'required' => 'Tanggal mulai kerusakan wajib diisi.',
            'valid_date' => 'Tanggal mulai kerusakan tidak valid.',
        ],

        'damage_photo_path' => [
            'required' => 'Foto kerusakan wajib diunggah.',
            'max_length' => 'Path foto kerusakan terlalu panjang.',
        ],

        'damage_video_path' => [
            'max_length' => 'Path video kerusakan terlalu panjang.',
        ],

        'whatsapp' => [
            'required' => 'Nomor WhatsApp wajib diisi.',
            'max_length' => 'Nomor WhatsApp maksimal 25 karakter.',
        ],

        'delivery_method' => [
            'required' => 'Metode penyerahan atau pengiriman wajib dipilih.',
            'max_length' => 'Metode penyerahan atau pengiriman maksimal 50 karakter.',
        ],

        'agreement' => [
            'required' => 'Persetujuan ketentuan klaim wajib diberikan.',
        ],

        'status' => [
            'required' => 'Status klaim wajib diisi.',
            'in_list' => 'Status klaim tidak valid.',
        ],
    ];

    public function findPublicTrackingByToken(string $trackingToken): ?array
    {
        return $this
            ->select([
                'warranty_claims.id',
                'warranty_claims.claim_number',
                'warranty_claims.status',
                'warranty_claims.created_at',
                'product_units.serial_number',
                'products.name AS product_name',
                'products.brand',
                'products.model',
            ])
            ->join(
                'warranties',
                'warranties.id = warranty_claims.warranty_id'
            )
            ->join(
                'sales',
                'sales.id = warranties.sale_id'
            )
            ->join(
                'product_units',
                'product_units.id = sales.product_unit_id'
            )
            ->join(
                'products',
                'products.id = product_units.product_id'
            )
            ->where(
                'warranty_claims.tracking_token',
                $trackingToken
            )
            ->first();
    }

    public function findPublicHistory(int $claimId): array
    {
        return $this->db
            ->table('claim_histories')
            ->select([
                'claim_histories.status',
                'claim_histories.changed_at',
            ])
            ->where(
                'claim_histories.warranty_claim_id',
                $claimId
            )
            ->orderBy(
                'claim_histories.changed_at',
                'ASC'
            )
            ->get()
            ->getResultArray();
    }

    public function findAdminClaims(?string $search = null, ?string $status = null, int $perPage = 10): array
    {
        $builder = $this
            ->select([
                'warranty_claims.id',
                'warranty_claims.claim_number',
                'warranty_claims.status',
                'warranty_claims.created_at',

                'customers.name AS customer_name',

                'product_units.serial_number',

                'products.name AS product_name',
                'products.brand',
                'products.model',
            ])
            ->join(
                'warranties',
                'warranties.id = warranty_claims.warranty_id'
            )
            ->join(
                'sales',
                'sales.id = warranties.sale_id'
            )
            ->join(
                'customers',
                'customers.id = sales.customer_id'
            )
            ->join(
                'product_units',
                'product_units.id = sales.product_unit_id'
            )
            ->join(
                'products',
                'products.id = product_units.product_id'
            );

        if ($search !== null && $search !== '') {
            $builder
                ->groupStart()
                ->like(
                    'warranty_claims.claim_number',
                    $search
                )
                ->orLike(
                    'product_units.serial_number',
                    $search
                )
                ->orLike(
                    'products.name',
                    $search
                )
                ->orLike(
                    'products.brand',
                    $search
                )
                ->orLike(
                    'products.model',
                    $search
                )
                ->orLike(
                    'customers.name',
                    $search
                )
                ->groupEnd();
        }

        if ($status !== null && $status !== '') {
            $builder->where(
                'warranty_claims.status',
                $status
            );
        }

        return $builder
            ->orderBy('warranty_claims.created_at', 'DESC')
            ->orderBy('warranty_claims.id', 'DESC')
            ->paginate($perPage);
    }

    public function findAdminClaimDetails(array $claimIds): array
    {
        if ($claimIds === []) {
            return [];
        }

        $rows = $this
            ->select([
                'warranty_claims.id',
                'warranty_claims.claim_number',
                'warranty_claims.status',
                'warranty_claims.complaint',
                'warranty_claims.damage_started_at',
                'warranty_claims.damage_photo_path',
                'warranty_claims.damage_video_path',
                'warranty_claims.whatsapp',
                'warranty_claims.delivery_method',
                'warranty_claims.shipping_address',
                'warranty_claims.agreement',
                'warranty_claims.created_at',
                'warranty_claims.updated_at',

                'warranties.warranty_number',
                'warranties.start_date AS warranty_start_date',
                'warranties.end_date AS warranty_end_date',

                'customers.name AS customer_name',
                'customers.whatsapp AS customer_whatsapp',
                'customers.email AS customer_email',
                'customers.address AS customer_address',

                'product_units.serial_number',

                'products.name AS product_name',
                'products.brand',
                'products.model',
            ])
            ->join(
                'warranties',
                'warranties.id = warranty_claims.warranty_id'
            )
            ->join(
                'sales',
                'sales.id = warranties.sale_id'
            )
            ->join(
                'customers',
                'customers.id = sales.customer_id'
            )
            ->join(
                'product_units',
                'product_units.id = sales.product_unit_id'
            )
            ->join(
                'products',
                'products.id = product_units.product_id'
            )
            ->whereIn('warranty_claims.id', $claimIds)
            ->findAll();

        $indexed = [];

        foreach ($rows as $row) {
            $indexed[(int) $row['id']] = $row;
        }

        return $indexed;
    }

    public function findAdminHistories(array $claimIds): array
    {
        if ($claimIds === []) {
            return [];
        }

        $rows = $this->db
            ->table('claim_histories')
            ->select([
                'claim_histories.warranty_claim_id',
                'claim_histories.id',
                'claim_histories.status',
                'claim_histories.note',
                'claim_histories.changed_at',
                'users.name AS user_name',
            ])
            ->join(
                'users',
                'users.id = claim_histories.user_id',
                'left'
            )
            ->whereIn(
                'claim_histories.warranty_claim_id',
                $claimIds
            )
            ->orderBy(
                'claim_histories.changed_at',
                'ASC'
            )
            ->orderBy(
                'claim_histories.id',
                'ASC'
            )
            ->get()
            ->getResultArray();

        $histories = [];

        foreach ($rows as $row) {
            $claimId = (int) $row['warranty_claim_id'];

            if (! isset($histories[$claimId])) {
                $histories[$claimId] = [];
            }

            $histories[$claimId][] = $row;
        }

        return $histories;
    }
}
