<!DOCTYPE html>
<html ng-app>
<head>
  <title>q</title>
  <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.2.0/angular.min.js"></script>
>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body ng-controller="AlumnoController">

<div class ='contact-item' ng-repeat="alumno in alumno | orderBy: 'nombre'">
{{alumno.nombre}} estudia {{alumno.curso}}
</div>

<button ng-click="ShowForm()" ng-hide="FormVisibility">Agregar</button>

<div ng-show="FormVisibility" class="wrapper">
<input type="text" ng-model="nuevoAlumno.nombre"></input>
<input type="text" ng-model="nuevoAlumno.curso"></input>

<button ng-click="Save()">GUardar</button>

  <script type="text/javascript">


function AlumnoController($scope){

  $scope.alumno = [

  {nombre: "zuan Blanco",curso: "3 ESO"},
  {nombre: "Juan Blanco1",curso: "3 ESO"},
  {nombre: "Juan Blanco2",curso: "3 ESO"}

  ];
  $scope.Save=function() {

  $scope.alumno.push({nombre:$scope.nuevoAlumno.nombre,curso:$scope.nuevoAlumno.curso})
  $scope.FormVisibility=false;
  console.log($scope.FormVisibility)
  } 

  $scope.FormVisibility=false;

  $scope.ShowForm=function(){

    $scope.FormVisibility=true;
    console.log($scope.FormVisibility)
  }
}

  </script>
</body>
</html>