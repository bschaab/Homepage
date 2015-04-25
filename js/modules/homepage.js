/* homepage.js
 * Holds the module that ties all the other modules together.
 * Also holds the config and routes for the website
 */

var quickbarApiUrl = "/dash/data/data.php";	//MODIFY THIS TO THE CORRECT URL TO RETRIEVE THE QUICKBAR

var homepageApp = angular.module("homepageApp", ["ngRoute", "homepageFeed", "homepageSearch"]);

homepageApp.controller("homepageController", ["$scope", "userService",
        function($scope, userService) {
            userService(function(data) {
                $scope.hpUser = data;

                // Build widget template URLs
                $scope.widgetsUrl = [];
                for(var i = 0; i < 3; i++) {
                    $scope.widgetsUrl[i] = "/dash/parts/widget-" + data.widgets[i] + ".html";
                }

            });
            
    		$scope.search = function(event) {
				location.href = "https://www.google.com/?gws_rd=ssl#q=" + $scope.searchQuery;
				event.preventDefault;
			}
			
			$scope.buildDate = function(dateLong) {
				var date = new Date(dateLong * 1000);
				
				var mins = date.getMinutes();
				
				return date.getHours() + ":" + (mins >= 10 ? mins : "0" + mins) + " " + (date.getMonth() + 1) + "/" + date.getDate();
			}
			
			$scope.bookmarkToggle = -1;	// Initialize bookmark toggling
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

/* Widget directive */
homepageApp.directive("homepageWidget", function() {
    return {
        //templateUrl : function(elem, attr) {

        //},
        link : function(scope, element, attrs) {
            console.log(element);
            scope.widgetUrl = "parts/search.html";
            element.attr("ng-include", "widgetUrl");
        }
    }
});

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
