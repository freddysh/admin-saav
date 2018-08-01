<?php

namespace App\Http\Controllers;

use App\CotizacionesPagos;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $vencimiento = $_POST['txt_vencimiento'];
        $monto = $_POST['txt_monto'];
        $cotizaciones = $_POST['txt_cotizaciones'];


//        return $monto[0];/
        $i = 0;
        foreach ($vencimiento as $ven){
            $payment = new CotizacionesPagos();
            $payment->vencimiento=$ven;
            $payment->monto=$monto[$i];
            $payment->cotizaciones_id=$cotizaciones;
            $payment->save();
            $i++;
        }

        return "hecho";

//        return redirect()->route('pax_show_path', '6?page=detail');
//        return response()->json(view('admin.pax.detail')->render());
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        $payment = CotizacionesPagos::findOrFail($id);

        $payment->monto= $_POST["txt_monto"];
        $payment->fecha= $_POST["txt_fecha"];
        $payment->medio= $_POST["txt_medio"];
        $payment->transaccion= $_POST["txt_transaccion"];
        $payment->estado= 1;
        $payment->cotizaciones_id= $_POST["txt_cotizaciones"];
        $payment->save();
        return "updated";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
