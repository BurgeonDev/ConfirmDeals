<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Newsletter;
use Illuminate\Http\Request;
use App\Mail\NewsletterMail;
use Illuminate\Support\Facades\Mail;

class NewsletterAdminController extends Controller
{
    public function index()
    {
        $subscribers = Newsletter::all();
        return view('admin.newsletters.index', compact('subscribers'));
    }

    public function destroy($id)
    {
        Newsletter::findOrFail($id)->delete();
        return back()->with('success', 'Subscriber deleted successfully.');
    }

    public function sendNewsletter(Request $request)
    {
        $request->validate([
            'content' => 'required',
        ]);

        $subscribers = Newsletter::where('is_subscribed', true)->get();

        foreach ($subscribers as $subscriber) {
            Mail::to($subscriber->email)->queue(new NewsletterMail($request->content));
        }

        return back()->with('success', 'Newsletter sent successfully!');
    }
}
