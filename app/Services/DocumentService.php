<?php

namespace App\Services;

use App\Models\Document;
use App\Interfaces\ModelInterface;

/**
 * Class to create/update documents
 */
class DocumentService implements ModelInterface
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
	 * Create resource in db
	 * @param int $doc_id
	 * @param array $tokens
	 * @return void
	 */
	public function updateOrCreate($doc_id, $tokens)
	{
		//insert data into mongodb
        return $this->document->updateOrCreate([
            'doc_id' => $doc_id
        ], [
            'doc_id' => $doc_id,
            'tokens' => $tokens
        ]);
	}
}