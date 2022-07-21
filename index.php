<?php
require_once 'scripts/config.php';
if(isset($_GET["genre"])){
  $gid=$_GET["genre"];
  $gsql="SELECT genres.name FROM genres WHERE id= '$gid' ;";
  $gquery=mysqli_query($db,$gsql);

  $sql= "SELECT original_title, poster_path, vote_average, release_date, overview,  movie_url FROM movies WHERE genre_id='$gid' ORDER BY release_date DESC LIMIT 100 ;";
  $query=mysqli_query($db,$sql);        
}else if(isset($_GET["search"])){
  $search=$_GET["search"];
  $g_name= "Search";
  $sql= "SELECT original_title, poster_path, vote_average, release_date, overview,  movie_url FROM movies WHERE original_title LIKE '%$search%' ORDER BY release_date DESC LIMIT 100;";
  $query=mysqli_query($db,$sql);  
}else{
  $g_name= "All";
  $sql= "SELECT original_title, poster_path, vote_average, release_date, overview,  movie_url FROM movies ORDER BY release_date DESC LIMIT 1000;";
  $query=mysqli_query($db,$sql);  
}
?>

<!DOCTYPE html>
<html>
<head>
	
	<title>Movie App</title>	
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css">
	<!-- CUSTOM STYLES -->
	<link rel="stylesheet" type="text/css" href="CSS/styles.css">
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Carrois+Gothic+SC" rel="stylesheet">

	<!-- JQUERY -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

	<!-- CUSTOM JS -->
	<script type="text/javascript" src="scripts/EventsHandler.js"></script>
  <script type="text/javascript">
      window.onload = function() {
         getPageMovies();
        };
        
      function findMovie(){
            SearchText= document.getElementById('search-text').value;
            if(SearchText.replace(/\s+/g, ' ').trim()!=""){
              let baseurl=<?php echo '"'.$url.'"';?>;
              let searchUrl=baseurl+"?search="+SearchText
              window.location.href=searchUrl
            }
            return false;
          }

        function getPageMovies(){
         
          let genrename=<?php 
                          if(isset($_GET["genre"])){
                        
                              while($gfetch=mysqli_fetch_assoc($gquery) ){
                                echo '"'.ucfirst($gfetch["name"]).'"';
                              }
                            }else{
                              echo '"'.$g_name.'"';
                          }
                        ?>;
            let jstr = <?php
                            echo '[';
                            while ($fetch= mysqli_fetch_assoc($query)){
                                echo json_encode($fetch).',';
                             }
                            echo "{}".']';
                       ?>;

            getMovies(jstr,genrename)
        }

    </script>

</head>
<body >
	<!--  -->
	<!-- Navbar -->
  <?php require_once 'scripts/Header.php' ?>
	<!--  -->
	<!-- Displaying the movies -->
 <br>
 <br>
	<div class="container" onLoang>
		<div class="row">
     
      <div class="genreLabel"><h1 id="movieGenreLabel"></h1></div>
      <br>
        <!-- I need the h1 to change accordingly depending on what was clicked. -->
			<div id="movie-grid">
				 <!-- Jquery get us the movie posters! Need a place to put the poster images -->
			</div>
      
		</div>
	</div>
</body>
</html>
