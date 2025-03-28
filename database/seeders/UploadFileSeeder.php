<?php

namespace Database\Seeders;

use App\Models\Upload_file;
use App\Models\UploadFile;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UploadFileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        UploadFile::factory(5)->create();
    }
}
