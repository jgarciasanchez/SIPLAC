<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Validator;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::paginate(10);

        return view('roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = Permission::orderBy('name')->get();

        return view('roles.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:255',],
        ])->validate();
        
        $data = $request->all();

        $role = Role::create([
            'name' => $data['name'],
             'description' => $data['description'],
            ]);
        
        $permissions = [];
        $contador = 0;
        foreach ($request->get('permissions') as $idp) {
            $permissions[$contador] = Permission::find($idp);
            $contador++;
        }
        $role->syncPermissions($permissions);
        return redirect()->route('roles.index')
            ->with('info', 'Rol guardado con éxito');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $role = Role::find($id);

        return view('roles.show', compact('role'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = Role::find($id);

        $permissions = Permission::orderBy('name')->get();

        return view('roles.edit', compact('role', 'permissions'));
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
        $role = Role::find($id);
        $permissions = [];
        $contador = 0;
        foreach ($request->get('permissions') as $idp) {
            $permissions[$contador] = Permission::find($idp);
            $contador++;
        }

          Validator::make($request->all(), [
               'name'=>'required',
          ])->validate();

        $data = $request->all();
        $role->update([
            'name' => $data['name'],
            'description' => $data['description'],
        ]);
        $role->syncPermissions($permissions);
        return redirect()->route('roles.index')
            ->with('info', 'Rol editado con éxito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role = Role::find($id)->delete();

        return back()->with('info', 'Eliminado correctamente');
    }
}
