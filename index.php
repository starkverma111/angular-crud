<!doctype html>
<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- google font -->
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Nunito&display=swap" rel="stylesheet">
	<!-- Bootstrap CSS -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
	<!-- Bootstrap view js -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
	<!-- Angular js  -->
	<script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js">
	</script>
	<style>
	body {
		background-color: whitesmoke;
		font-family: 'Nunito', sans-serif;
	}
	
	.container {
		background-color: #fff;
		padding: 2%;
	}
	</style>
	<title>Angular Crud app</title>
</head>

<body>
<!--------- Main Angular div here ------------->
	<div ng-app="crud" ng-controller="sachin" ng-init="display()">
	<!--------- Insert data ------------->	
		<div class="container mt-4 rounded shadow-sm" style="width:55%;">
			<h1 class="text-center">Angular Crud</h1>
			<form id="myform"> 
			    Name
				<input type="text" class="form-control mb-2" ng-model="name">
					
				City
				<input type="text" class="form-control mb-2" ng-model="city">
				
				<button type="submit" class="btn btn-primary mt-1" ng-click="insert()">Submit</button>
			</form>
		</div>
<!--------- Display data ------------->
		<div class="container mt-4 rounded shadow-sm " style="width:55%;">
			<h1 class="text-center">Display Data</h1>
			<table class="table">
				<thead>
					<tr>
						<th scope="col">ID</th>
						<th scope="col">NAME</th>
						<th scope="col">CITY</th>
						<th scope="col">UPDATE</th>
						<th scope="col">DELETE</th>
					</tr>
				</thead>
				<tbody>
					<tr ng-repeat="x in student">
						<td>{{x.id}}</td>
						<td>{{x.name}}</td>
						<td>{{x.city}}</td>
						<td>
							<button ng-click="update(x.id, x.name, x.city)" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal">Update</button>
						</td>
						<td>
							<button ng-click="delete(x.id)" class="btn btn-danger btn-sm" >Delete</button>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
<!--------- Modal ------------->
		<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Update Details</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<form id="myformup">
							<input type="text" class="form-control mb-2" ng-model="u_id" disabled> Name
							<input type="text" class="form-control mb-2" ng-model="u_name"> City
							<input type="text" class="form-control mb-3" ng-model="u_city"> </form>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
						<button type="button" class="btn btn-primary" ng-click="update_indb()">Save changes</button>
					</div>
				</div>
			</div>
		</div><!--Modal end-->
		
		<!--------- Angular div over ------------->
	</div>
	<script>
	var app = angular.module('crud', []);
	app.controller('sachin', function($scope, $http) {

//this function for Insert data from php file...	
		$scope.insert = function() {
				$http.post("insert.php", {
					'name': $scope.name, //$scope.fname GET DATA FROM YOUR HTML FORM
					'city': $scope.city //$scope.fname GET DATA FROM YOUR HTML FORM
				}).then(function(response) {
					
					alert(response.data);
					this.myform.reset();
					$scope.display();
					
				}, function(error) {
					alert("Sorry! Data Couldn't be inserted!");
				});
			}

//this function for display data from php file...			
		$scope.display = function() {
				$http.get("fetch.php").success(function(data) {
					$scope.student = data;
				});
			}

//this function for delete data from php file...	  
		$scope.delete = function(id) {
			if(confirm("Are you sure you want to delete this data id=" + id + "?")) {
				$http.post("delete.php", {
					'id': id
				}).success(function(data) {
					$scope.display();
				});
			} else {
				return false;
			}
		}

//update start here..		
		$scope.update = function(id, name, city) {
			$scope.u_id = id;
			$scope.u_name = name;
			$scope.u_city = city;
			$http.get("fetch.php").success(function(data) {
				$scope.student = data;
			});
		}
//update put in db here	..
		$scope.update_indb = function() {
			$http.post("update.php", {
				'u_id': $scope.u_id, //$scope.fname GET DATA FROM YOUR HTML FORM
				'u_name': $scope.u_name, //$scope.fname GET DATA FROM YOUR HTML FORM
				'u_city': $scope.u_city //$scope.fname GET DATA FROM YOUR HTML FORM
			}).then(function(response) {
				alert(response.data);
				$scope.display();
			}, function(error) {
				alert("Sorry! Data Couldn't be inserted!");
			});
		}
});
</script>

</body>

</html>