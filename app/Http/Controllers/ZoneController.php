<?php

namespace App\Http\Controllers;

use App\Helpers\Helpers;
use App\Http\Requests\ZoneRequest;
use App\Models\Zone;
use Illuminate\Http\Request;

class ZoneController extends Controller
{
    public function index()
    {
        $zones = Zone::all();
        $breads = [
            ['title' => 'Liste des Zones', 'url' => null],
            ['text' => 'Zones', 'url' => null], // You can set the URL to null for the last breadcrumb
        ];
        return view('pages.zone.index', compact('zones','breads'));
    }


    public function create()
    {
        return view('pages.zone.create');
    }



    public function store(ZoneRequest $request)
    {
        $customIdZ = Helpers::generateIdZ();
        $validatedData = $request->validated();

        $validatedData['id_Z'] = $customIdZ;
        Zone::create($validatedData);
        return redirect()->route('zone.index')->with('success', 'Zone created successfully');
    }

    public function edit($id)
    {
        $zone = Zone::find($id);
        if (!$zone) {
            return view('404');
        }
        return view('pages.zone.edit', compact('zone'));
    }
    public function update(ZoneRequest $request, $id)
    {

        $zone = Zone::find($id);
        if (!$zone) {
            return redirect()->route('zone.index')->with('error', 'Zone not found');
        }
        $zone->update($request->validated());
        return redirect()->route('zone.index')->with('success', 'Zone updated successfully');
    }

    public function destroy($id)
    {
        Zone::find($id)->delete();
        return redirect()->route('zone.index')->with('success', 'Zone deleted successfully');
    }
}
