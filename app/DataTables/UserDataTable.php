<?php

namespace App\DataTables;

use App\User;
use Yajra\Datatables\Services\DataTable;
use URL;
use Crypt;
use Form;
class UserDataTable extends DataTable
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
               return '<a href="'.URL::to("user/".Crypt::encrypt($query->userId)."/edit").'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a>'
            .Form::open([
            "method" => "DELETE",
            "id"=>"form-delete",
            "route" => ["user.destroy", $query->userId],
            "style" => "display:inline"
            ]).'
            <button class="btn btn-xs btn-danger" type="button" data-toggle="modal" data-target="#myModal" data-title="Delete User" data-message="Are you sure you want to delete this user ?"> <i class="glyphicon glyphicon-trash"></i> Delete
            </button>'
            .Form::close().'';}) 
            ->make(true);
    }

    /**
     * Get the query object to be processed by dataTables.
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Query\Builder|\Illuminate\Support\Collection
     */
    public function query()
    {
        $query = User::select('*');

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
            'userId',
            // add your columns
            'namaUser',
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'userdatatables_' . time();
    }
}
