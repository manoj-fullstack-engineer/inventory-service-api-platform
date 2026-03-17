<?php

namespace App\Http\Controllers;
use App\Staff;
use App\Exports\ExportProductReturn;
use App\Product;
use App\Product_Return;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Auth;
// use PDF;
use Barryvdh\DomPDF\Facade as PDF;
class Product_ReturnsController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:admin,staff');
    }


    public function index()
    {
        $products = Product::orderBy('nama', 'ASC')
            ->get()
            ->pluck('nama', 'id');

        // $customers = Customer::orderBy('nama', 'ASC')
        //     ->get()
        //     ->pluck('nama', 'id');

        $staffs = Staff::orderBy('staffName', 'ASC')
            ->get()
            ->pluck('staffName', 'id');

        // $invoice_data = Product_Keluar::all();
        return view('product_returns.index', compact('products', 'staffs'));
    }


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
        $this->validate($request, [
            'tanggal'          => 'required',
            'productIssueTime' => 'required',
            'staff_id'       => 'required',
            'product_id'       => 'required',
            'qty'            => 'required',
            
            
        ]);

        Product_Return::create($request->all());

        $product = Product::findOrFail($request->product_id);
        $product->qty += $request->qty;
        $product->save();

        return response()->json([
            'success'    => true,
            'message'    => 'Return Products Recorded'
        ]);
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
        $product_return = Product_Return::find($id);
        return $product_return;
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
        $this->validate($request, [
            'tanggal'           => 'required',
            'productIssueTime'  => 'required',
            'staff_id'          => 'required',
            'product_id'        => 'required',
            'qty'               => 'required',
            
        ]);

        $product_return = Product_Return::findOrFail($id);
        $lastQty = intval($product_return->qty);
        $product_return->update($request->all());
        $updatedQty = intval($product_return->qty);

        // dd($lastQty," and ", $updatedQty);
        // info('last and updated qty is: '. $lastQty.'and'.$updatedQty);

        $product = Product::findOrFail($request->product_id);

        if ($lastQty > $updatedQty)
            $product->qty =  $product->qty - ($lastQty - $updatedQty);
        else 
        $product->qty =  $product->qty + ($updatedQty - $lastQty);

        $product->update();

        return response()->json([
            'success'    => true,
            'message'    => 'Return Products Updated'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product_return = Product_Return::findOrFail($id);
        $product = Product::findOrFail($product_return->product_id);
        $product->qty =  (int)$product->qty - (int)$product_return->qty;
        $product->update();
        Product_Return::destroy($id);
        return response()->json([
            'success'    => true,
            'message'    => 'Return Product Deleted'
        ]);
    }



    public function apiProduct_Returns()
    {
        $product_returns = Product_Return::all();
        if(Auth::user()->role=='admin'){

            return Datatables::of($product_returns)
            ->addColumn('products_name', function ($product_return) {
                return $product_return->product ? $product_return->product->nama : 'No Product';
            })
            // ->addColumn('customer_name', function ($product_return) {
            //     return $product_return->customer->nama;
            // })
            ->addColumn('staffName', function ($product_return) {
                return $product_return->staff ? $product_return->staff->staffName : 'No Staff';
            })
            ->addColumn('action', function ($product_return) {
                return '<a onclick="editForm(' . $product_return->id . ')" class="btn btn-primary btn-xs"><i class="glyphicon glyphicon-edit"></i> Edit</a> ' .
                    '<a onclick="deleteData(' . $product_return->id . ')" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
            })
            ->rawColumns(['products_name', 'staff_name', 'action'])->make(true);
        }
        else
        {
            return Datatables::of($product_returns)
            ->addColumn('products_name', function ($product_return) {
                return $product_return->product ? $product_return->product->nama : 'No Product';
            })
            // ->addColumn('customer_name', function ($product_return) {
            //     return $product_return->customer->nama;
            // })
            ->addColumn('staffName', function ($product_return) {
                return $product_return->staff ? $product_return->staff->staffName : 'No Staff';
            })
            ->addColumn('action', function ($product) {
                return '<a onclick="editForm(' . $product->id . ')" class="btn btn-primary btn-xs" style="display: none;"><i class="glyphicon glyphicon-edit"></i> Edit</a> ' .
                    '<a onclick="deleteData(' . $product->id . ')" class="btn btn-danger btn-xs" style="display: none;" ><i class="glyphicon glyphicon-trash"></i> Delete</a>';
            })
            ->rawColumns(['products_name', 'staff_name', 'action'])->make(true);
        }
    }

    public function exportProductReturnAll()
    {
        $product_return = Product_Return::with(['product', 'staff'])->get(); // Eager load relationships
        $pdf = PDF::loadView('product_returns.productReturnAllPDF', compact('product_return'));
        return $pdf->download('product_return.pdf');
    }

    public function exportProductReturn($id)
    {
        $product_return = Product_Return::findOrFail($id);
        $pdf = PDF::loadView('product_returns.productReturnPDF', compact('product_return'));
        return $pdf->download($product_return->id . '_product_return.pdf');
    }

    public function exportExcel()
    {
        return (new ExportProductReturn)->download('product_return.xlsx');
    }

}
