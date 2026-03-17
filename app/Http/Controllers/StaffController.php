<?php

namespace App\Http\Controllers;


use App\Staff;
use App\Exports\ExportStaffs;
use App\Imports\StaffsImport;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Auth;
use Excel;
use PDF;

class StaffController extends Controller
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
        $staffs = Staff::all();
        return view('staffs.index');
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
            'staffName'     => 'required',
            'designation'   => 'required',
            'email'         => 'required',
            'telephone'     => 'required',
        ]);
        // 'email'         => 'required|unique:staffs',
        Staff::create($request->all());

        return response()->json([
            'success'    => true,
            'message'    => 'Staff Created'
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
        $staff = Staff::find($id);
        return $staff;
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
            'staffName'      => 'required|string|min:2',
            'designation'    => 'required|string|min:2',
            'email'     => 'required|string|email|max:255',
            'telephone'   => 'required|string|min:2',
        ]);
        $staff = Staff::findOrFail($id);
        $staff->update($request->all());
        return response()->json([
            'success'    => true,
            'message'    => 'Staff Updated'
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
        Staff::destroy($id);

        return response()->json([
            'success'    => true,
            'message'    => 'Staff Delete'
        ]);
    }

    public function apiStaffs()
    {
        $staff = Staff::all();
        if(Auth::user()->role=='admin'){
        return Datatables::of($staff)
            ->addColumn('action', function($staff){
                return '<a onclick="editForm('. $staff->id .')" class="btn btn-primary btn-xs"><i class="glyphicon glyphicon-edit"></i> Edit</a> ' .
                    '<a onclick="deleteData('. $staff->id .')" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
            })
            ->rawColumns(['action'])->make(true);
        }
        else
        {
            return Datatables::of($staff)
            ->addColumn('action', function($staff){
                return '<a onclick="editForm('. $staff->id .')" class="btn btn-primary btn-xs" style="display: none;" ><i class="glyphicon glyphicon-edit"></i> Edit</a> ' .
                    '<a onclick="deleteData('. $staff->id .')" class="btn btn-danger btn-xs" style="display: none;"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
            })
            ->rawColumns(['action'])->make(true);
        }
    }

    public function ImportExcel(Request $request)
    {
        //Validasi
        $this->validate($request, [
            'file' => 'required|mimes:xls,xlsx'
        ]);

        if ($request->hasFile('file')) {
            //UPLOAD FILE
            $file = $request->file('file'); //GET FILE
            Excel::import(new StaffsImport, $file); //IMPORT FILE
            return redirect()->back()->with(['success' => 'Upload file data staffs !']);
        }

        return redirect()->back()->with(['error' => 'Please choose file before!']);
    }


    public function exportStaffsAll()
    {
        $staffs = Staff::all();
        $pdf = PDF::loadView('staffs.StaffsAllPDF',compact('staffs'));
        return $pdf->download('staffs.pdf');
    }

    public function exportExcel()
    {
        return (new ExportStaffs)->download('staffs.xlsx');
    }
}
