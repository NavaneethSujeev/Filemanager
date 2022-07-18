<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\file;
use Session;

class filemanager extends Controller
{
    public function filemanager(Request $request){    
        $id        = $request->has('id')?$request->id:0;
        $fulldata  = file::get();
        $data      = file::where('locationId',$id)->get();

         return view('files',compact('data','fulldata','id'));
    
    }
    public function addfolder(Request $request){

        $locationId = $request->has('locationId')? $request->locationId:0;

        $folder              = new file();
        $folder->Filename    = $request->name;
        $folder->locationId  = $locationId;
        $folder->type        = 'Folder';
        $folder->save();

        return redirect()->route('filemanager')->with('message', 'File Added');
    }
    public function delete(Request $request){
       
        $id   = $request->id;
        $data = file::where('id',$id)->first();

        if($data->type == 'Folder'){
            $delete = file::where('id',$id)->orWhere('locationId',$id)->delete();
        }else{
            $delete = file::find($id);
            $delete->delete();
        }
        
    }
    public function addfile(Request $request){

        $imageName = time().'.'.$request->image->extension();  
        $request->image->move(public_path('images'), $imageName);
        $locationId = $request->has('locationId')? $request->locationId:0;
        // if($request->image->extension() == "jpg")

        $folder              = new file();
        $folder->Filename    = $imageName;
        $folder->locationId  = $locationId;
        $folder->type        = "file";
        $folder->save();
        return redirect()->route('filemanager')->with('message', 'uploaded');
    }
    public function edit(Request $request){    
        $id = $request->get('id');
        $data     = file::where('id',$id)->first();

        return $data;
    }
    public function update(Request $request){    
        $name = $request->get('editname');
        $id   = $request->get('editid');

        $data   = file::where('id',$id)->update([
            'Filename'=>$name,
        ]);

        return redirect()->route('filemanager')->with('message', 'Name changed');

    }
}
