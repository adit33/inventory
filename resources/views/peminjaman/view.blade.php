@extends('layout.master')

@section('content')
	<section class="content">
	<div class="box box-primary">
		<div class="box-body">
			<div class="form-group">
				<div class="col-sm-12">
					No Peminjaman : {!! $peminjaman->id !!} <br>
					Tanggal Pinjam :{!! $peminjaman->created_at  !!}<br>
					Lokasi :{!! $peminjaman->lokasi->nama  !!}

					<hr>

					@foreach($peminjaman->detailPeminjaman as $sub)

					{!! dd($sub->subKelompok) !!} <br>

					@endforeach

				</div>
			</div>
		</div>
	</div>
</section>
@endsection
