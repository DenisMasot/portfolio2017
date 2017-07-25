<?php
$destinataire = 'denis.masot@gmail.com';

$copie = 'yes';

$message_envoye = "Votre message nous est bien parvenu ! <a href=\"index.html\">Revenir sur la home</a>";
$message_non_envoye = "L'envoi du mail a échoué, veuillez réessayer SVP.";
$message_erreur_formulaire = "Vous devez d'abord <a href=\"index.html\">Envoyer le formulaire</a>.";
$message_formulaire_invalide = "Vérifiez que tous les champs soient bien remplis <br /> et que l'email soit sans erreur.";

if (!isset($_POST['send']))
{
	echo '
	<style>
		p{
			font-family: "raleway", sans-serif;
			font-size: 1.6rem;
			text-align:center;
			margin-top: 50px;
		}
		a{
			font-family: "raleway", sans-serif;
			font-size: 1.6rem;
			text-decoration: none;
			color:#FFF;
			display: table;
			margin-top: 20px;
			margin-left:auto;
			margin-right:auto;
			padding: 12px 15px;
			background-color: rgba(27, 68, 107,1);
			border: 1px solid rgb(27, 68, 107);;
		}
		a:hover{
			background-color: rgba(27, 68, 107,0);
			color: rgba(27, 68, 107,1);
		}
	</style>
	<p>'.$message_erreur_formulaire.'</p>'."\n";
}
else
{
	function Rec($text)
	{
		$text = htmlspecialchars(trim($text), ENT_QUOTES);
		if (1 === get_magic_quotes_gpc())
		{
			$text = stripslashes($text);
		}

		$text = nl2br($text);
		return $text;
	};


	function IsEmail($email)
	{
		$value = preg_match('/^(?:[\w\!\#\$\%\&\'\*\+\-\/\=\?\^\`\{\|\}\~]+\.)*[\w\!\#\$\%\&\'\*\+\-\/\=\?\^\`\{\|\}\~]+@(?:(?:(?:[a-zA-Z0-9_](?:[a-zA-Z0-9_\-](?!\.)){0,61}[a-zA-Z0-9_-]?\.)+[a-zA-Z0-9_](?:[a-zA-Z0-9_\-](?!$)){0,61}[a-zA-Z0-9_]?)|(?:\[(?:(?:[01]?\d{1,2}|2[0-4]\d|25[0-5])\.){3}(?:[01]?\d{1,2}|2[0-4]\d|25[0-5])\]))$/', $email);
		return (($value === 0) || ($value === false)) ? false : true;
	}

	$lastname     = (isset($_POST['lastname']))     ? Rec($_POST['lastname'])     : '';
	$firstname     = (isset($_POST['firstname']))     ? Rec($_POST['firstname'])     : '';
	$email   = (isset($_POST['email']))   ? Rec($_POST['email'])   : '';
	$object   = (isset($_POST['object']))   ? Rec($_POST['object'])   : '';
	$message = (isset($_POST['message'])) ? Rec($_POST['message']) : '';

	$email = (IsEmail($email)) ? $email : '';

	if (($lastname != '') &&($firstname != '') && ($email != '') && ($object != '') && ($message != ''))
	{
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'From:'.$firstname.' '.$lastname.' <'.$email.'>' . "\r\n" .
		'Reply-To:'.$email. "\r\n" .
		'Content-Type: text/plain; charset="utf-8"; DelSp="Yes"; format=flowed '."\r\n" .
		'Content-Disposition: inline'. "\r\n" .
		'Content-Transfer-Encoding: 7bit'." \r\n" .
		'X-Mailer:PHP/'.phpversion();

		// envoyer une copie au visiteur ?
		if ($copie == 'yes')
		{
			$cible = $destinataire.';'.$email;
		}
		else
		{
			$cible = $destinataire;
		};

		$message = str_replace("&#039;","'",$message);
		$message = str_replace("&#8217;","'",$message);
		$message = str_replace("&quot;",'"',$message);
		$message = str_replace('<br>','',$message);
		$message = str_replace('<br />','',$message);
		$message = str_replace("&lt;","<",$message);
		$message = str_replace("&gt;",">",$message);
		$message = str_replace("&amp;","&",$message);

		$num_emails = 0;
		$tmp = explode(';', $cible);
		foreach($tmp as $email_destinataire)
		{
			if (mail($email_destinataire, $object, $message, $headers))
			$num_emails++;
		}

		if ((($copie == 'yes') && ($num_emails == 2)) || (($copie == 'no') && ($num_emails == 1)))
		{
			echo '
			<style>
				p{
					font-family: "raleway", sans-serif;
					font-size: 1.6rem;
					text-align:center;
					margin-top: 50px;
				}
				a{
					font-family: "raleway", sans-serif;
					font-size: 1.6rem;
					text-decoration: none;
					color:#FFF;
					display: table;
					margin-top: 20px;
					margin-left:auto;
					margin-right:auto;
					padding: 12px 15px;
					background-color: rgba(27, 68, 107,1);
					border: 1px solid rgb(27, 68, 107);;
				}
				a:hover{
					background-color: rgba(27, 68, 107,0);
					color: rgba(27, 68, 107,1);
				}
			</style>
			<p>'.$message_envoye.'</p>';
		}
		else
		{
			echo '
			<style>
				p{
					font-family: "raleway", sans-serif;
					font-size: 1.6rem;
					text-align:center;
					margin-top: 50px;
				}
				a{
					font-family: "raleway", sans-serif;
					font-size: 1.6rem;
					text-decoration: none;
					color:#FFF;
					display: table;
					margin-top: 20px;
					margin-left:auto;
					margin-right:auto;
					padding: 12px 15px;
					background-color: rgba(27, 68, 107,1);
					border: 1px solid rgb(27, 68, 107);;
				}
				a:hover{
					background-color: rgba(27, 68, 107,0);
					color: rgba(27, 68, 107,1);
				}
			</style>
			<p>'.$message_non_envoye.'</p>';
		};
	}
	else
	{
		echo '
		<style>
		p{
			font-family: "raleway", sans-serif;
			font-size: 1.6rem;
			text-align:center;
			margin-top: 50px;
		}
		a{
			font-family: "raleway", sans-serif;
			font-size: 1.6rem;
			text-decoration: none;
			color:#FFF;
			display: table;
			margin-top: 20px;
			margin-left:auto;
			margin-right:auto;
			padding: 12px 15px;
			background-color: rgba(27, 68, 107,1);
			border: 1px solid rgb(27, 68, 107);;
		}
		a:hover{
			background-color: rgba(27, 68, 107,0);
			color: rgba(27, 68, 107,1);
		}
		</style>
		<p>'.$message_formulaire_invalide.' <a href="index.html#contact">Retour au formulaire</a></p>'."\n";
	};
};
?>
