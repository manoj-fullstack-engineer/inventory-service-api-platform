<?php

namespace App\Http\Controllers;

use PDF;
use DateTime;
use App\Staff;
use App\Ledger;
use App\Product;
use App\Category;
use App\Customer;
use App\Contract_Product;
use Illuminate\Http\Request;
use App\Exports\ExportLedgers;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use App\Exports\ExportProdukKeluar;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Exports\ExportContract_Products;

class LedgerController extends Controller
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
        return view('ledgers.index', compact('staffs', 'customers', 'contract_products', 'products'));
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
            'srNo'        => 'required|exists:contract_products,srno',
            'date'        => 'required',
            'staff_id'    => 'required',
            'action_done' => 'required',
        ]);

        // Handle the partsAndConsumables field
        $partsAndConsumables='No Parts / Consumables';
        if ($request->partsAndConsumables && $request->partsAndConsumables !== 'No Parts / Consumables') {
            $partsAndConsumables = rtrim($request->partsAndConsumables, ','); // Safely remove trailing comma if it exists
            $request->merge(['partsAndConsumables' => $partsAndConsumables]);
        }

        $input = $request->all();
        $input['srNo'] = trim(preg_replace('/\s+/', ' ', $input['srNo']));        


        Ledger::create($input);

        // Process and update product quantities
        if ($partsAndConsumables && $partsAndConsumables !== 'No Parts / Consumables') {
            $items = explode(',', $partsAndConsumables);
            $finalItems = array_map('trim', $items);

            foreach ($finalItems as $item) {
                $position = strpos($item, ':');
                if ($position !== false) {
                    $finalItemName = substr($item, 0, $position);
                    $fetchQty = (int)substr($item, $position + 1);

                    $product = Product::where('nama', $finalItemName)->first();

                    if ($product) {
                        $product->qty = $product->qty - $fetchQty; // Ensure quantity doesn't go negative
                        $product->save();
                    }
                }
            }
        }

        return response()->json([
            'success' => true,
            'message' => 'Ledger Entry Recorded'
        ]);
    }




    // public function store(Request $request)
    // {
    //     $this->validate($request, [
    //         'srNo'        => 'required|exists:contract_products,srno',
    //         'date'        => 'required',
    //         'staff_id'    => 'required',
    //         'action_done' => 'required',

    //     ]);

    //     if ($request->partsAndConsumables != 'No Parts / Consumables') {

    //         $request->merge([
    //             'partsAndConsumables' => substr($request->partsAndConsumables, 0, -1)
    //         ]);
    //     }
    //     $input = $request->all();


    //     Ledger::create($input);

    //     $partsAndConsumables = $request->partsAndConsumables;
    //     if ($partsAndConsumables != 'No Parts / Consumables') {
    //         $items = explode(',', $partsAndConsumables);
    //         $finalItems = array_map('trim', $items);

    //         foreach ($finalItems as $item) {    

    //             $fetchQty = substr($item, -1);
    //             $position = strpos($item, ':');
    //             $finalItemName = substr($item, 0, $position);
    //             $product = Product::select('nama', 'qty', 'id')
    //                 ->where('nama', $finalItemName)
    //                 ->first();
    //             $product->qty = (int)$product->qty - (int)$fetchQty;
    //             DB::update('UPDATE products SET qty = ? WHERE id = ?', [$product->qty, $product->id]);
    //         }
    //     }

    //     return response()->json([
    //         'success'    => true,
    //         'message'    => 'Ledger Entry Recorded'
    //     ]);
    // }

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
        ]);

        $record = Ledger::findOrFail($id);
        $input = $request->all();
        $input['srNo'] = trim(preg_replace('/\s+/', ' ', $input['srNo']));
        $request->merge(['srNo' => $input['srNo']]);
       // $input['srNo'] = trim(preg_replace('/\s+/', ' ', $record['srNo']));
        // Parse existing items
        // info($input);

        $partsAndConsumables = $request->partsAndConsumables;
        if (substr($partsAndConsumables, -1) === ',') {
            // Remove the last character
            $partsAndConsumables = substr($request->partsAndConsumables, 0, -1);
            $request->merge(['partsAndConsumables' => $partsAndConsumables]);
        }
       
        info("-----------" . now() . "-----------------");
        info($record->partsAndConsumables);
        info($request->partsAndConsumables);

        $existingItems = [];
        $newItems = [];
        if ($record->partsAndConsumables === $request->partsAndConsumables) {
            // No need to call $record->save() here if there are no changes to save
            $record->update($request->all());
            // info("Condition 1");
            return response()->json([
                'success' => true,
                'message' => 'Record Updated!',
            ]);
        }

        $partsAndConsumables = $request->partsAndConsumables;
        if (substr($partsAndConsumables, -1) === ',') {
            // Remove the last character
            $partsAndConsumables = substr($request->partsAndConsumables, 0, -1);
            $request->merge(['partsAndConsumables' => $partsAndConsumables]);
        }
        info("Parts after removing last , is " . $partsAndConsumables);
        // Process new items
        $newItemsString = $request->partsAndConsumables;
        $existingItemsString = $record->partsAndConsumables;
        // Convert string to array
        if ($existingItemsString === "No Parts / Consumables" && $newItemsString != "No Parts / Consumables") {
            $newItemsArray = [];
            if (is_string($newItemsString)) {
                $newItemsArray = array_map(function ($item) {
                    $parts = explode(':', trim($item));
                    return ['name' => $parts[0], 'quantity' => (int)$parts[1]];
                }, explode(',', $newItemsString));
            }

            info("--------New Item array:-----------");
            info($newItemsArray);

            // info("-------value of new item:-------------10:35PM.....");

            foreach ($newItemsArray as $item) {
                // info("Item Name:" . $item['name']);
                // info("Item Qty:" . $item['quantity']);

                // Fetch the product based on the item name
                $product = Product::select('nama', 'qty', 'id')
                    ->where('nama', $item['name'])
                    ->first();

                // Ensure the product exists before updating
                if ($product) {
                    // Update the product quantity
                    $product->qty = (int)$product->qty - (int)$item['quantity'];
                    // info("product  name:" . $product->nama . " and qty:" . $product->qty);


                    // Persist the updated quantity to the database
                    DB::update('UPDATE products SET qty = ? WHERE id = ?', [$product->qty, $product->id]);
                }
            }
            $record->update($request->all());
            // info("condition 2");
            return response()->json([
                'success' => true,
                'message' => 'Record updated successfully.',
            ]);
        } else if ($newItemsString === "No Parts / Consumables" && $existingItemsString != "No Parts / Consumables") {
            $existingItemsArray = [];
            if (is_string($existingItemsString)) {
                $existingItemsArray = array_map(function ($item) {
                    $parts = explode(':', trim($item));
                    return ['name' => $parts[0], 'quantity' => (int)$parts[1]];
                }, explode(',', $existingItemsString));
            }



            // info("-------value of item:-------------10:16PM.....");

            foreach ($existingItemsArray as $item) {
                // info("Item Name:" . $item['name']);
                // info("Item Qty:" . $item['quantity']);

                // Fetch the product based on the item name
                $product = Product::select('nama', 'qty', 'id')
                    ->where('nama', $item['name'])
                    ->first();

                // Ensure the product exists before updating
                if ($product) {
                    // Update the product quantity
                    $product->qty = (int)$product->qty + (int)$item['quantity'];
                    // info("product table name:" . $product->nama . " and qty:" . $product->qty);


                    // Persist the updated quantity to the database
                    DB::update('UPDATE products SET qty = ? WHERE id = ?', [$product->qty, $product->id]);
                } else {
                    // Handle cases where the product is not found
                    // info("Product not found: " . $item['name']);
                }
            }
            $record->update($request->all());
            // info("condition 3");
            return response()->json([
                'success' => true,
                'message' => 'Record updated successfully.',
            ]);
        } else {

            $newItemsArray = [];
            if (is_string($newItemsString)) {
                $newItemsArray = array_map(function ($item) {
                    $parts = explode(':', trim($item));
                    return ['name' => $parts[0], 'quantity' => (int)$parts[1]];
                }, explode(',', $newItemsString));
            }

            $existingItemsArray = [];
            if (is_string($existingItemsString)) {
                $existingItemsArray = array_map(function ($item) {
                    $parts = explode(':', trim($item));
                    return ['name' => $parts[0], 'quantity' => (int)$parts[1]];
                }, explode(',', $existingItemsString));
            }


            foreach ($newItemsArray as $newItem) {
                $found = false;
                foreach ($existingItemsArray as $existingItem) {
                    // info(("Existing Item:" . $existingItem['name'] . " and New Item:" . $newItem['name']));

                    if ($existingItem['name'] === $newItem['name']) {
                        $existingQty = (int)$existingItem['quantity'];
                        $newQty = (int)$newItem['quantity'];
                        $qtyDifference = $newQty - $existingQty;
                        // info("existingQty:" . $existingQty . "newQty:" . $newQty . "QtyDifference:" . $qtyDifference);
                        // Update the corresponding product quantity
                        $product = Product::where('nama', $existingItem['name'])->first();
                        if ($product) {
                            $product->qty = $product->qty - $qtyDifference;
                            $product->save();
                            DB::update('UPDATE products SET qty = ? WHERE id = ?', [$product->qty, $product->id]);
                        }

                        $existingItem['quantity'] = $newQty;
                        $found = true;
                        break;
                    }
                }
                if (!$found) {
                    $product = Product::where('nama', $newItem['name'])->first();
                    if ($product) {
                        $newQty = (int)$newItem['quantity'];
                        $product->qty = $product->qty - $newQty;
                        $product->save();
                        DB::update('UPDATE products SET qty = ? WHERE id = ?', [$product->qty, $product->id]);
                    }
                    $existingItems[] = $newItem;
                }
            }
            //-------------------checking second angele-------------
            foreach ($existingItemsArray as $existingItem) {
                $found = false;
                foreach ($newItemsArray as $newItem) {
                    // info(("Existing Item:" . $existingItem['name'] . " and New Item:" . $newItem['name']));

                    if ($newItem['name'] === $existingItem['name']) {
                        $found = true;
                        break;
                    }
                }
                if (!$found) {
                    $product = Product::where('nama', $existingItem['name'])->first();
                    if ($product) {
                        $existingQty = (int)$existingItem['quantity'];
                        $product->qty = $product->qty + $existingQty;
                        $product->save();
                        DB::update('UPDATE products SET qty = ? WHERE id = ?', [$product->qty, $product->id]);
                    }
                    $newItems[] = $existingItem;
                }
            }






            // Convert the updated items array back to a comma-separated string
            // $updatedItemsExisting = implode(',', array_map(function ($item) {
            //     return $item['name'] . ':' . $item['quantity'];
            // }, $existingItems));

            // $updatedItemsNew = implode(',', array_map(function ($item) {
            //     return $item['name'] . ':' . $item['quantity'];
            // }, $existingItems));

            // $updatedItems = array_merge($updatedItemsExisting, $updatedItemsNew);
            // Save the updated string back to the database
            $record->partsAndConsumables = $request->partsAndConsumables;
            $record->update($request->all());

            return response()->json([
                'success' => true,
                'message' => 'Record updated successfully.',
                'updated_products' => $record->partsAndConsumables,
            ]);
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       
        $record = Ledger::findOrFail($id);
        $existingItemsString = $record->partsAndConsumables;
        if (substr($existingItemsString, -1) === ',') {
            // Remove the last character
            $existingItemsString = substr($existingItemsString, 0, -1);
        }

        $existingItemsArray = [];
        if (is_string($existingItemsString)) {
            $existingItemsArray = array_map(function ($item) {
                $parts = explode(':', trim($item));
                return ['name' => $parts[0], 'quantity' => (int)$parts[1]];
            }, explode(',', $existingItemsString));
        }

        foreach ($existingItemsArray as $item) {
            // info("Item Name:" . $item['name']);
            // info("Item Qty:" . $item['quantity']);

            // Fetch the product based on the item name
            $product = Product::select('nama', 'qty', 'id')
                ->where('nama', $item['name'])
                ->first();

            // Ensure the product exists before updating
            if ($product) {
                // Update the product quantity
                $product->qty = (int)$product->qty + (int)$item['quantity'];
                // info("product table name:" . $product->nama . " and qty:" . $product->qty);


                // Persist the updated quantity to the database
                DB::update('UPDATE products SET qty = ? WHERE id = ?', [$product->qty, $product->id]);
            } 
        }


        Ledger::destroy($id);

        return response()->json([
            'success'    => true,
            'message'    => 'Ledger Entry Deleted'
        ]);
    }



    public function apiLedgers()
    {

        // $ledger = Ledger::all();

        $ledger = Ledger::with(['contract_product', 'customer', 'staff'])
            ->select('ledgers.id', 'ledgers.date', 'ledgers.srNo', 'ledgers.action_done', 'partsAndConsumables', 'totalSpent', 'ledgers.totalReading', 'contract_products.pmodel', 'contract_products.agrStatus', 'staffs.staffName', 'customers.nama')
            ->join('contract_products', 'ledgers.srNo', '=', 'contract_products.srno')
            ->join('staffs', 'ledgers.staff_id', '=', 'staffs.id')
            ->join('customers', 'contract_products.cust_id', '=', 'customers.id')
            ->get();

        if (Auth::user()->role == 'admin') {

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

                ->addColumn('action', function ($ledger) {
                    //return '<a onclick="editForm(' . $ledger->id . ')" class="btn btn-primary btn-xs"><i class="glyphicon glyphicon-edit"></i> Edit</a> ' .
                      //  '<a onclick="deleteData(' . $ledger->id . ')"  class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
                      return '<div style="display:flex;gap:5px;">' .
                      '<a onclick="editForm(' . $ledger->id . ')" class="btn btn-primary btn-xs"><i class="glyphicon glyphicon-edit"></i> Edit</a> ' .
                      '<a onclick="deleteData(' . $ledger->id . ')" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i> Delete</a>' .
                      '</div>';    
                })
                ->rawColumns(['pmodel', 'nama', 'agrStatus', 'staffName', 'action'])->make(true);
        } else {
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

                ->addColumn('action', function ($ledger) {
                    return '<a onclick="editForm(' . $ledger->id . ')" class="btn btn-primary btn-xs" style="display: none;" ><i class="glyphicon glyphicon-edit"></i> Edit</a> ' .
                        '<a onclick="deleteData(' . $ledger->id . ')"  class="btn btn-danger btn-xs" style="display: none;" ><i class="glyphicon glyphicon-trash"></i> Delete</a>';
                })
                ->rawColumns(['pmodel', 'nama', 'agrStatus', 'staffName', 'action'])->make(true);
        }
    }

    public function exportLedgersAll()
    {
        $ledgers = Ledger::all();
        $pdf = PDF::loadView('ledgers.LedgersAllPDF', compact('ledgers'));
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
        // return (new ExportLedgers)->download('ledger.xlsx');
        try {
            return (new ExportLedgers)->download('ledger.xlsx');
        } catch (\Exception $e) {
            // Log the error for further analysis
            Log::error($e->getMessage());
            return back()->withErrors(['error' => 'Failed to export ledgers. Please check the logs for details.']);
        }
        
    }
}
