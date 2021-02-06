<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;
use Exception;
class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product=new Products();
        $select['products']=$product->get();
        return view("viewProducts",$select);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $select['title']="Add Product";
        $select['url']="products/";

        return view("addProducts",$select);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            $request->validate(
                [
                    'product_name'=>'required',
                    'description'=>'required',
                    'price'=>'required|numeric',
                    'discount'=>'nullable|numeric',
                    'stock'=>'required|numeric',
                    'image'=>'required|mimes:jpeg,jpg,png',
                ],
                [
                    'product_name.required'=>'Please Enter Product Name',
                    'description.required'=>'Please Enter Product Description',
                    'price.required'=>'Please Enter Product price',
                    'price.numeric'=>'Product price allow only numeric value',
                    'discount.numeric'=>'Product discount allow only numeric value',
                    'stock.required'=>'Please Enter Product stock',
                    'stock.numeric'=>'Product stock allow only numeric value',
                    'image.required'=>'Please Select Image'
                ]
            );
            $image=$request->file("image");
            $image->move("image/",$image->getClientOriginalName());
            $product=new Products();
            $product->product_name=$request->product_name;
            $product->description=$request->description;
            $product->price=$request->price;
            $product->discount=$request->discount;
            $product->stock=$request->stock;
            $product->image=$image->getClientOriginalName();
            $product->save();
            return redirect("products/create")->with('successMsg','Product Has Been Added...');
        } catch(Exception $e){
            dd($e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function show(Products $products)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try{
            $select['title']="Edit Product";
            $select['url']="products/$id";
            $select['edit']=products::where([
                'id'=>$id
            ])->get();
            return view("addProducts",$select);
        } catch(Exception $e){
            dd($e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try{
            $request->validate(
                [
                    'product_name'=>'required',
                    'description'=>'required',
                    'price'=>'required|numeric',
                    'discount'=>'nullable|numeric',
                    'stock'=>'required|numeric',
                    'image'=>'mimes:jpeg,jpg,png',
                ],
                [
                    'product_name.required'=>'Please Enter Product Name',
                    'description.required'=>'Please Enter Product Description',
                    'price.required'=>'Please Enter Product price',
                    'price.numeric'=>'Product price allow only numeric value',
                    'discount.numeric'=>'Product discount allow only numeric value',
                    'stock.required'=>'Please Enter Product stock',
                    'stock.numeric'=>'Product stock allow only numeric value',
                ]
            );
            if($request->hasFile("image")){
                $image=$request->file("image");
                $image->move("image/",$image->getClientOriginalName());
            }
            $product=products::find($id);
            $product->product_name=$request->product_name;
            $product->description=$request->description;
            $product->price=$request->price;
            $product->discount=$request->discount;
            $product->stock=$request->stock;
            if($request->hasFile("image")){
                $product->image=$image->getClientOriginalName();
            }
            $product->save();
            return redirect("products/")->with('successMsg','Product Has Been Updated...');
        } catch(Exception $e){
            dd($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product=products::find($id);
        $product->delete();
        return redirect("products/")->with('successMsg','Product Has Been Deleted...');
    }
}