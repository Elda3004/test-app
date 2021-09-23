<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Document extends Eloquent
{
    use HasFactory;

    /**
	 * @var
	*/
	protected $connection = 'mongo';

	/**
	 * @var
	*/
    protected $collection = 'documents';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
       'doc_id', 'tokens'
    ];

    /**
     * @param array
    */
    public function setTokensAttribute($array)
    {
        $this->attributes['tokens'] = implode(' ', $array);
    }
}
