<?php

namespace App\Http\Controllers;
use App\Models\Lecturer;

use App\Http\Middleware\Lecturer as le;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function addtag(Request $request)
    {

    $lecturer=Lecturer::find($request->id);
    
        $lecturer->tags()->syncWithoutDetaching( $request->tags);
        return redirect(route('lecturerhome'));


    }

    public function deltag(Tag $tag)
    {
       $user=Lecturer::find(auth()->guard('lecturer')->user()->id);
       $user->tags()->detach($tag);
    
        return redirect()->route('lecturerhome')
                        ->with('success','Project deleted deleted successfully');


    }
 
    public function destroy(Tag $tag)
    {
        //
    }
}
