<?php
require_once 'scripts/config.php';
//$sql= "SELECT movies.original_title, movies.poster_path, movies.vote_average, movies.release_date, movies.overview, genre.name FROM movies JOIN genres ON genres.id=movies.genre_id ;";
?>;

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
        function getAllMovies(){
            let jstr = <?php
                            $sql= "SELECT movies.original_title, movies.poster_path, movies.vote_average, movies.release_date, movies.overview,  movies.movie_url FROM movies ORDER BY release_date DESC LIMIT 10 ;";
                            $query=mysqli_query($db,$sql);
                            
                            echo '[';
                            while ($fetch= mysqli_fetch_assoc($query)){
                                echo json_encode($fetch).',';
                             }
                            echo "{}".']';
                       ?>;
            getMovies(jstr)
        }

        function createCookie(name, value) {
              var expires;
              var date = new Date();
              date.setTime(date.getTime() + (5 * 1000));
              expires = "; expires=" + date.toGMTString();
              document.cookie = escape(name) + "=" + 
                  escape(value) + expires + "; path=/";
          }
        function getMoviesGenres(id){
          var date = new Date();
          date.setTime(date.getTime() + (5 * 1000));
          console.log(id)
          document.cookie="genid="+id+"; expires="+ date.toGMTString();
        
          var jstr = <?php  
                  $gid=intval($_COOKIE["genid"]);
                  $sql= "SELECT movies.original_title, movies.poster_path, movies.vote_average, movies.release_date, movies.overview,  movies.movie_url FROM movies WHERE genre_id=$gid ORDER BY release_date DESC LIMIT 10;";
                  $query=mysqli_query($db,$sql);
                  
                  echo '[';
                  while ($fetch= mysqli_fetch_assoc($query)){
                      echo json_encode($fetch).',';
                   }
                  echo "{}".']';
             ?>;
          
          var genreName=<?php 
               $gid=intval($_COOKIE["genid"]);
               $sql= "SELECT genres.name FROM genres WHERE id=$gid ;";
               $query=mysqli_query($db,$sql);
               $fetch= mysqli_fetch_assoc($query);
               echo json_encode($fetch);
          ?>;
          getMoviesByGenre(jstr,genreName.name);
        }

    </script>

</head>
<body>
	<!--  -->
	<!-- Navbar -->
	<!--  -->
	<nav class="navbar navbar-inverse">
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
        <li><a href="#" id="movies" onClick="getAllMovies()" >All Movies</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Genres<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#" class="action" onClick="getMoviesGenres(28)" id="action">Action</a></li>
            <li><a href="#" class="adventure" onClick="getMoviesGenres(12)" id="adventure">Adventure</a></li>
            <li><a href="#" class="animation" onClick="getMoviesGenres(16)" id="animation">Animation</a></li>
            <li><a href="#" class="comedy" onClick="getMoviesGenres(35)" id="comedy">Comedy</a></li>
            <li><a href="#" class="crime" onClick="getMoviesGenres(80)" id="crime">Crime</a></li>
            <li><a href="#" class="drama" onClick="getMoviesGenres(18)" id="drama">Drama</a></li>
            <li><a href="#" class="family" onClick="getMoviesGenres(10751)" id="family">Family</a></li>
            <li><a href="#" class="fantasy" onClick="getMoviesGenres(14)" id="fantasy">Fantasy</a></li>
            <li><a href="#" class="history" onClick="getMoviesGenres(36)" id="history">History</a></li>
            <li><a href="#" class="music" onClick="getMoviesGenres(10402)" id="music">Music</a></li>
            <li><a href="#" class="romance" onClick="getMoviesGenres(10749)" id="romance">Romance</a></li>
            <li><a href="#" class="horror" onClick="getMoviesGenres(27)" id="horror">Horror</a></li>
            <li><a href="#" class="scifi" onClick="getMoviesGenres(878)" id="scifi">Science Fiction</a></li>
            <li><a href="#" class="thriller" onClick="getMoviesGenres(53)" id="thriller">Thriller</a></li>
          </ul>
        </li>
        <li class="gitHubLogo">
          <a href="https://github.com/dangconnie/movie-app" target="_blank">GitHub Repo</a>
        </li>
        <!-- <li><a href="#">Specials</a></li> -->
   <!--      <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Extras <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#">VIP Rewards Card</a></li>
            <li><a href="#">Specials and Promotions</a></li>
            <li><a href="#">Gift Cards</a></li>
          </ul>
        </li> -->
        <!-- <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Locations<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#">Atlanta</a></li>
            <li><a href="#">Buckhead</a></li>
            <li><a href="#">Midtown</a></li>
            <li><a href="#">Marietta</a></li>
          </ul>
        </li> -->
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <form class="navbar-form navbar-right searchForm">
	        <div class="form-group">
	          <input type="text" class="form-control" placeholder="Search movies">
	        </div>
	        <button type="submit" class="btn btn-default">Submit</button>
	    </form>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
<div id="Movies" style="display: none;">
    <?php
        echo json_encode($fetch); /* You have to escape because the result                                       will not be valid HTML otherwise. */
    ?>
</div>

	<!-- Displaying the movies -->

	<div class="container">
		<div class="row">
      <div class="genreLabel"><h1 id="movieGenreLabel"></h1></div>
        <!-- I need the h1 to change accordingly depending on what was clicked. -->
			<div id="movie-grid">
				 <!-- Jquery get us the movie posters! Need a place to put the poster images -->
			</div>
		</div>
	</div>

</body>
</html>
