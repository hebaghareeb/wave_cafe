<?php

namespace App\Http\Controllers;
use ErlandMuchasaj\LaravelFileUploader\FileUploader; 
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Strorage;
use App\Models\Category;
use App\Models\Beverages;
class beveragesController extends Controller
{
    public function index()
    {
        $beverages = Beverages::all();
        return view ('admin.beverages',['beverages' => $beverages]);
    }
    public function addBeverage()
    {
        $categories = Category::all();
        return view('admin.addBeverage',['categories' => $categories]);
    }
    public function editBeverage(string $id)
    {
        $categories = Category::all();
        $beverage = Beverages::findOrFail($id);
        return view('admin.editBeverage',['beverage' => $beverage,'categories' => $categories]);
    }
    public function deleteBeverage(string $id)
    {
        Beverages::where('id',$id)->delete();
        return redirect('beverages');
    }
    public function updateBeverag(Request $request,string $id)
    {echo "hello in update";
        if($request->has('cancel'))
            return redirect('beverages');
        else if($request->has('update'))
        {
            if(isset($request->published))
                $published = 'yes';
            else $published = 'no';
        
            if(isset($request->special))
                $special = 'yes';
            else $special = 'no';

            if (isset($request->image))
            {
                $imageName =$request->file('image')->getClientOriginalName();
                Beverages::where('id',$id)->update(['title' => $request->title,'content'=>$request->content,
                'price'=>$request->price,'published'=>$published,'special'=>$special,'image'=>$imageName,
                'category_id'=>$request->category]);
                $request->file('image')->move(public_path('beverages_images'), $imageName);
                return redirect('beverages');
            }
            else 
            {
                Beverages::where('id',$id)->update(['title' => $request->title,'content'=>$request->content,
                'price'=>$request->price,'published'=>$published,'special'=>$special,'category_id'=>$request->category]);
                return redirect('beverages');
            }

        }
    }
    public function createBeverage(Request $request)
    {
        if($request->has('cancel'))
            return redirect('beverages');
        else if($request->has('add'))
        {
        $beverage = new Beverages();
        $beverage->title = $request->title;
        $beverage->content = $request->content;
        $beverage->price = $request->price;
        if(isset($request->published))
            $published = 'yes';
        else $published = 'no';
        $beverage->published = $published;
        if(isset($request->special))
            $special = 'yes';
        else $special = 'no';
        $beverage->special	 = $special;
        $beverage->category_id = $request->category;
     $imageName =$request->file('image')->getClientOriginalName();
     $beverage->image = $imageName;
     $beverage->save();
     $request->file('image')->move(public_path('beverages_images'), $imageName);
    return redirect('beverages');
        }
    }
}
