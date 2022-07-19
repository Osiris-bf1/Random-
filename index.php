<?php

    $firstname = $name = $email = $phone = $message = "";
    $firstnameError = $nameError = $emailError = $phoneError = $messageError = "";
    $isSuccess = false;
    $emailTo = "waongoosiris4@gmail.com";


    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $firstname =  verifyInput($_POST["firstname"]);
        $name =  verifyInput($_POST["name"]);
        $email =  verifyInput($_POST["email"]);
        $phone =  verifyInput($_POST["phone"]);
        $message =  verifyInput($_POST["message"]);
        $isSuccess = true;
        $emailText = "";

        if(empty($firstname))//Vérification des entrées traduction du code -> si $var est vide alors envoyé le message d'erreur qui suit
        {
            $firstnameError = "Je veux connaitre votre prénom !";
            $isSuccess = false;
        }
        else
            $emailText .= "Prénom: $firstname\n";
        if(empty($name))
        {
            $nameError = "Je veux connaitre votre nom !";
            $isSuccess = false;
        }
        else
            $emailText .= "Nom: $name\n";
        if(empty($message))
        {
            $messageError = "Quel est ton message";
            $isSuccess = false;
        }
        else
            $emailText .= "Message: $message\n";
        if(!isEmail($email))
        {
            $emailError = "T'essaies de me rouler ? c'est pas un email ça";
            $isSuccess = false;
        }
        else
            $emailText .= "Email: $email\n";
        if(!isPhone($phone))
        {
            $phoneError = " Que des chiffres et des espaces stp ";
            $isSuccess = false;
        }
        else
            $emailText .= "Phone: $phone\n";
        if($isSuccess)
        {
            $headers ="From: $firstname $name <$email>\r\nReply-to: $email";
            mail($emailTo, "Un message de votre site", $emailText , $headers);//Envoie de mail en local
            $firstname = $name = $email = $phone = $message = "";
        }



    }

    function isPhone($var)//Vérifie si le numéro entré par l'utilsateur est valid
    {
        return preg_match("/^[0-9 ]*$/", $var);
    }

    function isEmail($var)//vérifi si l'email saisi est valide PS: il n'accepte pas que ce champ soit vide
    {
        return filter_var($var, FILTER_VALIDATE_EMAIL);
    }

    function verifyInput($var)//Fonction qui permet de vérifier les saisies des utilisateurs dans le formulaire
    {
        $var = trim($var);//permet d'enlever les espaces et les retours à la lignes entrées par les utilisateurs
        $var = stripslashes($var);//permet d'enlever tous les anti slash
        $var = htmlspecialchars($var);
        return $var;
    }

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Contactez-moi</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script type="text/javascript" src="https://gc.kis.v2.scr.kaspersky-labs.com/FD126C42-EBFA-4E12-B309-BB3FDD723AC1/main.js?attr=zs6e21RcQYFxmLD7MEC07KlsUFl3B9MDwUrl31V7QgOLxoGQpa5DC2m9YgXqJLgmcEeV16WbZjl8yid7atjSAP1fSPT9EFqVs1Wq3Xti2bsD78ho2mfmlDuRnm88OwlNeZw0pw1t9ZImuK2rN1fmJW5Jbs-lWeChF58tMAthmvAU4N9xLSXgeqU_y64sgojKcI3NqYM1mPMwxjXDnx9110Z0LWfw8WbWnADXS1y9Hc2pukVYMt0mIBH4WW0FtZu0PL0p54A6Ue50Y65mVUUeQ0DBSyp7hg-ojmcU_09w-po0rlxCQEx0Kq7ZJCacYTmW9l0UPa29VEm5dMzLRscUVh6U7pb0B8IQL7fXA2V8IbBn-fqASzSBfxBE5nkdTB_8fYa4Je_28VzweNtKUCER7s1Iq-uXS1W_nZaHCYHVJNUrvOVhlY7VzCUPhErnbWx4aYeWKdbvvO3yHw60gqfy8gJEsQOUHKRr5gPkOSu2O8L1vbk6e95EkephYpkPyQv3C08bAWQcvYOY6vnJr8sfHRfMam-kRKJN2upDgVorNQXQNWQ--Eu8gyFKDj-l0Y-lcpVcj1HtFXDzkpLdNXBPd7hL3bBcuU5ZVkjCSKf38XbVMA3FWXhp_bbxia7If9mY-OjuaDGEwIewcPXl9QxbcP0XQmjpT30rzqpgThA1HzO-Ul8wLjihMj1t1l3m4p4mqh2LVXA0pPwrM5pzlkfEnyo1A-NihiG0ASQ4v7yNdq00S4ooy56NSkbiOP7WuK7bU7UkazSWeIP6kY4GIIa4Tg" charset="UTF-8"></script><link rel="stylesheet" crossorigin="anonymous" href="https://gc.kis.v2.scr.kaspersky-labs.com/E3E8934C-235A-4B0E-825A-35A08381A191/abn/main.css?attr=aHR0cHM6Ly9hdHQtYy51ZGVteWNkbi5jb20vMjAyMS0xMi0xNF8xNS00MC0zMC00ZmRiZTE3MWVmMDcwYjE0NjM2MzYzNzc4NmNiNTdiNS9vcmlnaW5hbC5odG1sP3Jlc3BvbnNlLWNvbnRlbnQtZGlzcG9zaXRpb249YXR0YWNobWVudCUzYiUyMGZpbGVuYW1lJTNkaW5kZXguaHRtbCZFeHBpcmVzPTE2NTc2ODA0MDImU2lnbmF0dXJlPVJMZmJ3eXJPclRPWEd-QjY5WDV1dHhBT2hkcFJOQVpVQW1GdmVHbk53anNuNDhSQUNGQWFad1ZoMVotZE9IeTRCa0tieTdrZ2xiYVFmfjI0aDhBamxmZFVnUHc4Vmd1ak9WT2x4WlhKdHNQSkZIdGRvUVY4STJ6V3YzNlpDNzk2MzEtcVQ4M2FWRzZ4U0lYbjFLQUlqUGdPZVNmcXdXZ0FIYldRMTdRYWk4U01IMHFtQmF4R0ZQV3MyUWhYNVBXUVBndnZoeklEVGVBdnVNZFVCUDRnS1M5VHNGVENMcGZXVkNxWTlOajM2Sngwc21PRi10emxlN3ZXdTJPLWdafm5oak15QUh6MERCUUc4TGpOZ2VGd0UyT2NPOURQS1UwdVNFOXlUTFFWNGt6Tm10aHRPT3VIYmx2M0o5WWtyRUJpY2lCeERPaFpmTm1YaThJcjFHeEFPd19fJktleS1QYWlyLUlkPUFQS0FJVEpWNzdXUzVaVDcyNjJB"/><script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"></script>
        <link href='http://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
        <div class="container">
            <div class="divider"></div>
            <div class="heading">
                <h2>Contactez-moi</h2>
            </div>
            <form id="contact-form" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" role="form">
                <div class="row">
                    <div class="col-lg-6">
                        <label for="firstname" class="form-label">Prénom <span class="blue">*</span></label>
                        <input id="firstname" type="text" name="firstname" class="form-control" placeholder="Votre prénom" value="<?php echo $firstname; ?>">
                        
                        <p class="comments"><?php echo $firstnameError; ?></p>
                    </div>
                    <div class="col-lg-6">
                        <label for="name" class="form-label">Nom <span class="blue">*</span></label>
                        <input id="name" type="text" name="name" class="form-control" placeholder="Votre Nom" value="<?php echo $name; ?>">
                        <p class="comments"><?php echo $nameError; ?></p>
                    </div>
                    <div class="col-lg-6">
                        <label for="email" class="form-label">Email <span class="blue">*</span></label>
                        <input id="email" type="email" name="email" class="form-control" placeholder="Votre Email" value="<?php echo $email; ?>">
                        <p class="comments"><?php echo $emailError; ?></p>
                    </div>
                    <div class="col-lg-6">
                        <label for="phone" class="form-label">Téléphone</label>
                        <input id="phone" type="tel" name="phone" class="form-control" placeholder="Votre Téléphone" value="<?php echo $phone; ?>">
                        <p class="comments"><?php echo $phoneError; ?></p>
                    </div>
                    <div>
                        <label for="message" class="form-label">Message <span class="blue">*</span></label>
                        <textarea id="message" name="message" class="form-control" placeholder="Votre Message" rows="4" <?php echo $message; ?>></textarea>
                        <p class="comments"><?php echo $messageError; ?></p>
                    </div>
                    <div>
                        <p class="blue"><strong>* Ces informations sont requises.</strong></p>
                    </div>
                    <div>
                        <input type="submit" class="button1" value="Envoyer">
                    </div>    
                </div>
                <p class="thank-you" style="display:<?php if($isSuccess){ echo 'block';}else echo 'none'; ?>">Votre message a bien été envoyé. Merci de m'avoir contacté :)</p>
            </form>
        </div>
    </body>
</html>