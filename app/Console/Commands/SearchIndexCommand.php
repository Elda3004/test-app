<?php

namespace App\Console\Commands;

use App\Services\SearchService;
use Illuminate\Console\Command;

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
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(SearchService $searchService)
    {
        parent::__construct();
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
        $query = preg_replace('/[^A-Za-z0-9\-]/', ' ', $query);
        $array = preg_split("/\s+/", $query);

        $array = array_filter($array);

        $results = $this->searchService->searchCollection($array);

        if (count($results) > 0) {
            return $this->info("Query results: ".implode(' ', $results));
        }

        return $this->error("Error: No results found");
    }
}
