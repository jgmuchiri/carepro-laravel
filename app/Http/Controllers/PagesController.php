<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subscriptions\Plan;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class PagesController extends Controller
{
    public function index()
    {
        $plans = Plan::all();

        return view('homepage.welcome')->with(compact('plans'));
    }

    public function contact(){
        return view('homepage.contact');
    }
    function contactUs(Request $request){
        $rules = [
            'name' => 'required|max:50',
            'email' => 'required|max:50',
            'message' => 'required|max:1500'
        ];
        if(!empty($request->fname)){
            session(['alert'=>'You must verify you are human. Capcha incorrect','alert-level'=>'danger']);
            return redirect()->back()->withInput()->exceptInput('recaptcha','captcha');
        }
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $msg = 'Name: '.$request->name;
        $msg .='<br/>Email: '.$request->email;
        $msg .='<br/>Phone: '.$request->phone;
        $msg .='<hr/>'.$request->message;
        Mail::send('emails.plain-text', ['msg' => $msg], function ($m) use ($request) {
            $m->from($request->email, $request->name);
            $m->to(config('mail.from.address'),config('app.name'))->subject(config('app.name').' Website contact');
        });

        session(['alert'=>'Thank you! We will get back with you shortly.','alert-level'=>'success']);
        return redirect()->back();
    }
}
