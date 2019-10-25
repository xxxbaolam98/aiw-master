<?php
header("Content-Type:application/json");
 include('dbase/dbase.php');

//getAllnews
if (isset($_GET['news'])) {
 $result = mysqli_query($db,"SELECT * FROM `news`");
 if(mysqli_num_rows($result)>0){

$news = array();
while($row = mysqli_fetch_assoc($result)) {

  $new =array(
                "id" =>  $row["id"],
                "title" => $row["title"],
                "date" => $row["date_created"],
                "author" => $row["author"],
                 "intro" => $row["short_intro"],
            );
            array_push($news,$new);
        }

getAllNews($news);

 mysqli_close($db);

 } else {
 	$mess ="No news found";
 	getAllNews($mess);
 }
} 
 
function getAllNews($news){
 $getAllNews['data'] = $news;


 $json_response = json_encode($getAllNews);
 echo $json_response;
}





//getNewsByTag

if (isset($_GET['tag']) && $_GET['tag'] != "") {
 $tag = $_GET['tag'];
 $tag_query = mysqli_query($db,"SELECT * FROM `tag` WHERE tag_name = '$tag'");
 $tag = mysqli_fetch_assoc($tag_query);
 $IDtag = $tag['id'];


$newsTag_query = mysqli_query($db, "SELECT * FROM news_tag WHERE id_tag = '$IDtag'");


 if(mysqli_num_rows($newsTag_query) > 0){


$news = array();

 while($newsTag = mysqli_fetch_assoc($newsTag_query)) {
 $IDnews = $newsTag['id_news'];
$news_query = mysqli_query($db, "SELECT * FROM news WHERE id = '$IDnews'");
$row = mysqli_fetch_assoc($news_query);

  $new =array(
                "id" =>  $row["id"],
                "title" => $row["title"],
                "date" => $row["date_created"],
                "author" => $row["author"],
                 "intro" => $row["short_intro"],
            );
            array_push($news,$new);
        }

 getNewsByTag($news);

 mysqli_close($db);
 }
  else {
 	$mess ="No news found";
 	getAllNews($mess);
 }
}
 
function getNewsByTag($news){
 $getNewsByTag['data'] = $news;
 
 $json_response = json_encode($getNewsByTag);
 echo $json_response;
}





//getNewsByID


if (isset($_GET['IDnews']) && $_GET['IDnews'] != "") {
 $IDnews = $_GET['IDnews'];
 $result = mysqli_query($db,"SELECT * FROM `news` WHERE id = '$IDnews'");
 if(mysqli_num_rows($result)>0){
 $row = mysqli_fetch_assoc($result);

$IDcate = $row['id_category'];

$category_query = mysqli_query($db, "SELECT * FROM `category` WHERE id = '$IDcate'");
$category = mysqli_fetch_assoc($category_query);

$tagArr = array();
$tagnews_query = mysqli_query($db,"SELECT * FROM `news_tag` WHERE id_news = '$IDnews'");
while($tagnews = mysqli_fetch_assoc($tagnews_query)){
	$IDtag = $tagnews['id_tag'];
	$tag_query = mysqli_query($db,"SELECT * FROM `tag` WHERE id = '$IDtag'");
	$tag = mysqli_fetch_assoc($tag_query);

		$tag1=array(
             
      	   "name" => $tag["tag_name"]      
            );
            array_push($tagArr,$tag1);
}


$commentArr = array();
$comment_query = mysqli_query($db, "SELECT * FROM `comment` WHERE id_news = '$IDnews'");
while ($comment = mysqli_fetch_assoc($comment_query)) {

	$comment1=array(
                "id" =>  $comment["id"],
                "poster" => $comment["poster"],
                "content" => $comment["comment_content"]      
            );
            array_push($commentArr,$comment1);
}


 $id = $row['id'];
 $title = $row['title'];
 $intro = $row['short_intro'];
 $content = $row['content'];
 $date = $row['date_created'];
 $author = $row['author'];
 $categoryName = $category['category_name'];


 getNewsByID($id, $title, $date,$author,$content, $intro,$categoryName,$tagArr,$commentArr);
 }  else {
 	$mess ="No news found";
 	getNewsByID($mess);
 }




$relatednews_query = mysqli_query($db, "SELECT * FROM related_news WHERE id_news = '$IDnews'");


 if(mysqli_num_rows($relatednews_query) > 0){


$news = array();

 while($relatednews = mysqli_fetch_assoc($relatednews_query)) {
 $IDrelatednews = $relatednews['id_relatednews'];
$news_query = mysqli_query($db, "SELECT * FROM news WHERE id = '$IDrelatednews'");
$row = mysqli_fetch_assoc($news_query);

  $new =array(
                "id" =>  $row["id"],
                "title" => $row["title"],
                "date" => $row["date_created"],
                "author" => $row["author"],
                 "intro" => $row["short_intro"],
            );
            array_push($news,$new);
        }

 getRelatedNews($news);

 } 


  mysqli_close($db);

}

function getRelatedNews($news){
 $getRelatedNews['data'] = $news;
 
 $json_response = json_encode($getRelatedNews);
 echo $json_response;
}

 
function getNewsByID($id,$title,$date,$author,$content,$intro,$categoryName,$tagArr,$commentArr){
 $getNewsByID['id'] = $id;
 $getNewsByID['title'] = $title;
 $getNewsByID['date'] = $date;
 $getNewsByID['author'] = $author;
  $getNewsByID['content'] = $content;
 $getNewsByID['intro'] = $intro;
  $getNewsByID['categoryName'] = $categoryName;
 $getNewsByID['tag'] = $tagArr;
  $getNewsByID['commentArr'] = $commentArr;



 
 $json_response = json_encode($getNewsByID);
 echo $json_response;
}







//post comment

if(isset($_GET['IDnews']) && isset($_POST['postComment'])){
  if(!empty($_POST['content']) && !empty($_POST['poster'])) {
   $content = $_POST['content'];
   $poster = $_POST['poster'];
   $IDnews = $_GET['IDnews'];

   $post_query = mysqli_query($db,"INSERT INTO comment(poster, comment_content, id_news) VALUES('$poster', '$content', '$IDnews')");

  }
   else {
 	$mess ="please input your name and comment";
	echo json_encode($mess); 
		} 
} 




//getRelatedNews



?>