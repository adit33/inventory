<?php

namespace App\DataTables;

use App\User;
use Yajra\Datatables\Services\DataTable;
use App\SubKelompok;
class SubKelompokDataTable extends DataTable
{
    /**
     * Display ajax response.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function ajax()
    {   $query=$this->query();
        return $this->datatables
            ->eloquent($this->query())
            // ->addColumn('action', '<a href="#" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a>
            // <button class="btn btn-xs btn-danger" type="button" data-toggle="modal" data-target="#myModal" data-title="Delete User" data-message="Are you sure you want to delete this user ?"> <i class="glyphicon glyphicon-trash"></i> Delete
            // </button>')

            ->addColumn('action',function($query){
                if($query->stock==0){
                    return '<button type="button" disabled onclick="getId('."'$query->id_sub'".')" id="btn_id" class="btn btn-xs btn-primary" value="'.$query->id_sub.'"><i class="glyphicon glyphicon-plus"></i>Add To Cart</button>';
                }else{
                    return '<button type="button" onclick="getId('."'$query->id_sub'".')" id="btn_id" class="btn btn-xs btn-primary" value="'.$query->id_sub.'"><i class="glyphicon glyphicon-plus"></i>Add To Cart</button>';}
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
        $query = SubKelompok::with('kelompok')->select('*');

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
            'kode_sub',
            'nama_sub',
            'kelompok.nama_kelompok',
            'stock',
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'subkelompokdatatables_' . time();
    }
}
