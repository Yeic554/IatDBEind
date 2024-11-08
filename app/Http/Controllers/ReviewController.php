<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Review;
use App\Lending;

class ReviewController extends Controller
{
    public function index()
    {
        $reviews = Review::all();
        return view('reviews.index', compact('reviews'));
    }

    public function show(Review $review)
    {
        return view('reviews.show', compact('review'));
    }

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'content' => 'required|string',
            'rating' => 'required|integer|between:1,5',
            'lending_id' => 'required|exists:lendings,id',
            'reviewed_id' => 'required|exists:users,id',
        ]);

        $lending = Lending::findOrFail($validated['lending_id']);

        if ($lending->lender_id !== auth()->id()) {
            return redirect()->route('lendings.index')->with('error', 'Je kunt alleen een review schrijven voor een uitlening waarvan jij de uitleverende partij bent.');
        }

        Review::create([
            'content' => $validated['content'],
            'rating' => $validated['rating'],
            'lending_id' => $validated['lending_id'],
            'reviewed_id' => $validated['reviewed_id'],
            'reviewer_id' => auth()->id(), 
        ]);

        return redirect()->route('lendings.show', $lending->id)->with('success', 'Review succesvol opgeslagen!');
    }
}
