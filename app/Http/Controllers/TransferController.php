<?php

namespace App\Http\Controllers;

use App\Models\Transfer;
use App\Models\Produk;
use App\Models\StokGudang;
use Illuminate\Http\Request;


class TransferController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $produk= Produk::all()->pluck('nama_produk','id_produk','stok');
        return view('transfer.index',compact('produk'));
    }


    public function data()
    {

        $transfer = Transfer::leftJoin('produk', 'produk.id_produk', 'transfer.id_produk', 'transfer.stok')
        ->select('transfer.*', 'nama_produk','stok')
        // ->orderBy('id_stokgudang','desc')
        ->get();
        return datatables()
        ->of($transfer)
        ->addColumn('tanggal', function ($transfer) {
            return tanggal_indonesia($transfer->created_at, false);
        })
        ->addColumn('jumlah', function($transfer){
            return $transfer->jumlah.' Kg' ;
        })
        ->rawColumns(['aksi'])
        ->addIndexColumn()
        ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $produks = Produk::all();
        return view('transfer.create', compact('produks'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $produk = Produk::find($request->id_produk);
        $stokGudang = StokGudang::where('id_produk', $produk->id_produk)->first();

        // Check if stok gudang is enough
        if ($stokGudang->stok_gudang < $request->jumlah) {
            return redirect()->back()->withErrors('Jumlah stok di gudang tidak mencukupi.');
        }

        // Update stok
        $stokGudang->stok_gudang -= $request->jumlah;
        $produk->stok += $request->jumlah;
        $stokGudang->save();
        $produk->save();


        // Create transfer record
        Transfer::create([
            'id_produk' => $request->id_produk,
            'jumlah' => $request->jumlah,
        ]);

        return redirect()->route('transfer.index')->with('success', 'Transfer berhasil.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transfer  $transfer
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $transfer = Transfer::find($id);
        return response()->json($transfer);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transfer  $transfer
     * @return \Illuminate\Http\Response
     */
    public function edit(Transfer $transfer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Transfer  $transfer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // $transfer = Transfer::find($id);
        // $transfer->update($request->all());

        // return response()->json('Data berhasil disimpan', 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transfer  $transfer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transfer $transfer)
    {
        $transfer = Transfer::find($id);
        $transfer->delete();

        return response(null, 204);
    }
}
