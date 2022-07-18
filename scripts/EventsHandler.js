const imageBaseUrl = 'https://image.tmdb.org/t/p/';
var MoviesHTML = '';
   

function getMoviesData(movies){   
    MoviesHTML = ''
    let moviesData= movies
    //we //needed to add .results because moviesData is an array.

    for(let i = 0; i<moviesData.length-1; i++){
       
            // console.log(i);
            // console.log(thisMovieUrl)
            //Need to go to that specific movie's URL to get the genres associated with it. (movieKey.id)
            // var getGenreNameUrl = apiBaseURL + 'movie/' +movieKey.id+ '?api_key=' + apiKey;
            // console.log(getGenreNameUrl);
            // console.log(movieKey.id);

            // $.getJSON(getGenreNameUrl, function(genreNames){
            // 	// console.log(genreNames);//an object
            // 	// console.log(genreNames.genres[0].name);

            // 	for (let j=0; j<genreNames.genres.length; j++){
            // 		var genre = genreNames.genres[0].name;
            // 		// console.log(genre);
            // 	}
            // })
            if(moviesData[i].poster_path){
                var poster = imageBaseUrl+'w300'+moviesData[i].poster_path;
            }
            else{
                var poster = "IMG/istockphoto-924949200-1024x1024.jpg";
            }
           

            var title = moviesData[i].original_title;

            var releaseDate = moviesData[i].release_date;

            var overview = moviesData[i].overview;
            // $('.overview').addClass('overview');

            var voteAverage = moviesData[i].vote_average;				
            // console.log(movieKey)
            var youtubeKey = moviesData[i].movie_url;

            var youtubeLink = 'https://www.youtube.com/watch?v='+youtubeKey;
            // console.log(youtubeLink)

           
            // added in i to MoviesHTML. Without it, only the details for the first movie in the results display in the modal no matter which movie poster you click on.
            MoviesHTML += '<div class="col-sm-3 eachMovie">';
                MoviesHTML += '<button type="button" class="btnModal" data-toggle="modal" data-target="#exampleModal'+ i + '" data-whatever="@' + i + '">'+'<img src="'+poster+'"></button>'; 	
                MoviesHTML += '<div class="modal fade" id="exampleModal' + i +'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">';
                    MoviesHTML += '<div class="modal-dialog" role="document">';
                        MoviesHTML += '<div class="modal-content col-sm-12">';
                            MoviesHTML += '<div class="col-sm-6 moviePosterInModal">';
                                MoviesHTML += '<a href="'+youtubeLink+'"><img src="'+poster+'"></a>'; 
                            MoviesHTML += '</div><br>';//close trailerLink
                            MoviesHTML += '<div class="col-sm-6 movieDetails">';
                                MoviesHTML += '<div class="movieName">'+title+'</div><br>';
                                MoviesHTML += '<div class="linkToTrailer"><a href="'+youtubeLink+'"><span class="glyphicon glyphicon-play"></span>&nbspPlay trailer</a>' + '</div><br>';	
                                MoviesHTML += '<div class="release">Release Date: '+releaseDate+'</div><br>';
                                // MoviesHTML += '<div class="genre">Genre: '+genre+'</div><br>';
                                MoviesHTML += '<div class="overview">' +overview+ '</div><br>';// Put overview in a separate div to make it easier to style
                                MoviesHTML += '<div class="rating">Rating: '+voteAverage+ '/10</div><br>';
                                MoviesHTML += '<div class="col-sm-3 btn btn-primary">8:30 AM' + '</div>';
                                MoviesHTML += '<div class="col-sm-3 btn btn-primary">10:00 AM' + '</div>';
                                MoviesHTML += '<div class="col-sm-3 btn btn-primary">12:30 PM' + '</div>';
                                MoviesHTML += '<div class="col-sm-3 btn btn-primary">3:00 PM' + '</div>';
                                MoviesHTML += '<div class="col-sm-3 btn btn-primary">4:10 PM' + '</div>';
                                MoviesHTML += '<div class="col-sm-3 btn btn-primary">5:30 PM' + '</div>';
                                MoviesHTML += '<div class="col-sm-3 btn btn-primary">8:00 PM' + '</div>';
                                MoviesHTML += '<div class="col-sm-3 btn btn-primary">10:30 PM' + '</div>';
                            MoviesHTML += '</div>'; //close movieDetails
                        MoviesHTML += '</div>'; //close modal-content
                    MoviesHTML += '</div>'; //close modal-dialog
                MoviesHTML += '</div>'; //close modal
            MoviesHTML += '</div>'; //close off each div

            
            //$('#movie-grid').append(MoviesHTML);
            //Without this line, there is nowhere for the posters and overviews to display so it doesn't show up 
            //$('#movieGenreLabel').html("All Movies");
            //h1 will change depending on what is clicked. Will display "Now Playing" in this case.
        
    }
}


function getMovies(movies,genreName){
    console.log(3)
    getMoviesData(movies);
    document.getElementById('movie-grid').innerHTML=MoviesHTML
    document.getElementById('movieGenreLabel').innerHTML=genreName+" Movies"
    //$('#movie-grid').html(MoviesHTML);
    //$('#movieGenreLabel').html("All Movies");
}