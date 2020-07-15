<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Databuku;
use DataTables;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
        // $categories = Category::all();
        // return view('categories.index', compact('categories'));
        $categ = Category::latest()->get();
        if($request->ajax()){
            $data = Category::latest()->get();
            return DataTables::of($data)->addIndexColumn()
                ->addColumn('action', function($data){ $c = csrf_field();
                    return '
                    <form action="'.route('categories.destroy', $data->id_kategori).'" method="post" id="data'. $data->id_kategori.'">
                    '.$c.'
                        <input type="hidden" name="_method" value="DELETE">
                    </form>
                        <a href="'.route('categories.show', $data->id_kategori) .'" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i><span>&nbsp;Show</span></a>
                        <a href="'.route('categories.edit', $data->id_kategori).'" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i><span>&nbsp;Edit</span></a>
                        <button onclick="deleteData('. $data->id_kategori .')" class="btn btn-primary btn-sm"><i class="fa fa-trash"></i>&nbsp;Delete</button>';
                })
            ->RawColumns(['action'])
            ->make(true);
        }
        return view('categories.index',compact('categ'));
    }

    // public function index()
    // {
    //     $categories = Category::all();
    //     return view('categories.index', compact('categories'));
    // }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         // memanggil view tambah
         return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $categ = Category::create([
        'nama_kategori' => $request->input('nama_kategori'),
        'cover' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        'doc_pdf' => 'required|mimes:pdf|max:2048',
        
    ]);
       
        $fileNameImage = time().'.'.request()->cover->getClientOriginalExtension();
        $fileNamePdf = time().'.'.request()->doc_pdf->getClientOriginalExtension();

        // $categ = new Category;
        // $categ->nama_kategori = $request->nama_kategori;
 
        // if ($request->has('active')) {
        //     $active = 1;
        // } else {
        //     $active = 0;
        // }

        
        
         
        if ($request->cover->move(storage_path('app/public/category/gambar'), $fileNameImage)) {
            $categ->cover = "storage/category/gambar/".$fileNameImage;
        }
        if ($request->doc_pdf->move(storage_path('app/public/category/pdf'), $fileNamePdf)) {
            $categ->doc_pdf = "storage/category/pdf/".$fileNamePdf;
        }

        $categ->save();
        
        return redirect('/categories')->with('success', 'Kategori baru telah ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = Category::where('id_kategori',$id)->get();
        $databukus = Databuku::where('id_buku',$id)->get();
        return view('categories.show',compact('category','databukus'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id_kategori)
    {
        // mengambil data kategori berdasarkan id yang dipilih
       $category = Category::where('id_kategori',$id_kategori)->get();
       // passing data kategori yang didapat ke view edit.blade.php
       return view('categories.edit',['category' => $category]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_kategori)
    {
        $imgbuku = Category::where("id_kategori","=",$id_kategori)->get()->first()->cover;
        $pdfbuku = Category::where("id_kategori","=",$id_kategori)->get()->first()->doc_pdf;
        
        if (!$request->cover) {
            
            $request->validate([
            'nama_kategori' => 'required',
            'doc_pdf' => 'required|mimes:pdf|max:2048',    
            ]);
            
            $fileNamePdf = time().'.'.request()->doc_pdf->getClientOriginalExtension();
        }else if (!$request->doc_pdf){
            $request->validate([
                'nama_kategori' => 'required',
                'cover' => 'required|mimes:jpeg,png,jpg,gif|max:2048',
                
            ]);
             $fileNameImage = time().'.'.request()->cover->getClientOriginalExtension();
        }else{
            $request->validate([
                'nama_kategori' => 'required',
                'doc_pdf' => 'required|mimes:pdf|max:2048',
                'cover' => 'required|mimes:jpeg,png,jpg,gif|max:2048', 
            ]);
            $fileNameImage = time().'.'.request()->cover->getClientOriginalExtension();
            $fileNamePdf = time().'.'.request()->doc_pdf->getClientOriginalExtension();
        } 
        
        if ($request->has('active')) {
            $active = 1;
        } else {
            $active = 0;
        }
        $category = Category::findOrFail($id_kategori);
        $category->nama_kategori = $request->nama_kategori;

        $category->cover = $request->cover;
        if($request->hasFile('cover')){
            if (is_file($category->cover)){
                try{
                    unlink($imgbuku);
                } catch(\Exception $e){

                }
            }
            $request->cover->move(storage_path('app/public/category/gambar'), $fileNameImage);
            $category->cover = "storage/category/gambar/".$fileNameImage;
        } else {
            $category->cover = $imgbuku;
        }

        $category->doc_pdf = $request->doc_pdf;
        if($request->hasFile('doc_pdf')){
            if (is_file($category->doc_pdf)){
                try{
                    unlink($pdfbuku);
                } catch(\Exception $e){

                }
            }
            $request->doc_pdf->move(storage_path('app/public/category/pdf'), $fileNamePdf);
            $category->doc_pdf = "storage/category/pdf/".$fileNamePdf;
        } else {
            $category->doc_pdf = $pdfbuku;
        }
        
        // $category = new Databuku();
        // $category->id_kategori = $request->input('id_kategori');
        // $category->nama_kategori = $request->input('nama');
        // $category->harga = $request->input('harga');
        // $category->qty = $request->input('qty');
        
        $category->save();


         // alihkan halaman ke halaman Index
        
            return redirect('/categories')->with(['success' => 'Berhasil! diubah']);
    }
        

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id_kategori)
    {
        Category::destroy($id_kategori);
        $nama = $request->name;
        return redirect('categories')->with(['success' => 'Berhasil! Data '.$nama.' berhasil dihapus.']);
    }
}
