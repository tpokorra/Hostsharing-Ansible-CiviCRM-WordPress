<?php

function Get($index, $defaultValue) {
  return isset($_GET[$index]) ? $_GET[$index] : $defaultValue;
}

# check SaasActivationPassword
if (Get('SaasActivationPassword', 'invalid') != '{{SaasActivationPassword}}') {
  echo '{"success": false, "msg": "invalid SaasActivationPassword"}';
  exit(1);
}

try {
  $USER_EMAIL_ADDRESS = Get('UserEmailAddress', '');
  if (empty($USER_EMAIL_ADDRESS)) {
    echo '{"success": false, "msg": "missing email address"}';
    exit(1);
  }

  $pdo = new PDO('mysql:host=localhost;dbname={{pac}}_{{user}}', '{{pac}}_{{user}}', '{{password}}');
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $sql = "update wp_usermeta set meta_value=REPLACE(meta_value,'disabled','') where meta_key='wp_capabilities' and user_id=1 and meta_value LIKE 'disabled%'";
  $statement = $pdo->prepare($sql);
  $statement->execute();

  $sql = "update wp_users set user_email=:email where ID = 1";
  $statement = $pdo->prepare($sql);
  $statement->execute(array(':email' => $USER_EMAIL_ADDRESS));
}
catch (Exception $e) {
    // echo 'Exception caught: ',  $e->getMessage(), "\n";
    echo '{"success": false, "msg": "error happened"}';
    exit(1);
}

echo '{"success": true}';
?>
