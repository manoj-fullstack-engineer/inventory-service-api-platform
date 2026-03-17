<?php

namespace App\Http\Controllers;

use App\Staff;
use App\Customer;
use App\Exports\ExportProdukKeluar;
use App\Product;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use PDF;
use App\Category;
use App\Contract_Product;
use App\Exports\ExportContract_Products;
use Illuminate\Support\Facades\Auth;


class Contract_ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:admin,staff');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categorys = Category::orderBy('name', 'ASC')
            ->get()
            ->pluck('name', 'id');

        $customers = Customer::orderBy('nama', 'ASC')
            ->get()
            ->pluck('nama', 'id');


        return view('contract_products.index', compact('categorys', 'customers'));
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
        $this->validate($request, [
            'cpname'    => 'required|string',
            'pmodel'    => 'required',
            'srno'      => 'required|string|unique:contract_products,srno',
            'cust_id'   => 'required'
        ]);
    
        // Retrieve all the input data
        $input = $request->all();
        
        // Optionally, you can trim fields if needed
        $input['cpname'] = trim(preg_replace('/\s+/', ' ', $input['cpname']));
        $input['pmodel'] = trim(preg_replace('/\s+/', ' ', $input['pmodel']));
        $input['srno'] = trim(preg_replace('/\s+/', ' ', $input['srno']));

        // $input['cpname'] = trim($input['cpname']);
        // $input['pmodel'] = trim($input['pmodel']);
        // $input['srno'] = trim($input['srno']);
    

        // $input['image'] = null;

        // if ($request->hasFile('image')) {
        //     $input['image'] = '/upload/contract_products/' . str_slug($input['cpname'], '-') . '.' . $request->image->getClientOriginalExtension();
        //     $request->image->move(public_path('/upload/contract_products/'), $input['image']);
        // }

        Contract_Product::create($input);
        // $product = Product::findOrFail($request->product_id);
        // $product->qty -= $request->qty;
        // $product->save();

        return response()->json([
            'success'    => true,
            'message'    => 'Contract Product Recorded'
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
        $product_contract = Contract_Product::find($id);
        return $product_contract;
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
        $product_contract = Contract_Product::find($id);

        $this->validate($request, [
            'cpname'        => 'required|string',
            'pmodel'        => 'required',
            'srno'          => 'required|string|unique:contract_products,srno,' . $product_contract->id,
            'cust_id'       => 'required',
            // 'image'         => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);


        $input = $request->all();
        $input['cpname'] = trim(preg_replace('/\s+/', ' ', $input['cpname']));
        $input['pmodel'] = trim(preg_replace('/\s+/', ' ', $input['pmodel']));
        $input['srno'] = trim(preg_replace('/\s+/', ' ', $input['srno']));
        // $input['srno'] = trim($input['srno']); // Example: converting to uppercase and trimming
        $product_contract = Contract_Product::findOrFail($id);
        info(": this is beforeu");
        // $input['image'] = $product_contract->image;
        // echo($request->image);

        // if ($request->hasFile('image')) {
        //     $input['image'] = '/upload/contract_products/' . str_slug($input['cpname'], '-') . '.' . $request->image->getClientOriginalExtension();
        //     $request->image->move(public_path('/upload/contract_products/'), $input['image']);
        // }

        $product_contract->update($input);

        // $product = Product::findOrFail($request->product_id);
        // $product->qty -= $request->qty;
        // $product->update();

        return response()->json([
            'success'    => true,
            'message'    => 'Contract Product(s) Updated'
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
        Contract_Product::destroy($id);

        return response()->json([
            'success'    => true,
            'message'    => 'Contract Product(s) Deleted'
        ]);
    }



    public function apiContractProducts()
    {

        $contractProducts = Contract_Product::with('customer')
            ->select('contract_products.id', 'contract_products.cpname', 'contract_products.pmodel', 'contract_products.srno', 'contract_products.price', 'customers.nama', 'contract_products.agrStatus', 'contract_products.agrDos')
            ->join('customers', 'contract_products.cust_id', '=', 'customers.id')
            ->get();
        if (Auth::user()->role == 'admin') {
            return Datatables::of($contractProducts)

                ->addColumn('cust_name', function ($contractProducts) {
                    return $contractProducts->nama;
                })
                ->addColumn('action', function ($product) {
                   // return '<a onclick="editForm(' . $product->id . ')" class="btn btn-primary btn-xs" ><i class="glyphicon glyphicon-edit"></i> Edit</a> ' .
                     //   '<a onclick="deleteData(' . $product->id . ')" class="btn btn-danger btn-xs" ><i class="glyphicon glyphicon-trash"></i> Delete</a>';
                     return '<div style="display:flex; gap:5px;">' .
                     '<a onclick="editForm(' . $product->id . ')" class="btn btn-primary btn-xs"><i class="glyphicon glyphicon-edit"></i> Edit</a> ' .
                     '<a onclick="deleteData(' . $product->id . ')" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i> Delete</a>' .
                     '</div>';    
                })
                ->rawColumns(['cust_name', 'action'])->make(true);
        } else {
            return Datatables::of($contractProducts)

                ->addColumn('cust_name', function ($contractProducts) {
                    return $contractProducts->nama;
                })

                ->addColumn('action', function ($product) {
                    return '<a onclick="editForm(' . $product->id . ')" class="btn btn-primary btn-xs" style="display: none;"><i class="glyphicon glyphicon-edit"></i> Edit</a> ' .
                        '<a onclick="deleteData(' . $product->id . ')" class="btn btn-danger btn-xs" style="display: none;"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
                })
                ->rawColumns(['cust_name', 'action'])->make(true);
        }
    }

    public function exportContractProductsAll()
    {
        $contract_product = Contract_Product::all();
        $pdf = PDF::loadView('contract_products.contractProductAllPDF', compact('contract_product'));
        return $pdf->download('Contract_Products.pdf');
    }

    public function exportContract_Product($id)
    {
        $product_contract = Contract_Product::findOrFail($id);
        $pdf = PDF::loadView('Contract_Products.Contract_ProductsAllPDF', compact('contract_products'));
        return $pdf->download($product_contract->id . '_product_out.pdf');
    }

    public function exportExcel()
    {
        return (new ExportContract_Products)->download('contract_products.xlsx');
    }
}
