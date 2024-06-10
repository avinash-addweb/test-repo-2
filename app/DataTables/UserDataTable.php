<?php

namespace App\DataTables;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Illuminate\Support\Str; 
use Yajra\DataTables\Services\DataTable;

class UserDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->editColumn('created_at', function($user) { return ($user->created_at)->format('Y-m-d H:i:s'); })
            ->editColumn('status', function($user) { return ($user->status) ? __('Active') : __('Inactive'); })
            ->addColumn('action', function($row){
                $actionBtn = "";
                if(!$row->hasRole(config('constants.super_admin_role'))) {
                    $actionBtn .= '<form action="'.route('user.destroy', $row->id).'" method="POST">';
                    if(\request()?->user()?->can('user list')){
                        $actionBtn .= '<a href="'.route('user.show', $row->id).'" class="view btn btn-primary btn-sm"><i class="bi bi-eye"></i> '.__("View").'</a>  &nbsp;&nbsp; ';
                    }
                    if(\request()?->user()?->can('user edit')){
                        $actionBtn .= '<a href="'.route('user.edit', $row->id).'" class="edit btn btn-success btn-sm"><i class="bi bi-pencil"></i> '.__("Edit").'</a>  &nbsp;&nbsp; ';
                    }
                    if(\request()?->user()?->can('user delete')){
                        $actionBtn .= '<input type="hidden" name="_token" value="'.csrf_token().'"> <input type="hidden" name="_method" value="DELETE">';
                        $actionBtn .= '<button class="delete btn btn-danger btn-sm" title="'.__("Delete").'" onclick="return confirm(\''.__('Are you sure to delete?').'\');">
                        <i class="bi bi-trash"></i> '.__("Delete").'</button>';
                    }
                    $actionBtn .= '</form>';
                }
                return $actionBtn;
            })->filter(function ($query) {
                if (request()->has('search')) {
                    $query->where(function($model){
                        return $model->where('name', 'like', "%" . request('search') . "%")
                            ->orWhere('email', 'like', "%" . request('search') . "%");
                    });

                }
                if (request()->has('userType') && !empty(request('userType'))) {
                    $query->whereHas('roles',function($model){
                        if (request('userType')=='adminUser'){
                            return $model->where('is_for_admin',1);
                        } elseif (request('userType')=='frontUser') {
                            return $model->where('is_for_client',1);
                        } else {
                            return $model;
                        }
                    });
                }
            })
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(User $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    //->dom('Bfrtip')
                    ->orderBy(1)
                    ->selectStyleSingle()
                    ->buttons([
                        Button::make('excel'),
                        Button::make('csv'),
                        Button::make('pdf'),
                        //Button::make('print'),
                        Button::make('reset'),
                        Button::make('reload')
                    ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [

            //Column::make('id'),
            Column::make(['name'=>'name','title'=>__('Name')]),
            Column::make(['name'=>'email','title'=>__('Email')]),
            Column::make(['name'=>'status','title'=>__('Status')]),
            Column::make(['name'=>'created_at','title'=>__('Created At')]),
            Column::computed('action',__('Action'))
                  ->exportable(false)
                  ->printable(false)
                  ->width(350)
                  ->addClass('text-center'),
            //Column::make('created_at'),
            //Column::make('updated_at'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'User_' . date('YmdHis');
    }
}
