<?php

namespace App\Http\Controllers;
use App\Models\Produk;
use Illuminate\Http\Request;
use App\Models\Stokgudang;

class StokGudangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $produk= Produk::all()->pluck('nama_produk','id_produk');

        return view('stokgudang.index',compact('produk'));

    }

    public function data()
    {

        $stok_gudang = StokGudang::leftJoin('produk', 'produk.id_produk', 'stok_gudang.id_produk')
        ->select('stok_gudang.*', 'nama_produk')
        // ->orderBy('id_stokgudang','desc')
        ->get();

        return datatables()
        ->of($stok_gudang)
        ->addIndexColumn()
        ->addColumn('stok_gudang', function($stok_gudang){
            return $stok_gudang->stok_gudang.' Kg' ;
        })
        ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $productId = $request->id_produk;
        $stok_gudang = StokGudang::where('id_produk', $productId)->first();

        if ($stok_gudang) {
            // If product exists in warehouse stock, update the quantity
            $stok_gudang->stok_gudang += $request->stok_gudang;
            $stok_gudang->update();

        } else {
            // If product doesn't exist, create a new entry
            $stokGudang = StokGudang::create([
                'id_produk' => $productId,
                'stok_gudang' => $request->stok_gudang
            ]);
        }

    }



    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $stok_gudang = StokGudang::find($id);
        return response()->json($stok_gudang);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // $stok_gudang = StokGudang::find($id);
        // $stok_gudang->update($request->all());

        // return response()->json('Data berhasil disimpan', 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }




}
