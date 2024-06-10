<?php

namespace App\Livewire\Admin;


use Livewire\Component;
use Spatie\Permission\Models\Role;
use Livewire\WithPagination;

class Roles extends Component
{
    use WithPagination;
    
    public $isModalOpen = 0;
    protected $queryString = ['query'];
    public $columns = [
        'id',
        'name',
    ];
    public $roles, $name, $role_id, $query = '', $sortColumn = "id", $sortDirection = "asc";

    public function search()
    {
        $this->resetPage();
    }
    public function sort($column)
    {
        $this->sortColumn = $column;
        $this->sortDirection = $this->sortDirection == 'asc' ? 'desc' : 'asc';
    }

    public function cleanFilter()
    {
        $this->query = "";
    }

    public function render()
    {

        $roleQuery = Role::orderBy($this->sortColumn, $this->sortDirection);

        if ($this->query) {
            $roleQuery->where('name', 'like', '%' . $this->query . '%');
        }

        $roleList = $roleQuery->paginate(10);
        return view('livewire.admin.roles.index', ['roleList' => $roleList]);
    }
    public function create()
    {
        $this->resetCreateForm();
        $this->openModalPopover();
    }
    public function openModalPopover()
    {
        $this->isModalOpen = true;
    }
    public function closeModalPopover()
    {
        $this->isModalOpen = false;
    }
    private function resetCreateForm(){
        $this->name = '';
    }
    
    public function store()
    {
        $this->validate([
            'name' => 'required',
        ]);
    
        Role::updateOrCreate(['id' => $this->role_id], [
            'name' => $this->name,
        ]);
        session()->flash('message', $this->role_id ? 'Role updated.' : 'Role created.');
        $this->closeModalPopover();
        $this->resetCreateForm();
    }
    public function edit($id)
    {
        $role = Role::findOrFail($id);
        $this->role_id = $id;
        $this->name = $role->name;    
        $this->openModalPopover();
    }

    public function delete($id)
    {
        Role::find($id)->delete();
        session()->flash('message', 'Role deleted.');
    }
}