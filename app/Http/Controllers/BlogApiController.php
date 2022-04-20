<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class BlogApiController extends Controller
{
    public function index(){
        $blogs = Blog::all();
        return response()->json(['message' => 'Success', 'data' => $blogs]);
    }

    public function show($id){
        $blog = Blog::find($id);
        return response()->json(['message' => 'Success', 'data' => $blog]);
    }

    public function store(Request $request)
{
    $this->validate($request, [
        'image'     => 'required|image|mimes:png,jpg,jpeg',
        'title'     => 'required',
        'content'   => 'required'
    ]);

    // upload image
    $image = $request->file('image');
    $image->storeAs('public/blogs', $image->hashName());

    $blog = Blog::create([
        'image'     => $image->hashName(),
        'title'     => $request->title,
        'content'   => $request->content
    ]);
    return response()->json(['message' => 'Tambah Data Success', 'data' => $blog]);

    
}

    public function update(Request $request, Blog $blog)
    {
        $this->validate($request, [
            'title'     => 'required',
            'content'   => 'required'
        ]);
    
        //get data Blog by ID
        $blog = Blog::findOrFail($blog->id);
    
        if($request->file('image') == "") {
    
            $blog->update([
                'title'     => $request->title,
                'content'   => $request->content
            ]);
    
        } else {
    
            //hapus old image
            Storage::disk('local')->delete('public/blogs/'.$blog->image);
    
            //upload new image
            $image = $request->file('image');
            $image->storeAs('public/blogs', $image->hashName());
    
            $blog->update([
                'image'     => $image->hashName(),
                'title'     => $request->title,
                'content'   => $request->content
            ]);
    
        }
    
        return response()->json(['message' => 'Edit Data Success', 'data' => $blog]);
        
    }


    public function destroy($id)
    {
      $blog = Blog::findOrFail($id);
      Storage::disk('local')->delete('public/blogs/'.$blog->image);
      $blog->delete();
    
      return response()->json(['message' => 'Data berhasil dihapus', 'data' => $blog]);
    }    

}

