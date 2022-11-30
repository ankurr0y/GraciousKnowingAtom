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
    3. Write a code or function to display dates in provided format?<br>
Example:
Input: 'Sep 20 2021' and '09092021'
Output: 2021-09-20 and 'Sep-09-2021'
<br>
    <?php
    $date_string = "Sep 20 2021";
    echo "Current format:" . $date_string . "<br>";
    $date=date_create($date_string);
    echo "New format:" . date_format($date, "mdY") . "<br>";
    $date_string = "2021-09-20";
    echo "Current format:" . $date_string . "<br>";
    $date=date_create($date_string);
    echo "New format:" . date_format($date, "M-d-Y") . "<br>";
    ?>
<h1>Question 4</h1>
    4. Write a code using Regex, to solve problem listed:<br>
a. Provided String: “abc_xyz@grepsr.com”<br>
b. Create an array with four values. Example: [‘abc’,’xyz’,’grepsr’,’com’]<br>
    <?php 
    $str = "abc_xyz@grepsr.com";
    $split_strings = preg_split("/[_@.]/", $str);
    print_r($split_strings);

?>
<h1>Question 5</h1>
    5. Write a crawler to extract data from URL: https://books.toscrape.com/
a. Navigate to category ‘Science’ and ‘Historical Fiction’
b. Collect all the listing (across pages) from both category above.
c. Collect the following data from each listing (column names as listed in bold, with
required datatype):
i. id: Create a random alphanumeric text value of length 8 – String
ii. category : ‘Science’ or ‘Historical Fiction’ (Fixed value – String)
iii. category_url : Category URL – String
iv. title : Book Title (full text – String)
v. price : Price listed for the book – Float
vi. stock: Stock Availability – String
vii. stock_qty: Quantity Available – Int
viii. upc : UPC value of the listing – String
ix. rating: No of Ratings (Stars value – Float)
x. reviews: Number of reviews (if available) – Int
xi. url: Detail URL of the book – String
d. Create a ‘CSV’ file named ‘toscrape_listing.csv’, with data collected.
e. Create another ‘CSV’ file named ‘reviews_desc.csv’, with records available in
Descending (DESC) order based on ‘reviews’ value from file
‘toscrape_listing.csv’.
i. You can create file using coding or any 3rd party application
ii. If 3rd party application is used, provide the application Name, URL (if
applicable) <br>
<?php
  $all = array();
?>
    <?php
    $html = file_get_contents("https://books.toscrape.com/catalogue/category/books/science_22/index.html");
    $start = stripos($html, '<ol>');
    $end = stripos($html, "</ol>", $offset = $start);
    $length = $end - $start;
    $sub_html = substr($html, $start, $length);
    libxml_use_internal_errors(true);
    $doc = new DOMDocument();
    $doc->loadHTML($sub_html);
    $xpath = new DOMXPath($doc);
    $titles = $xpath->evaluate('//ol[@class="row"]//li//article//h3/a/@href');
    $head_titles = $xpath->evaluate('//ol[@class="row"]//li//article//h3/a');
    $prices = $xpath->evaluate('//ol[@class="row"]//li//article//div[@class="product_price"]//p[@class="price_color"]');
    foreach ($titles as $key=>$title) {
      
      $endpoint = $title->textContent;
      $endpoint = substr($endpoint, 8);
      $content = file_get_contents("https://books.toscrape.com/catalogue" . $endpoint);
      $doc = new DOMDocument();
      $doc->loadHTML($content);
      $xpath = new DOMXPath($doc);
      $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
      $id = substr(str_shuffle($str_result),0,8);
      $stack = array();
      array_push($stack, $id);
      array_push($stack, $head_titles[$key]->textContent.PHP_EOL);
      array_push($stack, $prices[$key]->textContent.PHP_EOL);
      array_push($stack, "Science");
      array_push($stack, "https://books.toscrape.com/catalogue/category/books/science_22/index.html");
      $one = $xpath->evaluate('boolean(//div[@class="col-sm-6 product_main"]//p[@class="star-rating One"])');
      $two = $xpath->evaluate('boolean(//div[@class="col-sm-6 product_main"]//p[@class="star-rating Two"])');
      $three = $xpath->evaluate('boolean(//p[@class="star-rating Three"])');
      $four = $xpath->evaluate('boolean(//div[@class="col-sm-6 product_main"]//p[@class="star-rating Four"])');
      $five = $xpath->evaluate('boolean(//div[@class="col-sm-6 product_main"]//p[@class="star-rating Five"])');
      if($one === true){
        array_push($stack,"one");
      }
      elseif($two === true){
        array_push($stack,"two");
      }
      elseif($three === true){
        array_push($stack,"three");
      }
      elseif($four === true){
        array_push($stack,"four");
      }
      elseif($five === true){
        array_push($stack,"five");
      }
      else {
        array_push($stack,"zero");
      }
      foreach ($xpath->query('//article[@class="product_page"]//table[@class="table table-striped"]//tr[6]//td[1]') as $row){
              if(strpos($row->textContent, "In stock") !== false){
                  array_push($stack, "In stock");
                  preg_match_all('!\d+!', $row->textContent, $matches);
                  array_push($stack, $matches[0][0]);
              } else{
                  array_push($stack, "Not in stock");
                  array_push($stack, 0);
              }
      }
      foreach ($xpath->query('//article[@class="product_page"]//table[@class="table table-striped"]//tr[1]//td[1]') as $row){
               array_push($stack,$row->textContent);
      }
      foreach ($xpath->query('//article[@class="product_page"]//table[@class="table table-striped"]//tr[7]//td[1]') as $row){
               array_push($stack,$row->textContent);
      }
      array_push($stack, "https://books.toscrape.com/catalogue" . $endpoint);
      array_push($all, $stack);
      // foreach($stack as $s){
      //   echo $s . "<br>";
      // }
    }
?>
<?php
    $html = file_get_contents("https://books.toscrape.com/catalogue/category/books/historical-fiction_4/page-2.html");
    $start = stripos($html, '<ol>');
    $end = stripos($html, "</ol>", $offset = $start);
    $length = $end - $start;
    $sub_html = substr($html, $start, $length);
    libxml_use_internal_errors(true);
    $doc = new DOMDocument();
    $doc->loadHTML($sub_html);
    $xpath = new DOMXPath($doc);
    $titles = $xpath->evaluate('//ol[@class="row"]//li//article//h3/a/@href');
    $head_titles = $xpath->evaluate('//ol[@class="row"]//li//article//h3/a');
    $prices = $xpath->evaluate('//ol[@class="row"]//li//article//div[@class="product_price"]//p[@class="price_color"]');
    foreach ($titles as $key=>$title) {
      
      $endpoint = $title->textContent;
      $endpoint = substr($endpoint, 8);
      $content = file_get_contents("https://books.toscrape.com/catalogue" . $endpoint);
      $doc = new DOMDocument();
      $doc->loadHTML($content);
      $xpath = new DOMXPath($doc);
      $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
      $id = substr(str_shuffle($str_result),0,8);
      $stack = array();
      array_push($stack, $id);
      array_push($stack, $head_titles[$key]->textContent.PHP_EOL);
      array_push($stack, $prices[$key]->textContent.PHP_EOL);
      array_push($stack, "Historical Fiction");
      array_push($stack, "https://books.toscrape.com/catalogue/category/books/historical-fiction_4/page-2.html");
      $one = $xpath->evaluate('boolean(//div[@class="col-sm-6 product_main"]//p[@class="star-rating One"])');
      $two = $xpath->evaluate('boolean(//div[@class="col-sm-6 product_main"]//p[@class="star-rating Two"])');
      $three = $xpath->evaluate('boolean(//p[@class="star-rating Three"])');
      $four = $xpath->evaluate('boolean(//div[@class="col-sm-6 product_main"]//p[@class="star-rating Four"])');
      $five = $xpath->evaluate('boolean(//div[@class="col-sm-6 product_main"]//p[@class="star-rating Five"])');
      if($one === true){
        array_push($stack,"one");
      }
      elseif($two === true){
        array_push($stack,"two");
      }
      elseif($three === true){
        array_push($stack,"three");
      }
      elseif($four === true){
        array_push($stack,"four");
      }
      elseif($five === true){
        array_push($stack,"five");
      }
      else {
        array_push($stack,"zero");
      }
      foreach ($xpath->query('//article[@class="product_page"]//table[@class="table table-striped"]//tr[6]//td[1]') as $row){
              if(strpos($row->textContent, "In stock") !== false){
                  array_push($stack, "In stock");
                  preg_match_all('!\d+!', $row->textContent, $matches);
                  array_push($stack, $matches[0][0]);
              } else{
                  array_push($stack, "Not in stock");
                  array_push($stack, 0);
              }
      }
      foreach ($xpath->query('//article[@class="product_page"]//table[@class="table table-striped"]//tr[1]//td[1]') as $row){
               array_push($stack,$row->textContent);
      }
      foreach ($xpath->query('//article[@class="product_page"]//table[@class="table table-striped"]//tr[7]//td[1]') as $row){
               array_push($stack,$row->textContent);
      }
      array_push($stack, "https://books.toscrape.com/catalogue" . $endpoint);
      array_push($all, $stack);
      // foreach($stack as $s){
      //   echo $s . "<br>";
      // }
    }
?>
<?php
    $html = file_get_contents("https://books.toscrape.com/catalogue/category/books/historical-fiction_4/index.html");
    $start = stripos($html, '<ol>');
    $end = stripos($html, "</ol>", $offset = $start);
    $length = $end - $start;
    $sub_html = substr($html, $start, $length);
    libxml_use_internal_errors(true);
    $doc = new DOMDocument();
    $doc->loadHTML($sub_html);
    $xpath = new DOMXPath($doc);
    $titles = $xpath->evaluate('//ol[@class="row"]//li//article//h3/a/@href');
    $head_titles = $xpath->evaluate('//ol[@class="row"]//li//article//h3/a');
    $prices = $xpath->evaluate('//ol[@class="row"]//li//article//div[@class="product_price"]//p[@class="price_color"]');
    foreach ($titles as $key=>$title) {
      
      $endpoint = $title->textContent;
      $endpoint = substr($endpoint, 8);
      $content = file_get_contents("https://books.toscrape.com/catalogue" . $endpoint);
      $doc = new DOMDocument();
      $doc->loadHTML($content);
      $xpath = new DOMXPath($doc);
      $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
      $id = substr(str_shuffle($str_result),0,8);
      $stack = array();
      array_push($stack, $id);
      array_push($stack, $head_titles[$key]->textContent.PHP_EOL);
      array_push($stack, $prices[$key]->textContent);
      array_push($stack, "Historical Fiction");
      array_push($stack, "https://books.toscrape.com/catalogue/category/books/historical-fiction_4/index.html");
      $one = $xpath->evaluate('boolean(//div[@class="col-sm-6 product_main"]//p[@class="star-rating One"])');
      $two = $xpath->evaluate('boolean(//div[@class="col-sm-6 product_main"]//p[@class="star-rating Two"])');
      $three = $xpath->evaluate('boolean(//p[@class="star-rating Three"])');
      $four = $xpath->evaluate('boolean(//div[@class="col-sm-6 product_main"]//p[@class="star-rating Four"])');
      $five = $xpath->evaluate('boolean(//div[@class="col-sm-6 product_main"]//p[@class="star-rating Five"])');
      if($one === true){
        array_push($stack,"one");
      }
      elseif($two === true){
        array_push($stack,"two");
      }
      elseif($three === true){
        array_push($stack,"three");
      }
      elseif($four === true){
        array_push($stack,"four");
      }
      elseif($five === true){
        array_push($stack,"five");
      }
      else {
        array_push($stack,"zero");
      }
      foreach ($xpath->query('//article[@class="product_page"]//table[@class="table table-striped"]//tr[6]//td[1]') as $row){
              if(strpos($row->textContent, "In stock") !== false){
                  array_push($stack, "In stock");
                  preg_match_all('!\d+!', $row->textContent, $matches);
                  array_push($stack, $matches[0][0]);
              } else{
                  array_push($stack, "Not in stock");
                  array_push($stack, 0);
              }
      }
      foreach ($xpath->query('//article[@class="product_page"]//table[@class="table table-striped"]//tr[1]//td[1]') as $row){
               array_push($stack,$row->textContent);
      }
      foreach ($xpath->query('//article[@class="product_page"]//table[@class="table table-striped"]//tr[7]//td[1]') as $row){
               array_push($stack,$row->textContent);
      }
      array_push($stack, "https://books.toscrape.com/catalogue" . $endpoint);
      array_push($all, $stack);
      // foreach($stack as $s){
      //   echo $s . "<br>";
      // }
    }
?>

<?php 
  $file = fopen("toscrape_listing.csv","w");
  fputcsv($file, array("ID", "Title", "Price", "Category", "Category_URL","Rating","Stock","Stock_Quantity", "UPC", "Reviews", "URL"));
  foreach($all as $a){
    fputcsv($file, $a);
  }
  function csvToJson($fname) {
    // open csv file
    if (!($fp = fopen($fname, 'r'))) {
        die("Can't open file...");
    }
    
    //read csv headers
    $key = fgetcsv($fp,"1024",",");
    
    // parse csv rows into array
    $json = array();
        while ($row = fgetcsv($fp,"1024",",")) {
        $json[] = array_combine($key, $row);
    }
    
    // release file handle
    fclose($fp);
    
    // encode array to json
    return json_encode($json);
}
    $jsonString = csvToJson("toscrape_listing.csv");
    $fp = fopen("toscrape_listing.json", "w");
    fwrite($fp, $jsonString);
    fclose($fp);
?>
<strong>Done, file is in the code base.</strong>
<h1>Question 6</h1>
    6. Write a code to create a ‘JSON’ file named ‘toscrape_listing.json’ using or reading the
data in the file ‘toscrape_listing.csv’ from Q.5 above.
<strong>Done, file is in the code base.</strong>

<h1>Question 7</h1>
    7. Write a code to create a ‘CSV’ file named ‘categories.csv’ with column name listed:
a. Category
from JSON data. (available at https://dummyjson.com/products/categories)
<strong>Done, file is in the code base.</strong>
    <?php 
    $json = file_get_contents('https://dummyjson.com/products/categories');
    $obj = json_decode($json);
    $fp = fopen("categories.csv", "w");
    fputcsv($fp, array("Categories"));
    foreach($obj as $o) {
      fputcsv($fp, array($o));
    }
    fclose($fp);
?>
<h1>Question 8</h1>

8. Create a crawler to Login & Print (an array), with available unique ‘Tags’ (from Page 1).
a. https://toscrape.com/index.html
b. http://quotes.toscrape.com/login Login
c. http://quotes.toscrape.com/ Collect Tags found in each listed quote from this
page after Login.

<?php 
  $quotes = file_get_contents("http://quotes.toscrape.com/");
  $doc = new DOMDocument();
  $doc->loadHTML($quotes);
  $xpath = new DOMXPath($doc);
  $tags =  $xpath->evaluate('//div[@class="tags"]//a[@class="tag"]');
  $tag_array = array();
  foreach($tags as $key=>$tag){
    array_push($tag_array, $tag->textContent);
  }
  $tag_array = array_unique($tag_array);
  foreach($tag_array as $t){
    echo $t . "<br>";
  }

?>
    <!--
    This script places a badge on your repl's full-browser view back to your repl's cover
    page. Try various colors for the theme: dark, light, red, orange, yellow, lime, green,
    teal, blue, blurple, magenta, pink!
    -->
    <script src="https://replit.com/public/js/replit-badge.js" theme="blurple" defer></script> 
  </body>
</html>