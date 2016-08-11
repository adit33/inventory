
 	<link rel="stylesheet" href="{{ asset('/uikit/css/uikit.almost-flat.min.css')}}" />
	
	Laporan Penjualan dari tgl {!! $tgl1 !!} sampai {!! $tgl2 !!}

	<table class="uk-table uk-table-striped">
					<thead>
						<tr>
						<th>No Faktur</th>
						<th>Nama Pelanggan</th>
						<th>Tanggal</th>
					
					</tr>
					
					</thead>
					<tbody>	
					@foreach($datas as $data)
					<tr>
						<td>{!! $data->kodeJual !!}</td>
						<td>{!! $data->r_pelanggan->namaPelanggan !!}</td>
						<td>{!! $data->tgl !!}</td>
					
					</tr>
					@endforeach
					</tbody>	
	</table>
