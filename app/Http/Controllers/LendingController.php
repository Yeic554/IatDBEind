<?php

namespace App\Http\Controllers;

use App\Lending;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class LendingController extends Controller
{
    public function index(Request $request)
    {

        $lendings = Lending::where('borrower_id', auth()->id())
                           ->orWhere('lender_id', auth()->id())
                           ->latest() 
                           ->paginate(5);  

        return view('lendings.index', compact('lendings'));
    }

    public function store(Request $request, Product $product)
    {
        $validated = $request->validate([
            'return_date' => 'required|date|after:today',
        ]);
    
        Lending::create([
            'product_id' => $product->id,
            'lender_id' => $product->user_id,
            'borrower_id' => auth()->id(),
            'return_date' => $validated['return_date'],
        ]);
    
        $product->update(['is_available' => false]);
        return redirect()->route('lendings.index')->with('status', 'Product succesvol uitgeleend!');
    }

    public function show($id)
    {
        $lending = Lending::findOrFail($id);

        if (auth()->user()->id != $lending->lender_id) {
        abort(403, 'Je kunt geen review schrijven als lener.');
        }

        return view('lendings.show', compact('lending'));
    }

    public function returnProduct($id)
    {
        $lending = Lending::findOrFail($id);

        if ($lending->borrower_id != auth()->id()) {
            abort(403, 'Je kunt dit product niet teruggeven.');
        }

        $lending->update([
            'is_returned' => true,
        ]);

        $lending->product->update([
            'is_available' => true,
        ]);

        return redirect()->route('lendings.index')->with('success', 'Product is succesvol teruggegeven.');
    }

}
