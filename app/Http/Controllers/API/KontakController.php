<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\kontak;
use Illuminate\Http\Request;

class KontakController extends Controller
{
    public function getKontak(Request $request)
    {
        $userId = $request->header('userid');

        $kontaks = Kontak::where('teman_id', $userId)->get();

        return response()->json([
            'kontaks' => $kontaks,
        ]);
    }

    public function create(Request $request)
    {
        $kontak = new kontak();
        $kontak->name = $request->name;
        $kontak->email = $request->email;
        $kontak->notelp = $request->notelp;
        $kontak->teman_id = $request->userId;
        $kontak->save();

        $response = [
            'success' => true,
            'message' => 'add kontak succesfully',
        ];

        return response()->json($response, 200);
    }

    public function edit(Request $request, $id)
    {

        $kontak = kontak::findOrFail($id);
        return response()->json($kontak, 200);
    }

    public function update(Request $request, $id)
    {

        $kontak = Kontak::findOrFail($id);

        // Memperbarui data kontak berdasarkan data yang diberikan dari request
        $kontak->update($request->all());

        return response()->json([
            'success' => true,
            'message' => 'update kontak succesfully',
            'kontak' => $kontak,
        ]);
    }

    public function destroy($id)
    {
        $item = Kontak::find($id);
        $item->delete();

        return response()->json(['message' => 'Kontak deleted successfully']);
    }

    public function search(Request $request)
    {
        $keyword = $request->input('keyword');

        $items = Kontak::where('name', 'LIKE', "%$keyword%")
            ->orWhere('email', 'LIKE', "%$keyword%")
            ->orWhere('notelp', 'LIKE', "%$keyword%")
            ->get();

        return response()->json($items);
    }
}
