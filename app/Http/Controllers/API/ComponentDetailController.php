<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Album;
use App\Models\Component\Component;
use App\Models\ComponentDetail\ComponentDetail;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ComponentDetailController extends Controller
{
    public function updateOrder(Request $request): \Illuminate\Http\JsonResponse
    {
        $pageId = $request->page_id;
        $newOrder = $request->order;

        try {
            DB::beginTransaction();

            $page = Page::findOrFail($pageId);

            foreach ($newOrder as $data) {
                $componentId = $data['id'];
                $componentOrder = $data['order'];

                if ($page->components()->find($componentId)) {
                    $page->components()->updateExistingPivot($componentId, ['order' => $componentOrder]);
                }
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Order updated successfully.'
            ]);

        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error('Order update failed: ' . $e->getMessage());

            return response()->json([
                'message' => 'An error occurred while updating the order.' . $e->getMessage(),
                'error' => true
            ],
                500);
        }
    }
    public function getDetailRowTemplate(): \Illuminate\Http\JsonResponse
    {
        $markup = view('includes.admin.component.ajax.new-detail-row')->render();
        return response()->json([
            'success' => true,
            'markup' => $markup,
            'message' => 'Component album disconnected successfully'
        ]);
    }
    public function album_disconnect($component_id)
    {
        $component = Component::findOrFail($component_id);
        $component->update(['album_id' => null]);

        return response()->json(['message' => 'Component album disconnected successfully']);
    }
    public function destroy($id)
    {
//        dd($id);
        $detail = ComponentDetail::findOrFail($id);
        $detail->delete();

        return response()->json([
            'success' => true,
            'message' => 'Component detail deleted successfully'
        ]);
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
    public function attach_form(Request $request)
    {
        dd($request);
    }
}
