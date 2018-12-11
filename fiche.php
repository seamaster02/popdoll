<?php

  $context = [
    'site' => 'PopDolls !',
    'banniere' => 'small'
  ];

  // Load Doll class
  require_once('./src/models/doll.php');

  if ($_GET AND $_GET['id']) $reqID = $_GET['id'];

  if (isset($reqID) AND file_exists('./txt/' . $reqID . '.txt')) {
    $doll = new Doll(yaml_parse_file('./txt/' . $reqID . '.txt'));

    // Load Top of Page
    require_once('./src/templates/html_header.html');

    // Render Resource
    $doll->render(1);

  } else {

    // Return HTTP 404 Not Found
    http_response_code(404);

    // Load Top of Page
    require_once('./src/templates/html_header.html');
    ?>
    <section>
      <header>
        <h2>Introuvable</h2>
        <h3>Erreur 404</h3>
      </header>
      <p>La fiche demandée n'existe pas.</p>
    </section>
    <?php
  }

  // Load Bottom of Page
  require_once('./src/templates/html_header.html');
