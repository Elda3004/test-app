<?php

namespace App\Console\Commands;

use App\Models\Document;
use Illuminate\Console\Command;
use App\Services\DocumentService;
use App\Validations\DocumentValidation;

class IndexCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'add:index {document?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command is used for the indexing of documents in mongo db database';

    /**
     * DocumentService $service
     *
     * @var string
     */
    protected $service;

    /**
     * DocumentValidation $validation
     *
     * @var string
     */
    protected $validation;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(DocumentService $service, DocumentValidation $validation)
    {
        parent::__construct();
        $this->service = $service;
        $this->validation = $validation;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $array = [];
        $input = $this->ask('Type some input...');

        if (!is_null($input)) {

            $array = preg_split("/\s+/", $input);

            $validator = $this->validation->validateInput($input);

            if ($validator->fails()) {
                $this->info('Index not created. Please corret the errors below:');

                foreach ($validator->errors()->all() as $error) {
                    $this->error($error);
                }

                return 1;
            }

            $docId = $array[0];
            unset($array[0]);

            //after passing validations
            $inserted = $this->service->updateOrCreate($docId, $array);

            if ($inserted) {
                return $this->info("Ok: ".$inserted['doc_id']);
            }

            return $this->error("Error: Could not proccess the document.");
        }
    }
}
