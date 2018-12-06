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

                <li><a href="#Liste">Liste</a>
                    <ul>
                        <li><a href="#Recherche">Recherche</a></li>
                        <li><a href="#Catégorie">Catégorie</a></li>
                    </ul>
                </li>
                <li><a href="#Gestion">Gestion</a>
                    <ul>
                        <li><a href="./creer.php">Créer</a></li>
                        <li><a href="./edit.php">Modifier</a></li>
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
        <th class='tab'>IMAGE</th>
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
            
            echo "<td>
                  <form action='./file.php' method='POST'>
                  <button type='submit' name='".trim($tableau["ID"])."'>
                  <img src='".$path_img."/".trim($tableau["ID"]).".jpg' height='50' align='center' 
                  border='2' ></button></form></td>";
          echo "</tr>";
          

        }
        
      }
      
      closedir($dir);
    }
    
  ?>

        </table>
 </body>
</html>
