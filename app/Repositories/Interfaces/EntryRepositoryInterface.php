<?php

namespace App\Repositories\Interfaces;

use App\Exceptions\EntryExistException;
use App\Models\Entry;

/**
 * Interface EntryRepositoryInterface
 *
 * @author Andy Chang<softdev1114@gmail.com>
 */
interface EntryRepositoryInterface
{
    /**
     * Save the data to Entry table
     *
     * @param array $input
     * @return Entry
     *
     * @throws EntryExistException
     */
    public function saveEntry(array $input): Entry;
}

