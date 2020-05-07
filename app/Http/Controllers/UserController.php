<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use DataTables;

class UserController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
    //  $user = User::all();
    //  return view('user.index', compact('user'));
        if($request->ajax()){
            $data = User::latest()->get();
            return DataTables::of($data)->addIndexColumn()
                ->addColumn('action', function($data){ $c = csrf_field();
                    return '
                    <form action="'.route('user.destroy', $data->id).'" method="post" id="data'. $data->id.'">
                    '.$c.'
                        <input type="hidden" name="_method" value="DELETE">
                    </form>
                        <a href="'.route('user.show', $data->id) .'" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i><span>&nbsp;Show</span></a>
                        <a href="'.route('user.edit', $data->id).'" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i><span>&nbsp;Edit</span></a>
                        <button onclick="deleteData('. $data->id .')" class="btn btn-primary btn-sm"><i class="fa fa-trash"></i>&nbsp;Delete</button>';
                })
            ->RawColumns(['action'])
            ->make(true);
        }
        return view('user.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $usr = new User;
        $usr->name = $request->get('nama');
        $usr->email = $request->get('email');
        $usr->password= bcrypt($request->password);
        $usr->save();
        
        return redirect('user')->with('success', 'User baru telah ditambahkan');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::where('id',$id)->get();
        return view('user.show', ['user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       // mengambil data user berdasarkan id yang dipilih
       $user = User::where('id',$id)->get();
       // passing data user yang didapat ke view edit.blade.php
       return view('user.edit',['user' => $user]);
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
        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

         // alihkan halaman ke halaman Index
         return redirect('/user')->with(['success' => 'Berhasil! mengubah ']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   
     public function destroy($id)
    {
        User::destroy($id);
        return redirect('/user')->with(['success' => 'Berhasil! Stok berhasil dihapus.']);
    }
    
}