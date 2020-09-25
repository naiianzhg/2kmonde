<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\UploadFileRequest;
use App\Http\Requests\UploadNewFolderRequest;
use App\Services\UploadsManager;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class UploadController extends Controller
{
    protected $manager;

    public function __construct(UploadsManager $manager)
    {
        $this->manager = $manager;
    }

    /**
     * Show pages of files / subfolders
     */
    public function index(Request $request)
    {
        $folder = $request->get('folder');
        $data = $this->manager->folderInfo($folder);

        return view('admin.upload.index', $data);
    }

    /**
     * Create new directory
     */
    public function createFolder(UploadNewFolderRequest $request)
    {
        $new_folder = $request->get('new_folder');
        $folder = $request->get('folder') . '/' . $new_folder;

        $result = $this->manager->createDirectory($folder);

        if ($result === true) {
            return redirect()
                ->back()
                ->with('success', 'Directory ‹ ' . $new_folder . ' › created successfully.');
        }

        $error = $result ?: "Error creating directory.";
        return redirect()
            ->back()
            ->withErrors([$error]);
    }

    /**
     * Delete directory
     */
    public function deleteFolder(Request $request)
    {
        $del_folder = $request->get('del_folder');
        $folder = $request->get('folder') . '/' . $del_folder;

        $result = $this->manager->deleteDirectory($folder);

        if ($result === true) {
            return redirect()
                ->back()
                ->with('success', 'Directory ‹ ' . $del_folder . ' › deleted.');
        }

        $error = $result ?: "Error deleting directory.";
        return redirect()
            ->back()
            ->withErrors([$error]);
    }

    /**
     * Upload file
     */
    public function uploadFile(UploadFileRequest $request)
    {
        $file = $_FILES['file'];
        $fileName = $request->get('file_name');
        $fileName = $fileName ?: $file['name'];
        $path = str_finish($request->get('folder'), '/') . $fileName;
        $content = File::get($file['tmp_name']);

        $result = $this->manager->saveFile($path, $content);

        if ($result === true) {
            return redirect()
                ->back()
                ->with('success', 'File ‹ ' . $fileName . ' › uploaded successfully.');
        }

        $error = $result ?: "Error uploading file.";
        return redirect()
            ->back()
            ->withErrors([$error]);
    }

    /**
     * Delete file
     */
    public function deleteFile(Request $request)
    {
        $del_file = $request->get('del_file');
        $path = $request->get('folder') . '/' . $del_file;

        $result = $this->manager->deleteFile($path);

        if ($result === true) {
            return redirect()
                ->back()
                ->with('success', 'File ‹ ' . $del_file . ' › deleted.');
        }

        $error = $result ?: "Error deleting file.";
        return redirect()
            ->back()
            ->withErrors([$error]);
    }
}
