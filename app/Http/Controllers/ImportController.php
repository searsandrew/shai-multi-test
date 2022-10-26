<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\Actions\ImportCSV;
use App\Models\Campaign;

use Auth;

class ImportController extends Controller
{
    private function injestCSVFile(Request $request)
    {
        $campaign = Campaign::where('uuid', $request->campaign)->first();
        $path = $request->file('file')->store('recipients/'.$campaign->uuid);
 
        return $path;
    }

    public function setupImport(Request $request)
    {
        $path = $this->injestCSVFile($request);
        $firstRow = fgetcsv(fopen(Storage::path($path), "r"), 10000, ",");
        Auth::user()->current_organization->setMeta('firstRow', json_encode($firstRow));

        return view('import.setup', compact('firstRow', 'path'));
    }

    public function setupColumn(Request $request)
    {
        $path = $request->path;
        $cleaned = $request->except(['_token', 'path']);

        Auth::user()->current_organization->setMeta('uploadPreset', json_encode($cleaned));

        ImportCSV::run($path);
    }
}
