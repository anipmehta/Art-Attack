<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"
      xmlns:svg="http://www.w3.org/2000/svg"
      xmlns:vml="urn:schemas-microsoft-com:vml">
  <head>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
    <title>Art Attack-A Verbal Drawing Tool</title>
    <meta http-equiv="X-UA-Compatible" content="IE=7" />
    <!--[if vml]><style>vml\:* {behavior: url(#default#VML);}</style><![endif]-->
    <script type="text/javascript" src="./jsgl.min.js"></script>
  </head>
  <body>

   <div id="title">
   		<h1>Art Attack</h1>

   </div>

    <div id="panel" style="width: 640px; height: 480px">
       <canvas id="drawing" width="440" height="220" style="border:2px solid #c3c3c3;" >  </canvas>
    </div>

    <script type="text/javascript">
      /* Instantiate JSGL Panel. */
      myPanel = new jsgl.Panel(document.getElementById("panel"));

      /* Start drawing! */
      function circle(x,y,radius,temp){
      /* Create circle and modify it */
      console.log("Hello");
      temp = myPanel.createCircle();
      temp.setCenterLocationXY(x,y);
      temp.setRadius(radius);
      temp.getStroke().setWeight(5);
      temp.getStroke().setColor("rgb(255,0,0)");
      myPanel.addElement(temp);
 }
      function polygon(){
      polygon = myPanel.createPolygon();
      polygon.addPointXY(50,50);
      polygon.addPointXY(110,50);
      polygon.addPointXY(150,80);
      polygon.addPointXY(110,110);
      polygon.addPointXY(50,110);
      polygon.getStroke().setWeight(5);
      polygon.getStroke().setColor("rgb(0,0,255)");
      polygon.getFill().setColor("rgb(0,255,0)");
      polygon.getFill().setOpacity(0.5);
      myPanel.addElement(polygon);
      }
      function label(x,y,text,temp){
      temp = myPanel.createLabel();
      temp.setText(text);
      temp.setLocationXY(x,y);
      temp.setBold(true);
      temp.setFontFamily("sans-serif");
      temp.setFontSize(24);
      myPanel.addElement(temp);
    }

    <?php
     $url1=$_SERVER['REQUEST_URI'];
    header("Refresh: 10; URL=$url1");
mysql_connect('localhost','root','');
mysql_select_db("art");
$query="select * from draw";
$res=mysql_query($query);

while($row=mysql_fetch_array($res))
 {
  if($row['shape']=="circle"){
    $x=$row['xco'];
    $y=$row['yco'];
    $rad=$row['radius'];
    $sno=$row['S.no'];
    $temp=str_shuffle("HelloWorld");
      echo "circle($x,$y,$rad,'$sno')";
      echo "\n";
    }

  else if($row['shape']=="label"){
      $sno=$row['S.no'];
      echo "label($row[xco],$row[yco],'$row[text]','$sno')";
      echo "\n";
     }


}

/*
echo "circle(50,50,30,'1')";
echo  "\n";

echo "label(30,120,'Hello World','3')";
echo "\n";
echo "circle(50,50,20,'2')";
echo "\n";

*/
?>

     </script>
  </body>
</html>
