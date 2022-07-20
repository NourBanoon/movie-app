    
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