<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Product;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index()
    {
        $users = User::all();
        $products = Product::where('is_available', true)
                          ->whereDoesntHave('lendings') 
                          ->get();
        return view('admin.dashboard', compact('users', 'products'));
    }

    public function toggleBlock(User $user)
    {
        $user->is_blocked = !$user->is_blocked;
        $user->save();
        
        return redirect()->route('admin.dashboard')->with('success', 'Gebruiker status is aangepast!');
    }

    public function deleteProduct(Product $product)
    {
        if ($product->is_available && $product->lendings->isEmpty()) {
            $product->delete();
            return redirect()->route('admin.dashboard')->with('success', 'Product succesvol verwijderd.');
        }

        return redirect()->route('admin.dashboard')->with('error', 'Product kan niet worden verwijderd, het is mogelijk uitgeleend.');
    }
}
