const imageBaseUrl = 'https://image.tmdb.org/t/p/';
var allMoviesHTML = '';
   

function getallMoviesData(movies){   
    let allMoviesData= movies
    //we needed to add .results because allMoviesData is an array.

    for(let i = 0; i<allMoviesData.length; i++){
       
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
            if(allMoviesData[i].poster_path){
                var poster = imageBaseUrl+'w300'+allMoviesData[i].poster_path;
            }
            else{
                var poster = "IMG/istockphoto-924949200-1024x1024.jpg";
            }
           

            var title = allMoviesData[i].original_title;

            var releaseDate = allMoviesData[i].release_date;

            var overview = allMoviesData[i].overview;
            // $('.overview').addClass('overview');

            var voteAverage = allMoviesData[i].vote_average;				
            // console.log(movieKey)
            var youtubeKey = allMoviesData[i].movie_url;

            var youtubeLink = 'https://www.youtube.com/watch?v='+youtubeKey;
            // console.log(youtubeLink)

           
            // added in i to allMoviesHTML. Without it, only the details for the first movie in the results display in the modal no matter which movie poster you click on.
            allMoviesHTML += '<div class="col-sm-3 eachMovie">';
                allMoviesHTML += '<button type="button" class="btnModal" data-toggle="modal" data-target="#exampleModal'+ i + '" data-whatever="@' + i + '">'+'<img src="'+poster+'"></button>'; 	
                allMoviesHTML += '<div class="modal fade" id="exampleModal' + i +'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">';
                    allMoviesHTML += '<div class="modal-dialog" role="document">';
                        allMoviesHTML += '<div class="modal-content col-sm-12">';
                            allMoviesHTML += '<div class="col-sm-6 moviePosterInModal">';
                                allMoviesHTML += '<a href="'+youtubeLink+'"><img src="'+poster+'"></a>'; 
                            allMoviesHTML += '</div><br>';//close trailerLink
                            allMoviesHTML += '<div class="col-sm-6 movieDetails">';
                                allMoviesHTML += '<div class="movieName">'+title+'</div><br>';
                                allMoviesHTML += '<div class="linkToTrailer"><a href="'+youtubeLink+'"><span class="glyphicon glyphicon-play"></span>&nbspPlay trailer</a>' + '</div><br>';	
                                allMoviesHTML += '<div class="release">Release Date: '+releaseDate+'</div><br>';
                                // allMoviesHTML += '<div class="genre">Genre: '+genre+'</div><br>';
                                allMoviesHTML += '<div class="overview">' +overview+ '</div><br>';// Put overview in a separate div to make it easier to style
                                allMoviesHTML += '<div class="rating">Rating: '+voteAverage+ '/10</div><br>';
                                allMoviesHTML += '<div class="col-sm-3 btn btn-primary">8:30 AM' + '</div>';
                                allMoviesHTML += '<div class="col-sm-3 btn btn-primary">10:00 AM' + '</div>';
                                allMoviesHTML += '<div class="col-sm-3 btn btn-primary">12:30 PM' + '</div>';
                                allMoviesHTML += '<div class="col-sm-3 btn btn-primary">3:00 PM' + '</div>';
                                allMoviesHTML += '<div class="col-sm-3 btn btn-primary">4:10 PM' + '</div>';
                                allMoviesHTML += '<div class="col-sm-3 btn btn-primary">5:30 PM' + '</div>';
                                allMoviesHTML += '<div class="col-sm-3 btn btn-primary">8:00 PM' + '</div>';
                                allMoviesHTML += '<div class="col-sm-3 btn btn-primary">10:30 PM' + '</div>';
                            allMoviesHTML += '</div>'; //close movieDetails
                        allMoviesHTML += '</div>'; //close modal-content
                    allMoviesHTML += '</div>'; //close modal-dialog
                allMoviesHTML += '</div>'; //close modal
            allMoviesHTML += '</div>'; //close off each div

            $('#movie-grid').append(allMoviesHTML);
            //Without this line, there is nowhere for the posters and overviews to display so it doesn't show up 
            $('#movieGenreLabel').html("All Movies");
            //h1 will change depending on what is clicked. Will display "Now Playing" in this case.
        
    }
}

function allMovies(movies){
    getallMoviesData(movies);
    $('#movie-grid').html(allMoviesHTML);
    $('#movieGenreLabel').html("All Movies");
}