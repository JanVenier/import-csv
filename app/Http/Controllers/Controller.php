<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Validator;
use League\Csv\Reader;
use App\Jobs\ImportCsvData;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function showUploadForm(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('users');
    }

    public function upload (Request $request): \Illuminate\Http\RedirectResponse
    {

        if (!$request->file()) {

            return redirect()->back()->with('error', 'Upload a file first');
        }
        // Validate the uploaded file type
        $validator = Validator::make($request->all(), [
            'csv_file' => 'required|file|mimes:csv,txt',
        ]);

        if ($validator->fails()) {

            return redirect()->back()->with('error', 'Wrong type of file uploaded');
        }

        // Process and import the CSV file
        try {
            $file = $request->file('csv_file');

            if (!$file) {

                return redirect()->back()->with('error', 'No csv file detected.');
            }

            $path = $file->store('csv_imports');

            ImportCsvData::dispatch($path);

        } catch (\Exception $e) {

            return redirect()->back()->with('error', $e->getMessage());
        }

        return redirect()->back()->with('success', 'CSV file uploaded and data imported successfully.');
    }
}
