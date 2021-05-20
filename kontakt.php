<?php
include('./head.php');
?>
<link rel="stylesheet" href="/src/css/kontakt.css">
</head>

<?php
include('./header.php');
?>



<?php
if (!empty($_POST["send"])) {
  $name = $_POST["fname"];
  $email = $_POST["femail"];
  $content = $_POST["fmsg"];
  $subject = "Kontaktaufnahme durch Formular";

  $toEmail = "info@btv-hdh.de";
  $mailHeaders = "From: " . $name . "<" . $email . ">\r\n" . "MIME-Version: 1.0\r\n" . "Content-Type: text/plain; charset=utf-8";
  if (mail($toEmail, $subject, $content, $mailHeaders)) { //throws error because there is no mailserver, should work when there is
    $message = "Email wurde versendet.";
    $type = "success";
  } else {
    $message = "Email konnte nicht versendet werden.";
    $type = "fail";
  }
}
?>

<main>
  <div id="maindiv">
    <h2>Kontakt</h2><br />

    <p><b>Kontaktzeiten:</b><br />
      Montag bis Donnerstag<br />
      Von 8.00 bis 11.30 Uhr<br />
      Oder nach Vereinbarung<br />
    </p>

    <div style='height:300px;width:100%;'>
      <iframe width="" height="300" src=https://maps.google.de/maps?hl=de&q=%20%20Felsenstr.+36%20Heidenheim&t=&z=16&ie=utf8&iwloc=b&output=embed frameborder="0" scrolling="no" marginheight="0" marginwidth="0" style='height:300px;width:100%;'></iframe>
    </div>

    <p><br />
      <b>Postanschrift:</b><br />
      Betreuungsverein Heidenheim e.V.<br />
      c/o Landratsamt Heidenheim<br />
      Felsenstr. 36<br />
      89518 Heidenheim<br />
    </p>

    <div style='height:300px;width:100%;'>
      <iframe width="" height="300" src=https://maps.google.de/maps?hl=de&q=%20%20Bergstr.+36%20Heidenheim&t=&z=16&ie=utf8&iwloc=b&output=embed frameborder="0" scrolling="no" marginheight="0" marginwidth="0" style='height:300px;width:100%;'></iframe>
    </div>

    <p><br />
      <b>Geschäftsstelle:</b><br />
      Bergstr. 36, 1. OG<br />
      (Eingang Adlerstr.)<br />
      89518 Heidenheim<br />
    </p>

    <h2>Kontaktformular</h2><br />

    <form enctype="multipart/form-data" method="post">
      <div class="mb-3">
        <div><label class="form-label" for="fname">Name*:</label></div>
        <div><input class="form-control" id="fname" name="fname" type="text" required></div>
      </div>
      <div class="mb-3">
        <div><label class="form-label" for="femail">Email*:</label></div>
        <div><input class="form-control" id="femail" name="femail" type="email" required></div>
      </div>
      <div class="mb-3">
        <div><label class="form-label" for="ftel">Telefonnummer:</label></div>
        <div><input class="form-control" id="ftel" name="ftel" pattern="^([+](\d{1,3})\s?)?((\(\d{3,5}\)|\d{3,5})(\s)?)\d{3,8}$" type="tel"></div>
      </div>
      <div class="mb-3">
        <div><label class="form-label" for="fmsg">Nachricht*:</label></div>
        <div><textarea class="form-control" id="fmsg" name="fmsg" autocomplete="on" required></textarea></div>
      </div>

      <!--div class="g-recaptcha" data-sitekey="WEBSITEKEYHERE" data-theme="light" data-size="normal" data-image="image"></div>
      <script src="https://www.google.com/recaptcha/api.js" async defer></script-->
      <!-- needs to be setup, doesnt make sense for testing, alternate sources for captchas are possible ofc -->
      <div><input type="checkbox" value=required> Ich stimme zu, dass meine Angaben aus dem Kontaktformular zur Beantwortung meiner Anfrage erhoben und verarbeitet werden. Detaillierte Informationen zum Umgang mit Nutzerdaten finden Sie in unserer <a href="datenschutz">Datenschutzerklärung</a></div>
      <div><input type="submit" class="btn btn-primary" name="send" value="Abschicken" /></div>

      <div id="statusMessage">
        <?php if (!empty($message)) { ?>
          <p class='<?php echo $type; ?>Message'><?php echo $message; ?></p>
        <?php } ?>
      </div>
    </form>
  </div>
</main>


<?php
include('./footer.php');
?>