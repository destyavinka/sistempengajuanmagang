<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use Illuminate\Http\Request;

class ProfilController extends Controller
{
   public function index()
   {
        $unit = Unit::get();
        return view('profil.form', ['unit' => $unit, 'user' => auth()->user()]);
   }

   public function update(Request $request)
   {
        $user = auth()->user();
        $user->update($request->all());
        return redirect()->route('profil');
   }
}
