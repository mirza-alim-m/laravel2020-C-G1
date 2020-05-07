<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Produkmasuk;
use App\Databuku;
use DataTables;

class ProdukmasukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if($request->ajax()){
            $data = Produkmasuk::latest()->get();
            return DataTables::of($data)->addIndexColumn()
                ->editColumn('nama_barang', function($data){
                    return $data->databuku->nama_barang;})
                ->editColumn('created_at', function ($data){
                    return date('d-m-y H:i', strtotime($data->created_at) );
                    })
                ->addColumn('action', function($data){ $c = csrf_field();
                    return '
                    <form action="'.route('produkmasuk.destroy', $data->id_masuk).'" method="post" id="data'. $data->id_masuk.'">
                    '.$c.'
                        <input type="hidden" name="_method" value="DELETE">
                    </form>
                        <a href="'.route('produkmasuk.show', $data->id_masuk) .'" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i><span>&nbsp;Show</span></a>
                        <button onclick="deleteData('. $data->id_masuk .')" class="btn btn-primary btn-sm"><i class="fa fa-trash"></i>&nbsp;Delete</button>';
                })
            ->RawColumns(['action'])
            ->make(true);
        }
        return view('produkmasuk.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $databukus = Databuku::all();
        return view('produkmasuk.create', compact('databukus'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $produkmasuk = new Produkmasuk();
        $produkmasuk->id_buku = $request->input('id_buku');
        $produkmasuk->qty = $request->input('qty');
        $databuku = Databuku::findOrFail($request->id_buku);
        $databuku->qty += $request->qty;
        $databuku->save();
        $produkmasuk->save();
        
        return redirect('produkmasuk')->with('success', 'Stock baru telah ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id_masuk)
    {
        $produkmasuk = Produkmasuk::where('id_masuk',$id_masuk)->get();
        return view('produkmasuk.show', ['produkmasuk' => $produkmasuk]);
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
    public function destroy($id_masuk)
    {
        Produkmasuk::destroy($id_masuk);
        return redirect('/produkmasuk')->with(['success' => 'Berhasil! Stok berhasil dihapus.']);
    }
}
