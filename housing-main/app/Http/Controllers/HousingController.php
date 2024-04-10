<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use App\Models\housing;
 
class housingController extends Controller
{
    public function index()
    {
        $housings = housing::orderBy('id', 'desc')->get();
        return view('admin.housing.home', compact(['housing']));
    }
 
    public function create()
    {
        return view('admin.housing.create');
    }
 
    public function save(Request $request)
    {
        $validation = $request->validate([
            'city' => 'required',
            'adres' => 'required',
            'type' => 'required',
        ]);
        $data = housing::create($validation);
        if ($data) {
            session()->flash('success', 'housing Add Successfully');
            return redirect(route('admin/housings'));
        } else {
            session()->flash('error', 'Some problem occure');
            return redirect(route('admin.housings/create'));
        }
    }
    public function edit($id)
    {
        $housings = housing::findOrFail($id);
        return view('admin.housing.update', compact('housings'));
    }
 
    public function delete($id)
    {
        $housings = housing::findOrFail($id)->delete();
        if ($housings) {
            session()->flash('success', 'housing Deleted Successfully');
            return redirect(route('admin/housings/'));
        } else {
            session()->flash('error', 'housing Not Delete successfully');
            return redirect(route('admin/housings/'));
        }
    }
 
    public function update(Request $request, $id)
    {
        $housings = housing::findOrFail($id);
        $city = $request->city;
        $adres = $request->adres;
        $type = $request->type;
 
        $housings->city = $city;
        $housings->adres = $adres;
        $housings->type = $type;
        $data = $housings->save();
        if ($data) {
            session()->flash('success', 'housing Update Successfully');
            return redirect(route('admin/housings'));
        } else {
            session()->flash('error', 'Some problem occure');
            return redirect(route('admin/housings/update'));
        }
    }
}