<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\BaseController;
use App\Http\Requests\Admin\User\UserViewRequest;
use App\Http\Requests\Admin\User\UserStoreRequest;
use App\Http\Requests\Admin\User\UserUpdateRequest;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Repositories\Interfaces\RoleRepositoryInterface;
use Illuminate\Contracts\Support\Renderable;
use App\DataTables\UserDataTable;

class UserController extends BaseController
{
    private UserRepositoryInterface $userRepository;
    private RoleRepositoryInterface $roleRepository;
    function __construct(UserRepositoryInterface $userRepository, RoleRepositoryInterface $roleRepository)
    {
         $this->userRepository = $userRepository;
         $this->roleRepository = $roleRepository;
         $this->middleware('can:user list', ['only' => ['index','show']]);
         $this->middleware('can:user create', ['only' => ['create','store']]);
         $this->middleware('can:user edit', ['only' => ['edit','update']]);
         $this->middleware('can:user delete', ['only' => ['destroy']]);
    }
    
    /**
     * Display a listing of the resource.
     *
     */
    public function index(UserDataTable $dataTable)
    {
        $filters['searchParams']['is_for_admin']=1;
        $adminRoles = $this->roleRepository->getData($filters,false);
        return $dataTable->render('admin.user.index',['adminRoles'=>$adminRoles]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = $this->roleRepository->getAllRoles();
        return view('admin.user.create', compact('roles'));
    }
    public function store(UserStoreRequest $request)
    {
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'status' => $request->status?1:0,
        ];
        $roles = (!empty($request->roles)) ? $request->roles : [];
        $this->userRepository->storeUser($data,$roles);
        return redirect()->route('user.index')->with('success',__('messages.:record created successfully.',['record'=>__('Record')]));
    }

    /**
     * Display the specified resource.
     */
    public function show(UserViewRequest $request, $id)
    {
        $user = $this->userRepository->viewUser($id);
        $roles = $this->roleRepository->getAllRoles();
        $userHasRoles = array_column(json_decode($user->roles, true), 'id');
        return view('admin.user.show', compact('user', 'roles', 'userHasRoles'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(UserViewRequest $request, $id)
    {
        $user = $this->userRepository->viewUser($id);
        $roles = $this->roleRepository->getAllRoles();
        $userHasRoles = array_column(json_decode($user->roles, true), 'id');
        return view('admin.user.edit', compact('user', 'roles', 'userHasRoles'));
    }
    public function update(UserUpdateRequest $request, $id)
    {
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'status' => $request->status?1:0,
        ];
        $roles = (!empty($request->roles)) ? $request->roles : [];
        $this->userRepository->updateUser($data, $roles, $id);
        return redirect()->route('user.index')->with('success',__('messages.:record updated successfully.',['record'=>__('Record')]));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UserViewRequest $request, $id)
    {
        $deleteUser = $this->userRepository->deleteUser($id);
        return redirect()->route('user.index')->with('success',__('messages.:record deleted successfully.',['record'=>__('Record')]));
    }
}
