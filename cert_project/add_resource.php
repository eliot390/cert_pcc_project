<?php
  include('session.php');

  // check for submit
  if(isset($_POST['submit'])){
    $resource_name = mysqli_real_escape_string($conn, $_POST['resource_name']);
    $userID = $logged_in_user_id;
    $primary_func = mysqli_real_escape_string($conn, $_POST['primary_func']);
    $secondary_func = mysqli_real_escape_string($conn, $_POST['secondary_func']);
    if($secondary_func == 'Secondary Function')
    {
      $secondary_func = 'NULL';
    }
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $distance = mysqli_real_escape_string($conn, $_POST['distance']);
    $cost = mysqli_real_escape_string($conn, $_POST['cost']);
    $cost_unit = mysqli_real_escape_string($conn, $_POST['cost_unit']);

    $query = "INSERT INTO resources(resource_name, userID, primary_func, secondary_func, description, distance, cost, cost_unit)
    VALUES('$resource_name', $userID, $primary_func, $secondary_func, '$description', '$distance', '$cost', '$cost_unit')";

    if(mysqli_query($conn, $query)){
      header('Location: index.php');
    }
    else
    {
      echo 'ERROR: ' . mysqli_error($conn);
    }
  }

  echo "<body>
    <div id='main'>
      <div class='row' id='logged-in'>
        <div class='col-md-11' id='ARtitle'>New Resource Information</div>
      </div>
      <div class='row'>
        <div id='tableHeading1' class='col-md-12'>Resource ID<br><span id=subtext>(assigned on save)</span></div>
      </div>
      <div class='row'>
        <div id='tableHeading' class='col-md-4'>Owner</div>
        <div class='col-md-4' style='font-size: 20px;	font-weight: 500;'>" . $row['displayName'] . "</div>
      </div>
      <form action='add_resource.php' method='POST'>
        <div class='row'>
          <div id='tableHeading' class='col-md-4'>Resource Name<span id=required>*</span><br><span id=subtext>(required)</span></div>
          <div class='col-md-6'><input type='text' class='form-control' name='resource_name' type='text' value=''></div>
        </div>
        <div class='row'>
          <div id='tableHeading' class='col-md-4'>Primary Function</div>
            <select name='primary_func' id='primary_func' style='margin-left: 15px; height:40px' class='btn btn-primary'>
              <option>Primary Function</option>
              <option value='1'>Transportation</option>
              <option value='2'>Communications</option>
              <option value='3'>Engineering</option>
              <option value='4'>Search and Rescue</option>
              <option value='5'>Education</option>
              <option value='6'>Energy</option>
              <option value='7'>Firefighting</option>
              <option value='8'>Human Services</option>
            </select>
        </div>
        <div class='row'>
          <div id='tableHeading' class='col-md-4'>Secondary Function</div>
            <select name='secondary_func' id='secondary_func' style='margin-left: 15px; height:40px' class='btn btn-primary'>
              <option>Secondary Function</option>
              <option value='1'>Transportation</option>
              <option value='2'>Communications</option>
              <option value='3'>Engineering</option>
              <option value='4'>Search and Rescue</option>
              <option value='5'>Education</option>
              <option value='6'>Energy</option>
              <option value='7'>Firefighting</option>
              <option value='8'>Human Services</option>
            </select>
        </div>
        <div class='row'>
          <div id='tableHeading' class='col-md-4'>Description<br><span id=subtext>(optional)</span></div>
          <div class='col-md-6'><input type='text' name='description' class='form-control' id='exampleInputName2' placeholder='Description'></div>
        </div>
        <div class='row'>
          <div id='tableHeading' class='col-md-4'>Capabilities<br><span id=subtext>(optional)</span></div>
          <div class='col-md-6'><input type='text' class='form-control' id='capabilities' placeholder='Capabilities'></div>
          <div><input type='button' class='btn btn-primary' id='button1' value='Add' onclick='add_element_to_array();''></input></div>
        </div>
        <div class='row'>
          <div id='tableHeading' class='col-md-4'>Distance from PCC<br><span id=subtext>(optional)</span></div>
          <div class='col-md-4'><input type='text' name='distance' class='form-control' id='exampleInputName2' placeholder='Distance'></div>
        </div>
        <div class='row'>
          <div id='tableHeading' class='col-md-4'>Cost<span id=required>*</span><br><span id=subtext>(USD)</span></div>
          <div class='col-md-4'><input type='text' name='cost' class='form-control' id='exampleInputName2' placeholder='$0.00'></div> per
          <div class='col-md-2'><input type='text' name='cost_unit' class='form-control' id='exampleInputName2' placeholder='Unit'></div>
        </div>
        <div class='row' id='cancelSave'>
          <div>
            <a class='btn btn-primary' href='index.php' role='button'>Main Menu</a>
            <input name='reset' type='reset' value='Cancel' class='reset_button btn btn-default' />
            <button class='btn btn-primary submit' name='submit' type='submit'>Save</button>
          </div>
        </div>
      </form>
    </div>
    <script src='https://code.jquery.com/jquery-3.3.1.slim.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js'></script>
    <script src='https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js'></script>
  </body>"
?>


<!DOCTYPE>
<html>

<head>
  <meta charset="utf-8">
  <title>Add Available Resource</title>
  <link rel="stylesheet" href="TEVG.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
</head>

<script>
var $select = $("select");
$select.on("change", function(){
  var selected = [];
  $.each($select, function(index, select) {
    if (select.value !== ""){ selected.push(select.value); }
  });
   $("option").attr("hidden", false);
   for (var index in selected) { $('option[value="'+selected[index]+'"]').attr("hidden", true); }
});
</script>

<script>
var x = 0;
var arrayData = Array();

function add_element_to_array()
{
 arrayData[x] = document.getElementById("capabilities").value;
 //alert("Element: " + array[x] + " Added at index " + x);
 alert("\"" + arrayData[x] + "\"" + " added to capabilities");
 x++;
 document.getElementById("capabilities").value = "";
}
</script>

</html>
