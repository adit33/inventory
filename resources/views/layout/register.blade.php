@extends('master')
<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="utf-8">
    <title>Step by step tab style form validation Wizard using Bootstrap</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
   
    <style type="text/css">
body {
  margin-top:40px;
}
.stepwizard-step p {
  margin-top: 10px;
}
.stepwizard-row {
  display: table-row;
}
.stepwizard {
  display: table;
  width: 50%;
  margin-top: 20px;
  position: relative;
}
.stepwizard-step button[disabled] {
  opacity: 1 !important;
  filter: alpha(opacity=100) !important;
}
.stepwizard-row:before {
  top: 14px;
  bottom: 0;
  position: absolute;
  content: " ";
  width: 100%;
  height: 1px;
  background-color: #ccc;
  z-order: 0;
}
.stepwizard-step {
  display: table-cell;
  text-align: center;
  position: relative;
}
.btn-circle {
  width: 30px;
  height: 30px;
  text-align: center;
  padding: 6px 0;
  font-size: 12px;
  line-height: 1.428571429;
  border-radius: 15px;
}
</style>
    </head>
    
    
    <body>
    @section('content')

<div class="container">

      <div class="stepwizard col-md-offset-3">
    <div class="stepwizard-row setup-panel">
          <div class="stepwizard-step">
        <a href="#step-1" type="button" class="btn btn-primary btn-circle">1</a>
        <p>Data Diri Pemilik</p>
      </div>
          <div class="stepwizard-step">
        <a href="#step-2" type="button" class="btn btn-default btn-circle" disabled="disabled">2</a>
        <p>Data Perusahaan</p>
      </div>
          <div class="stepwizard-step">
        <a href="#step-3" type="button" class="btn btn-default btn-circle" disabled="disabled">3</a>
        <p>Persetujuan</p>
      </div>
        </div>
  </div>
      {{Form::open(array('url' => route('user.store'),'method'=>'post'))}}
    <div class="row setup-content" id="step-1">
          <div class="col-xs-10 col-md-offset-1">
        <div class="col-md-12">

        <div class="box box-primary">
                <div class="box-header">
        
              <h3>Data Diri Pemilik</h3>
              
              <div class="form-group">
            <label class="control-label">No Identitas /No KTP</label>
            <input name="user_id" maxlength="100" type="text" required="required" class="form-control" placeholder="Masukan No Identitas"  />
          </div>

              <div class="form-group">
            <label class="control-label">First Name</label>
            <input name="namadepan" maxlength="100" type="text" required="required" class="form-control" placeholder="Enter First Name"  />
          </div>
              <div class="form-group">
            <label class="control-label">Last Name</label>
            <input name="namabelakang" maxlength="100" type="text" required="required" class="form-control" placeholder="Enter Last Name" />
          </div>

          <div class="form-group">
            <label class="control-label">Email</label>
            <input name="email" maxlength="100" type="text" required="required" class="form-control" placeholder="Enter E-mail" />
          </div>

          <div class="form-group">
            <label class="control-label">Password</label>
            <input name="password" maxlength="100" type="password" required="required" class="form-control" placeholder="Enter Password" />
          </div>


              <div class="form-group">
            <label class="control-label">Address</label>
            {{form::textarea('alamat',null,array('class'=>'form-control'))}}
          </div>

            <div class="form-group">
            <label class="control-label">Image</label>
            <input type="file" class="form-control" placeholder="Enter your address" ></textarea>
          </div>

              <button class="btn btn-primary nextBtn btn-lg pull-right" type="button" >Next</button>
            </div>
      </div>
        </div>
        </div>
        </div>
    <div class="row setup-content" id="step-2">
          <div class="col-xs-6 col-md-offset-3">
        <div class="col-md-12">
              <h3> Step 2</h3>
              <div class="form-group">
            <label class="control-label">No Izin Usaha</label>
            <input name="idusaha" maxlength="200" type="text" required="required" class="form-control" placeholder="Enter Company Name" />
          </div>

              <div class="form-group">
            <label class="control-label">Nama Perusahaan</label>
            <input name="namausaha" maxlength="200" type="text" required="required" class="form-control" placeholder="Enter Company Name" />
          </div>
              <div class="form-group">
            <label class="control-label">Alamat Perusahaan</label>
            <input name="alamatusaha" maxlength="200" type="text" required="required" class="form-control" placeholder="Enter Company Address"  />
          </div>
          <div class="form-group">
            <label class="control-label">No Telp</label>
            <input name="telpusaha" maxlength="200" type="text" required="required" class="form-control" placeholder="Enter Company Address"  />
          </div>
              <button class="btn btn-primary nextBtn btn-lg pull-right" type="button" >Next</button>
            </div>
      </div>
        </div>
    <div class="row setup-content" id="step-3">
          <div class="col-xs-6 col-md-offset-3">
        <div class="col-md-12">
              <h3> Step 3</h3>
              <button class="btn btn-success btn-lg pull-right" type="submit">Submit</button>
            </div>
      </div>
        </div>
{{form::close()}}
    </div>

<script type="text/javascript">
  $(document).ready(function () {
  var navListItems = $('div.setup-panel div a'),
      allWells = $('.setup-content'),
      allNextBtn = $('.nextBtn');

  allWells.hide();

  navListItems.click(function (e) {
    e.preventDefault();
    var $target = $($(this).attr('href')),
        $item = $(this);

    if (!$item.hasClass('disabled')) {
      navListItems.removeClass('btn-primary').addClass('btn-default');
      $item.addClass('btn-primary');
      allWells.hide();
      $target.show();
      $target.find('input:eq(0)').focus();
    }
  });

  allNextBtn.click(function(){
    var curStep = $(this).closest(".setup-content"),
      curStepBtn = curStep.attr("id"),
      nextStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().next().children("a"),
      curInputs = curStep.find("input[type='text'],input[type='url'],textarea[textarea]"),
      isValid = true;

    $(".form-group").removeClass("has-error");
    for(var i=0; i<curInputs.length; i++){
      if (!curInputs[i].validity.valid){
        isValid = false;
        $(curInputs[i]).closest(".form-group").addClass("has-error");
      }
    }

    if (isValid)
      nextStepWizard.removeAttr('disabled').trigger('click');
  });

  $('div.setup-panel div a.btn-primary').trigger('click');
});
  </script>
</body>
@stop
</html>
