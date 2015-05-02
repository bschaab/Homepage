var calculatorWidget = angular.module("homepageApp");


/**
 * Angular Javascript for calculator widget
 *
 */
calculatorWidget.factory("calcFactory", function() {

    var calcFac = {};
    
    /*
    calcFac.blahTest = function() {
        alert("hello");
        console.log("Hello");
    }*/


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
                switch (buttonPressed){
                case 'C':
                    screenValue.innerHTML = ''; //clear value
                	break;
                // If eval key is pressed, calculate and display the result
                case '=':
                    screenValue.innerHTML = evaluateString(screenValue.innerHTML);
                	break;
                case '(':
                    countParanthesis += 1;
                    screenValue.innerHTML += buttonPressed;
                	break;
                case 'sin':
                    countParanthesis += 1;
                    screenValue.innerHTML += buttonPressed;
                    screenValue.innerHTML += '(';
                	break;
                case 'tan':
                    countParanthesis += 1;
                    screenValue.innerHTML += buttonPressed;
                    screenValue.innerHTML += '(';
                	break;
                case 'cos':
                    countParanthesis += 1;
                    screenValue.innerHTML += buttonPressed;
                    screenValue.innerHTML += '(';
                	break;
				case 'log':
				    countParanthesis += 1;
                    screenValue.innerHTML += buttonPressed;
                    screenValue.innerHTML += '(';
                	break;
                case ')':
                    if (countParanthesis == 0) {
                        // alert("no matching paranthesis (");
                    }
                    else {
                        screenValue.innerHTML += buttonPressed;
                        countParanthesis -= 1;
                    }
                    break;             
				case '.':
                    screenValue.innerHTML = inputDecimal(screenValue.innerHTML);
                	break;
                case 'del':
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
                    break;
                default:
                    screenValue.innerHTML += buttonPressed;
                
				}
                // prevent page jumps
                e.preventDefault();
            }



			/**
			 *
			 * This function will empty the screen of the calculator 
			 *
			 */
            function clearScreen(){
                var screenValue = document.querySelector('.screen');
                screenValue.innerHTML = "";
            }

			/**
			 * Evaluates the given string and returns the result
			 *
			 * @param {input}
			 * @return {double}
			 */
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
            
            /**
			 * This function will check if the last operator of the screen is an operator or not
			 * and will write another operator if it works or not
			 * 
			 * @param {input}
			 * @param {operator}
			 * @return {boolean}
			 */
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


			/**
			 * Return the list of operators that the calculator uses
			 *
			 * @param{input}
			 * @return {operatorList}
			 */
            function inputDecimal(input){
                result = input;
                var lastChar = input[input.length - 1];
                if(isNumber(lastChar) == true || lastChar == '' || lastChar == ' '){
                    result += '.';
                }

                return result;
            }

			/**
			 * Return the list of operators that the calculator uses
			 *
			 * @return {operatorList}
			 */
            function getOperatorList(){
                return ['+', '-', 'x', '/','^','÷','*','!'];
            }

			/**
			 * This function is used to check whether or not the input is a number
			 *
			 * @param {input}
			 * @return {boolean}
			 */
            function isNumber(input){
                var numberList = ['0','1','2','3','4','5','6','7','8','9'];
                for(var i = 0; i < numberList.length; i++)
                {
                    if(input == numberList[i])
                        return true;
                }
                return false;
            }

			/**
			 * This function is used to check whether or not the input is an operator
			 *
			 * @param {input}
			 * @return {boolean}
			 */
            function isOperator(input){
                if(input.length > 1)
                    return false;
                if(getOperatorList().indexOf(input) > -1){
                    return true;
                }
                return false;
            }
        }
    }




    return calcFac;
});



/**
 * This function is used to set up the buttons in calc-html
 * 
 * @this {calculatorWidget}
 * @param {input}
 * @return {boolean}
 */
calculatorWidget.controller("calcController", ["$scope", "calcFactory",
    function($scope, calcFactory) {

        addEventListener('load',calcFactory.loadButtons,false);
        $scope.loadButtons = calcFactory.loadButtons();

        $scope.swap = function(one, two) {

            one = document.getElementById(one);
            two = document.getElementById(two);

            // Displaying the settings
            if (one.style.display == 'block') {
                two.style.display = 'block';
                one.style.display = 'none';
            }
            else { // Displaying the calculator
                one.style.display = 'block';
                two.style.display = 'none';
            }
        }

        $scope.changeCalculatorColor = function(color) {
            var calculator = document.getElementById('calculator');
            calculator.style.background = color;
        }


    }]);
