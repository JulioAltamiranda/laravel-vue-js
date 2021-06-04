<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{


    /**
     * Vista de productos
     *
     * @return view
     * 
     */
    public function index()
    {

        return view('Admin.products.index');
    }

    /**
     * Lista de productos pertenecientes al usuario autenticado
     *
     * @return Product
     * 
     */
    public function products()
    {

        return Product::whereUserId(auth()->user()->id)->get();
    }

    /** metodo para agregar un producto
     * 
     *
     * @return response 
     * @param Request $request 

     */
    public function store(Request $request)
    {

        $rule = [
            'name' => 'required|string|max:120',
            'price' => 'required|numeric',
            'stock' => 'required|numeric',
        ];

        $data = $request->validate($rule);
        //asign foreign to user_id
        $data['user_id'] = auth()->user()->id;
        // save product
        Product::create($data);
        return response()->json(['message' => 'created!'], 200);
    }


    /** metodo para eliminar un producto
     * 
     *
     * @return response 
     * @param Product $product 

     */
    public function destroy(Product $product)
    {
        $product->delete();
        return response()->json(['message' => 'deleted!'], 200);
    }


    /** metodo para actualizar un producto
     * 
     *
     * @return response 
     * @param Request
     * @param Product

     */


    public function update(Request $request, Product $product)
    {
        $rule = [
            'name' => 'required|string|max:120',
            'price' => 'required|numeric',
            'stock' => 'required|numeric',
        ];

        $data = $request->validate($rule);
        // update date, time
        $data['date'] = Carbon::now();
        $data['time'] = Carbon::now();
        // save product
        $product->update($data);
        return response()->json(['message' => 'updated!'], 200);
    }

    /** metodo para agregar una imagen
     * 
     *
     * 
     * @param Request $request 
     * @param Product $product

     */
    public function imageSave(Product $product, Request $request)
    {
        //if product have a image, it is eliminated
        if($product->image){
            Storage::delete(str_replace('storage','public',$product->image));
        }
        //save image 
        $url = request()->file('image')->store('public');
        //save product with image url
        $product->image = Storage::url($url);
        //update date, time
        $product->date= Carbon::now();
        $product->time = Carbon::now();
        $product->save();
    }
}
