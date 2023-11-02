<?php
$firstname = $name = $email = $phone = $message =" ";
$firstnameError = $nameError = $emailError = $phoneError = $messageError =" ";
$isSucces = false;
$email2 = "tsatsopjoelvaldes@gmail.com";
//fhdhd

if($_SERVER["REQUEST_METHOD"] == "POST"){
$firstname = verifyInput($_POST["firstname"]);
$name = verifyInput($_POST["name"]);
$email = verifyInput($_POST["email"]);
$phone = verifyInput($_POST["phone"]);
$message = verifyInput($_POST["message"]);
$emailText = "";

             if(empty($firstname)){
                  $firstnameError = "je veux connaitre ton prenom !";
                  $isSucces = false;
                }
                else{
                    $emailText .= "Firstname: $firstname\n";
                }
             if(empty($name)){
                  $nameError = "et meme ton nom !";
                  $isSucces = false;
                }
                else{
                    $emailText .= "Name: $name\n";
                }
            
            if(! isEmail($email)){
                $emailError = "T'essaie de me rouler ? c'est pas un email ca!";
                $isSucces = false;
            } 
            else{
                $emailText .= "Email: $email\n";
            }
            if(! isPhone($phone)){
                $phoneError = " que des chiffres et des espaces, stp...";
                $isSucces = false;
            } 
            else{
                $emailText .= "Phone: $phone\n";
            }
            if(empty($message)){
                $messageError = "qu'est ce que tu veux me dire";
                $isSucces = false;
             }
             else{
                 $emailText .= "Message: $message\n";
             }
            if($isSucces){
                $headers = "From: $firstname $name <$email>\r\nReply-To: $email";
                mail($email2,"un message de votre site", $emailText, $headers );
                $firstname = $name = $email = $phone = $message =" ";
            }  

}

function isPhone($var){

    return preg_match("/^[0-9 ]*$/", $var); 
}

function isEmail($var){

         return filter_var($var, FILTER_VALIDATE_EMAIL);    
}



function verifyInput($var){
    $var = trim($var);
    $var = stripslashes($var);
    $var = htmlspecialchars($var);



    return $var;
}

?>
<!DOCTYPE html>
<html>
    <head>
    <title>Contactez- moi</title> 
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.3/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <link href="http://fonts.googleapis.com/css?family=Lato" rel="'stylesheet" type="text/css">
    <link rel="stylesheet" href="css/style.css">

    </head>
    <body>
    <div class="container">
        <div class="divider"></div>
        <div class="heading">
            <h2>contactez- moi</h2>
        </div>
         <div class="row">
            <div class="col-lg-10 col-lg-ofset-1">
                <form id="contact-form" method="post" action="<?php echo htmlspecialchars($_SERVER ['PHP_SELF']) ; ?>" role="form">
                 <div class="row">
                    <div class="col-md-6">
                        <label for="firstname">prenom<span class="blue"> *</span></label>
                        <input type="text" id="firstname"name="firstname"  class="form-control" placeholder="votre prenom" value="<?php echo $firstname ;?>">
                        <p class="comments"><?php echo $firstnameError; ?></p>
                    </div>
                    <div class="col-md-6">
                        <label for="name">Nom<span class="blue"> *</span></label>
                        <input type="text" id="name" name="name" class="form-control" placeholder="votre nom" value="<?php echo $name;?>">
                        <p class="comments"><?php echo $nameError; ?></p>
                    </div>
                    <div class="col-md-6">
                        <label for="email">Email<span class="blue"> *</span></label>
                        <input type="text" id="email" name="email"  class="form-control" placeholder="votre email" value="<?php echo $email;?>">
                        <p class="comments"><?php echo $emailError; ?></p>
                    </div>
                    <div class="col-md-6">
                        <label for="phone">Telephone</label>
                        <input type="tel" id="phone" name="phone" class="form-control" placeholder="votre telephone" value="<?php echo $phone;?>">
                        <p class="comments"><?php echo $phoneError; ?></p>
                    </div>
                    <div class="col-md-12">
                        <label for="message">Message<span class="blue"> *</span></label>
                        <textarea id="message" name="message" class="form-control" placeholder="message" rows="4"><?php echo $message;?></textarea>
                        <p class="comments"><?php echo $messageError; ?></p>
                    </div>
                        <div class="col-md-12">
                            <p class="blue"><strong>* Ces informations sont requises</strong></p>
                        </div>
                        <diV class="col-md-12">
                            <input type="submit" class="button1" value="Envoyer"/>
                        </diV>  
                 </div>
                 <p class="thank-you" style="display:<?php if($isSucces) echo 'block'; else echo ' none';?>">  Votre message a bien ete envoye. Merci de m'avoir contacte.</p>
                </form>
            </div>
         </div>
    </div>  
             
    </body>
</html>