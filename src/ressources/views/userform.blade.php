@section("script")
<script type="text/javascript" src="{{ url("/vendor/rybs/js/ngRyRoute.js") }}"></script>
<script type="text/javascript" src="{{ url("/vendor/rybs/js/ngRySchema.js") }}"></script>
<script type="text/javascript" src="{{ url("/vendor/rycart/js/script.js") }}"></script>
<script type="text/javascript">
(function(){
	(function(angular, $, cart){
		var ngAportax = angular.module('ngAportax', ["ngRyCart"])
		.directive('passtoconfirm', function(){
			return {
				require : 'ngModel',
				link: function(scope, elm, attrs, ctrl){
					ctrl.$validators.passtoconfirm = function(modelValue, viewValue){
						if(viewValue) {
							scope.user.passtoconfirm = viewValue;
							return true;
						}
						
						return false;
					};
				}
			};
		}).directive('passconfirmed', function(){
			return {
				require : 'ngModel',
				link: function(scope, elm, attrs, ctrl) {
					ctrl.$validators.passconfirmed = function(modelValue, viewValue){
						if(viewValue && scope.user.passtoconfirm == viewValue)
							return true;
						
						return false;
					};
				}
			};
		}).controller("UserController", ["$scope", "$http", function($scope, $http){
			$scope.loading = false;
			$scope.user = {};

			$scope.save = function(){
				$scope.loading = true;
				$http.post("", $scope.user).then(function(resp){
					$scope.loading = false;
					document.location.href = "";
				}, function(err){
					
				});
			};
		}])
		
	})(window.angular, window,jQuery, window.ryCart, undefined);
})();
</script>
@stop 

@section("form")
<style type="text/css">
.ng-cloak {
	display: none;
}
</style>
<div ng-controller="UserController">
	<form name="frm_user" novalidate>				
@if($row)
<div class="form-group">
	<label class="control-label" for="user_password_old">Ancien mot de passe</label>
	<input type="password" class="form-control" name="user_password_old" ng-model="user.password_old" id="user_password_old" required>
</div>
<div class="form-group">
	<label class="control-label" for="user_password">Nouveau mot de passe</label>
	<input type="password" class="form-control" name="user_password" ng-model="user.password" id="user_password" passtoconfirm>
</div>
@else
<div class="form-group">
	<label class="control-label" for="user_password">mot de passe</label>
	<input type="password" class="form-control" name="user_password" ng-model="user.password" id="user_password" passtoconfirm>
</div>
@endif
<div class="form-group">
	<label class="control-label" for="user_password_confirm">Confirmer mot de passe</label>
	<input type="password" class="form-control" name="user_password_confirm" ng-model="user.password_confirm" id="user_password_confirm" passconfirmed>
</div>
				
<input type="hidden" name="user_id" value="{{ $row->id or '' }}">
				
<input type="hidden" name="user_remember_token" value="{{ $row->remember_token or '' }}">

		<div class="form-group">
			<button type="submit" class="btn btn-default"
			ng-disabled="frm_user.$invalid || loading" ng-click="save()">Enregistrer</button>
		</div>
	</form>
</div>
@stop
