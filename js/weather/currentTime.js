function startTime() {
    var today=new Date();
    var h=today.getHours();
    var m=today.getMinutes();
    var s=today.getSeconds();
    m = checkTime(m);
    s = checkTime(s);
    var hours = setHours(h);
    document.getElementById('time').innerHTML = hours+":"+m;
    var t = setTimeout(function(){startTime()},500);
}

function setHours(h){
    if(h==12){
        return 12;
    }
    else
        return h%12;
}
function checkTime(i) {
    if (i<10) {i = "0" + i};  // add zero in front of numbers < 10
    return i;
}