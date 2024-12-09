<?php

namespace App\Models;

use CodeIgniter\Model;

class FileModel extends Model
{
    protected $table = 'uploaded_files';  // Name of the table
    protected $primaryKey = 'id';        // Primary key
    protected $allowedFields = ['file_name', 'file_type', 'file_path']; // Fields to insert/update

    // To automatically insert the current timestamp into the uploaded_at field
    protected $useTimestamps = true;

    // Validate file data before insertion
    protected $validationRules = [
        'file_name' => 'required|min_length[3]|max_length[255]',
        'file_type' => 'required',
        'file_path' => 'required|min_length[5]|max_length[255]',
    ];
    // To enable auto validation
    protected $validationMessages = [
        'file_name' => [
            'required' => 'File name is required.',
            'min_length' => 'File name is too short.',
            'max_length' => 'File name is too long.',
        ],
        'file_type' => [
            'required' => 'File type is required.',
        ],
        'file_path' => [
            'required' => 'File path is required.',
            'min_length' => 'File path is too short.',
            'max_length' => 'File path is too long.',
        ],
    ];
}
