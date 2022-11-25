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
    $html = file_get_contents("https://books.toscrape.com/catalogue/category/books/science_22/index.html");
    $start = stripos($html, '<ol>');
    $end = stripos($html, "</ol>", $offset = $start);
    $length = $end - $start;
    $sub_html = substr($html, $start, $length);
    libxml_use_internal_errors(true);
//     $doc = new DOMDocument();
//     $doc->loadHTML($sub_html);
//     $xpath = new DOMXPath($doc);
//     $titles = $xpath->evaluate('//ol[@class="row"]//li//article//h3/a/@href');
//     foreach ($titles as $key=>$title) {
//       $endpoint = $title->textContent;
//       $endpoint = substr($endpoint, 8);
//       $content = file_get_contents("https://books.toscrape.com/catalogue" . $endpoint);
//       $content->filter('.row li article div.product_price p.price_color')->each(function ($node) use (&$prices) {
// $prices[] = $node->text();
// });
//       echo $prices;
    }
?>
    <!--
    This script places a badge on your repl's full-browser view back to your repl's cover
    page. Try various colors for the theme: dark, light, red, orange, yellow, lime, green,
    teal, blue, blurple, magenta, pink!
    -->
    <script src="https://replit.com/public/js/replit-badge.js" theme="blue" defer></script> 
  </body>
</html>