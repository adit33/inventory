
 	<link rel="stylesheet" href="{{ asset('/uikit/css/uikit.almost-flat.min.css')}}" />
	
	Laporan Penjualan dari tgl {!! $tgl1 !!} sampai {!! $tgl2 !!}

	<table class="uk-table uk-table-striped">
					<thead>
						<tr>
						<th>No Peminjaman</th>
						<th>Lokasi Peminjam</th>
						<th>Tanggal</th>
						<th>Barang</th>
						<th>Jumlah</th>
					
					</tr>
					
					</thead>
					<tbody>	
					@foreach($datas as $data)
					
						@foreach($data->detailPeminjaman as $pnj)
					<tr>
						<td>{!! $data->id !!}</td>
						<td>{!! $data->lokasi->nama !!}</td>
						<td>{!! $data->created_at !!}</td>
						<td>{!! $pnj->subKelompok->nama_sub !!}</td>
						<td>{!! $pnj->jumlah !!}</td>
					</tr>
						@endforeach
					
					@endforeach
					</tbody>	
	</table>
