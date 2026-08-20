<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Newsletter;
use Illuminate\Http\Request;

class NewsletterController extends Controller
{
    public function index(Request $request)
    {
        $query = Newsletter::query();
        if ($request->filled('q')) {
            $query->where('email', 'like', '%' . $request->q . '%');
        }
        
        $subscribers = $query->latest()->paginate(20);
        return view('admin.newsletters.index', compact('subscribers'));
    }

    public function export()
    {
        $subscribers = Newsletter::latest()->get();
        
        $csvHeader = "ID,Email,Subscribed At\n";
        $csvData = "";
        
        foreach($subscribers as $sub) {
            $csvData .= "{$sub->id},{$sub->email},{$sub->created_at->format('Y-m-d H:i:s')}\n";
        }
        
        return response($csvHeader . $csvData)
            ->header('Content-Type', 'text/csv')
            ->header('Content-Disposition', 'attachment; filename="subscribers-'.date('Y-m-d').'.csv"');
    }

    public function destroy(Newsletter $newsletter)
    {
        $newsletter->delete();
        return redirect()->route('admin.newsletters.index')->with('success', 'Subscriber removed successfully.');
    }
}
