<?php

namespace App\Jobs;

use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use League\Csv\Reader;
use App\Models\user_model as UserModel;

class ImportCsvData implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $filePath;
    /**
     * Create a new job instance.
     */
    public function __construct($csvFilePath)
    {
        $this->filePath = $csvFilePath;
    }

    /**
     * Execute the job.
     */
    public function handle(): void {

        try {

            $csv = Reader::createFromPath(storage_path('app/' . $this->filePath), 'r');
            $csv->setDelimiter(';');
            $csv->setHeaderOffset(0);

            foreach ($csv as $row) {

                UserModel::updateOrCreate(['EMŠO' => $row['EMŠO']], $row);
            }
        } catch (\Exception $e) {

            dd($e->getMessage());
            throw new Exception('Wrong table structure', 500);

        }

    }
}
