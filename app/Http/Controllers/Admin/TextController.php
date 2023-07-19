<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Text;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class TextController extends Controller
{
    public function index()
    {
        $texts = Text::orderBy('id', 'desc')->get();

        return view('admin.text.index', compact('texts'));
    }

    public function create()
    {
        return view('admin.text.create');
    }

    public function store(Request $request)
    {
        $validator = $request->validate([
            'text' => 'required',
            'key' => 'required|unique:texts,key|min:3',
        ]);

        $text = Text::create([
            'text' => encrypt($request->text),
            'key' => Hash::make($request->key), 
        ]);

        return redirect()->route('text.index')->with('status', 'Data Encrypt Berhasil Di Buat');
    }

    public function edit($id)
    {
        $t = Text::find(decrypt($id));

        return view('admin.text.edit', compact('t'));
    }

    public function update(Request $request, $id)
    {
        $validator = $request->validate([
            'text' => 'nullable',
            'key' => 'required|min:3',
        ]);

        $text = Text::find(decrypt($id));
        $keyOld = $text->key;

        if($request->key) {
            if(Hash::check($request->key, $keyOld)) {
                $text = Text::find(decrypt($id))->update([
                    'text' => decrypt($request->text)
                ]);
            } else {
                return back()->withErrors([
                    'error' => 'Kunci Yang Anda Masukkan Salah !'
                ]);
            }
        }

        return redirect()->route('text.index')->with('status', 'Data Encrypt Berhasil Di Decrypt');
    }
}
