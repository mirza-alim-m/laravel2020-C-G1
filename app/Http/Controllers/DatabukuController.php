<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Databuku;
use App\Category;
use DataTables;
use Storage;

class DatabukuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $databuku = Databuku::latest()->get();
        if($request->ajax()){
            $data = Databuku::latest()->get();
            return DataTables::of($data)->addIndexColumn()
                ->editColumn('nama_kategori', function($data){
                    return $data->category->nama_kategori;})
                ->addColumn('action', function($data){ $c = csrf_field();
                    return '
                    <form action="'.route('databuku.destroy', $data->id_buku).'" method="post" id="data'. $data->id_buku.'">
                    '.$c.'
                        <input type="hidden" name="_method" value="DELETE">
                    </form>
                        <a href="'.route('databuku.show', $data->id_buku) .'" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i><span>&nbsp;Show</span></a>
                        <a href="'.route('databuku.edit', $data->id_buku).'" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i><span>&nbsp;Edit</span></a>
                        <button onclick="deleteData('. $data->id_buku .')" class="btn btn-primary btn-sm"><i class="fa fa-trash"></i>&nbsp;Delete</button>';
                })
            ->RawColumns(['action'])
            ->make(true);
        }
        return view('databuku.index', compact('databuku'));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('databuku.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $databuku = new Databuku();
        $databuku->id_kategori = $request->input('id_kategori');
        $databuku->nama_barang = $request->input('nama_barang');
        $databuku->harga = $request->input('harga');
        $databuku->qty = $request->input('qty');
        // $databuku->save();
        // request()->validate([
        //     'id_kategori' => 'required',
        //     'nama_barang' => 'required',
        //     'harga' => 'required',
        //     'qty' => 'required',
        //     'cover' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        //     'doc_pdf' => 'required|mimes:pdf|max:2048',

        // ]);

        if ($request->has('active')) {
            $active = 1;
        } else {
            $active = 0;
        }

        $fileNameImage = time().'.'.request()->cover->getClientOriginalExtension();
        $fileNamePdf = time().'.'.request()->doc_pdf->getClientOriginalExtension();
        
        // $databuku = new Databuku();
        // $databuku->id_kategori = $request->input('id_kategori');
        // $databuku->nama_barang = $request->input('nama');
        // $databuku->harga = $request->input('harga');
        // $databuku->qty = $request->input('qty');

            
            if ($request->cover->move(storage_path('app/public/databuku/gambar'), $fileNameImage)) {
                $databuku->cover = "storage/databuku/gambar/".$fileNameImage;
            }
            if ($request->doc_pdf->move(storage_path('app/public/databuku/pdf'), $fileNamePdf)) {
                $databuku->doc_pdf = "storage/databuku/pdf/".$fileNamePdf;
            }
            
           
            $databuku->save();
        

        return redirect('/databuku')->with('success', 'Data buku baru telah ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $databuku = Databuku::where('id_buku',$id)->get();
        return view('databuku.show', ['databuku' => $databuku]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id_buku)
    {
        $categories = Category::all();
        // mengambil data Produk berdasarkan id yang dipilih
        $databuku = Databuku::where('id_buku',$id_buku)->get();
        // passing data produk yang didapat ke view edit.blade.php
        return view('databuku.edit',['databuku' => $databuku, 'categories' => $categories]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_buku)
    {   
        $imgbuku = Databuku::where("id_buku","=",$id_buku)->get()->first()->cover;
        $pdfbuku = Databuku::where("id_buku","=",$id_buku)->get()->first()->doc_pdf;
        
        if (!$request->cover) {
            
            $request->validate([
            'nama_barang' => 'required',
            'id_kategori' => 'required',
            'harga' => 'required',
            'qty' => 'required',
            'doc_pdf' => 'required|mimes:pdf|max:2048',    
            ]);
            
            $fileNamePdf = time().'.'.request()->doc_pdf->getClientOriginalExtension();
        }else if (!$request->doc_pdf){
            $request->validate([
                'nama_barang' => 'required',
                'id_kategori' => 'required',
                'harga' => 'required',
                'cover' => 'required|mimes:jpeg,png,jpg,gif|max:2048',
                'qty' => 'required',
                
            ]);
             $fileNameImage = time().'.'.request()->cover->getClientOriginalExtension();
        }else{
            $request->validate([
                'nama_barang' => 'required',
                'id_kategori' => 'required',
                'harga' => 'required',
                'cover' => 'required|mimes:jpeg,png,jpg,gif|max:2048',
                'qty' => 'required',
                'doc_pdf' => 'required|mimes:pdf|max:2048', 
            ]);
            $fileNameImage = time().'.'.request()->cover->getClientOriginalExtension();
            $fileNamePdf = time().'.'.request()->doc_pdf->getClientOriginalExtension();
        } 
        
        if ($request->has('active')) {
            $active = 1;
        } else {
            $active = 0;
        }
        $databuku = Databuku::findOrFail($id_buku);
        $databuku->id_kategori = $request->id_kategori;
        $databuku->nama_barang = $request->nama_barang;
        $databuku->harga = $request->harga;
        $databuku->qty = $request->qty;

        $databuku->cover = $request->cover;
        if($request->hasFile('cover')){
            if (is_file($databuku->cover)){
                try{
                    unlink($imgbuku);
                } catch(\Exception $e){

                }
            }
            $request->cover->move(storage_path('app/public/databuku/gambar'), $fileNameImage);
            $databuku->cover = "storage/databuku/gambar/".$fileNameImage;
        } else {
            $databuku->cover = $imgbuku;
        }

        $databuku->doc_pdf = $request->doc_pdf;
        if($request->hasFile('doc_pdf')){
            if (is_file($databuku->doc_pdf)){
                try{
                    unlink($pdfbuku);
                } catch(\Exception $e){

                }
            }
            $request->doc_pdf->move(storage_path('app/public/databuku/pdf'), $fileNamePdf);
            $databuku->doc_pdf = "storage/databuku/pdf/".$fileNamePdf;
        } else {
            $databuku->doc_pdf = $pdfbuku;
        }
        
        // $databuku = new Databuku();
        // $databuku->id_kategori = $request->input('id_kategori');
        // $databuku->nama_barang = $request->input('nama');
        // $databuku->harga = $request->input('harga');
        // $databuku->qty = $request->input('qty');
        
        $databuku->save();


         // alihkan halaman ke halaman Index
        
            return redirect('/databuku')->with(['success' => 'Berhasil! diubah']);
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id_buku)
    {
        Databuku::destroy($id_buku);
        $nama_barang = $request->nama_barang;
        return redirect('/databuku')->with(['success' => 'Berhasil! '.$nama_barang.' berhasil dihapus.']);
    }
}
