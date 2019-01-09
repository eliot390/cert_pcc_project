<?php
  error_reporting(0);
  include('session.php');

    $sql="SELECT certuser.displayName, certuser.userID, cimtuser.cimtID, sysadmin.adminID, cimtuser.phone, sysadmin.email, resourceprovider.address
    FROM certuser
    LEFT JOIN cimtuser ON cimtuser.userID = certuser.userID
    LEFT JOIN sysadmin ON sysadmin.userID = certuser.userID
    LEFT JOIN resourceprovider ON resourceprovider.userID = certuser.userID
    WHERE certuser.userID = '$logged_in_user_id' ";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    echo "<body>
      <div id='main'>
        <div class='row'>
          <div class='col-md-12' id='logged-in'>You are now logged in</div>
        </div>
        <div id='heading' class='row'>
          <div id='title' class='col-md-6'>CIMT</div>
          <div id='user-info' class='col-md-6'>" .$row['displayName']. "<br><span style='font-size: 20px'>" . $row['phone'] . $row['email'] . $row['address'] . "</span></div>
        </div>
        <div id='main-menu' class='row'>
          <div class='col-md-12'>Main Menu</div>
          <div class='col-md-12' id='menu-options'><a href='add_resource.php'>Add Emergency Resource</a>
            <br><a href='new_incident.php'>Add Emergency Incident</a>
            <br><a href='search_resources.php'>Search Resources</a>
            <br><a href='resource_report.php'>Generate Resource Report</a>
          </div>
        </div>
        <div class='row'>
          <div class='col-md-10'></div>
          <div class='col-sm-1'>
            <a class='btn btn-primary' href='logout.php' role='button'>Log Out</a>
          </div>
        </div>
      </div>
    </body>"
?>

<!DOCTYPE>
<html>

<head>
  <meta charset="utf-8">
  <title>CIMT Main Menu</title>
  <link rel="stylesheet" href="TEVG.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>

</html>
