<?php

namespace App\Interfaces;

/**
 *
 */
interface ModelInterface {
	public function updateOrCreate(int $id, array $data);
}