<?php
/**
 * Created by PhpStorm.
 * User: Flávio Costa e Silva
 * Date: 04/03/2017
 * Time: 20:07
 */

namespace App\Models\Services;


use Symfony\Component\HttpFoundation\File\UploadedFile;

interface ProductServiceInterface
{
    public function storageFileUploaded(UploadedFile $file);

    public function processFileWithProducts($filename);
}