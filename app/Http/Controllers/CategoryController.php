<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Product;
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
        return view('categories.index');
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
        $validatedData = $request->validate([
            'category_name' => 'required|unique:categories,nama_kategori',
        ]);

        $ctg = new Category;
        $ctg->nama_kategori = $request->get('category_name');
        $ctg->save();
        
        return redirect('categories')->with('success', 'Kategori baru berhasil ditambahkan');
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
        $products = Product::where('id_kategori',$id)->get();
        
        return view('categories.show', ['category' => $category],['products' => $products]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id_kategori)
    {
       $category = Category::where('id_kategori',$id_kategori)->get();

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
        $validatedData = $request->validate([
            'category_name' => 'required',
        ]);

        $category = Category::findOrFail($id_kategori);
        $category->nama_kategori = $request->category_name;
        $category->save();

        return redirect('/categories')->with(['success' => 'Berhasil diubah']);
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
        return redirect('categories')->with(['success' => 'Kategori berhasil dihapus']);
    }
}
