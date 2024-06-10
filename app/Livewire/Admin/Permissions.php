<?php

namespace App\Livewire\Admin;


use Livewire\Component;
use Spatie\Permission\Models\Permission;
use Livewire\WithPagination;

class Permissions extends Component
{
    use WithPagination;
    
    public $isModalOpen = 0;
    protected $queryString = ['query'];
    public $columns = [
        'id',
        'name',
    ];
    public $permissions, $name, $permission_id, $query = '', $sortColumn = "id", $sortDirection = "asc";
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

        $permissionQuery = Permission::orderBy($this->sortColumn, $this->sortDirection);

        if ($this->query) {
            $permissionQuery->where('name', 'like', '%' . $this->query . '%');
        }

        $permissionList = $permissionQuery->paginate(10);
        return view('livewire.admin.permissions.index', ['permissionList' => $permissionList]);
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
    
        Permission::updateOrCreate(['id' => $this->permission_id], [
            'name' => $this->name,
        ]);
        session()->flash('message', $this->permission_id ? 'Permission updated.' : 'Permission created.');
        $this->closeModalPopover();
        $this->resetCreateForm();
    }
    public function edit($id)
    {
        $permission = Permission::findOrFail($id);
        $this->permission_id = $id;
        $this->name = $permission->name;    
        $this->openModalPopover();
    }

    public function delete($id)
    {
        Permission::find($id)->delete();
        session()->flash('message', 'Permission deleted.');
    }
}