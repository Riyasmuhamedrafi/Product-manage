<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::where('user_type','!=','admin')->get();
        return view('users.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = User::create([
            'name' => request('name'),
            'email' => request('email'),
            'password' => request('password'),
            'status' => request('status'),
        ]);

        $role = Role::find(2);
        $user->assignRole($role->name);
        $users = User::where('user_type','!=','admin')->get();
        return ['status'=>200,'message'=>'SubAdmin Created Successfully','data'=>$users];
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

    }

    public function delete()
    {
        DB::beginTransaction();
        $user = User::find(request('id'));
        try {
            $user->update([
                'email' => time() . '::' . $user->email,
            ]);
            $user->delete();
            $users = User::where('user_type','!=','admin')->get();
            DB::commit();
        } catch (Exception $ex) {
            DB::rollBack();
            logger($ex);
            return ['status'=>422,'message'=>'Something Went Wrong'];
        }
        return ['status'=>200,'message'=>'SubAdmin Deleted Successfully','data'=>$users];
    }
}
