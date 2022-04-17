<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
    /**
     * Message POST.
     *
     * @return redirect
     */
    public function sendMessage(Request $request)
    {
		if ($request['area_code'] == "") {
			$request['area_code'] = "blank";
		}
		$inquiry_validation = array('required');
		$this->validate($request, [
			'name' => 'required',
			'email' => 'nullable|email',
			'phone' => 'nullable|numeric',
			'inquiry' => $inquiry_validation,
			'area_code' => 'in:blank',
		]);
		// Clean Data
		function sanitize_input($data) {
		   $data = trim($data);
		   $data = stripslashes($data);
		   $data = htmlspecialchars($data);
		   return $data;
		}
		// send email
		try {
			$today = date("j F, Y. H:i:s");
			$data['name'] = sanitize_input($request->name);
			$data['email'] = sanitize_input($request->email);
			$data['phone'] = sanitize_input($request->phone);
			$data['inquiry'] = sanitize_input($request->inquiry);
			Mail::send('emails.contact', $data, function ($message) use ($today) {
				$message->from('no-reply@oneziko.com', 'Covid-19 Viz Website');
				$message->to('info@oneziko.com', 'One Ziko Info')->subject('Covid-19 Viz Website Submission [' . $today . ']');
			});
		} catch (\Exception $e) {
			return redirect()->route('welcome')->withInput()->with('email_error', 'Message Sending Failed. Please Try Again!');
		}
		
        return redirect()->route('welcome')->with('email_sent', 'Message Successfully Sent!');
    }
}
