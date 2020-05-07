<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transaksi;
use App\Databuku;
use DataTables;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $data = Transaksi::latest()->get();
            return DataTables::of($data)->addIndexColumn()
                ->editColumn('nama_barang', function($data){
                    return $data->databuku->nama_barang;})
                ->editColumn('created_at', function ($data){
                    return date('d-m-y H:i', strtotime($data->created_at) );
                    })
                ->addColumn('action', function($data){ $c = csrf_field();
                    return '
                    <form action="'.route('transaksi.destroy', $data->id_transaksi).'" method="post" id="data'. $data->id_transaksi.'">
                    '.$c.'
                        <input type="hidden" name="_method" value="DELETE">
                    </form>
                        <a href="'.route('transaksi.show', $data->id_transaksi) .'" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i><span>&nbsp;Show</span></a>
                        <button onclick="deleteData('. $data->id_transaksi .')" class="btn btn-primary btn-sm"><i class="fa fa-trash"></i>&nbsp;Delete</button>';
                })
            ->RawColumns(['action'])
            ->make(true);
        }
        return view('transaksi.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $databukus = Databuku::all();
        return view('transaksi.create', compact('databukus'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $transaksi = new Transaksi();
        $transaksi->id_buku = $request->input('id_buku');
        $transaksi->nama_pembeli = $request->input('nama_pembeli');
        $transaksi->qty = $request->input('qty');
        $transaksi->email = $request->input('email');
       
        $transaksi->save();
        
        return redirect('transaksi')->with('success', 'Stock baru telah ditambahkan');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id_transaksi)
    {
        $transaksi = Transaksi::where('id_transaksi',$id_transaksi)->get();
        return view('transaksi.show', ['transaksi' => $transaksi]);
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
    public function destroy($id_transaksi)
    {
        Transaksi::destroy($id_transaksi);
        return redirect('/transaksi')->with(['success' => 'Berhasil! Stok berhasil dihapus.']);
    }
}
