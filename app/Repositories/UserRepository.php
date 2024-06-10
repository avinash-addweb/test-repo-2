<?php

namespace App\Repositories;

use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Models\User;
use App\Exceptions\RecordNotFoundException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class UserRepository implements UserRepositoryInterface
{
    /**
     *  @method used to get the list of model data with or without pagination and can also pass the searching and sorting params
     * 
     *  @param array $filters
     *  @param bool  $pagination
     * 
     *  @return mixed $users
     * 
     */
    public function getData(array $filters, bool $pagination = true) :Collection|LengthAwarePaginator {
        $users = (new User)->newQuery();
        if (!empty($filters['searchParams']['name'])) {
            $users->where('name', 'like', '%' . $filters['searchParams']['name'] . '%');
        }
        if (!empty($filters['searchParams']['email'])) {
            $users->where('email', 'like', '%' . $filters['searchParams']['email'] . '%');
        }
        if (!empty($filters['sortParams']['sortColumn']) && !empty($filters['sortParams']['sortDir'])) {
            $users->orderBy($filters['sortParams']['sortColumn'],$filters['sortParams']['sortDir']);
        } else {
            $users->latest();
        }
        $recordlimit = $filters['paginationParams']['recordLimit'] ?? config('constants.pagination_limit');
        if (!$pagination) {
            $users = $users->limit($recordlimit)->get();
        } else {
            $users = $users->paginate($recordlimit);
        }
        return $users;
    }

    /**
     *  @method used to get the model data by id
     * 
     *  @param int $id
     * 
     *  @return object $user
     * 
     */
    public function viewUser(int $id) :User {
        $user = User::findOrFail($id);
        return $user;
    }

    /**
     *  @method used to store the model data
     * 
     *  @param array $data
     *  @param array $roles
     * 
     *  @return object $user
     * 
     */
    public function storeUser(array $data, array $roles) :User {
        $data['password'] = Hash::make($data['password']);
        $user = User::create($data);
        if(!empty($roles)) {
            $user->assignRole($roles);
        }
        return $user;
    }

    /**
     *  @method used to update the model data
     * 
     *  @param array $data
     *  @param array $roles
     *  @param int   $id
     * 
     *  @return object $user
     * 
     */
    public function updateUser(array $data, array $roles, int $id) :User {
        $userUpdate = User::findOrFail($id);
        if ($userUpdate) {
            if(!empty($data['password'])) {
                $data['password'] = Hash::make($data['password']);
            }
            $user = $userUpdate->update($data);
            if(!empty($roles)) {
                $userUpdate->syncRoles($roles);
            }
        }
        return $userUpdate;
    }

    /**
     *  @method used to delete the model data
     * 
     *  @param int   $id
     * 
     *  @return bool
     * 
     */
    public function deleteUser(int $id) :bool {
        $user = User::findOrFail($id);
        return $user->delete();
    }
}