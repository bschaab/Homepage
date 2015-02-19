//code isolation to avoid 
(function(){
	var keys = document.querySelectorAll('#calculator span');



	// Add onclick event to all the keys and perform operations
	for(var i = 0; i < keys.length; i++) {
		keys[i].onclick = function(e) {
			// Get the input and button values
			var screenValue = document.querySelector('.screen');
			var buttonPressed = this.innerHTML;
			
			//erase everthing
			if(buttonPressed == 'C') {
				screenValue.innerHTML = ''; //clear value
			}
			// If eval key is pressed, calculate and display the result
			else if(buttonPressed == '=' && screenValue.innerHTML != "") {
				screenValue.innerHTML = evaluateString(screenValue.innerHTML);	
			}
			//validate the operator operations(no two operators )
			else if(isOperator(buttonPressed)){
				screenValue.innerHTML = validateOperator(screenValue.innerHTML,buttonPressed);
			}
			//validate decimal
			else if(buttonPressed == '.') {
				screenValue.innerHTML = inputDecimal(screenValue.innerHTML);
			}
			else {
				screenValue.innerHTML += buttonPressed;
			}
			
			// prevent page jumps
			e.preventDefault();
		} 
	}



})();


	//this function is used to swap between the settings window
	//and the calculator 
	function swap(one, two) {
		one = document.getElementById(one);
		two = document.getElementById(two);

		if (one.style.display == 'block') {
			one.style.display = 'none';
			two.style.display = 'block';

		}
		else {
			one.style.display = 'block';
			two.style.display = 'none';
		}

	}

	function changeSize(input){
		var calc = document.getElementById('calculator');
		var keys = document.querySelectorAll('#calculator span');
		var myScreen = document.querySelector('.screen');
		var settingsSize = document.getElementById('settings-panel');
		if(input == "large"){
			myScreen.style.width = 362;
			myScreen.style.height = 60;
			myScreen.style.marginRight = 0;
			myScreen.style.fontSize = 24;
			calc.style.width = 525;
			for(var i = 0; i < keys.length; i++) {
				keys[i].style.width = 116;
				keys[i].style.height = 56;
				keys[i].style.fontSize = 20;
				//keys[i].style.lineHeight = 45;
			}
			alert("large");
		}
		else if(input == "medium"){
			calc.style.width = 325;
			myScreen.style.height = 40;
			myScreen.style.width = 212;
			myScreen.style.marginRight = 0;
			myScreen.style.fontSize = 16;
			for(var i = 0; i < keys.length; i++) {
				keys[i].style.width = 66;
				keys[i].style.height = 36;
				keys[i].style.fontSize = 12;
				//keys[i].style.lineHeight = 45;
			}

			alert("medium");

		}
		else{
			settingsSize.style.fontSize = 5;
			calc.style.width = 190;
			myScreen.style.height = 20;
			myScreen.style.width =100;
			myScreen.style.fontSize = 8;
			myScreen.style.marginRight = 10;
			myScreen.style.lineHeight = 3;
			for(var i = 0 ; i <keys.length;i++){
				keys[i].style.width = 30;
				keys[i].style.height = 16;
				keys[i].style.fontSize = 8;
				keys[i].style.lineHeight = 2;
			}


			alert("small");

		}

		clearScreen();

	}

	function clearScreen(){
		var screenValue = document.querySelector('.screen');
		screenValue.innerHTML = "";
	}


	//evaluate the given string and return the value 
	function evaluateString(input)
	{
		var equation = input;
		var lastChar = equation[equation.length - 1];
		equation = equation.replace(/x/g, '*').replace(/÷/g, '/');
		//change the last character if it is an operator
		var operatorList = getOperatorList();
		if(isOperator(lastChar) || lastChar == '.')
			equation = equation.replace(/.$/, '');
		var result =  eval(equation);
		return result;
	}

	//gets the operator list
	function getOperatorList(){
		return ['+', '-', 'x', '/'];
	}


	function isOperator(input){
		if(input.length > 1)
			return false;
		if(getOperatorList().indexOf(input) > -1){
			return true;
		}
		return false;
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
		for(var i = 0; i < input.length; i++) {
			if(input[i] == '.')
				return result;
		}
		result += '.'
		return result;
	}



