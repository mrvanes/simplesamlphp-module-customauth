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
    <p><b>Choose User profile</b><p>
<?php
    foreach ($this->data['users'] as $user => $values) {
        echo "<input type=radio name=username value='$user'> " . $values['displayName'] . "<br>\n";
    }
?>
    <p><b>Choose attributes</b></p>
      <div style="float: left" id="attributes"></div>
      <div  id="explanation"></div><br style="clear: both" />
    <p><b>Released attributes</b></p>
      <div id="output"></div>
    <input type="hidden" name="ReturnTo" value="<?= htmlspecialchars($this->data['returnTo']) ?>">
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
                html += key + ": " + users[user][key] + "<br />\n";
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
        };
        $('#attributes').html(attributes);
        $('#explanation').html('');
        $('input[id^=chkbx_]').change(function() {
            var key = this.name.slice(5,-1);
            keys[key] = this.checked;
            if (this.checked) $('#explanation').html('Ah! You enabled ' + key + '!<br />\nIt\'s allways good to enable ' + key + ', because it\'s good you know!');
            else $('#explanation').html('Never disable ' + key + '! You should leave it there.<br />No good will come from disabling ' + key + '!');
        });
        update();
    });

    //$('#attributes').change(update);
    $('#attributes').change(function() {
        update();
    });

  </script>
</html>
