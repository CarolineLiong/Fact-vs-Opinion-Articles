<?php
  $paragraph = $_POST["input_paragraph"];
  echo $paragraph;
  $paragraph_title = $paragraph;
  
  if (strlen($paragraph) > 35){
    $paragraph_title = substr($paragraph, 0, 35);
    $paragraph_title .= "...";
  }
  
  // Execute the python script with the JSON data
  $result = shell_exec('python algorithm.py ' . escapeshellarg(json_encode($paragraph)));
  
  // Decode the result
  $resultData = json_decode($result, true);
  
  // This will contain: array('data': data, 'status' => 'Yes!')
  print_r($resultData);
  
  echo $resultData['status'];
  
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Opinion vs. Fact</title>
        
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">

        <link href="main.css" rel="stylesheet">
        <link href="graph.css" rel="stylesheet">
                
    </head>
    <body>
        <div id="container">
          <div id="header">
            <h2 class="header_left">OPINION OR NEWS</h2>
            <a href="index.html"><button class="header_right">NEW SEARCH</button></a>
          </div>
          
          <h1 id="result_title"><?=$paragraph_title?></h1>
          <div id="result">
            <div class="left" id="graph">
              <div class="progress blue">
                  <span class="progress-left">
                      <span class="progress-bar"></span>
                  </span>
                  <span class="progress-right">
                      <span class="progress-bar"></span>
                  </span>
                  <div class="progress-value">90%</div>
              </div>
            </div>
            <div class="right">
              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque ac ligula vel magna laoreet varius sit amet quis eros. Maecenas condimentum accumsan fringilla. Pellentesque tempus, nisl vitae molestie convallis, leo dui vehicula dolor, et gravida mi urna eget mauris. Aliquam ut massa vitae nulla hendrerit luctus sed in odio. </p>
            </div>
          </div>
        </div>
        <div id="footer">
            <p class="left">CSCI 183 Winter 2018</p>
            <p class="right" id="copyright">Copyright &copy; Caroline Lionosari, Yueqi Su, Daniel Zhang</p>
        </div>
    </body>
    
    
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
</html>