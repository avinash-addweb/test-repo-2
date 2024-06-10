<?php

namespace Modules\Testimonial\DataTables;

use Modules\Testimonial\Entities\Testimonial;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Support\Str; 
class TestimonialDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
        ->editColumn('created_at', function($testimonial) { return ($testimonial->created_at)->format('Y-m-d H:i:s'); })
        ->editColumn('status', function($testimonial) { return ($testimonial->status) ? __('Active') : __('Inactive'); })
        ->addColumn('testimonialLocales.name', function (Testimonial $testimonial) {
            return $testimonial->testimonialLocales[0]->name;
        })
        ->addColumn('image', function(Testimonial $testimonial) { return (!empty($testimonial->testimonialImage->name) && !empty($testimonial->testimonialImage->path)) ? asset(config('constants.asset_prefix').$testimonial->testimonialImage->path.DIRECTORY_SEPARATOR.$testimonial->testimonialImage->name) : ""; })
        ->addColumn('testimonialLocales.designation', function (Testimonial $testimonial) {
            return $testimonial->testimonialLocales[0]->designation;
        })
        ->addColumn('testimonialLocales.lang_code', function (Testimonial $testimonial) {
            $langList = getLocaleList();
            return $testimonial->testimonialLocales->map(function($testimonialLocale)use($langList) {
                return $langList[$testimonialLocale->lang_code];
            })->implode(', ');
        })->addColumn('action', function($row){
            $actionBtn = "";
            $actionBtn .= '<form action="'.route('testimonial::testimonial.destroy', $row->id).'" method="POST">';
            if(\request()?->user()?->can('testimonial::testimonial list')){
                $actionBtn .= '<a href="'.route('testimonial::testimonial.show', $row->id).'" class="view btn btn-primary btn-sm"><i class="bi bi-eye"></i> '.__('View').'</a>  &nbsp;&nbsp; ';
            }
            if(\request()?->user()?->can('testimonial::testimonial edit')){
                $actionBtn .= '<a href="'.route('testimonial::testimonial.edit', $row->id).'" class="edit btn btn-success btn-sm"><i class="bi bi-pencil"></i> '.__('Edit').'</a>  &nbsp;&nbsp; ';
            }
            if(\request()?->user()?->can('testimonial::testimonial delete')){
                $actionBtn .= '<input type="hidden" name="_token" value="'.csrf_token().'"> <input type="hidden" name="_method" value="DELETE">';
                $actionBtn .= '<button class="delete btn btn-danger btn-sm" title="'.__("Delete").'" onclick="return confirm(\''.__('Are you sure to delete?').'\');">
                <i class="bi bi-trash"></i> '.__("Delete").'</button>';
            }
            $actionBtn .= '</form>';
            return $actionBtn;
        })->filter(function ($query) {
            if (request()->has('search') && !empty(request('search'))) {
                $query->where('email', 'like', "%" . request('search') . "%");
                $query->orWhereHas('testimonialLocales',function($model){ 
                    return $model->where('name', 'like', "%" . request('search') . "%")
                        ->orWhere('designation', 'like', "%" . request('search') . "%");
                });
            }
        })
        ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Testimonial $model): QueryBuilder
    {
        return Testimonial::with('testimonialLocales')->newQuery();
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
            Column::make(['name'=>'testimonialLocales.name','title'=>__('Name')]),
            Column::make(['name'=>'testimonialLocales.lang_code','title'=>__('Language')]),
            Column::make(['name'=>'email','title'=>__('Email')]),
            Column::make(['name'=>'testimonialLocales.designation','title'=>__('Designation')]),
            Column::make(['name'=>'image','title'=>__('Image'),'orderable'=>false,'searchable'=>false,'printable'=>false,'exportable'=>false]),
            Column::make(['name'=>'status','title'=>__('Status')]),
            Column::make(['name'=>'created_at','title'=>__('Created At')]),
            Column::computed('action',__('Action'))
                  ->exportable(false)
                  ->printable(false)
                  ->width(300)
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
        return 'Testimonial_' . date('YmdHis');
    }
}
