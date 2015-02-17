/* homepage.js
 * Holds the module that ties all the other modules together.
 * Also holds the config and routes for the website
 */

var quickbarApiUrl = "/dash/fake_api/fake_quickbar.json";	//MODIFY THIS TO THE CORRECT URL TO RETRIEVE THE QUICKBAR

var homepageApp = angular.module("homepageApp", ["ngRoute", "homepageFeed", "homepageSearch"]);

homepageApp.controller("homepageController", ["$scope", "userService",
	function($scope, userService) {
		userService(function(data) {
			$scope.hpUser = data;
		});
	}]
);

/* This service returns a function that takes a callback, this callback is called when the data is successfully retreived from API 
 */
homepageApp.factory("userService", ["$http",
	function($http) {
		return function(callback) {
			//Build the URL, since we are using a GET request
			var urlWithParams = quickbarApiUrl + "?sessionId=" + "0";	
			$http.get(urlWithParams).success(function(data) {
				callback(data);
			});
		}
	}]
);


/* Routes */
homepageApp.config(["$routeProvider",
	function($routeProvider) {
		$routeProvider
		.when("/dash", {
			templateUrl : "parts/main-dashboard.html",
			controller : "homepageFeedController"
		})
		.when("/dash/search", {
			templateUrl : "parts/search.html",
			controller : "homepageSearchController"
		}).otherwise({
			redirectTo : "/dash"
		});
	}
]);