@extends('layout.master')

@section('content')
{!! Form::open(['url'=>route('user.store'),'files'=>'true']) !!}
<div class="box box-primary">
		<div class="box-body">
			<div class="form-group">
			@if (count($errors) > 0)
		    <div class="alert alert-danger">
		        <ul>
		            @foreach ($errors->all() as $error)
		                <li>{{ $error }}</li>
		            @endforeach
		        </ul>
		    </div>
			@endif
				
					@include('user._form')
					<input type="submit" name="" value="Save" class="btn btn-primary">
			</div>
		</div>
</div>
{!! Form::close() !!}
@endsection