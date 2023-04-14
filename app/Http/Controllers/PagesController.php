<?php

namespace App\Http\Controllers;

use App\Repositories\Interfaces\EntryRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;
use App\Exceptions\EntryExistException;

class PagesController extends Controller
{
    /**
     * Constructor
     */
    public function __construct(private EntryRepositoryInterface $entryRepository) {

    }

    /**
     * Home page that contains the form
     *
     * @param  Request  $request
     * @return void
     */
    public function home(Request $request)
    {
        return Inertia::render('Home');
    }

    /**
     * Form POST request
     *
     * @param  Request  $request
     * @return void
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|email',
            'phone_number' => 'required|string',
            'agree_rules' => 'required',
            'subscribed_to_newsletter' => 'nullable',
        ], [
            'agree_rules.required' => 'You must agree with our rules.',
            'required' => 'This :attribute is required.',
        ]);

        $validated = $validator->validate();

        try {
            $entry = $this->entryRepository->saveEntry($validated);
            return redirect()->route('confirmation');
        } catch (EntryExistException $e) {
            return redirect()->back()->withErrors(['save_error' => 'You have already entered for today. You can only once per day.']);
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['save_error' => 'There was an error while saving your data.' . $e->getMessage()]);
        }
    }

    /**
     * Confirmation Page
     *
     * @param  Request  $request
     * @return void
     */
    public function confirmation(Request $request)
    {
        return Inertia::render('Confirmation');
    }
}
