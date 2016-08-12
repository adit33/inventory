@extends('layout.master')

@section('content')
<body ng-controller="barangController">
Notifikasi
<div id="notifications"></div>

<section class="content">
<div class="box box-primary">

<div class="box-header"></div>   
<!-- Button trigger modal -->
<div class="box-body pad table-responsive">

<div class="col-md-12">
<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus"></i>
  Tambah Barang 
</button>
              <div class="box">
                <div class="box-header with-border">
                  <h3 class="box-title">Data Barang</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  {!! $dataTable->table() !!}
                </div><!-- /.box-body -->
              </div><!-- /.box -->          
            </div>


</div>
</div>

</div>
</section>
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
      </div>

      <div class="col-md-9">
      <div class="modal-body">
        
        {!! Form::open(['class'=>'form-horizontal']) !!}
          {!! csrf_field() !!}

      <div class="form-group">
      
      <div class="col-lg-6">
      <label for="">Kode Barang :</label>
            {!! Form::text('idBarang',$kodeBarang,array('class'=>'form-control ','disabled','ng-model'=>'idBarang','ng-init'=>"idBarang='$kodeBarang'")) !!}
            <input type="hidden" ng-model="idBarang" value="{!! $kodeBarang !!}" ng-init="idBarang='{!! $kodeBarang !!}'">         
        </div>    
      </div>

      <div class="form-group" id="formNama">
        <div>  
          <label id="label">Nama Barang :</label>    
          {!! Form::text('namaBarang',null,array('class'=>'form-control','ng-model'=>'namaBarang')) !!}<label id="vNama"></label>
        </div>
      </div>

      <div class="form-group" id="formJml">
        <label id="label">Jumlah Barang :</label>    
        <div>
          {!! Form::text('jumlahBarang',null,array('class'=>'form-control','ng-model'=>'jumlahBarang','numbers-only'=>'numbers-only')) !!}<label id="vJumlah"></label>
        </div>
      </div>

      <div class="form-group" id="formHrg">
        <label id="label">Harga Barang :</label>    
          <div class="input-group">
        <span class="input-group-addon">Rp</span>
            {!! Form::text('hargaBarang',null,array('class'=>'form-control','ng-model'=>'hargaBarang','numbers-only'=>'numbers-only')) !!}
        </div>
        <label id="vHarga"></label>
      </div>    
        <br>
        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
             <button type="submit" class="btn btn-primary"  >Simpan</button>
    
    {!! Form::close() !!}
    </div>
      </div>

    
      <div class="modal-footer">
   
      </div>
   
    </div>
  </div>
</div>
</body>

@push('scripts')
{!! $dataTable->scripts() !!}
@endpush

@stop



