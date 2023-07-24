
<?php

    session_start();

  $bd = new PDO('mysql:host=localhost;dbname=bd_calculator;charset=utf8;', 'root', '');
 
  if(isset($_POST['val1']) AND isset($_POST['val2']) AND isset($_POST['operation'])){
    if (!empty($_POST['val1']) AND !empty($_POST['val2']) AND !empty($_POST['operation']) )

   $val1 = $_POST['val1'];
   $val2 = $_POST['val2'];
   $operation = $_POST['operation'];
   if( is_numeric( $val1 ) AND is_numeric( $val2 ) )
   {
       if( $operation != null )
       {
           switch( $operation )
           {
               case "add" : $result = $val1 + $val2; break;
               case "mul" : $result = $val1 * $val2; break;
               case "sous" : $result = $val1 - $val2; break;
               case "div" : $result = $val1 / $val2; break;
           }
        
       }
    
   }
  
   }

   $insertoperation = $bd->prepare('INSERT INTO  operation(val1,	val2)VALUES(?,?)');
  

   $recupoperation = $bd->prepare('SELECT * FROM operation WHERE val1 = ? AND val2 = ?');
   
   
   if ($recupoperation->rowCount() > 0) {
    $_SESSION['val1'] = $val1;
    $_SESSION['val2'] = $val2;
    $_SESSION['id'] = $recupoperation->fetch()['id'];
      
}
    
  ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Operation</title>
    <link href="calcul.css" rel="stylesheet" type="text/css"/>
</head>
<body>
    
<form action = "<?php print $_SERVER['PHP_SELF'];?>" method = "post">
 <fieldset>
  <legend>Calculatrice simple</legend>
  <table border="0">

  <label for="">Valeur 1</label>
    <input type = "number" name = "val1" size = "20">
    <label for="">Valeur 2</label>
    <input type = "number" name = "val2" size = "20">
    <hr>
    <label for="" style="color:red;">Veuillez choisir une opération !!!</label>
    <input type = "radio" name = "operation" value = "add"><b> Addition</b>
    <input type = "radio" name = "operation" value = "sous"><b>Sustraction</b> 
    <input type = "radio" name = "operation" value = "mul"><b>Multiplication</b> 
    <input type = "radio" name = "operation" value = "div"><b>Division</b> 

    <input type = "submit" value = "CALCULER" style="color:green;"><br>
    <input type = "reset" value = "EFFACER" style="color:red;"><br>
    <input type="text" value="<?php echo( " $result " );?> " disabled="desabled" style="background-color:#C0C0C0;">

    </form>
   </table>
  </fieldset>
    <a href="index.php" class="fas fa-user" id="btn-conexion">Se deconnecter</a>	
  </body>
 </html>


