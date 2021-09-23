<?php

namespace App\Console\Commands;

use App\Services\SearchService;
use Illuminate\Console\Command;
use App\Validations\SearchValidation;

class SearchIndexCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'search:index {document?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command is used to search on indexed collection of documents in the mongo database';

    /**
     * DocumentService $service
     *
     * @var string
     */
    protected $searchService;

    /**
     * SearchValidation $validation
     *
     * @var string
     */
    protected $validation;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(SearchService $searchService, SearchValidation $validation)
    {
        parent::__construct();
        $this->validation = $validation;
        $this->searchService = $searchService;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $array = [];
        $query = $this->ask('Type something to search...');

        //validate query expression
        $validator = $this->validation->validateInput($query);

        if ($validator->fails() && isset($validator->errors()->all()[0])) {
            $this->error($validator->errors()->all()[0]);

            $this->handle();
        } else {
            $results = $this->searchService->searchCollection($query);

            if (count($results) > 0) {
                return $this->info("Query results: ".implode(' ', $results));
            } else {
                return $this->error("Query Error: No results found");
            }
        }
    }
}
