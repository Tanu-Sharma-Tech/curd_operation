<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\View\View;
use Illuminate\Support\Facades\File;

// use App\Validator;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{

    public function index(){
        $products = Product::orderBy('created_at','desc')->get();
        return view('products.list',['products'=>$products]);
    }

    public function create(){
        return view('products.create');
    }

    public function store(Request $request){
        $rules = [ 
            'name' => 'required|min:10',
            'sku' => 'required|min:10',
            'price' => 'required|numeric'
        ];
        
        $validator = Validator::make($request->all(), $rules);
        
        if($request->hasFile('image')){
            $rules['image']='image';
        }
        if($validator->fails()) {
            return redirect()->route('products.create')->withInput() ->withErrors($validator);
        }
        
        $data=[
            'name' => $request->name,
            'sku' => $request->sku,
            'price' => $request->price,
            'created_at' => date('Y-m-d H:i:s'),
        ];
        if($request->hasFile('image')){
            $image = $request->image;
            $ext=$image->getClientOriginalExtension();
             $imageName = time().'.'.$ext;
            $image->move(public_path('upload/products') , $imageName);
            $data['image'] = $imageName;
        }

        Product::insert($data);
    
        return redirect()->route('products.list') ->with('success', 'Product created successfully');
    }

    public function edit($id){
        $products=Product::findOrFail($id);
        return view('products.edit',['product'=>$products]);
    }
    
    public function update($id ,Request $request){
        $products=Product::findOrFail($id);

        $rules = [ 
            'name' => 'required|min:10',
            'sku' => 'required|min:10',
            'price' => 'required|numeric'
        ];
        
        $validator = Validator::make($request->all(), $rules);
        
        if($request->hasFile('image')){
            $rules['image']='image';
        }
        if($validator->fails()) {
            return redirect()->route('products.edit',$products->id)->withInput() ->withErrors($validator);
        }
        
        $data=[
            'name' => $request->name,
            'sku' => $request->sku,
            'price' => $request->price,
            'created_at' => date('Y-m-d H:i:s'),
        ];
        if($request->hasFile('image')){
            File::delete(public_path('upload/products', $products->image));
            $image = $request->image;
            $ext=$image->getClientOriginalExtension();
             $imageName = time().'.'.$ext;
            $image->move(public_path('upload/products') , $imageName);
            $data['image'] = $imageName;
        }

        Product::where(['id'=>$products->id])->update($data);
    
        return redirect()->route('products.list') ->with('success', 'Product update successfully');
    }

    public function destroy($id){
        $products=Product::findOrFail($id);
        File::delete(public_path('upload/products', $products->image));
        Product::destroy($products->id);
        return redirect()->route('products.list') ->with('success', 'Product deleted successfully');
        
    }
}
