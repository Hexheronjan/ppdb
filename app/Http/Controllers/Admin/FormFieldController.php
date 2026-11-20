<?php

namespace App\Http\Controllers\Admin;

use App\Models\FormField;
use App\Models\FormGroup;
use Illuminate\Http\Request;

class FormFieldController extends Controller
{
    public function index($id_form)
    {
        $formGroup = FormGroup::findOrFail($id_form);
        $fields = $formGroup->fields; // Ambil field berdasarkan form
        return view('admin.form_fields.index', compact('formGroup', 'fields'));
    }

    public function create($id_form)
    {
        $formGroup = FormGroup::findOrFail($id_form);
        return view('admin.form_fields.create', compact('formGroup'));
    }

    public function store(Request $request, $id_form)
    {
        $request->validate([
            'name' => 'required',
            'type' => 'required',
            'label' => 'required',
        ]);

        FormField::create([
            'id_form' => $id_form,
            'name' => $request->name,
            'type' => $request->type,
            'label' => $request->label,
            'placeholder' => $request->placeholder,
            'options' => $request->options,
            'required' => $request->has('required'),
        ]);

        return redirect()->route('admin.form_fields.index', $id_form)->with('success', 'Field berhasil ditambahkan!');
    }

    public function edit($id_form, $id_field)
    {
        // Ambil data form group dan field berdasarkan ID
        $formGroup = FormGroup::findOrFail($id_form);
        $field = FormField::findOrFail($id_field);

        return view('admin.form_fields.edit', compact('formGroup', 'field'));
    }

    public function update(Request $request, $id_form, $id_field)
    {
        // Validasi input
        $request->validate([
            'name' => 'required',
            'type' => 'required',
            'label' => 'required',
        ]);

        // Ambil field yang akan diupdate
        $field = FormField::findOrFail($id_field);

        // Update field
        $field->update([
            'name' => $request->name,
            'type' => $request->type,
            'label' => $request->label,
            'placeholder' => $request->placeholder,
            'options' => $request->options,
            'required' => $request->has('required'),
        ]);

        return redirect()->route('admin.form_fields.index', $id_form)->with('success', 'Field berhasil diperbarui!');
    }

    public function destroy($id_form, $id_field)
    {
        // Ambil field dan hapus
        $field = FormField::findOrFail($id_field);
        $field->delete();

        return redirect()->route('admin.form_fields.index', $id_form)->with('success', 'Field berhasil dihapus!');
    }

}


