<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
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
        echo "<input type=radio name=username value='$user'> " . $values['displayName'] . "<br>\n";
    }
?>
      <div id=attributes></div>
      <input type="hidden" name="ReturnTo" value="<?= htmlspecialchars($this->data['returnTo']) ?>">
    <h3>Released attributes</h3>
      <div id='output'></div>
      <p><input type="submit" value="Log in"></p>
    </form>
  </body>

  <script>
    var users = [];
    var keys = [];
    var user = '';
<?php
    foreach ($this->data['users'] as $user => $values) {
        echo "users['$user'] = [];\n";
        foreach ($values as $key => $value) {
            echo "users['$user']['$key'] = '$value';\n";
            echo "keys['$key'] = true;";
        }
    }

?>
    function update() {
        var html = "";
        for (let key in users[user]) {
            if (keys[key]) {
                html += key + ": " + users[user][key] + "<br>\n";
            }
        }
        $('#output').html(html);

    };
    $('input[type=radio][name=username]').change(function() {
        var attributes = "";
        user = this.value;
        for (let key in users[user]) {
            attribute = users[user][key];
            attributes += "<input id=chkbx_" + key + " type=checkbox name=keys[" + key + "] " + (keys[key]?'checked':'') + ">" + key + "<br>\n";
        }
        $('#attributes').html(attributes);
        $('input[id^=chkbx_]').change(function() {
            var key = this.name.slice(5,-1);
            keys[key] = this.checked;
        });
        update();
    });

    //$('#attributes').change(update);
    $('#attributes').change(function() {
        update();
    });

  </script>
</html>
