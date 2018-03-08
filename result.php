<?php
  $paragraph = $_POST["input_paragraph"];
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
  //print_r($resultData);
  
  //echo $resultData['status'];
  
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Opinion vs. Fact</title>
        
        <link href="main.css" rel="stylesheet">
    </head>
    <body>
        <div id="container">
          <div id="header">
            <h2 class="header_left">OPINION OR FACT</h2>
            <a href="index.html"><button class="header_right">NEW SEARCH</button></a>
          </div>
          
          <h1 id="result_title"><?=$paragraph_title?></h1>
          <div id="result">
            <div class="result_left">
              <div id="graph"></div>
              <div id="label"><h2>OPINION</h2></div>
            </div>
            <div class="result_right">
              <table>
                <tr>
                  <th>Key Words</th>
                  <th>Frequency</th>
                </tr>
                <tr>
                  <td>test</td>
                  <td>1</td>
                </tr>
                <tr>
                  <td>Lois</td>
                  <td>2</td>
                </tr>
                <tr>
                  <td>Joe</td>
                  <td>3</td>
                </tr>
                <tr>
                  <td>Cleveland</td>
                  <td>4</td>
                </tr>
                <tr>
                  <td>Cleveland</td>
                  <td>5</td>
                </tr>
                <tr>
                  <td>Joe</td>
                  <td>3</td>
                </tr>
                <tr>
                  <td>Joe</td>
                  <td>3</td>
                </tr>
                <tr>
                  <td>Joe</td>
                  <td>3</td>
                </tr>
              </table>
            </div>
          </div>
        </div>
        <div id="footer">
            <p class="left">CSCI 183 Winter 2018</p>
            <p class="right" id="copyright">Copyright &copy; Caroline Lionosari, Yueqi Su, Daniel Zhang</p>
        </div>
    </body>

    <script type="text/javascript" src="node_modules/progressbar.js/dist/progressbar.js"></script>
    <script type="text/javascript" src="graph.js"></script>
</html>