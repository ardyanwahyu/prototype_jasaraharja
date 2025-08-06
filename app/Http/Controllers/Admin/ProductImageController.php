<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Image;
use Illuminate\Support\Facades\Storage;

class ProductImageController extends Controller
{
    public function bulkDelete(Request $request)
    {
        $ids = $request->image_ids;
        if ($ids && count($ids)) {
            $images = Image::whereIn('id', $ids)->get();

            foreach ($images as $image) {
                Storage::delete('public/' . $image->image_path);
                $image->delete();
            }
        }

        return back()->with('success', 'Gambar terpilih berhasil dihapus.');
    }

    public function reorder(Request $request)
    {
        foreach ($request->order as $item) {
            Image::where('id', $item['id'])->update(['order' => $item['order']]);
        }

        return response()->json(['status' => 'ok']);
    }
}
