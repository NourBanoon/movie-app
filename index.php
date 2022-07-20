<?php
require_once 'scripts/config.php';
//$sql= "SELECT original_title, poster_path, vote_average, release_date, overview, genre.name FROM movies JOIN genres ON genres.id=genre_id ;";
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
  $sql= "SELECT original_title, poster_path, vote_average, release_date, overview,  movie_url FROM movies ORDER BY release_date DESC LIMIT 100;";
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
  <script type="text/javascript" src="scripts/config.js"></script>
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
	<!--  -->
	
  <nav class="navbar navbar-default navbar-fixed-top navbar-inverse" >
            <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">Popcorn Bits Cinemas</a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li><a href="<?php echo $url?>" id="movies" >All Movies</a></li>
                    <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Genres<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="<?php echo $url."?genre=28"?>" class="action"  id="action">Action</a></li>
                        <li><a href="<?php echo $url."?genre=12"?>" class="adventure"  id="adventure">Adventure</a></li>
                        <li><a href="<?php echo $url."?genre=16"?>" class="animation"  id="animation">Animation</a></li>
                        <li><a href="<?php echo $url."?genre=35"?>" class="comedy"  id="comedy">Comedy</a></li>
                        <li><a href="<?php echo $url."?genre=80"?>" class="crime"  id="crime">Crime</a></li>
                        <li><a href="<?php echo $url."?genre=18"?>" class="drama"  id="drama">Drama</a></li>
                        <li><a href="<?php echo $url."?genre=10751"?>" class="family"  id="family">Family</a></li>
                        <li><a href="<?php echo $url."?genre=14"?>" class="fantasy"  id="fantasy">Fantasy</a></li>
                        <li><a href="<?php echo $url."?genre=36"?>" class="history"  id="history">History</a></li>
                        <li><a href="<?php echo $url."?genre=10402"?>" class="music"  id="music">Music</a></li>
                        <li><a href="<?php echo $url."?genre=10749"?>" class="romance" id="romance">Romance</a></li>
                        <li><a href="<?php echo $url."?genre=27"?>" class="horror"  id="horror">Horror</a></li>
                        <li><a href="<?php echo $url."?genre=878"?>" class="scifi"  id="scifi">Science Fiction</a></li>
                        <li><a href="<?php echo $url."?genre=53"?>" class="thriller" id="thriller">Thriller</a></li>
                    </ul>
                    </li>
                    <li class="gitHubLogo">
                    <a href="https://github.com/dangconnie/movie-app" target="_blank">GitHub Repo</a>
                    </li>      
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <form class="navbar-form navbar-right searchForm">
                        <div class="form-group">
                        <input type="text" id="search-text" placeholder="Search movies">
                        </div>
                        <button type="submit" href="#" class="btn btn-default" onClick="findMovie();return false;">Submit</button>
                    </form>
                </ul>
                </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
        </nav>    
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
