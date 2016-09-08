

				  ID USer:{!! Form::text('userId',null,array('class'=>'form-control','id'=>'userId')) !!}
				  Nama User :{!! Form::text('namaUser',null,array('class'=>'form-control','id'=>'namaUser')) !!}
				  Password:{!! Form::password('password',array('class'=>'form-control','id'=>'password')) !!}
				  Password Confirmation:{!! Form::password('password_confirmation',array('class'=>'form-control','id'=>'password_confirmation')) !!}

					Asal Tempat : {!! Form::select('id_lokasi',App\Lokasi::lists('nama','id'),null,['class'=>'form-control js-example-basic-single','placeholder'=>'']) !!}
			
				<?php 
					if (isset($user_role)) {
						$role=$user_role;
					}else{
						$role=null;
					}
				 ?>

				  Role :{!! Form::select('role',App\Role::lists('namaRole','namaRole'),$role,['class'=>'form-control','id'=>'namaRole','placeholder'=>'Pilih Role']) !!}
				  <input type="file" name="foto" id="foto"></input>
