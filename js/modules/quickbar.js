/* quickbar.js
 * Angular module for the quickbar
 */

var quickbarMod = angular.module("homepageQuickbar", []);

var quickbarApiUrl = "/dash/fake_api/fake_quickbar.json";	//MODIFY THIS TO THE CORRECT URL TO RETRIEVE THE QUICKBAR

quickbarMod.controller("homepageQuickbarController", ["$scope", "qbService",
	function($scope, qbService) {
		qbService(function(data) {
			$scope.quickbarItems = data;
		});
	}]
);

quickbarMod.factory("qbService", ["$http",
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
