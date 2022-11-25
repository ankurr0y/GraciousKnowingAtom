<html>
  <head>
    <title>PHP Test</title>
  </head>
  <body>
    <h1>Question 1</h1>
    1. Write a code, using listed PHP functions, with example<br>
    a. is_int()<br>
    b. is_numeric()<br>
    c. is_integer()<br><br>
    <?php
    $values = array(1,1.4,"Text", 1000, .23233232, "q");
    echo "Values given:" . join(', ', $values) . "<br><br>";
    foreach ($values as $value) {
      if (is_int($value)){
        echo $value . " is an integer <br>";
      }
      else {
        echo $value . " is not an integer <br>";
      }
      if (is_integer($value)){
        echo $value . " is an integer <br>";
      }
      else {
        echo $value . " is not an integer <br>";
      }
      if (is_numeric($value)){
        echo $value . " is numeric <br>";
      }
      else {
        echo $value . " is not numeric <br>";
      }
      echo "<br>";
    }
    ?>
    <br>
    <h1>Question 2</h1>
    2. Create a function in PHP to floor decimal numbers with any provided precision. <br>
Example: convert(2.99999,2), convert(199.99999,4)<br>
    <?php
    function convert($value, $precision){
      echo bcdiv($value, 1, $precision) . "<br>";
    }
    convert(2.99999,2); 
    convert(199.99999,4);
    ?>
    <h1>Question 3 </h1>
    
    <!--
    This script places a badge on your repl's full-browser view back to your repl's cover
    page. Try various colors for the theme: dark, light, red, orange, yellow, lime, green,
    teal, blue, blurple, magenta, pink!
    -->
    <script src="https://replit.com/public/js/replit-badge.js" theme="blue" defer></script> 
  </body>
</html>