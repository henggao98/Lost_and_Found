<?php 
if(!session_id())
  session_start();

require_once "db_connection.php";
require_once "vendor/autoload.php";

$fb = new Facebook\Facebook([
  'app_id' => '325483621434882', // Replace {app-id} with your app id
  'app_secret' => '3e92d047ce78104df483c8dd63c104a4',
  'default_graph_version' => 'v2.2',
  ]);

$helper = $fb->getRedirectLoginHelper();

try {
  $accessToken = $helper->getAccessToken();
} catch(Facebook\Exceptions\FacebookResponseException $e) {
  // When Graph returns an error
  echo 'Graph returned an error: ' . $e->getMessage();
  exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
  // When validation fails or other local issues
  echo 'Facebook SDK returned an error: ' . $e->getMessage();
  exit;
}

if (! isset($accessToken)) {
  if ($helper->getError()) {
    header('HTTP/1.0 401 Unauthorized');
    echo "Error: " . $helper->getError() . "\n";
    echo "Error Code: " . $helper->getErrorCode() . "\n";
    echo "Error Reason: " . $helper->getErrorReason() . "\n";
    echo "Error Description: " . $helper->getErrorDescription() . "\n";
  } else {
    header('HTTP/1.0 400 Bad Request');
    echo 'Bad request';
  }
  exit;
}

// Logged in
echo '<h3>Access Token</h3>';
var_dump($accessToken->getValue());

// The OAuth 2.0 client handler helps us manage access tokens
$oAuth2Client = $fb->getOAuth2Client();

// Get the access token metadata from /debug_token
$tokenMetadata = $oAuth2Client->debugToken($accessToken);
echo '<h3>Metadata</h3>';
var_dump($tokenMetadata);

// Validation (these will throw FacebookSDKException's when they fail)
$tokenMetadata->validateAppId('325483621434882'); // Replace {app-id} with your app id
// If you know the user ID this access token belongs to, you can validate it here
//$tokenMetadata->validateUserId('123');
$tokenMetadata->validateExpiration();

if (! $accessToken->isLongLived()) {
  // Exchanges a short-lived access token for a long-lived one
  try {
    $accessToken = $oAuth2Client->getLongLivedAccessToken($accessToken);
  } catch (Facebook\Exceptions\FacebookSDKException $e) {
    echo "<p>Error getting long-lived access token: " . $e->getMessage() . "</p>\n\n";
    exit;
  }

  echo '<h3>Long-lived</h3>';
  var_dump($accessToken->getValue());
}

$_SESSION['fb_access_token'] = (string) $accessToken;

$fb->setDefaultAccessToken($_SESSION['fb_access_token']);
$response = $fb->get('/me?locale=en_US&fields=name,email');
$userNode = $response->getGraphUser();
/*
var_dump(
    $userNode->getField('email'), $userNode['email']
);
*/
$fbEmail = $userNode['email'];
$fbName = $userNode['name'];

$sql = "SELECT * FROM Users WHERE Email = '$fbEmail' ";
$result = $conn->query($sql);

$isInDB = false;
if($result->num_rows > 0)
{
  $row = $result->fetch_assoc();
  $isInDB = true;
  $_SESSION["loggedIn"] = 1;
  $_SESSION["id"] = $row["ID"];
  $_SESSION["email"] = $fbEmail;
  $_SESSION["name"] = $fbName;
}

if(!$isInDB)
{
  $insertQuery = "INSERT INTO Users (Name, Email)
                VALUES ('$fbName', '$fbEmail')";
  if($conn->query($insertQuery) === TRUE)
  {
    $_SESSION["loggedIn"] = 1;
    $_SESSION["id"] = $conn->insert_id;
    $_SESSION["email"] = $fbEmail;
    $_SESSION["name"] = $fbName;
    echo "New record created successfully";
    
  }
  else
    echo "Error";
}
// User is logged in with a long-lived access token.
// You can redirect them to index page.
header('Location: index.php');
?>