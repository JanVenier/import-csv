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
    public function handle(): void
    {

        try {

            $csv = Reader::createFromPath(storage_path('app/' . $this->filePath), 'r');

            $csv->setHeaderOffset(0);
            $header = explode(';', $csv->getHeader()[0]);

            foreach ($csv as $row) {

                $values = explode(';', array_values($row)[0]);

                UserModel::updateOrCreate(['EMŠO' => array_combine($header, $values)['EMŠO']], array_combine($header, $values));
            }
        } catch (\Exception $e) {

            throw new Exception('Wrong table structure', 500);

        }

    }
}
