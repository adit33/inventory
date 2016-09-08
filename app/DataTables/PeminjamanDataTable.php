<?php

namespace App\DataTables;

use App\User;
use App\Peminjaman;
use Yajra\Datatables\Services\DataTable;
use URL,Auth;

class PeminjamanDataTable extends DataTable
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
            ->editColumn('status',function($query){
                if($query->is_approve=='false'){
                    $status='<span class="badge bg-yellow">Pending</span>';
                }elseif ($query->is_approve=='true') {
                    $status='<span class="badge bg-green">Acepted</span>';
                }
                return $status;
            })
            ->editColumn('is_return',function($query){
                if($query->is_return=='false'){
                    $status='<span class="badge bg-red">Not Return</span>';
                }elseif ($query->is_return=='true') {
                    $status='<span class="badge bg-green">Return</span>';
                }
                return $status;
            })
            ->addColumn('action',function($query){
                if($query->is_return == 'false' AND $query->is_approve == 'false'){
                   $status=null;
                }elseif ($query->is_approve == 'false' AND Auth::user()->can('peminjaman.approve')) {
                    $status='<a href="'.URL::to('peminjaman/approve/'.$query->id).'" class="btn btn-xs btn-primary">Approve</a><input type="submit" class="btn btn-xs btn-danger" value="Reject">';
                }elseif(($query->is_return == 'false') AND ($query->is_approve == 'true')){
                     $status='<a href="'.URL::to('peminjaman/return/'.$query->id).'" class="btn btn-xs btn-info">Return</a>';
                }else{
                    $status=null;
                }
                return $status ;
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
        if(Auth::User()->can('peminjaman.approve')){
        $query = Peminjaman::with('detailPeminjaman','lokasi','detailPeminjaman.subKelompok')->select('*');}else{
        $query = Peminjaman::with('detailPeminjaman','lokasi','detailPeminjaman.subKelompok')
        ->where('id_lokasi','=',Auth::User()->id_lokasi)
        ->select('*');   
        }

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
            'id',
            'lokasi.nama',
            'status',
            'is_return',
            // add your columns
            'created_at'
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'peminjamandatatables_' . time();
    }
}
