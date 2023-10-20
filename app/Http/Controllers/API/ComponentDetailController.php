<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Album;
use App\Models\Component\Component;
use App\Models\ComponentDetail\ComponentDetail;
use Illuminate\Http\Request;

class ComponentDetailController extends Controller
{
    public function destroy($id)
    {
        $detail = ComponentDetail::findOrFail($id);
        $detail->delete();

        return response()->json(['message' => 'Component detail deleted successfully']);
    }

    public function change_album(Request $request)
    {

        $album_id = $request->input('album_id');
        $component_id = $request->input('component_id');
        $new_album = Album::find($album_id);
        $component = Component::find($component_id);

        $component->update(['album_id' => $album_id]);
        if($component->album_id == $album_id) {
            return response()->json([
                'message' => 'Album successfully changed. New album id: ' . $album_id,
                'images' => $component->album->images
            ]);
        }


    }
}
