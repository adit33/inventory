

				  ID USer:{!! Form::text('userId',null,array('class'=>'form-control','id'=>'userId')) !!}
				  Nama User :{!! Form::text('namaUser',null,array('class'=>'form-control','id'=>'namaUser')) !!}
				  Password:{!! Form::password('password',array('class'=>'form-control','id'=>'password')) !!}
				  Password Confirmation:{!! Form::password('password_confirmation',array('class'=>'form-control','id'=>'password_confirmation')) !!}

					Asal Tempat : {!! Form::select('id_lokasi',App\Lokasi::lists('nama','id'),null,['class'=>'form-control js-example-basic-single','placeholder'=>'']) !!}
			

				  Role :{!! Form::select('role',App\Role::lists('namaRole','namaRole'),null,['class'=>'form-control','id'=>'namaRole']) !!}
				  <input type="file" name="foto" id="foto"></input>
