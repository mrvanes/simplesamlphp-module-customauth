<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>customauth login page</title>
  </head>
  <body>
    <h1>CustomAuth login page</h1>
    <form method="post" action="?">
      <p>
        Choose User profile:
      <p>
<?php
    foreach ($this->data['users'] as $user => $values) {
        echo "<input type=radio name=username value='$user'> " . $values['name'] . "<br>\n";
    }

?>
      <input type="hidden" name="ReturnTo" value="<?= htmlspecialchars($this->data['returnTo']) ?>">
      <p><input type="submit" value="Log in"></p>
    </form>
    <div id='output'>

    </div>
  </body>
</html>
