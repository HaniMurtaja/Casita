<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\Log;
use Illuminate\Http\Request;

class CountryController extends Controller
{
   
    public function index()
    {
        $countries = Country::all();
        return view('countries.index', compact('countries'));
    }

    
    public function create()
    {
        return view('countries.create');
    }

    
    public function store(Request $request)
    {
        $country = Country::create($request->all());

        
        Log::create([
            'model_type' => 'Country',
            'model_id' => $country->id,
            'changes' => json_encode(['created' => $request->all()])
        ]);

        return redirect()->route('countries.index');
    }

   
    public function edit($id)
    {
        $country = Country::findOrFail($id);
        return view('countries.edit', compact('country'));
    }

    
    public function update(Request $request, $id)
    {
        $country = Country::findOrFail($id);

        
        $originalData = $country->getOriginal();
        $country->update($request->all());

        Log::create([
            'model_type' => 'Country',
            'model_id' => $country->id,
            'changes' => json_encode([
                'old' => $originalData,
                'new' => $request->all()
            ])
        ]);

        return redirect()->route('countries.index');
    }

    
    public function destroy($id)
    {
        $country = Country::findOrFail($id);

       
        Log::create([
            'model_type' => 'Country',
            'model_id' => $country->id,
            'changes' => json_encode(['deleted' => $country->toArray()])
        ]);

        $country->delete();

        return redirect()->route('countries.index');
    }

   
    public function logs()
    {
        $logs = Log::all();
        return view('countries.logs', compact('logs'));
    }
}

