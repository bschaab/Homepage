

QUnit.test( "loadWeatherChicago", function( assert ) {
    var result = loadWeather('Chicago','');
    var links = document.getElementById("city");
    assert.ok( links.innerHTML == "Chicago, IL", "");
});
