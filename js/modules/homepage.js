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
                    $scope.widgetsUrl[i] = "test.html";//"/dash/parts/widget-" + data.widgets[i] + ".html";
                }

            });
        }]
);

homepageApp.factory("calcFactory", function() {

    var calcFac = {};

    calcFac.loadButtons = function() {

        var keys = document.querySelectorAll('#calculator span');

        var countParanthesis = 0;

        // Add onclick event to all the keys and perform operations
        for(var i = 0; i < keys.length; i++) {
            keys[i].onclick = function (e) {
                // Get the input and button values
                var screenValue = document.querySelector('.screen');
                var buttonPressed = this.innerHTML;
                var lastChar = screenValue.innerHTML[tempLength - 1];

                //erase everthing
                if (buttonPressed == 'C') {
                    screenValue.innerHTML = ''; //clear value
                }
                // If eval key is pressed, calculate and display the result
                else if (buttonPressed == '=') {
                    screenValue.innerHTML = evaluateString(screenValue.innerHTML);
                }
                else if (buttonPressed == '(') {
                    countParanthesis += 1;
                    screenValue.innerHTML += buttonPressed;
                }
                else if (buttonPressed == 'sin' || buttonPressed == 'cos' || buttonPressed == 'tan' || buttonPressed == 'log') {
                    countParanthesis += 1;
                    screenValue.innerHTML += buttonPressed;
                    screenValue.innerHTML += '(';
                }
                else if (buttonPressed == ')') {
                    if (countParanthesis == 0) {
                       // alert("no matching paranthesis (");
                    }
                    else {
                        screenValue.innerHTML += buttonPressed;
                        countParanthesis -= 1;
                    }
                }
                //validate the operator operations(no two operators )
                //else if(isOperator(buttonPressed)) {
                //    screenValue.innerHTML = validateOperator(screenValue.innerHTML, buttonPressed);
                //}
                //validate decimal
                else if (buttonPressed == '.') {
                    screenValue.innerHTML = inputDecimal(screenValue.innerHTML);
                }
                else if (buttonPressed == 'del') {
                    var tempLength = screenValue.innerHTML.length;
                    lastChar = screenValue.innerHTML[tempLength - 1];
                    if (isNumber(lastChar) || isOperator(lastChar) || lastChar == '.') {
                        screenValue.innerHTML = screenValue.innerHTML.substring(0, tempLength - 1);
                    }
                    else if (lastChar == ')') {
                        countParanthesis += 1;
                        screenValue.innerHTML = screenValue.innerHTML.substring(0, tempLength - 1);
                    }
                    else if (lastChar == '(') {
                        screenValue.innerHTML = screenValue.innerHTML.substring(0, tempLength - 1);
                        lastChar = screenValue.innerHTML[screenValue.innerHTML.length - 1];
                        while (lastChar == 's' || lastChar == 'i' || lastChar == 'o' || lastChar == 'n' || lastChar == 't' || lastChar == 'a' || lastChar == 'c'
                        || lastChar == 'l' || lastChar == 'g') {
                            screenValue.innerHTML = screenValue.innerHTML.substring(0, screenValue.innerHTML.length - 1);
                            lastChar = screenValue.innerHTML[screenValue.innerHTML.length - 1];
                            if (screenValue.innerHTML.length <= 0) {
                                break;
                            }
                        }
                    }
                }
                else {
                    screenValue.innerHTML += buttonPressed;
                }

                // prevent page jumps
                e.preventDefault();
            }


            /////////////////////////////*************************************/////////////////////////////////////
            function clearScreen(){
                var screenValue = document.querySelector('.screen');
                screenValue.innerHTML = "";
            }


            //evaluate the given string and return the value
            function evaluateString(input) {
                var equation = input;
                var lastChar = equation[equation.length - 1];
                equation = equation.replace(/x/g, '*').replace(/÷/g, '/');


                var operatorList = getOperatorList();
                if(isOperator(lastChar) || lastChar == '.')
                    equation = equation.replace(/.$/, '');
                var result =  math.eval(equation);
                return result;
            }
            function validateOperator(input,operator){
                var lastChar = input[input.length - 1];

                var result = input;
                if(input != '' &&  !isOperator(lastChar)) {//if last is not operator
                    result += operator;
                }
                else if(input == '' && operator == '-'){//if negative
                    result +=operator;
                }
                else if(isOperator(lastChar)){//if last is operator
                    result = result.replace(/.$/, operator);
                }

                return result;
            }

            function inputDecimal(input){
                result = input;
                var lastChar = input[input.length - 1];
                if(isNumber(lastChar) == true || lastChar == '' || lastChar == ' '){
                    result += '.';
                }

                return result;
            }


            function getOperatorList(){
                return ['+', '-', 'x', '/','^','÷','*','!'];
            }


            function isNumber(input){
                var numberList = ['0','1','2','3','4','5','6','7','8','9'];
                for(var i = 0; i < numberList.length; i++)
                {
                    if(input == numberList[i])
                        return true;
                }
                return false;
            }

            function isOperator(input){
                if(input.length > 1)
                    return false;
                if(getOperatorList().indexOf(input) > -1){
                    return true;
                }
                return false;
            }


            /////////////////////////////*************************************/////////////////////////////////////

        }
    }
    return calcFac;
});


homepageApp.controller("calcController", ["$scope", "calcFactory",
    function($scope,calcFactory) {
    addEventListener('load',calcFactory.loadButtons,false);
    $scope.loadButtons = calcFactory.loadButtons();

}]);





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