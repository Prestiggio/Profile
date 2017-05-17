(function(window, angular, $, undefined){
	
	angular.module("ngProfile", ["ng"]).factory("$profile", function(){
		var c = function(){
			this.collections = [{id:'Mme', title:'Madame'},{id:'Mlle', title:'Mademoiselle'},{id:'M', title:'Monsieur'}];
		};
		
		return new c();
	});
	
})(window, window.angular, window.jQuery);