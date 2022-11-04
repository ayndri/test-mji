<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $products = Product::get();
        $draft = Product::where('status', 'Draft')->get();
        $published = Product::where('status', 'Published')->get();

        return view('products.products', compact('products', 'draft', 'published'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('products.add-products');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
            $request->validate([
                'name' => ['string', 'max:255', 'required'],
                'price' => ['required'],
                'stock' => ['required'],
                'status' => ['required']
            ]);

            $newprice = str_replace('.', '', $request->price);

            if($request->file('image')){
                $file = $request->file('image');
                $filename= time().'_'.$file->getClientOriginalName();
                $file->move(public_path('public/product-image'), $filename);
            }

            Product::create([
                'name' => $request->name,
                'description' => $request->description,
                'image_url' => $filename,
                'price' => $newprice,
                'stock' => $request->stock,
                'status' => $request->status
            ]);

            $products = Product::get();
            $draft = Product::where('status', 'Draft')->get();
            $published = Product::where('status', 'Published')->get();

            return view('products.products', compact('products', 'draft', 'published'));

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::findOrFail($id);

        return view('products.product-details', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {   
        $product = Product::findOrFail($id);

        return view('products.edit-product', compact('product'));
           
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'name' => ['string', 'max:255', 'required'],
                'price' => ['required'],
                'stock' => ['required'],
                'status' => ['required']
            ]);

            
            if (str_contains($request->price, '.')) { 
                $newprice = str_replace('.', '', $request->price);
            } else {
                $newprice = $request->price;
            }
            

           

            $product = Product::where('id', $id)->update([
                'name' => $request->name,
                'description' => $request->description,
                'price' => $newprice,
                'stock' => $request->stock,
                'status' => $request->status
           ]);

           

           if($request->file('image')){
            $file = $request->file('image');
            $filename= time().'_'.$file->getClientOriginalName();
            $file->move(public_path('public/product-image'), $filename);
            $product['image_url'] = $filename;
        } 


           $products = Product::get();
            $draft = Product::where('status', 'Draft')->get();
            $published = Product::where('status', 'Published')->get();

            return view('products.products', compact('products', 'draft', 'published'));


        } catch (QueryException $error) {
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        unlink(public_path('public/product-image/') . $product->image_url);

        $product->delete();

        //redirect to index
        return redirect()->back();

    }
}
