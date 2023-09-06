<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{   
    public function index()
    {
        return view('dashboard');
    }
    

    public function processCep(Request $request)
    {
        $cep = $request->input('cep');
        $url = "https://viacep.com.br/ws/{$cep}/json/";
        $addressData = json_decode(file_get_contents($url));
        session()->flash('cep', $cep);
        session()->flash('success', 'Endereço alterado com sucesso.');

        return view('dashboard', ['address' => $addressData]);
    }
}
