<?php

namespace App\Repositories\Interfaces;

Interface UserRepositoryInterface{
    public function getData(array $filters, bool $pagination=true);
    public function viewUser(int $id);
    public function storeUser(array $data, array $roles);
    public function updateUser(array $data, array $roles, int $id); 
    public function deleteUser(int $id); 
}