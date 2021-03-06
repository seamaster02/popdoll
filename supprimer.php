<!DOCTYPE html>
<html>
	<head>

		<title>Supprimer une PopDoll</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<link rel="stylesheet" href="./style.css" />
		<link rel="shortcut icon" href="fond/popLogo.png" />

	</head>

<header>

    	<img id='banniere' src="fond/bannierePetite.jpg" alt="Pop" title="Pop Dolls" />

	 <nav>
	    <ul>
	        <li><a href="./index.php">Accueil</a></li>
	        <li><a href="#Gestion">Gestion</a>
	            <ul>
	                <li><a href="./creer.php">Créer</a></li>
	                <li><a href="./modifier.php">Modifier</a></li>
	                <li><a href="./supprimer.php">Supprimer</a></li>
	            </ul>
	        </li>
	    </ul>	   
	</nav>

</header>

	<body>
    <table>
      <tr>
        <th class='tab'>ID</th>
        <th class='tab'>TITRE</th>
        <th class='tab'>CATEGORIE</th>
        <th class='tab'>DESCRIPTION</th>
        <th class='tab'>DETAILS</th>
        <th class='tab'>EDITER</th>
      </tr>

<?php

    $path_txt = "./txt";
    $path_img = "./img";
    $tableau = array();

	if ($dir = opendir($path_txt))
	{
		while ($entry = readdir($dir))
		{
			if ($entry != "." && $entry != "..")
			{
				$path = $path_txt."/".$entry;
				$file = fopen($path, "r");

				while (!feof($file))
				{
					$LigneDeTexte = fgets($file);
					$parts = explode(":", $LigneDeTexte);
					$tableau[$parts[0]] = $parts[1];
				}

				fclose($file);
				echo"<tr>";

				foreach ($tableau as $key => $value)
				{
					echo"<td>".$value."</td>";
				}

				$confirmation = "return confirm(\"Voulez-vous supprimer ". trim($tableau['TITRE']) ." de votre catalogue ?\")";

				echo "<td><form class='clicForm' action='./fiche.php' method='POST'>

				<button class='boutonSuppr' type='submit' name='".htmlentities(trim($tableau["ID"]))."'>
				  <img src='".$path_img."/".htmlentities(trim($tableau["ID"])).".jpg' alt='".trim($tableau["TITRE"])."' title='".trim($tableau["TITRE"])."' height='50' align='center' border='2' >
				</button>

				</form></td>

				<td id='tdsuppr'>
					<form id='suppr' action='' method=POST> 
						<input class='boutonSuppr' type='submit' onclick='".$confirmation."' name='". htmlentities(trim($tableau['ID'])) . "' value='Supprimer !'>
					</form>
				</td>";
				echo "</tr>";

				$tab_id = trim($tableau['ID']);

				if (isset($_POST["$tab_id"]))
				{
					unlink($path_txt."/".$tab_id.".txt");
					unlink($path_img."/".$tab_id.".jpg");

					echo '<script type="text/javascript">
						document.location.href="./supprimer.php";
					</script>';
				}
			}
		}
		closedir($dir);
	}
?>

    </table>
  </body>
</html>
