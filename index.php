<?php


   $bd = new PDO('mysql:host=localhost;dbname=bd_calculator;charset=utf8;', 'root', '');

   if (isset($_POST['validate'])) {
     if (!empty($_POST['nom']) AND !empty($_POST['prenom']) AND !empty($_POST['date']) AND !empty($_POST['email']) 
         AND !empty($_POST['pass1']) AND !empty($_POST['pass2'])) {

            $nom = htmlspecialchars($_POST['nom']);
            $prenom = htmlspecialchars($_POST['prenom']);
            $email = htmlspecialchars($_POST['email']);
            $pass1 = sha1($_POST['pass1']);
            $pass2 = sha1($_POST['pass2']);
            $date = $_POST['date'];

            $insertformulaire = $bd->prepare('INSERT INTO  formulaire(nom,	prenom,	email,	pass1,	pass2,	 date)VALUES(?,?,?,?,?,?)');
            $insertformulaire->execute(array($nom, $prenom,	$email,	$pass1,	$pass2,	$date));

            $recupformulaire = $bd->prepare('SELECT * FROM formulaire WHERE nom = ? AND prenom = ? AND	email = ? AND pass1 = ?	AND pass2 = ? AND date = ?');
            
            $recupformulaire->execute(array($nom, $prenom,	$email,	$pass1,	$pass2,	$date));
            
            if ($recupformulaire->rowCount() > 0) {
                $_SESSION['nom'] = $nom;
                $_SESSION['prenom'] = $prenom;
                $_SESSION['email'] = $email;
                $_SESSION['pass1'] = $pass1;
                $_SESSION['pass2'] = $pass2;
                $_SESSION['date'] = $date;
                $_SESSION['id_Formulaire'] = $recupformulaire->fetch()['id_Formulaire'];
                  
            }
            header('Location:calcul.php');
     }
   }


   ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ma_Calculatrice</title>
     <script src="index.js" type="text/javascript"></script>
        <link href="index.css" rel="stylesheet" type="text/css"/>
</head>
<body>
    <form onsubmit="verify()">
            <fieldset>
                <legend>PAGE INSCRIPTION</legend>
                <table border="0">
                        <tr>
                            <td>Nom:</td>
                            <td><input type="text" name="nom" value="" required="required" autofocus="" placeholder="Tapez votre Nom"/></td>
                            <td>*</td>
                        </tr>
                        <tr>
                        
                            <td>Prenoms:</td>
                            <td><input type="text" name="prenom" value="" required="required" autofocus="autofocus" placeholder="Tapez votre Prenom"/></td>
                            <td>*</td>
                        </tr>
                        <tr>
                            <td>Email:</td>
                            <td><input type="text" name="email" value="" required="required" autofocus="autofocus" placeholder="Tapez votre email"/></td>
                            <td>*</td>
                        </tr>
                        <tr>
                            <td>Date de Naissance:</td>
                            <td><input type="date" name="date" value="<?php echo date('d/m/Y');?>"/></td>
                            <td>*</td>
                        </tr>
                        <tr>
                            <td>Mot de Passe:</td>
                            <td><input id="pass1" type="password" name="pass1" value="" placeholder="Tapez votre mot de passe" required="required"/></td>
                            <td>*</td>
                        </tr>
                        <tr>
                            <td>Confirmez Mot de Passe:</td>
                            <td><input id="pass2" type="password" name="pass2" value=""  placeholder="Confirmez votre mot de Passe" required="required"/></td>
                            <td>*<label id ="msg"></label></td>
                        </tr>
                        <tr>
                            <td></td>
                           <td><input type="submit" value="ENREGISTRER" name="validate" style="background:green;color:white;" class=""/></td>
                               
                            <td></td>
                        </tr>
                </table>
            </fieldset>
        </form>
</body>
</html>
