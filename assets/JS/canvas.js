window.onload = function()
{
  var canvas = document.getElementById('olivier');
  if(!canvas)
  {
    alert("Impossible de récupérer le canvas");
    return;
  }

  var ctx = canvas.getContext('2d');
  if(!ctx)
  {
    alert("Impossible de récupérer le context du canvas");
    return;
  }
//lettre "G"
ctx.beginPath();
ctx.arc(200,200,150,0*Math.PI,1.5*Math.PI);
//trai du "G"
ctx.moveTo(357,200);
ctx.lineTo(200,200);
ctx.strokeStyle = 'dark';
//ombres
ctx.lineWidth = 15;
ctx.shadowOffsetX = 12;
ctx.shadowOffsetY = 7;
ctx.shadowBlur = 16;
ctx.shadowColor = 'dark';
ctx.closePath();
ctx.stroke();
ctx.closePath();
//lettre "O"
ctx.beginPath();
ctx.arc(200,200,100,0.2*Math.PI,1.8*Math.PI);
ctx.strokeStyle = 'black';
ctx.stroke();
ctx.closePath();
//oeil
ctx.beginPath();
ctx.arc(235,160,15,0,Math.PI*2,false);
ctx.strokeStyle = 'red';
ctx.stroke();
ctx.closePath();
//sourcil
ctx.beginPath();
ctx.shadowColor = 'transparent';
ctx.moveTo(260,150);
ctx.lineTo(220,125);
ctx.strokeStyle = 'red';
ctx.lineWidth = 10;
ctx.stroke();
ctx.closePath();
};

