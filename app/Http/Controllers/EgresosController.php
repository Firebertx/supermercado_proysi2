<?php

namespace App\Http\Controllers;

use App\Bitacora;
use App\Customer;
use App\DetalleEgreso;
use App\DetalleInventario;
use App\Egreso;
use App\Inventory;
use App\Product;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Mockery\Exception;

class EgresosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $egresos=Egreso::all();
        $customers=Customer::all();
        $inventories = Inventory::all();
        $users=User::all();
        return view('admin.egresos.index', compact('egresos','customers','inventories','users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $inventories=Inventory::all();
        $products=Product::all();
        $customers=Customer::all();
        $detalles = DetalleInventario::all();
        return view('admin.egresos.create', compact('customers','inventories','products','detalles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $now=Carbon::now('America/La_Paz');
        try{
            DB::beginTransaction();

            $data = $request->validate([
                'customer' => 'required',
                'purchase_number' => 'required',
            ],[
                'customer.required'=>'El campo Cliente es obligatorio.',
                'purchase_number.required'=>'El campo Número de Compra es obligatorio.',
            ]);

            $egreso = new Egreso($data);
            $egreso->customer_id=$request->get('customer');
            $egreso->user_id = Auth::user()->id;
            $egreso->purchase_number=$request->get('purchase_number');
            $egreso->date=$now->toDateTimeString();
            $egreso->total=$request->totalview;
            $egreso->tax=(($request->totalview)*15/100);
            $egreso->state='Registrado';
            $egreso->save();

            $product_id=$request->product_id;
            $inventory=$request->inventory;
            $quantity=$request->cantidad;
            $discount=$request->discount;
            $price=$request->price;

            //Recorro todos los elementos
            $cont=0;
            while($cont < count($product_id)){

                //$ware=Inventory::select('warehouse_id')->where('id','=',$egreso->inventory_id)->get();

                $detalle_egreso = new DetalleEgreso();
                $detalle_egreso->egreso_id = $egreso->id;
                $detalle_egreso->product_id = $product_id[$cont];
                $detalle_egreso->inventory_id=$inventory[$cont];
                $detalle_egreso->quantity = $quantity[$cont];
                $detalle_egreso->discount = $discount[$cont];
                $detalle_egreso->price = $price[$cont];
                $detalle_egreso->date =$now->toDateTimeString();
                $detalle_egreso->save();
                $cont=$cont+1;
            }

            DB::commit();

        } catch(Exception $e){

            DB::rollBack();
        }

        $bitacora = new Bitacora();
        $bitacora->user = Auth::user()->name;
        $bitacora->last_name = Auth::user()->last_name;
        $bitacora->action = 'Registro un nuevo egreso - venta';
        $bitacora->date =$now->toDateTimeString();
        $bitacora->hour =$now->toDateTimeString();
        $bitacora->save();

        return redirect()->route('admin.egresos.index')->withFlash('Se ha registrado el egreso de los productos');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Egreso $egreso)
    {
        //$this->authorize('view', $egreso);
        $inventories = Inventory::all();
        $products = Product::all();
        $detalleEgresos = DetalleEgreso::all();
        $customers=Customer::all();
        return view('admin.egresos.show', compact('egreso','inventories','products','detalleEgresos','customers'));
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
    public function destroy(Egreso $egreso)
    {
        //$this->authorize('delete', $egreso);
        $egreso->state = 'Anulado';
        $egreso->save();

        $bitacora = new Bitacora();
        $bitacora->user = Auth::user()->name;
        $bitacora->last_name = Auth::user()->last_name;
        $bitacora->action = 'Anuló un egreso - venta';
        $now=Carbon::now('America/La_Paz');
        $bitacora->date =$now->toDateTimeString();
        $bitacora->hour =$now->toDateTimeString();
        $bitacora->save();

        return redirect()->route('admin.egresos.index')->withFlash('El egreso ha sido anulado');
    }

    function fetch(Request $request)
    {
        $select = $request->get('select');
        $value = $request->get('value');
        $dependent = $request->get('dependent');
        $data = DB::table('country_state_city')
            ->where($select, $value)
            ->groupBy($dependent)
            ->get();
        $output = '<option value="">Select '.ucfirst($dependent).'</option>';
        foreach($data as $row)
        {
            $output .= '<option value="'.$row->$dependent.'">'.$row->$dependent.'</option>';
        }
        echo $output;
    }

    public function reportePdf()
    {
        $customers=Customer::all();
        $users=User::all();
        $products=Product::all();
        $egresos=Egreso::all();
        $detalleEgreso=DetalleEgreso::all();
        return view('admin.egresos.pdf',compact('customers','users','inventories','products','egresos','detalleEgreso'));
    }

    public function pdf(Request $request)
    {
        $customers=Customer::all();
        $users=User::all();
        $products=Product::all();
        $egresos=Egreso::all();
        $detalleEgreso=DetalleEgreso::all();

        $data=$request->get('egreso_purchase_number');

        $data1=$request->get('customer_photo');
        $data2=$request->get('customer_name');
        $data3=$request->get('customer_last_name');
        $data4=$request->get('customer_location');
        $data5=$request->get('customer_sex');
        $data6=$request->get('customer_nationality');
        $data7=$request->get('customer_address');
        $data8=$request->get('customer_city');
        $data9=$request->get('customer_phone');
        $data10=$request->get('customer_email');
        $data11=$request->get('customer_latitude');
        $data12=$request->get('customer_length');

        $data13=$request->get('egreso_vendedor');
        $data14=$request->get('egreso_date');
        $data15=$request->get('egreso_tax');
        $data16=$request->get('egreso_total');
        $data17=$request->get('egreso_state');

        $data18=$request->get('product_name');
        $data19=$request->get('product_quantity');
        $data20=$request->get('product_price');
        $data21=$request->get('product_discount');

        $pdf= \PDF::loadView('admin.pdf.venta',compact('customers','users','products','egresos','detalleEgreso'
            ,'data','data1','data2','data3','data4','data5','data6','data7','data8','data9','data10','data11','data12','data13','data14','data15'
            ,'data16','data17','data18','data19','data20','data21'));
        if (count($request->all())>10){
            $pdf->setPaper('letter', 'landscape');
        }
        return $pdf->stream('venta.pdf');
    }

    public function pdf2(Request $request)
    {
        $fechaInicio=$request->get('date_inicio');
        $fechaFinal=$request->get('date_final');
        $customers=Customer::all();
        $users=User::all();
        $products=Product::all();
        $egresos=Egreso::all();
        $detalleEgreso=DetalleEgreso::all();

        $pdf= \PDF::loadView('admin.pdf.venta_fechas',compact('customers','users','products','egresos','detalleEgreso','fechaInicio','fechaFinal'));
        return $pdf->stream('ventaFechas.pdf');
    }
}
