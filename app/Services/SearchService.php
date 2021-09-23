<?php

namespace App\Services;

use App\Models\Document;
use App\Interfaces\SearchInterface;

/**
 * Class to search collection of documents
 */
class SearchService implements SearchInterface
{
	/**
	 * @var
	 */
	protected Document $document;

	/**
	 * @param App\Models\Document
	 */
	public function __construct(Document $document)
    {
        $this->document = $document;
    }

	/**
	 * Search documents
	 * @param array $query
	 * @return mixed
	 */
	public function searchCollection($query)
	{
		return $this->document->whereRaw([
			'$text' => [
				'$search' => $query
			]
		])
		->orderBy('doc_id', 'asc')
		->pluck('doc_id')
		->toArray();
	}
}