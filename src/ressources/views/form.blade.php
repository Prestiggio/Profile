@section("script")
<script type="text/javascript" src="{{ url("/vendor/rybs/js/ngRyRoute.js") }}"></script>
<script type="text/javascript" src="{{ url("/vendor/rybs/js/ngRySchema.js") }}"></script>
<script type="text/javascript" src="{{ url("/vendor/rycart/js/script.js") }}"></script>
<script type="text/javascript">
(function(){
	(function(angular, $, cart){
		var ngAportax = angular.module('ngAportax', ["ngRyCart"]).controller("ProfileController", ["$scope", "$http", function($scope, $http){
			$scope.profile_gender_collection = [
					{id:'M',title:'Monsieur'},
					{id:'Mme',title:'Madame'},
					{id:'Mlle',title:'Mademoiselle'}
			];
			$scope.profile = {!!$row!!};
			$scope.loading = false;
			$scope.save = function(){
				$scope.loading = true;
				$http.post("", $scope.profile).then(function(resp){
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
<div ng-controller="ProfileController">
	<form name="frm_profile" novalidate>
				
<div class="form-group">
	<label class="control-label" for="profile_firstname">pr&eacute;nom</label>
	<input type="text" class="form-control" ng-model="profile.firstname" name="profile_firstname" id="profile_firstname" required>
</div>
				
<div class="form-group">
	<label class="control-label" for="profile_lastname">nom</label>
	<input type="text" class="form-control" ng-model="profile.lastname" name="profile_lastname" id="profile_lastname" required>
</div>

@if(!auth()->user()->isSociete())
			
<div class="form-group">
	<label class="control-label" for="profile_adresse_raw">adresse</label>
	<input type="text" class="form-control" ng-model="profile.adresse.raw" name="profile_adresse_raw" id="profile_adresse_raw" required>
</div>

<div class="form-group">
	<label class="control-label" for="profile_adresse_ville_cp">code postal</label>
	<input type="text" class="form-control" ng-model="profile.adresse.ville.cp" name="profile_adresse_ville_cp" id="profile_adresse_ville_cp" required>
</div>
				
<div class="form-group">
	<label class="control-label" for="profile_adresse_ville_nom">ville</label>
	<input type="text" class="form-control" ng-model="profile.adresse.ville.nom" name="profile_adresse_ville_nom" id="profile_adresse_ville_nom" required>
</div>
		
<div class="form-group">
	<label class="control-label" for="profile_adresse_ville_country_nom">pays</label>
	<input type="text" class="form-control" ng-model="profile.adresse.ville.country.nom" name="profile_adresse_ville_country_nom" id="profile_adresse_ville_country_nom" required>
</div>

@endif

<div class="form-group">
			<button type="submit" class="btn btn-default"
			ng-disabled="frm_profile.$invalid || loading" ng-click="save()">Enregistrer</button>
		</div>
	</form>
</div>
@stop
