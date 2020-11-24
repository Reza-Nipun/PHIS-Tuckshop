




var date1 = new Date();
var y1= date1.getFullYear();
var m1 = date1.getMonth()+1;
if(m1<10)
    m1="0"+m1;
var dt1 = date1.getDate();
if(dt1<10)
dt1 = "0"+dt1;
var d2 = y1+"-"+m1+"-"+dt1;
document.getElementById('date1').value=d2;
