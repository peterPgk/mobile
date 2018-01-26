<?php
/**
 * Created by PhpStorm.
 * User: pgk
 * Date: 25.1.2018 г.
 * Time: 15:09
 */

namespace App\Contracts;


//use Symfony\Component\HttpFoundation\File\UploadedFile;

use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;

interface FileSource
{
    public function saveFiles(Request $request, ...$args);
}