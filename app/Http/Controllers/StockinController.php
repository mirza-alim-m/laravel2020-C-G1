<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Stockin;
use App\Product;
use DataTables;

class StockinController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $stockins = Stockin::with('product')->get();
        // return view('stockin.index', compact('stockins'));

        if($request->ajax()){
            $data = Stockin::latest()->get();
            return DataTables::of($data)->addIndexColumn()
                ->editColumn('nama_barang', function($data){
                    return $data->product->nama_barang;})
                ->editColumn('created_at', function ($data){
                    return date('d-m-y H:i', strtotime($data->created_at) );
                    })
                ->addColumn('action', function($data){ $c = csrf_field();
                    return '
                    <form action="'.route('stockin.destroy', $data->id_stockin).'" method="post" id="data'. $data->id_stockin.'">
                    '.$c.'
                        <input type="hidden" name="_method" value="DELETE">
                    </form>
                        <a href="'.route('stockin.show', $data->id_stockin) .'" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i><span>&nbsp;Show</span></a>
                        <button onclick="deleteData('. $data->id_stockin .')" class="btn btn-primary btn-sm"><i class="fa fa-trash"></i>&nbsp;Delete</button>';
                })
            ->RawColumns(['action'])
            ->make(true);
        }
        return view('stockin.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::all();
        return view('stockin.create', compact('products'));
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

        $stockin = new Stockin();
        $stockin->id_barang = $request->input('product_id');
        $stockin->qty = $request->input('qty');
        $product = Product::findOrFail($request->product_id);
        $product->qty += $request->qty;
        $product->save();
        $stockin->save();
        
        return redirect('stockin')->with('success', 'Stock masuk baru berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id_stockin)
    {
        $stockin = Stockin::where('id_stockin',$id_stockin)->get();
        return view('stockin.show', ['stockin' => $stockin]);
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
    public function destroy($id_stockin)
    {
        Stockin::destroy($id_stockin);
        return redirect('/stockin')->with(['success' => 'Stok masuk berhasil dihapus']);
    }
}
