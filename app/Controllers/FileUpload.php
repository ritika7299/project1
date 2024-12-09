<?php
namespace App\Controllers;

use App\Models\FileModel;
use CodeIgniter\Controller;

class FileUpload extends Controller
{
    public function index()
    {
        return view('upload_form');
    }

    /*public function upload()
    {

        // Define the upload configuration
        $validationRule = [
            'file' => [
                'uploaded[file]',
                'mime_in[file,image/jpg,image/jpeg,image/png,application/pdf]',
                'max_size[file,2048]', // 2MB limit for file size
            ]
        ];

        // print_r($validationRule);
        // die;

        // Validate the file input
        if (!$this->validate($validationRule)) {
            return redirect()->back()->with('errors', $this->validator->getErrors());
        }

        // Handle the uploaded file
        $file = $this->request->getFile('file');
        $fileName = $file->getRandomName();
        $fileType = $file->getClientMimeType();
        $filePath = 'uploads/' . $fileName; // Save in the 'manual' folder

        // Move the file to the "manual" folder
        if ($file->move(ROOTPATH . 'public/uploads', $fileName)) {
            // Load the FileModel
            $fileModel = new FileModel();
            // Prepare data to insert into the database
            $fileData = [
                'file_name' => $fileName,
                'file_type' => $fileType,
                'file_path' => $filePath
            ];
            // Save the file data in the database
            if ($fileModel->save($fileData)) {
                return redirect()->to('/')->with('success', 'File uploaded and saved to the database successfully!');
            } else {
                return redirect()->back()->with('errors', 'Failed to save file details to the database.');
            }
        } else {
            return redirect()->back()->with('errors', 'File upload failed!');
        }
    }*/
    /*public function upload()
    {
        // Define the upload configuration
        $validationRule = [
            'file' => [
                'uploaded[file]',
                'mime_in[file,image/jpg,image/jpeg,image/png,application/pdf]',
                'max_size[file,2048]', // 2MB limit for file size
            ]
        ];

        // Validate the file input
        if (!$this->validate($validationRule)) {
            return redirect()->back()->with('errors', $this->validator->getErrors());
        }

        // Handle the uploaded file
        $file = $this->request->getFile('file');

        // Get the original file name
        $originalFileName = $file->getName();

        // To ensure uniqueness, you can append a timestamp or any other method to avoid overwriting files
        $fileName = time() . '-' . $originalFileName; // Example: appending timestamp to the original file name

        $fileType = $file->getClientMimeType();
        $filePath = 'uploads/' . $fileName; // Save in the 'uploads' folder

        // Move the file to the "uploads" folder
        if ($file->move(ROOTPATH . 'public/uploads', $fileName)) {
            // Load the FileModel
            $fileModel = new FileModel();

            // Prepare data to insert into the database
            $fileData = [
                'file_name' => $fileName, // Store the new unique file name
                'file_type' => $fileType,
                'file_path' => $filePath
            ];

            // Save the file data in the database
            if ($fileModel->save($fileData)) {
                return redirect()->to('/')->with('success', 'File uploaded and saved to the database successfully!');
            } else {
                return redirect()->back()->with('errors', 'Failed to save file details to the database.');
            }
        } else {
            return redirect()->back()->with('errors', 'File upload failed!');
        }
    }*/

    public function upload()
    {
        // Define the upload configuration
        $validationRule = [
            'file' => [
                'uploaded[file]',
                'mime_in[file,image/jpg,image/jpeg,image/png,application/pdf]',
                'max_size[file,2048]', // 2MB limit for file size
            ]
        ];

        // Validate the file input
        if (!$this->validate($validationRule)) {
            return redirect()->back()->with('errors', $this->validator->getErrors());
        }

        // Handle the uploaded file
        $file = $this->request->getFile('file');

        // Get the original file name
        $originalFileName = $file->getName();

        // Path where file will be saved
        $uploadPath = ROOTPATH . 'public/uploads/';
        $filePath = 'uploads/' . $originalFileName; // Store relative file path

        // Check if a file with the same name already exists
        $newFileName = $originalFileName;
        $counter = 1;

        // If the file already exists, append a counter to the file name
        while (file_exists($uploadPath . $newFileName)) {
            $newFileName = pathinfo($originalFileName, PATHINFO_FILENAME) . '-' . $counter . '.' . pathinfo($originalFileName, PATHINFO_EXTENSION);
            $counter++;
        }

        // Move the file to the "uploads" folder
        if ($file->move($uploadPath, $newFileName)) {
            // Load the FileModel
            $fileModel = new FileModel();

            // Prepare data to insert into the database
            $fileData = [
                'file_name' => $newFileName,  // Save the final file name
                'file_type' => $file->getClientMimeType(),
                'file_path' => $filePath
            ];

            // Save the file data in the database
            if ($fileModel->save($fileData)) {
                return redirect()->to('/')->with('success', 'File uploaded and saved to the database successfully!');
            } else {
                return redirect()->back()->with('errors', 'Failed to save file details to the database.');
            }
        } else {
            return redirect()->back()->with('errors', 'File upload failed!');
        }
    }


}