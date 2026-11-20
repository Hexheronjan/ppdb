<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\FormGroup;

class FormGroupController extends Controller
{
    public function index()
    {
        $formGroups = FormGroup::all();
        return view('admin.form_groups.index', compact('formGroups'));
    }

    public function create()
    {
        return view('admin.form_groups.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:form_groups',
            'description' => 'nullable',
            'acamdemic_year' => 'nullable',
            'category' => 'nullable',
        ]);

        FormGroup::create($request->all());

        return redirect()->route('admin.form_groups.index')->with('success', 'Form berhasil dibuat!');
    }

    public function edit($id_form)
    {
        // Ambil data form group berdasarkan ID
        $formGroup = FormGroup::findOrFail($id_form);
        return view('admin.form_groups.edit', compact('formGroup'));
    }

    public function update(Request $request, $id_form)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|unique:form_groups,name,' . $id_form . ',id_form',
            'description' => 'nullable',
            'acamdemic_year' => 'nullable',
            'category' => 'nullable',
        ]);

        // Ambil data form group dan update
        $formGroup = FormGroup::findOrFail($id_form);
        $formGroup->update($request->all());

        return redirect()->route('admin.form_groups.index')->with('success', 'Form berhasil diperbarui!');
    }

    public function destroy($id_form)
    {
        // Ambil data form group dan hapus
        $formGroup = FormGroup::findOrFail($id_form);
        $formGroup->delete();

        return redirect()->route('admin.form_groups.index')->with('success', 'Form berhasil dihapus!');
    }

    public function toggleStatus($id_form)
    {
        $formGroup = FormGroup::findOrFail($id_form);
        $formGroup->is_active = !$formGroup->is_active;
        $formGroup->save();

        return redirect()->back()->with('success', 'Status formulir berhasil diperbarui.');
    }

}

