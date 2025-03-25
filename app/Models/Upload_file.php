<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Upload_file extends Model
{
    /** @use HasFactory<\Database\Factories\UploadFileFactory> */
    use HasFactory;
    protected $table = 'upload_files';
}
