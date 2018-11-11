<?php
echo "<center>Start Scraping thescienceexplorer<center>"."<br/>";
include 'simple_html_dom.php';
$urlFormat  = 'http://thescienceexplorer.com/categories/technology?page=';
$data       = array();

for($i=0;$i<=85;$i++){
    echo "Start Scraping page number - ".($i+1)."<br/>";
    $url  = $urlFormat.$i; //echo $url;
    get_content($url);
    echo "End Scraping page number - ".($i+1)."<br/>";
}
echo "End Scraping thescienceexplorer"."<br/>";
// function of scraping
function get_content($url){
    $html = str_get_html(file_get_contents($url));
    $rows = $html->find("//div[@class=teaser-list]/article/header/h1");
    if (!count($rows)){
        echo"---- No data found ----"."<br>";
        return; //skip
    }
        foreach($rows as $row){
            $rowResult = $row->find('a',0);
            $href      = $rowResult->href;
            $text      = $rowResult->innertext;
            echo"-------------------------------------------"."<br>";
            echo "-link:".$href."<br/>","-text:".$text."<br/>";
            echo"-------------------------------------------"."<br>";
            $data[]['href'] = $href."<br/>";
            $data[]['text'] = $text."<br/>";
        }
  //  print_r($data);

}

?>