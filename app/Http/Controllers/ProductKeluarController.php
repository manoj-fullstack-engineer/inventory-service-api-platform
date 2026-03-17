<?php

namespace App\Http\Controllers;
use Barryvdh\DomPDF\Facade as PDF;
use App\Staff;
use App\Product;
use App\Customer;
use App\Product_Keluar;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use App\Exports\ExportProdukKeluar;
use Illuminate\Support\Facades\Auth;


class ProductKeluarController extends Controller
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
        $products = Product::orderBy('nama', 'ASC')
            ->get()
            ->pluck('nama', 'id');

        $customers = Customer::orderBy('nama', 'ASC')
            ->get()
            ->pluck('nama', 'id');

        $staffs = Staff::orderBy('staffName', 'ASC')
            ->get()
            ->pluck('staffName', 'id');

        // $invoice_data = Product_Keluar::all();
        return view('product_keluar.index', compact('products', 'customers', 'staffs'));
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

            'tanggal'               => 'required',
            'productIssueTime'      => 'required',
            'customer_id'           => 'required',
            'partsAndConsumables'   => 'required',
            'staff_id'              => 'required'
        ]);


        if (is_null($request->partsAndConsumables) || trim($request->partsAndConsumables) === 'No Parts / Consumables') {
            return response()->json([
                'error' => true,
                'message' => 'Empty/Invalid Outgoing/Sales Entry'
            ], 400); // Optional: Set the HTTP status code to 400 (Bad Request)
        }

        $partsAndConsumables = 'No Parts / Consumables';
        if ($request->partsAndConsumables && $request->partsAndConsumables !== 'No Parts / Consumables') {
            $partsAndConsumables = rtrim($request->partsAndConsumables, ','); // Safely remove trailing comma if it exists
            $request->merge(['partsAndConsumables' => $partsAndConsumables]);
        }

        $input = $request->all();
        Product_Keluar::create($input);
        // $partsAndConsumables .= ',';
        // info("----------------------------------");
        info("------------Time:" . now() . "---------------");
        // info($partsAndConsumables);
        // Process and update product quantities
        if ($partsAndConsumables && $partsAndConsumables !== 'No Parts / Consumables') {
            $items = explode(',', $partsAndConsumables);
            $finalItems = array_map('trim', $items);
            // print_r($finalItems);
            foreach ($finalItems as $item) {
                $qtyPosition=false;
                $itemPosition = strpos($item, '@');
                $qtyPosition = strpos($item, ':');
                if ($qtyPosition !== false) {
                    $finalItemName = substr($item, 0, $itemPosition);
                    $fetchQty = (int)trim(substr($item, $qtyPosition + 1));

                    // Log the item being processed
                    info("Processing item: " . $finalItemName . " with quantity: " . $fetchQty);
                    // info("Last iteration item name: " . $finalItemName);

                    // $product = Product::where('nama', $finalItemName)->first();
                    $product = Product::where('nama', trim($finalItemName))->first();
                    // $product = Product::whereRaw('LOWER(nama) = ?', [strtolower($finalItemName)])->first();

                    // $product = Product::where('nama', $finalItemName)->firstOrFail();

                    info($product);
                    if ($product) {
                        // Ensure quantity doesn't go negative
                        $product->qty -= $fetchQty;
                        $product->save();
                        info("Product updated: " . $product->nama . " New Quantity: " . $product->qty);
                    }
                }
            }
        }


        return response()->json([
            'success'    => true,
            'message'    => 'Sales/Outgoing Products Recorded'
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
        $product_keluar = Product_Keluar::find($id);
        return $product_keluar;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * 
     */
   
    public function update(Request $request, $id)
    {
        $this->validate($request, [

            'tanggal'               => 'required',
            'productIssueTime'      => 'required',
            'customer_id'           => 'required',
            'partsAndConsumables'   => 'required',
            'staff_id'              => 'required'
        ]);
        $record = Product_Keluar::findOrFail($id);
        info("\n\n...............Update Start at: " . now()->format('d-m-Y H:i:s') . "............................");
        // Parse existing items
        $partsAndConsumables = $request->partsAndConsumables;
        info($partsAndConsumables);
        if (substr($partsAndConsumables, -1) === ',') {
            // Remove the last character
            $partsAndConsumables = substr($request->partsAndConsumables, 0, -1);
            info($partsAndConsumables);
            $request->merge(['partsAndConsumables' => $partsAndConsumables]);
            info($request->partsAndConsumables);
        }

        $existingItems = [];
        $newItems = [];
        if ($record->partsAndConsumables === $request->partsAndConsumables) {
            // No need to call $record->save() here if there are no changes to save
            info("Inside First if");
            $record->update($request->all());
            // info("end of condition 1");
            return response()->json([
                'success' => true,
                'message' => 'Record Updated!',
            ]);
        }


        // Process new items
        $existingItemsArray = [];
        $existingItemsString = $record->partsAndConsumables;
        $newItemsArray = [];
        $newItemsString = $request->partsAndConsumables;
        if (is_string($existingItemsString)) {
            $existingItemsArray = array_map(function ($item) {
                // Split by '@' to separate name and quantity part
                $parts = explode('@', $item);

                // Extract the product name (before '@')
                $name = trim($parts[0]);

                // Initialize quantity
                $quantity = 0;

                // Check if there is a quantity part and split by ':' to get the quantity
                if (isset($parts[1])) {
                    $quantityParts = explode(':', $parts[1]);
                    if (isset($quantityParts[1])) {
                        $quantity = (int)trim($quantityParts[1]);
                    }
                }

                return ['name' => $name, 'quantity' => $quantity];
            }, explode(',', $existingItemsString));
        }


        if (is_string($newItemsString)) {
            $newItemsArray = array_map(function ($item) {
                // Split by '@' to separate name and quantity part
                $parts = explode('@', $item);

                // Extract the product name (before '@')
                $name = trim($parts[0]);

                // Initialize quantity
                $quantity = 0;

                // Check if there is a quantity part and split by ':' to get the quantity
                if (isset($parts[1])) {
                    $quantityParts = explode(':', $parts[1]);
                    if (isset($quantityParts[1])) {
                        $quantity = (int)trim($quantityParts[1]);
                    }
                }

                return ['name' => $name, 'quantity' => $quantity];
            }, explode(',', $newItemsString));
        }



        info("\n\nExisting Items String:");
        info($existingItemsString);
        info("Existing Item Array:");
        info($existingItemsArray);
        info("\n\n");

        info("\n\n New Items String:");
        info($newItemsString);
        info("New Item Array:");
        info($newItemsArray);
        info("\n\n");

        // Convert string to array
        if ($existingItemsString === "No Parts / Consumables" && $newItemsString != "No Parts / Consumables") {
            info("Inside Second if");

            foreach ($newItemsArray as $item) {

                // Fetch the product based on the item name
                $product = Product::select('nama', 'qty', 'id')
                    ->where('nama', $item['name'])
                    ->first();
                // info("Value of product");
                // info($product);
                // Ensure the product exists before updating
                if ($product) {
                    // Update the product quantity
                    $product->qty = (int)$product->qty - (int)$item['quantity'];

                    // Persist the updated quantity to the database
                    DB::update('UPDATE products SET qty = ? WHERE id = ?', [$product->qty, $product->id]);
                }
            }
            $record->update($request->all());
            return response()->json([
                'success' => true,
                'message' => 'Record updated successfully.',
            ]);
        } else if ($newItemsString === "No Parts / Consumables" && $existingItemsString != "No Parts / Consumables") {
            info("Inside Third if");

            foreach ($existingItemsArray as $item) {
                // Fetch the product based on the item name
                // info($item);
                $product = Product::select('nama', 'qty', 'id')
                    ->where('nama', $item['name'])
                    ->first();
                // info("Value of product");
                // info($product);
                // Ensure the product exists before updating
                if ($product) {
                    // Update the product quantity

                    $product->qty = (int)$product->qty + (int)$item['quantity'];

                    // Persist the updated quantity to the database
                    DB::update('UPDATE products SET qty = ? WHERE id = ?', [$product->qty, $product->id]);
                }
            }

            Product_Keluar::destroy($id);
            return response()->json([
                'success' => true,
                'message' => 'Stock Updated and Sales/Outgoing Entry Deleted successfully.',
            ]);
        } else {
            info("Inside else part");
            info("Value of product first angle");
            info($existingItemsArray);
            info($newItemsArray);
            $found = false;
            foreach ($newItemsArray as $newItem) {
                $found = false;
                foreach ($existingItemsArray as $existingItem) {
                    // info(("Existing Item:" . $existingItem['name'] . " and New Item:" . $newItem['name']));
                    info("Value of product first angle");
                    if ($existingItem['name'] === $newItem['name']) {
                        $existingQty = (int)$existingItem['quantity'];
                        $newQty = (int)$newItem['quantity'];
                        $qtyDifference = $newQty - $existingQty;
                        $existingItem['quantity'] = $newQty;
                        $found = true;
                        $product = Product::where('nama', $newItem['name'])->first();
                        if ($product) {
                            $newQty = (int)$newItem['quantity'];
                            $product->qty = $product->qty - $qtyDifference;
                            DB::update('UPDATE products SET qty = ? WHERE id = ?', [$product->qty, $product->id]);
                        }
                        break;
                    }
                }
                if (!$found) {
                    $product = Product::where('nama', $newItem['name'])->first();
                    if ($product) {
                        $newQty = (int)$newItem['quantity'];
                        $product->qty = $product->qty - $newQty;
                        DB::update('UPDATE products SET qty = ? WHERE id = ?', [$product->qty, $product->id]);
                    }
                    // $existingItems[] = $newItem;
                }
            }
            //-------------------checking second angele-------------
            foreach ($existingItemsArray as $existingItem) {
                $found = false;
                foreach ($newItemsArray as $newItem) {
                    // info(("Existing Item:" . $existingItem['name'] . " and New Item:" . $newItem['name']));
                    info("Value of product second angle");
                    if ($newItem['name'] === $existingItem['name']) {
                        $found = true;
                        break;
                    }
                }
                if (!$found) {
                    $product = Product::where('nama', $existingItem['name'])->first();
                    // info("Value of product second angle");
                    // info("product = " . $product);
                    if ($product) {
                        $existingQty = (int)$existingItem['quantity'];
                        $product->qty = $product->qty + $existingQty;
                        DB::update('UPDATE products SET qty = ? WHERE id = ?', [$product->qty, $product->id]);
                    }
                    // $newItems[] = $existingItem;
                }
            }


            $record->partsAndConsumables = $request->partsAndConsumables;
            $record->update($request->all());
            return response()->json([
                'success'    => true,
                'message'    => 'Sales/Outgoing Entry Updated'
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

        info("\n\nthis is delete operation.....");
        $record = Product_Keluar::findOrFail($id);
        $existingItemsString = $record->partsAndConsumables;
        if (substr($existingItemsString, -1) === ',') {
            // Remove the last character
            $existingItemsString = substr($existingItemsString, 0, -1);
        }
        info("From database:" . $existingItemsString);
        $existingItemsArray = [];
        if (is_string($existingItemsString)) {
            $existingItemsArray = array_map(function ($item) {
                // Split by '@' to separate name and quantity part
                $parts = explode('@', $item);

                // Extract the product name (before '@')
                $name = trim($parts[0]);

                // Initialize quantity
                $quantity = 0;

                // Check if there is a quantity part and split by ':' to get the quantity
                if (isset($parts[1])) {
                    $quantityParts = explode(':', $parts[1]);
                    if (isset($quantityParts[1])) {
                        $quantity = (int)trim($quantityParts[1]);
                    }
                }

                return ['name' => $name, 'quantity' => $quantity];
            }, explode(',', $existingItemsString));
        }

        info($existingItemsString);
        info($existingItemsArray);

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


        Product_Keluar::destroy($id);

        return response()->json([
            'success'    => true,
            'message'    => 'Sales/Outgoing Entry Deleted!'
        ]);
    }



    public function apiProductsOut()
    {
        $product = Product_Keluar::all();
        if (Auth::user()->role == 'admin') {
            return Datatables::of($product)
                // ->addColumn('products_name', function ($product) {
                //     return $product->product->nama;
                // })
                // ->addColumn('tanggal', function ($product) {
                //     // Format the 'tanggal' field as DD/MM/YYYY
                //     return $product->tanggal ? (new \DateTime($product->tanggal))->format('d/m/Y') : '';
                // })

                ->addColumn('customer_name', function ($product) {
                    return $product->customer->nama;
                })
                ->addColumn('staffName', function ($product) {
                    return $product->staff->staffName;
                })
                ->addColumn('action', function ($product) {
                    return '<div style="display:flex;gap:5px;">' .
                        '<a onclick="editForm(' . $product->id . ')" class="btn btn-primary btn-xs"><i class="glyphicon glyphicon-edit"></i> Edit</a> ' .
                        '<a onclick="deleteData(' . $product->id . ')" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i> Delete</a>' .
                        '</div>';
                })
                ->rawColumns(['customer_name', 'staff_name', 'action'])->make(true);
        } else {
            return Datatables::of($product)
                // ->addColumn('products_name', function ($product) {
                //     return $product->product->nama;
                // })
                ->addColumn('customer_name', function ($product) {
                    return $product->customer->nama;
                })
                ->addColumn('staffName', function ($product) {
                    return $product->staff->staffName;
                })
                ->addColumn('action', function ($product) {
                    return '<a onclick="editForm(' . $product->id . ')" class="btn btn-primary btn-xs" style="display: none;"><i class="glyphicon glyphicon-edit"></i> Edit</a> ' .
                        '<a onclick="deleteData(' . $product->id . ')" class="btn btn-danger btn-xs "style="display: none;"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
                })
                ->rawColumns(['customer_name', 'staff_name', 'action'])->make(true);
        }
    }

    public function exportProductKeluarAll()
    {


        // Fetch all records
        $product_keluar = Product_Keluar::all();

        // Format the date for each record
        // foreach ($product_keluar as $p) {
        // Ensure $p->tanggal is a valid date format before parsing
        // $p->formatted_tanggal = (new DateTime($p->tanggal))->format('d-m-Y');
        // }

        // Load the view and pass the data
        $pdf = PDF::loadView('product_keluar.productKeluarAllPDF', compact('product_keluar'));

        // Return the PDF download response
        return $pdf->download('product_out.pdf');
    }


    public function exportProductKeluar($id)
    {
        $product_keluar = Product_Keluar::findOrFail($id);
        $pdf = PDF::loadView('product_keluar.productKeluarPDF', compact('product_keluar'));
        return $pdf->download($product_keluar->id . '_product_out.pdf');
    }

    public function exportExcel()
    {
        return (new ExportProdukKeluar)->download('product_keluar.xlsx');
    }
}
