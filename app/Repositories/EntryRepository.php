<?php

namespace App\Repositories;

use App\Exceptions\EntryExistException;
use App\Models\User;
use App\Models\Entry;
use App\Repositories\Interfaces\EntryRepositoryInterface;
use Carbon\Carbon;


/**
 * Class EntryRepository
 *
 * @author Andy Chang<softdev1114@gmail.com>
 */

class EntryRepository implements EntryRepositoryInterface
{
    /**
     * Save the data to Entry table
     *
     * @param array $input
     * @return Entry
     *
     * @throws EntryExistException
     */
    public function saveEntry(array $input): Entry
    {
        $user = User::firstOrCreate(['email' => $input['email']], ['subscribed_to_newsletter' => $input['subscribed_to_newsletter'] ?? 0]);
        if (!$user->lastEntry || Carbon::createFromFormat('Y-m-d H:i:s', $user->lastEntry->created_at)->format("Y-m-d") < Carbon::now()->format('Y-m-d')) {
            $entry = Entry::create([
                        'user_id' => $user->id,
                        'first_name' => $input['first_name'],
                        'last_name' => $input['last_name'],
                        'phone_number' => $input['phone_number'],
                    ]);
            return $entry;
        } else {
            throw new EntryExistException("You've already entered data for today.");
        }
    }
}
