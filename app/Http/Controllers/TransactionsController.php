<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class TransactionsController extends Controller
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
    
    public function selectSearch(Request $request)
    {
    	$products = [];
        $products = Product::select("id", "name")->get();
        if($request->has('q')){
            $search = $request->q;
           
            $products->where('name', 'LIKE', "%$search%");
            		
        }
        return response()->json($products);
    }

    public function index()
    {
        $transactions = Transaction::get();
        $pengurangan = Transaction::where('type', 'pengurangan')->get();
        $penambahan = Transaction::where('type', 'penambahan')->get();

        return view('transaction.transactions', compact('transactions', 'pengurangan', 'penambahan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('transaction.add-transaction');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // try {

            $transaction = Transaction::get();

            //die($request->date);

            if (!$transaction->count()) {
                $firstOrderId = 'MJI' . '-' . str_pad(1, 3, 0, STR_PAD_LEFT);
                $newprice = str_replace('.', '', $request->price);

                Transaction::create([
                    'transaction_number' => $firstOrderId,
                    'id_product' => $request->id_product,
                    'date' => Carbon::createFromFormat('d-m-Y', $request->date),
                    'price' => $newprice,
                    'amount' => $request->amount,
                    'type' => $request->type,
                ]);
                
                $showstock = Product::where('id', $request->id_product)->first();
                
                if ($request->type == 'pengurangan') {
    
                    $editproduct = Product::where('id', $request->id_product)->update([
                        'stock' => $showstock->stock - $request->amount,
    
                   ]);
                } else {
                    $editproduct = Product::where('id', $request->id_product)->update([
                        'stock' => $showstock->stock + $request->amount,
    
                   ]);
                } 
            } else {
                $lastorderId = Transaction::select('transaction_number')->orderBy('id', 'desc')->first();
            $lastIncreament = substr($lastorderId, -5, 3);
            $lastnew = $lastIncreament + 1;
            $newOrderId = 'MJI' . '-' . str_pad($lastnew, 3, 0, STR_PAD_LEFT);

                $newprice = str_replace('.', '', $request->price);

                Transaction::create([
                    'transaction_number' => $newOrderId,
                    'id_product' => $request->id_product,
                    'date' => Carbon::createFromFormat('d-m-Y', $request->date),
                    'price' => $newprice,
                    'amount' => $request->amount,
                    'type' => $request->type,
                ]);

                
    
                $showstock = Product::where('id', $request->id_product)->first();
    
                if ($request->type == 'pengurangan') {
    
                    $editproduct = Product::where('id', $request->id_product)->update([
                        'stock' => $showstock->stock - $request->amount,
    
                   ]);
                } else {
                    $editproduct = Product::where('id', $request->id_product)->update([
                        'stock' => $showstock->stock + $request->amount,
    
                   ]);
                } 
            }
 
                

            $transactions = Transaction::get();
        $pengurangan = Transaction::where('type', 'pengurangan')->get();
        $penambahan = Transaction::where('type', 'penambahan')->get();

        return view('transaction.transactions', compact('transactions', 'pengurangan', 'penambahan'));


        // } catch (QueryException $error) {
        //     return redirect()->back()->withErrors($error);
        // }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $transactions = Transaction::join('products', 'products.id', '=', 'transactions.id_product')
                        ->where('transactions.id', $id)
                        ->select('transactions.id as t_id', 'products.name as p_name', 'products.id as p_id', 'transactions.price as t_price', 'type', 'amount', 'date', 'id_product')
                        ->first();

        return view('transaction.edit-transaction', compact('transactions'));
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
        if (str_contains($request->price, '.')) { 
            $newprice = str_replace('.', '', $request->price);
        } else {
            $newprice = $request->price;
        }

        $oldamount = Transaction::where('id', $id)->first();

                $newstock = $oldamount->amount - $request->amount;
               
        $trans = Transaction::where('id', $id)->update([
                    'date' => Carbon::createFromFormat('d-m-Y', $request->date),
                    'price' => $newprice,
                    'amount' => $request->amount,
                    'type' => $request->type,
                ]);
                
                $showstock = Product::where('id', $oldamount->id_product)->first();
                
                
                if ($request->type == 'pengurangan') {
    
                    $editproduct = Product::where('id', $oldamount->id_product)->update([
                        'stock' => $showstock->stock + $newstock,
    
                   ]);
                } else {
                    $editproduct = Product::where('id', $oldamount->id_product)->update([
                        
                        'stock' => $showstock->stock - $newstock,
    
                   ]);
                } 
            
 
                

            $transactions = Transaction::get();
        $pengurangan = Transaction::where('type', 'pengurangan')->get();
        $penambahan = Transaction::where('type', 'penambahan')->get();

        return view('transaction.transactions', compact('transactions', 'pengurangan', 'penambahan'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $transaction = Transaction::findOrFail($id);

        $showstock = Product::where('id', $transaction->id_product)->first();

        if ($transaction->type == 'pengurangan') {
    
            $editproduct = Product::where('id', $transaction->id_product)->update([
                'stock' => $showstock->stock + $transaction->amount,

           ]);
        } else {
            $editproduct = Product::where('id', $transaction->id_product)->update([
                'stock' => $showstock->stock - $transaction->amount,

           ]);
        } 

        $transaction->delete();

        //redirect to index
        return redirect()->back();
    }
}
