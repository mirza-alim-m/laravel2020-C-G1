<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Stockout;
use App\Product;
use DataTables;

class StockoutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $stockouts = Stockout::with('product')->get();
        // return view('stockout.index', compact('stockouts'));

        if($request->ajax()){
            $data = Stockout::latest()->get();
            return DataTables::of($data)->addIndexColumn()
                ->editColumn('nama_barang', function($data){
                    return $data->product->nama_barang;})
                ->editColumn('created_at', function ($data){
                    return date('d-m-y H:i', strtotime($data->created_at) );
                    })
                ->addColumn('action', function($data){ $c = csrf_field();
                    return '
                    <form action="'.route('stockout.destroy', $data->id_stockout).'" method="post" id="data'. $data->id_stockout.'">
                    '.$c.'
                        <input type="hidden" name="_method" value="DELETE">
                    </form>
                        <a href="'.route('stockout.show', $data->id_stockout) .'" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i><span>&nbsp;Show</span></a>
                        <button onclick="deleteData('. $data->id_stockout .')" class="btn btn-primary btn-sm"><i class="fa fa-trash"></i>&nbsp;Delete</button>';
                })
            ->RawColumns(['action'])
            ->make(true);
        }
        return view('stockout.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::all();
        return view('stockout.create', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'product_id' => 'required',
            'qty' => 'required|integer',
        ]);

        $stockout = new Stockout();
        $stockout->id_barang = $request->input('product_id');
        $stockout->qty = $request->input('qty');
        $product = Product::findOrFail($request->product_id);
        $product->qty -= $request->qty;
        $product->save();
        $stockout->save();
        
        return redirect('stockout')->with('success', 'Stock keluar baru berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id_stockout)
    {
        $stockout = Stockout::where('id_stockout',$id_stockout)->get();
        return view('stockout.show', ['stockout' => $stockout]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_stockout)
    {
        Stockout::destroy($id_stockout);
        return redirect('/stockout')->with(['success' => 'Stok keluar berhasil dihapus']);
    }
}
