//code isolation to avoid 
(function(){
    var keys = document.querySelectorAll('#calculator span');
    var countParanthesis = 0;

    // Add onclick event to all the keys and perform operations
    for(var i = 0; i < keys.length; i++) {
        keys[i].onclick = function(e) {
            // Get the input and button values
            var screenValue = document.querySelector('.screen');
            var buttonPressed = this.innerHTML;
            var lastChar = screenValue.innerHTML[tempLength - 1];

            //erase everthing
            if(buttonPressed == 'C') {
                screenValue.innerHTML = ''; //clear value
            }
            // If eval key is pressed, calculate and display the result
            else if(buttonPressed == '=' ) {
                screenValue.innerHTML = evaluateString(screenValue.innerHTML);
            }
            else if(buttonPressed == '(') {
                countParanthesis += 1;
                screenValue.innerHTML += buttonPressed;
            }
            else if(buttonPressed == 'sin' || buttonPressed == 'cos' || buttonPressed == 'tan' || buttonPressed == 'log'){
                countParanthesis += 1;
                screenValue.innerHTML += buttonPressed;
                screenValue.innerHTML += '(';
            }
            else if(buttonPressed == ')'){
                if(countParanthesis == 0){
                    alert("no matching paranthesis (");
                }
                else{
                    screenValue.innerHTML += buttonPressed;
                    countParanthesis -=1;
                }
            }
            //validate the operator operations(no two operators )
            else if(isOperator(buttonPressed)) {
                screenValue.innerHTML = validateOperator(screenValue.innerHTML, buttonPressed);
            }
            //validate decimal
            else if(buttonPressed == '.') {
                screenValue.innerHTML = inputDecimal(screenValue.innerHTML);
            }
            else if(buttonPressed == 'del') {
                var tempLength = screenValue.innerHTML.length;
                lastChar = screenValue.innerHTML[tempLength - 1];
                if (isNumber(lastChar) || isOperator(lastChar) || lastChar == '.') {
                    screenValue.innerHTML = screenValue.innerHTML.substring(0, tempLength - 1);
                }
                else if(lastChar == ')'){
                    countParanthesis += 1;
                    screenValue.innerHTML = screenValue.innerHTML.substring(0, tempLength - 1);
                }
                else if(lastChar == '('){
                    screenValue.innerHTML = screenValue.innerHTML.substring(0, tempLength - 1);
                    lastChar = screenValue.innerHTML[screenValue.innerHTML.length - 1];
                    while ( lastChar == 's' || lastChar == 'i' || lastChar == 'o' || lastChar == 'n' || lastChar == 't' || lastChar == 'a' || lastChar == 'c'
                    ||lastChar == 'l' || lastChar == 'g')  {
                        screenValue.innerHTML = screenValue.innerHTML.substring(0, screenValue.innerHTML.length - 1);
                        lastChar = screenValue.innerHTML[screenValue.innerHTML.length - 1];
                        if(screenValue.innerHTML.length <= 0){
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
    }
})();


//this function is used to swap between the settings window
//and the calculator
function swap(one, two) {

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

function makeOptionGreen(input) {

    var left = document.getElementById('size-left');
    var mid  = document.getElementById('size-middle');
    var right  = document.getElementById('size-right');

    if (input == "small") {
        left.style.background = '#72ec78';
        mid.style.background = '#ffffff';
        right.style.background = '#ffffff';
    }
    else if (input == "medium") {
        left.style.background = '#ffffff';
        mid.style.background = '#72ec78';
        right.style.background = '#ffffff';
    }
    else if (input == "large") {
        left.style.background = '#ffffff';
        mid.style.background = '#ffffff';
        right.style.background = '#72ec78';
    }
}


function changeSize(input){

    makeOptionGreen(input);


    var calc = document.getElementById('calculator');

    var keys = document.querySelectorAll(".keys")[0].children; // get all span elements within keys
    var clear = document.querySelectorAll(".top")[0].children; // get all the "clear" button

    var ops  = document.querySelectorAll('.op');
    var myScreen = document.querySelector('.screen');

    if(input == "large")
    {
        myScreen.style.width = 362;
        myScreen.style.height = 60;
        myScreen.style.marginRight = 0;
        myScreen.style.fontSize = 24;
        calc.style.width = 525;
        clear[0].style.width = 116;
        clear[0].style.height = 56;
        clear[0].style.fontSize = 20;

        for(var i = 0; i < keys.length; i++) {
            keys[i].style.width = 116;
            keys[i].style.height = 56;
            keys[i].style.fontSize = 20;
            //keys[i].style.lineHeight = 45;
        }
    }
    else if(input == "medium"){
        calc.style.width = 325;
        myScreen.style.height = 40;
        myScreen.style.width = 212;
        myScreen.style.marginRight = 0;
        myScreen.style.fontSize = 16;
        clear[0].style.width = 66;
        clear[0].style.height = 36;
        clear[0].style.fontSize = 12;

        for(var i = 0; i < keys.length; i++) {
            keys[i].style.width = 66;
            keys[i].style.height = 36;
            keys[i].style.fontSize = 12;
            //keys[i].style.lineHeight = 45;
        }
    }
    else if (input == "small")
    {
        calc.style.width = 190;
        myScreen.style.height = 20;
        myScreen.style.width =100;
        myScreen.style.fontSize = 8;
        myScreen.style.marginRight = 10;
        myScreen.style.lineHeight = 3;
        clear[0].style.width = 30;
        clear[0].style.height = 16;
        clear[0].style.fontSize = 8;
        clear[0].style.lineHeight = 2;

        for(var i = 0 ; i <keys.length;i++){
            keys[i].style.width = 30;
            keys[i].style.height = 16;
            keys[i].style.fontSize = 8;
            keys[i].style.lineHeight = 2;
        }
    }
    clearScreen();
}

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






//gets the operator list
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

function changeCalculatorColor(color) {
    var calculator = document.getElementById('calculator');
    calculator.style.background = color;
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


