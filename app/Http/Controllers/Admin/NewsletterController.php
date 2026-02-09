<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Newsletter;
use Illuminate\Http\Request;

class NewsletterController extends Controller
{
    public function index()
    {
        $subscribers = Newsletter::orderBy('created_at', 'desc')->get();
        return view('admin.newsletter.index', compact('subscribers'));
    }

    public function destroy(Newsletter $newsletter)
    {
        $newsletter->delete();

        return redirect()->route('admin.newsletter.index')
            ->with('success', 'Subscriber removed successfully!');
    }

    public function export()
    {
        $subscribers = Newsletter::where('is_active', true)->pluck('email');
        
        $filename = 'newsletter_subscribers_' . date('Y-m-d') . '.csv';
        
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function() use ($subscribers) {
            $file = fopen('php://output', 'w');
            fputcsv($file, ['Email', 'Subscribed At']);
            
            foreach (Newsletter::where('is_active', true)->get() as $subscriber) {
                fputcsv($file, [$subscriber->email, $subscriber->created_at->format('Y-m-d H:i:s')]);
            }
            
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
