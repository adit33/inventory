<?php

namespace App\DataTables;

use App\Lokasi;
use Yajra\Datatables\Services\DataTable;
use URL;

class LokasiDataTable extends DataTable
{
    /**
     * Display ajax response.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function ajax()
    {
        $query=$this->query();
        return $this->datatables
            ->eloquent($this->query())
            ->addColumn('action', function($query){
                return '<a href="'.URL::to('lokasi/'.$query->id.'/edit').'" class="btn btn-xs btn-primary">Edit</a>';
            })
            ->make(true);
    }

    /**
     * Get the query object to be processed by dataTables.
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Query\Builder|\Illuminate\Support\Collection
     */
    public function query()
    {
        $query = Lokasi::select('*');

        return $this->applyScopes($query);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\Datatables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->columns($this->getColumns())
                    ->ajax('')
                    ->addAction(['width' => '150px'])
                    ->parameters($this->getBuilderParameters());
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            'nama',
            // add your columns
            'lat',
            'lang',
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'lokasidatatables_' . time();
    }
}
