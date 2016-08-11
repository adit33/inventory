var app = angular.module('http',[],function($interpolateProvider) {
    $interpolateProvider.startSymbol('<%');
    $interpolateProvider.endSymbol('%>');
});

app.directive('numbersOnly', function(){
   return {
     require: 'ngModel',
     link: function(scope, element, attrs, modelCtrl) {
       modelCtrl.$parsers.push(function (inputValue) {
           // this next if is necessary for when using ng-required on your input. 
           // In such cases, when a letter is typed first, this parser will be called
           // again, and the 2nd time, the value will be undefined
           if (inputValue == undefined) return '' 
           var transformedInput = inputValue.replace(/[^0-9]/g, ''); 
           if (transformedInput!=inputValue) {
              modelCtrl.$setViewValue(transformedInput);
              modelCtrl.$render();
           }         

           return transformedInput;         
       });
     }
   };
});

app.directive('validasiNama',function(){
  return{
  restrict:'A',
  template:"<label class='control-label' for='inputError'/>"}
});

 app.controller('barangController',function($scope,$http){
    $scope.barang={};
    $scope.datas=[{}];
    $scope.juals=[{}];
    $scope.kode;
  
    $http.get('api/barang').success(function(data){
    $scope.datas=data;
    });

    
    $scope.addBarang = function(event){
        event.preventDefault();
       
        $http.post('barang/store',{idBarang:$scope.idBarang,namaBarang:$scope.namaBarang,jumlahBarang:$scope.jumlahBarang,hargaBarang:$scope.hargaBarang,_token:$scope._token})
        .success(function(data, status, headers, config,response){
         
           if(data.errors){                          
            $.each(data, function(index, error){               
                if(error.namaBarang){
                 $("#formNama").addClass("form-group has-error");
                 var nm = document.getElementById('vNama');
                 var log = document.createElement('div');
                 nm.innerHTML = "<label class='control-label' for='inputError'>"+error.namaBarang+"</label>";
                 nm.appendChild(log);}

                 if(error.jumlahBarang){
                  $("#formJml").addClass("form-group has-error");
                 var jml = document.getElementById('vJumlah');
                 var log = document.createElement('div');
                 jml.innerHTML = "<label class='control-label' for='inputError'>"+error.jumlahBarang+"</label>";
                 jml.appendChild(log);}

                 if(error.hargaBarang){
                  $("#formHrg").addClass("form-group has-error");
                 var log = document.createElement('div'); 
                 var hrg = document.getElementById('vHarga');
                 hrg.innerHTML = "<label class='control-label' for='inputError'>"+error.hargaBarang+"</label>";
                 hrg.appendChild(log);}
            });
           
        }
        else{
          $('#validasi').remove();
          $("#myModal").modal("hide");
            $("#form").removeClass("form-group has-error");
                 $('#label').removeAttr('for','inputError');
            $http.get('api/getidBarang').success(function(data){
            $scope.datas.push({namaBarang:$scope.namaBarang,idBarang:$scope.idBarang,jumlahBarang:$scope.jumlahBarang,hargaBarang:$scope.hargaBarang});
            $scope.idBarang=data;
            $scope.namaBarang="";
            $scope.hargaBarang="";
            $scope.jumlahBarang="";
            
            });
          }
        });
    }
  
     $scope.delete = function(id) {
        if (confirm("Anda yakin untuk menghapus data?") === true) {
            $http.delete("barang/delete/" + id).success(function(data) {
                
                   $http.get('api/barang').success(function(data){
                      $scope.datas=data;
                  });
                
            });
        }
    }

    });
