<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JenisLayanan;
use App\Models\Komentar;
use Mail;

class ContactController extends Controller
{

  public function contact_us()
  {
    $jenisLayanan = JenisLayanan::all();
    $komentar = Komentar::all()->take(-3);
    return view('user.contact-us', compact('jenisLayanan', 'komentar'));
  }

  public function post_contact(Request $request) {

        // Form validation
        // $this->validate($request, [
        //     'name' => 'required',
        //     'email' => 'required|email',
        //     'subject'=>'required',
        //     'message1' => 'required'
        //  ]);

         // Send mail to admin

         try {

           $status = "success";

           \Mail::send('user.contactUs',
                    array(
                        'name' => $request->get('name'),
                        'email' => $request->get('email'),
                        'subject' => $request->get('subject'),
                        'user_message' => $request->get('message1'),
                    ), function($message) use ($request)
                      {
                         $message->from($request->email);
                         $message->to('Bangik12@gmail.com');
                      });

          return view('user.contact-us', compact('status'));

         } catch (\Exception $e) {
           $status = "error";
          return view('user.contact-us', compact('status'));

         }


    }
}
