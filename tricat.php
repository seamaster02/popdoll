<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="./style.css" />
    <link rel="shortcut icon" href="fond/popLogo.png" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pop Dolls</title>
  </head>
 <body>

    <header>
            <img id='banniere' src="fond/banniere.jpg" alt="Pop" title="Pop Dolls" />
        <nav>
          <ul>

                <li><a href="./index.php">Accueil</a></li>

            <li><a href="#Liste">Trier</a>
                <ul>
                    <li><a href="#Recherche">Par Titres</a></li>
                    <li><a href="tricat.php"><form action="tricat.php" method="post"><input type="submit" name=""><?php echo $marvel;?></form></a></li>
                    </ul>
                </li>
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



    <table>
      <tr>
        <th class='tab'>ID</th>
        <th class='tab'>TITRE</th>
        <th class='tab'>CATEGORIE</th>
        <th class='tab'>DESCRIPTION</th>
        <th class='tab'>DETAILS</th>
      </tr>

  <?php
    $marvel="Marvel";
    $path_txt = "./txt";
    $path_img = "./img";
    $path_img1="./img1";
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
          if (trim($tableau["CAT"])==$marvel){

          echo"<tr>";
          foreach ($tableau as $key => $value)
            {
              echo"<td>".$value."</td>";

            }

          echo "<td><form class='clicForm' action='./fiche.php' method='POST'>

                    <button class='boutonSuppr' type='submit' name='".trim($tableau["ID"])."'>
                      <img class='imgpop' src='".$path_img."/".trim($tableau["ID"]).".jpg' height='50' align='center' border='2' >
                    </button>

                    </form></td>";

          echo "</tr>";
        }
        }

      }

      closedir($dir);
    }

  ?>

        </table>
 </body>
</html>
