

QUnit.test( "Evaluatestring 1", function( assert ) {
	var result = evaluateString("1+1");		
    assert.ok( result == "2", "Passed! input=\"1+1\" " );
});


QUnit.test( "Evaluatestring 2", function( assert ) {
	var result = evaluateString("5x3");		
    assert.ok( result == "15", "Passed! input=\"5*3\" " );
});

QUnit.test( "Evaluatestring 3", function( assert ) {
	var result = evaluateString("5x-3");		
    assert.ok( result == "-15", "Passed! input=\"5*-3\" " );
});


QUnit.test( "is opeartor", function( assert ) {
	var result = isOperator("+");		
    assert.ok( result == true, "Passed! input=+ " );
});

QUnit.test( "is opeartor", function( assert ) {
	var result = isOperator("9");		
    assert.ok( result == false, "Passed! input=9 " );
});

QUnit.test("validateOperator 1", function( assert ){
	var result = validateOperator("3+3x","+");
	assert.ok(result == "3+3+","Passed!");
});