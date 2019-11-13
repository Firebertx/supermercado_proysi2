<?php

namespace App\Http\Controllers;

use App\Bitacora;
use App\Customer;
use App\DetalleIngreso;
use App\DetalleInventario;
use App\Ingreso;
use App\Inventory;
use App\Product;
use App\Provider;
use App\User;
use App\Warehouse;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Mockery\Exception;

class IngresosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ingresos=Ingreso::all();
        $providers = Provider::all();
        $inventories = Inventory::all();
        $users=User::all();
        return view('admin.ingresos.index', compact('ingresos','providers','inventories','users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', new Ingreso());

        $providers=Provider::all();
        $products=Product::all();
        $inventories=Inventory::all();
        return view('admin.ingresos.create', compact('providers','products', 'inventories'));
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
                'provider' => 'required',
                'inventory' => 'required',
                'purchase_number' => 'required',
            ],[
                'provider.required'=>'El campo Proveedor es obligatorio.',
                'inventory.required'=>'El campo Inventario es obligatorio.',
                'purchase_number.required'=>'El campo Número de Compra es obligatorio.',
            ]);

            $ingreso = new Ingreso($data);
            $ingreso->provider_id=$request->get('provider');
            $ingreso->user_id = Auth::user()->id;
            $ingreso->inventory_id=$request->get('inventory');
            $ingreso->purchase_number=$request->get('purchase_number');
            $ingreso->date=$now->toDateTimeString();
            $ingreso->total=$request->totalview;
            $ingreso->tax=(($request->totalview)*15/100);
            $ingreso->state='Registrado';
            $ingreso->save();

            $product_id=$request->product_id;
            $quantity=$request->quantity;
            $price=$request->price;

            //Recorro todos los elementos
            $cont=0;
            while($cont < count($product_id)){

                $info = $request->validate([
                    'product_id' => 'required',
                    'quantity' => 'required',
                ],[
                    'product_id.required'=>'El campo Producto es obligatorio.',
                    'quantity.required'=>'El campo Cantidad es obligatorio.',
                ]);

                //$ware=Inventory::select('warehouse_id')->where('id','=',$ingreso->inventory_id)->get();

                $detalle_ingreso = new DetalleIngreso($info);
                $detalle_ingreso->ingreso_id = $ingreso->id;
                $detalle_ingreso->product_id = $product_id[$cont];
                //$detalle_ingreso->warehouse_id = $ware[0]->warehouse_id;
                $detalle_ingreso->inventory_id=$ingreso->inventory_id;
                $detalle_ingreso->quantity = $quantity[$cont];
                $detalle_ingreso->price = $price[$cont];
                $detalle_ingreso->date =$now->toDateTimeString();
                $detalle_ingreso->save();
                $cont=$cont+1;
            }

            DB::commit();

        } catch(Exception $e){

            DB::rollBack();
        }

        $bitacora = new Bitacora();
        $bitacora->user = Auth::user()->name;
        $bitacora->last_name = Auth::user()->last_name;
        $bitacora->action = 'Registro un nuevo ingreso';
        $bitacora->date =$now->toDateTimeString();
        $bitacora->hour =$now->toDateTimeString();
        $bitacora->save();

        return redirect()->route('admin.ingresos.index')->withFlash('Se ha registrado el ingreso a los inventarios');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Ingreso $ingreso)
    {
        //$this->authorize('view', $ingreso);
        //return $ingreso;
        $inventories = Inventory::all();
        $products = Product::all();
        $detalleIngreso = DetalleIngreso::all();
        $providers=Provider::all();
        return view('admin.ingresos.show', compact('ingreso','inventories','products','detalleIngreso','providers'));
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
    public function destroy(Ingreso $ingreso)
    {
        //$this->authorize('delete', $ingreso);
        $ingreso->state='Anulado';
        $ingreso->save();

        $bitacora = new Bitacora();
        $bitacora->user = Auth::user()->name;
        $bitacora->last_name = Auth::user()->last_name;
        $bitacora->action = 'Anuló un ingreso';
        $now=Carbon::now('America/La_Paz');
        $bitacora->date =$now->toDateTimeString();
        $bitacora->hour =$now->toDateTimeString();
        $bitacora->save();

        return redirect()->route('admin.ingresos.index')->withFlash('El ingreso ha sido anulado');
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
        $providers=Provider::all();
        $users=User::all();
        $inventories=Inventory::all();
        $warehouses=Warehouse::all();
        $products=Product::all();
        $ingresos=Ingreso::all();
        $detalleIngreso=DetalleIngreso::all();
        return view('admin.ingresos.pdf',compact('providers','users','inventories','warehouses','products','ingresos','detalleIngreso'));
    }

    public function pdf(Request $request)
    {
        $providers=Provider::all();
        $users=User::all();
        $inventories=Inventory::all();
        $products=Product::all();
        $ingresos=Ingreso::all();
        $detalleIngreso=DetalleIngreso::all();

        $data=$request->get('ingreso_purchase_number');
        $data1=$request->get('provider_nit');

        $data2=$request->get('provider_photo');
        $data3=$request->get('provider_name');
        $data4=$request->get('provider_last_name');
        $data5=$request->get('provider_sex');
        $data6=$request->get('provider_nationality');
        $data7=$request->get('provider_address');
        $data8=$request->get('provider_city');
        $data9=$request->get('provider_phone');
        $data10=$request->get('provider_email');

        $data11=$request->get('inventory_name');
        $data12=$request->get('inventory_description');
        $data13=$request->get('inventory_warehouse');

        $data14=$request->get('ingreso_comprador');
        $data15=$request->get('ingreso_date');
        $data16=$request->get('ingreso_tax');
        $data17=$request->get('ingreso_total');
        $data18=$request->get('ingreso_state');

        $data19=$request->get('product_name');
        $data20=$request->get('product_quantity');
        $data21=$request->get('product_price');

        $pdf= \PDF::loadView('admin.pdf.compra',compact('providers','users','inventories','products','ingresos','detalleIngreso',
            'data','data1','data2','data3','data4','data5','data6','data7','data8','data9','data10','data11','data12','data13','data14','data15'
            ,'data16','data17','data18','data19','data20','data21'));
        if (count($request->all())>9){
            $pdf->setPaper('letter', 'landscape');
        }
        return $pdf->stream('compra.pdf');
    }

    public function pdf2(Request $request)
    {
        $fechaInicio=$request->get('date_inicio');
        $fechaFinal=$request->get('date_final');
        $providers=Provider::all();
        $users=User::all();
        $inventories=Inventory::all();
        $products=Product::all();
        $ingresos=Ingreso::all();
        $detalleIngreso=DetalleIngreso::all();

        $pdf= \PDF::loadView('admin.pdf.compra_fechas',compact('providers','users','inventories','products','ingresos','detalleIngreso','fechaInicio','fechaFinal'));
            $pdf->setPaper('letter', 'landscape');
        return $pdf->stream('compraFechas.pdf');
    }
}
