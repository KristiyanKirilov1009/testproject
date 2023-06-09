<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\INewsletter;
use Exception;
use App\Services\MailchimpNewsletter;
use App\Services\Newsletter;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class NewsletterController extends Controller
{
    public function __invoke(INewsletter $newsletter)
    {

        request()->validate(['email' => 'required|email']);



        try {

            $newsletter->subscribe(request('email'));
        } catch (\Exception $e) {
            dd($e);
            throw ValidationException::withMessages([
                'email' => 'This email could not be added to our newletter list'
            ]);
        }

        return redirect('/')->with('success', 'You are now signed up for our newsletter');
    }
}
