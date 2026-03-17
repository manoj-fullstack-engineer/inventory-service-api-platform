<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use App\Staff;
use App\Customer;
use App\Exports\ExportProdukKeluar;
use App\Product;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use PDF;
use Illuminate\Support\Facades\DB;
use App\Category;
use App\Contract_Product;
use App\Exports\ExportContract_Products;
use App\Ledger;
use DateTime;

class ReportController extends Controller
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
        $staffs = Staff::orderBy('staffName', 'ASC')
            ->get()
            ->pluck('staffName', 'id');

        $customers = Customer::orderBy('nama', 'ASC')
            ->get()
            ->pluck('nama', 'id');

        $contract_products = Contract_Product::orderBy('cpname', 'ASC')
            ->get()
            ->pluck('pmodel', 'id');


        $products = Product::orderBy('nama', 'ASC')
            ->get()
            ->pluck('nama', 'id');
        // $staffs = Staff::orderBy('staffName', 'ASC')
        //     ->get()
        //     ->pluck('staffName', 'id');

        // $invoice_data = Contract_Product::all();
        // info("HI at 4.52");
        return view('reports.index', compact('staffs', 'customers', 'contract_products', 'products'));
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
            'srNo'        => 'required',
            'date'        => 'required',
            'staff_id'    => 'required',
            'action_done' => 'required',

        ]);


        $input = $request->all();

        // $input['image'] = null;

        // if ($request->hasFile('image')) {
        //     $input['image'] = '/upload/contract_products/' . str_slug($input['cpname'], '-') . '.' . $request->image->getClientOriginalExtension();
        //     $request->image->move(public_path('/upload/contract_products/'), $input['image']);
        // }

        Ledger::create($input);

        $partsAndConsumables = $request->partsAndConsumables;
        $partsAndConsumables = substr($partsAndConsumables, 0, -1);
        // info("HIHIIH is" . $partsAndConsumables);
        $items = explode(',', $partsAndConsumables);
        $finalItems = array_map('trim', $items);

        foreach ($finalItems as $item) {

            $fetchQty = substr($item, -2);
            $position = strpos($item, ':');
            $finalItemName = substr($item, 0, $position);
            // info('final Item is:'. $finalItemName);
            $product = Product::select('nama', 'qty', 'id')
                ->where('nama', $finalItemName)
                ->first();
            // $finalQty = $product->qty;
            // info("finalQty=". $finalQty);
            info("Product ID is: " . $product->id . ", database qty: " . $product->qty . ", input qty=" . $fetchQty . "and Product Name: " . $finalItemName);
            $product->qty = (int)$product->qty - (int)$fetchQty;
            // info("updated Qty is=" . $product->qty);
            // DB::update('UPDATE products SET qty = $product->qty');
            DB::update('UPDATE products SET qty = ? WHERE id = ?', [$product->qty, $product->id]);
            // $product->save();

            // Product::update('update products set qty = qty - ? where nama = ?', [$fetchQty, $finalItemName]);
            // try {
            //     $product->save();
            //     info("Product updated successfully: " . $finalItemName . ", Database Qty was=" . $product->qty);
            // } catch (\Exception $e) {
            //     info("Error updating product: " . $e->getMessage());
            // }


        }


        return response()->json([
            'success'    => true,
            'message'    => 'Ledger Entry Recorded'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $ledger = Ledger::with(['contract_product', 'customer', 'staff'])
            ->select('ledgers.id', 'ledgers.date', 'ledgers.srNo', 'ledgers.action_done', 'partsAndConsumables', 'totalSpent', 'ledgers.totalReading', 'contract_products.pmodel', 'contract_products.agrStatus', 'staffs.staffName', 'customers.nama')
            ->join('contract_products', 'ledgers.srNo', '=', 'contract_products.srno')
            ->join('staffs', 'ledgers.staff_id', '=', 'staffs.id')
            ->join('customers', 'contract_products.cust_id', '=', 'customers.id')
            ->get();
        // info("Hi, This is at 11:39PM");
        // info($request->from_date);
        // info($request->to_date);

        return Datatables::of($ledger)

            ->addColumn('pmodel', function ($ledger) {
                return $ledger->pmodel;
            })
            ->addColumn('cust_name', function ($ledger) {
                return $ledger->nama;
            })

            ->addColumn('agrStatus', function ($ledger) {
                return $ledger->agrStatus;
            })

            ->addColumn('staffName', function ($ledger) {
                return $ledger->staffName;
            })
            ->addColumn('date', function ($ledger) {
                return Carbon::createFromFormat('Y-m-d', $ledger->date)->format('d/m/Y');
            })

            // ->addColumn('action', function ($ledger) {
            //     return '<a onclick="editForm(' . $ledger->id . ')" class="btn btn-primary btn-xs"><i class="glyphicon glyphicon-edit"></i> Edit</a> ' .
            //         '<a onclick="deleteData(' . $ledger->id . ')"  class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
            // })
            ->rawColumns(['date','pmodel', 'nama', 'agrStatus', 'staffName'])->make(true);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ledger = Ledger::find($id);
        return $ledger;
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
            'srNo'        => 'required',
            'date'        => 'required',
            'staff_id'    => 'required',
            'action_done' => 'required',

            // 'image'         => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);


        $input = $request->all();
        $ledger = Ledger::findOrFail($id);
        //////////

        $partsAndConsumables = $request->partsAndConsumables;
        $partsAndConsumables = substr($partsAndConsumables, 0, -1);
        // info("old parts and consumables are" . $itemsBeforeEdit);
        info("New edited parts and consumables are" . $partsAndConsumables);


        $items = explode(',', $partsAndConsumables);
        $finalItems = array_map('trim', $items);

        foreach ($finalItems as $item) {

            $fetchQty = substr($item, -2);
            $position = strpos($item, ':');
            $finalItemName = substr($item, 0, $position);
            // info('final Item is:'. $finalItemName);
            $product = Product::select('nama', 'qty', 'id')
                ->where('nama', $finalItemName)
                ->first();
            // $finalQty = $product->qty;
            // info("finalQty=". $finalQty);
            //info("Product ID is: ".$product->id . ", database qty: " . $product->qty . ", input qty=" . $fetchQty . "and Product Name: " . $finalItemName);
            $product_Qty_Database = (int)$product->qty;
            $product_Qty_EditForm = (int)$fetchQty;
            $oldValue = 1;
            if ($product_Qty_EditForm > $product_Qty_Database) {
                $product->qty = $product->qty - ($product_Qty_EditForm - $oldValue);
            }
            $product->qty = (int)$product->qty - (int)$fetchQty;
            // info("updated Qty is=" . $product->qty);
            // DB::update('UPDATE products SET qty = $product->qty');
            DB::update('UPDATE products SET qty = ? WHERE id = ?', [$product->qty, $product->id]);
        }
        /////////
        // $input['image'] = $product_contract->image;
        // echo($request->image);

        // if ($request->hasFile('image')) {
        //     $input['image'] = '/upload/contract_products/' . str_slug($input['cpname'], '-') . '.' . $request->image->getClientOriginalExtension();
        //     $request->image->move(public_path('/upload/contract_products/'), $input['image']);
        // }

        $ledger->update($input);

        // $product = Product::findOrFail($request->product_id);
        // $product->qty -= $request->qty;
        // $product->update();

        return response()->json([
            'success'    => true,
            'message'    => 'Ledger Entry Updated'
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
        Ledger::destroy($id);

        return response()->json([
            'success'    => true,
            'message'    => 'Ledger Entry Deleted'
        ]);
    }



    public function apiReports(Request $request)
    {

        // Retrieve the dates from the request
        $filterFromDate = $request->from_date;
        $filterToDate = $request->to_date;

        info("Hi, This is at 12:03AM");
        info($request->from_date);
        info($request->to_date);

        if (empty($filterFromDate) || empty($filterToDate)) {
            info("hi, inside if");
            return $this->show($request);
        }


        try {
            // Convert the dates to 'Y-m-d' format using DateTime
            $dateTimeFromDate = DateTime::createFromFormat('d/m/Y', $filterFromDate);
            $dateTimeToDate = DateTime::createFromFormat('d/m/Y', $filterToDate);

            // Format the dates
            $finalFilterFromDate = $dateTimeFromDate ? $dateTimeFromDate->format('Y-m-d') : null;
            $finalFilterToDate = $dateTimeToDate ? $dateTimeToDate->format('Y-m-d') : null;

            // Update the request dates with the new format
            $request->merge([
                'from_date' => $finalFilterFromDate,
                'to_date' => $finalFilterToDate,
            ]);
        } catch (\Exception $e) {
            // Handle the exception if date parsing fails
            return response()->json(['error' => 'Invalid date format provided.'], 422);
        }


        // info("Hi, This is at 11:39PM");
        // info($request->from_date);
        // info($request->to_date);


        $ledger = Ledger::with(['contract_product', 'customer', 'staff'])
            ->select('ledgers.id', 'ledgers.date', 'ledgers.srNo', 'ledgers.action_done', 'partsAndConsumables', 'totalSpent', 'ledgers.totalReading', 'contract_products.pmodel', 'contract_products.agrStatus', 'staffs.staffName', 'customers.nama')
            ->join('contract_products', 'ledgers.srNo', '=', 'contract_products.srno')
            ->join('staffs', 'ledgers.staff_id', '=', 'staffs.id')
            ->join('customers', 'contract_products.cust_id', '=', 'customers.id')
            ->whereBetween('ledgers.date', [$request->from_date, $request->to_date])
            ->get();
        // info("Hi, This is at 11:39PM");
        // info($request->from_date);
        // info($request->to_date);

        return Datatables::of($ledger)

            ->addColumn('pmodel', function ($ledger) {
                return $ledger->pmodel;
            })
            ->addColumn('cust_name', function ($ledger) {
                return $ledger->nama;
            })

            ->addColumn('agrStatus', function ($ledger) {
                return $ledger->agrStatus;
            })

            ->addColumn('staffName', function ($ledger) {
                return $ledger->staffName;
            })

            ->addColumn('date', function ($ledger) {
                return Carbon::createFromFormat('Y-m-d', $ledger->date)->format('d/m/Y');
                // return $ledger->date->format('d/m/Y');
                
            })


            // ->addColumn('action', function ($ledger) {
            //     return '<a onclick="editForm(' . $ledger->id . ')" class="btn btn-primary btn-xs"><i class="glyphicon glyphicon-edit"></i> Edit</a> ' .
            //         '<a onclick="deleteData(' . $ledger->id . ')"  class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
            // })
            ->rawColumns(['date','pmodel', 'nama', 'agrStatus', 'staffName' ])->make(true);
    }

    public function exportLedgersAll()
    {
        $ledger = Ledger::all();
        $pdf = PDF::loadView('Ledgers.LedgersAllPDF', compact('ledger'));
        return $pdf->download('Ledger.pdf');
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
