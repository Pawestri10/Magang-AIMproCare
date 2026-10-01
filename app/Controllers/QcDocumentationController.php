<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\QcDocumentationModel;

class QcDocumentationController extends BaseController
{
    protected QcDocumentationModel $qcDocumentationModel;

    public function __construct()
    {
        $this->qcDocumentationModel = new QcDocumentationModel();
    }

    public function show($id)
    {
        $documentation = $this->qcDocumentationModel->find($id);

        if (!$documentation) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound(
                'Dokumentasi QC tidak ditemukan.'
            );
        }

        $relativePath = $documentation['file_path'];

        if (
            !str_starts_with($relativePath, 'uploads/qc/') ||
            str_contains($relativePath, '..') ||
            str_contains($relativePath, '\\')
        ) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound(
                'File dokumentasi tidak valid.'
            );
        }

        $filePath = WRITEPATH . $relativePath;

        $qcStoragePath = realpath(WRITEPATH . 'uploads/qc');

        if ($qcStoragePath === false) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound(
                'Storage dokumentasi QC tidak ditemukan.'
            );
        }

        $realFilePath = realpath($filePath);

        if (
            $realFilePath === false ||
            !str_starts_with(
                $realFilePath,
                $qcStoragePath . DIRECTORY_SEPARATOR
            )
        ) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound(
                'File dokumentasi tidak ditemukan.'
            );
        }

        if (!is_file($realFilePath)) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound(
                'File dokumentasi tidak ditemukan.'
            );
        }

        return $this->response
            ->download($realFilePath, null, true)
            ->inline();
    }
}
