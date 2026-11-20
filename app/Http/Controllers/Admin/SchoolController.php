<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\School;

class SchoolController extends Controller
{
   public function index()
   {
        $title = "Data Sekolah";
        $schools = School::All();

        return view('admin.schools.index', compact('schools', 'title'));
   }

   public function create()
   {
        $title = "Tambah Data Sekolah";

        return redirect()->back();
   }

   public function store(Request $request)
   {
        $request->validate([
            'name' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'email' => 'nullable|email',
            'principal_name' => 'nullable|string',
        ]);

        School::create($request->all());

        return redirect()->route('admin.schools.index');
   }

   public function edit($id_school)
   {   
        $title = "Halaman Edit Data Sekolah"; 
        $schools = School::findOrFail($id_school); // Ini akan mendapatkan data sekolah dengan id_school yang diberikan
        return view('admin.schools.edit', compact('schools'));
   }

   public function update(Request $request, $id_school)
   {
     $request->validate([
          'name' => 'nullable',
          'address' => 'nullable',
          'phone' => 'nullable',
          'email' => 'nullable|email',
          'principal_name' => 'nullable|string',
     ]);

     // Update data sekolah berdasarkan id
     $school = School::findOrFail($id_school);
     $school->update($request->all());

     return redirect()->route('admin.schools.index');
   }

   public function destroy($id_school)
   {
        $school->delete();
        return redirect()->route('admin.schools.index');
   }
}
