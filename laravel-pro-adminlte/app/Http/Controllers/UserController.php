<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{

    public function index(){

        $this->checkPermission('view users');
        $users = User::all();

        return view('users.index', compact('users'));
    }

    public function create(){

        $this->checkPermission('create users');
        return view('users.create');
    }

    public function store(Request $request){

        $this->checkPermission('create users');
        $dataRequest = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email|max:255',
            'password' => 'required|string|min:8',
        ]);

        $createUser = User::create($dataRequest);

        if($createUser){
            return redirect()->route('users.index')->with('success', 'Registro criado com sucesso!');
        }else{
            return redirect()->back()->with('error', 'Erro ao criar o registro. Tente novamente.');
        }
    }

    public function show(User $user){}

    public function edit(User $user){

        $this->checkPermission('edit users');
        $user->load(['profile', 'interest', 'roles', 'permissions']);

        $permissions = Permission::all();
        $roles = Role::all();
        $rolePermissions = $user->roles->flatMap->permissions->pluck('name')->unique();

        return view('users.edit', compact('user', 'permissions', 'roles', 'rolePermissions'));
    }

    public function update(Request $request, User $user): RedirectResponse
    {

        $this->checkPermission('edit users');
        $dataRequest = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'password' => 'exclude_if:password,null|string|min:8',
        ]);

        $user->update($dataRequest);

        return redirect()->back()->with('success', 'Registro atualizado com sucesso!');
    }

    public function updateProfile(Request $request, User $user): RedirectResponse
    {

        $this->checkPermission('edit users');
        $dataRequest = $request->validate([
            'address' => 'nullable|string',
        ]);

        UserProfile::updateOrCreate([
            'user_id' => $user->id,
        ], $dataRequest);

        return redirect()->back()->with('success', 'Registro atualizado com sucesso!');
    }

    public function updateInterest(Request $request, User $user){

        $this->checkPermission('edit users');
        $dataRequest = $request->validate([
            'interest' => 'required|array',
        ]);

        if(!empty($dataRequest['interest'])){
            DB::beginTransaction();
            try {
                $user->interest()->delete();

                $user->interest()->createMany($dataRequest['interest']);

                DB::commit();

                return redirect()->back()->with('success', 'Interesses atualizados com sucesso!');
            } catch (\Exception $e) {
                DB::rollBack();

                return redirect()->back()->with('error', 'Ocorreu um erro ao atualizar os interesses.');
            }
        }

        return redirect()->back();
    }

    public function updatePermissions(Request $request, User $user): RedirectResponse
    {

        $this->checkPermission('edit users');
        $user->syncPermissions($request->permissions);
        return redirect()->back()->with('success', 'Permissões atualizadas!');
    }

    public function updateRole(Request $request, User $user): RedirectResponse
    {

        $this->checkPermission('edit users');
        $dataRequest = $request->validate([
            'role' => 'required|exists:roles,name',
        ]);

        $user->syncRoles([$dataRequest['role']]);
        return redirect()->back()->with('success', 'Cargo do usuário atualizado com sucesso!');
    }

    public function destroy(User $user): RedirectResponse
    {

        $this->checkPermission('delete users');
        $user->delete();

        return redirect()->back()->with('success', 'Registro apagado com sucesso!');
    }
}
