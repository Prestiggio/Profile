@section("formscript")
<script type="text/javascript">
(function($, angular, appApp, undefined){

	angular.module("ngApp").controller("ProfileController", ["$scope", "$http", "$mdDialog", function($scope, $http, $mdDialog){
		$scope.user_profile_gender_collection = [
		                                 		{id:"Mr", title:"Monsieur"},
		                                 		{id:"Mme", title:"Madame"},
		                                 		{id:"Mlle", title:"Mademoiselle"}
		                                 		];
 		$scope.user_profile_relationship_collection = [
 		                                               	{id:"Celibataire", title:"Célibataire"},
 		                                              	{id:"Marié", title:"Marié"}
 	 		                                       		];
     	$scope.user_profile_languages_collection = [
     	                                           {id:"fr/FR", title:"Français"},
     	                                           {id:"mg/MG", title:"Malagasy"}
     	                                        	];

     	$scope.user = {!!$user!!};

     	$scope.post_user = function(){
			$http.post("{{action("\Ry\Profile\Http\Controllers\ProfileController@postEdit")}}", $scope.user).then(function(response){
				$mdDialog.show($mdDialog.alert()
				        .clickOutsideToClose(true)
				        .title(document.location.host)
				        .textContent(response.data.error)
				        .ariaLabel(response.data.error)
				        .ok('OK'));
			});
        };
	}]);
	
})(window.jQuery, window.angular, window.appApp);

function main(){
	
}
</script>
@stop

@section("form")
<div ng-controller="ProfileController">
	<form novalidate name="frm_user" ng-submit="frm_user.$valid && post_user()" layout="column" class="md-padding">	
		<md-input-container class="md-block">
		  <label>Civilité</label>
		  <md-select ng-model="user.profile.gender" required>
		    <md-option name="user_profile_gender" ng-repeat="gender in user_profile_gender_collection" value="@{{gender.id}}">
		      @{{gender.title}}
		    </md-option>
		  </md-select>
		  <div ng-messages="frm_user.user_profile_gender.$error">
			<div ng-message="required">Vous devez renseigner la civilité</div>
		  </div>
		</md-input-container>			
		<md-input-container class="md-block">
		 	<label>Prénom</label>
		 	<input type="text" ng-model="user.profile.firstname" name="user_profile_firstname" required>
		 	<div ng-messages="frm_user.user_profile_firstname.$error">
		 		<div ng-message="required">Vous devez renseigner le prénom</div>
		 	</div>
		</md-input-container>						
		<md-input-container class="md-block">
		 	<label>Nom de famille</label>
		 	<input type="text" ng-model="user.profile.lastname" name="user_profile_lastname" required>
		 	<div ng-messages="frm_user.user_profile_lastname.$error">
		 		<div ng-message="required">Vous devez renseigner le nom de famille</div>
		 	</div>
		</md-input-container>
		<md-input-container class="md-block">
		  <label>Situation familiale</label>
		  <md-select ng-model="user.profile.relationship" required>
		    <md-option name="user_profile_relationship" ng-repeat="relationship in user_profile_relationship_collection" value="@{{relationship.id}}">
		      @{{relationship.title}}
		    </md-option>
		  </md-select>
		  <div ng-messages="frm_user.user_profile_relationship.$error">
			<div ng-message="required">Vous devez renseigner la situation familiale</div>
		  </div>
		</md-input-container>				
		<md-input-container class="md-block">
		 	<label>A propos de vous</label>
		 	<textarea ng-model="user.profile.about" name="user_profile_about" md-maxlength="150" rows="5" required></textarea>
		 	<div ng-messages="frm_user.user_profile_about.$error">
		 		<div ng-message="required">Vous devez renseigner le à propos de vous</div>
		 	</div>
		</md-input-container>				
		<ry-edit ng-model="user.profile.adresse" src="{{url("ry/geo/ngmodel")}}"></ry-edit>				
		<md-input-container class="md-block">
		  <label>Language</label>
		  <md-select ng-model="user.profile.languages" required>
		    <md-option name="user_profile_languages" ng-repeat="languages in user_profile_languages_collection" value="@{{languages.id}}">
		      @{{languages.title}}
		    </md-option>
		  </md-select>
		  <div ng-messages="frm_user.user_profile_languages.$error">
			<div ng-message="required">Vous devez renseigner la langage</div>
		  </div>
		</md-input-container>
		<ry-edit ng-model="user.contacts" src="{{url("ry/profile/ngcontact")}}"></ry-edit>
		<md-button class="md-raised md-primary"  type="submit" ng-disabled="loading || frm_user.$pending">Enregistrer</md-button>
	</form>
</div>
@stop