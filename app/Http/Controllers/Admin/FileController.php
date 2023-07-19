<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class FileController extends Controller
{
    public function index()
    {
        $files = File::orderBy('id', 'desc')->get();

        return view('admin.file.index', compact('files'));
    }

    public function create()
    {
        return view('admin.file.create');
    }

    public function store(Request $request)
    {
        $validator = $request->validate([
            'file' => 'required|file|max:5120|mimes:pdf',
            'key' => 'required|unique:files,key|min:3',
        ]);

        $extension = $request->file('file')->getClientOriginalExtension();
        $fileName = rand(). '.' .$extension;
        $path = $request->file('file')->storeAs('files', $fileName, 'public');

        $file = File::create([
            'file' => encrypt($fileName),
            'key' => Hash::make($request->key),
        ]);

        return redirect()->route('file.index')->with('status', 'Data File Berhasil Di Encrypt');
    }

    public function edit($id)
    {
        $f = File::find(decrypt($id));
        
        return view('admin.file.edit', compact('f'));
    }

    public function update(Request $request, $id)
    {
        $validator = $request->validate([
            'file' => 'nullable',
            'key' => 'required|min:3',
        ]);

        $file = File::find(decrypt($id));
        $keyOld = $file->key;

        // $extension = $request->file('file')->getClientOriginalExtension();
        // $fileName = rand(). '.' .$extension;
        // $path = $request->file('file')->storeAs('files', encrypt($fileName), 'public');

        if($request->key) {
            if(Hash::check($request->key, $keyOld)) {
                // $path = $request->file('file')->storeAs('files', decrypt($file->file), 'public');

                $file = File::find(decrypt($id))->update([
                    'file' => decrypt($file->file)
                ]);
            } else {
                return back()->withErrors([
                    'error' => 'Kunci Yang Anda Masukkan Salah !'
                ]);
            }
        }

        return redirect()->route('file.index')->with('status', 'Data Encrypt Berhasil Di Decrypt');
    }
}
