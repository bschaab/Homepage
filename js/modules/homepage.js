/* homepage.js
 * Holds the module that ties all the other modules together.
 * Also holds the config and routes for the website
 */

var homepageApp = angular.module("homepageApp", ["ngRoute", "homepageFeed", "homepageSearch"]);

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