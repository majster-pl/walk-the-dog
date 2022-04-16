<?php

namespace App\Http\Controllers;

use App\Mail\ContactMeMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function index(Request $request)
    {
        if ($request->has('editor')) {
            # code...
            return view('contact.index', [
                'editor' => 'Please drop me short message and tick box at the bottom of this form if you want to become an editor.'
            ]);
        } else {
            return view('contact.index');
        }
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:2',
            'email' => 'required|email',
            'message' => 'required|min:10'
        ]);

        $details = [
            'title' => 'Query from walkthedog.info',
            'email' => $request->email,
            'name' => $request->name,
            'body' => $request->message,

        ];

        if ($request->has('')) {
            $details['editorRequest'] = true;
        }

        try {
            Mail::to('waliczek.szymon@gmail.com')->send(new ContactMeMail($details));
        } catch (\Exception $th) {
            return redirect()->back()->with(
                'error',
                '<i class="fa fa-paper-plane-o pe-2" aria-hidden="true"></i>
       There was a problem sending a message, please try again later!!<br>'. $th
            );
        }

        // If all ok redirect with message ...
        return redirect()->back()->with(
            'success',
            '<i class="fa fa-paper-plane-o pe-2" aria-hidden="true"></i>
 Thank you for your message, I\'ll get back to you shortly!'
        );
    }
}
