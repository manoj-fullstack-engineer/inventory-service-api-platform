<?php

namespace App\Http\Controllers;

use App\Exports\ExportSuppliers;
use App\Imports\SuppliersImport;
use App\User;
use Excel;
use Illuminate\Http\Request;
use PDF;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
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
		$users = User::all();
		return view('users.index');
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
			'name' => 'required',
			'email' => 'required|unique:users',
			'role' => 'required',
		]);

		User::create($request->all());

		return response()->json([
			'success' => true,
			'message' => 'User Created',
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
		$users = User::find($id);
		return $users;
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
			'name' => 'required|string|min:2',
			// 'email' => 'required|string|email|max:255|unique:users',
		]);

		// info("Hi 1");
		$users = User::findOrFail($id);

		$users->update($request->all());

		return response()->json([
			'success' => true,
			'message' => 'User Name Updated',
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
		User::destroy($id);

		return response()->json([
			'success' => true,
			'message' => 'User Deleted',
		]);
	}

	public function apiUsers()
	{
		$users = User::all();
		if (Auth::user()->role == 'admin') {


			return Datatables::of($users)
				->addColumn('action', function ($users) {
					return '<a onclick="editForm(' . $users->id . ')" class="btn btn-primary btn-xs"><i class="glyphicon glyphicon-edit"></i> Edit</a> ' .
						'<a onclick="deleteData(' . $users->id . ')" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
				})
				->rawColumns(['action'])->make(true);
		} else {
			return Datatables::of($users)
				->addColumn('action', function ($users) {
					return '<a onclick="editForm(' . $users->id . ')" class="btn btn-primary btn-xs" style="display: none;"><i class="glyphicon glyphicon-edit"></i> Edit</a> ' .
						'<a onclick="deleteData(' . $users->id . ')" class="btn btn-danger btn-xs" style="display: none;" ><i class="glyphicon glyphicon-trash"></i> Delete</a>';
				})
				->rawColumns(['action'])->make(true);
		}
	}


	// public function exportUsersAll()
	// {
	// 	$users = User::all();
	// 	$pdf = PDF::loadView('users.UsersAllPDF', compact('users'));
	// 	return $pdf->download('Users.pdf');
	// }

	// public function exportExcel()
	// {
	// 	return (new ExportUsers)->download('Users.xlsx');
	// }
}
