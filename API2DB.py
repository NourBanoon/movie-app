import requests
import  mysql.connector

mydb = mysql.connector.connect(
  host="localhost",
  user="root",
  password="", 
  database="movieapp"
)

mycursor = mydb.cursor()
#mycursor.execute("CREATE DATABASE movieapp ")

mycursor.execute("CREATE TABLE genres (id INT PRIMARY KEY, name VARCHAR(16))")
sql ="INSERT INTO genres(id, name) VALUES(%s, %s) "
val= [(28 , "action")
    ,(12 , "adventure")
    ,(16 , "animation")
    ,(35 , "comedy")
    ,(80 , "crime")
    ,(18 , "drama")
    ,(10751 , "family")
    ,(14 , "fantasy")
    ,(36 , "history")
   ,(27 , "horror")
    ,(10402 , "music")
    ,(10749 , "romance")
    ,(878 , "science fiction")
    ,(53 , "thriller")]
mycursor.executemany(sql, val)
mydb.commit()



#apiKey="?api_key=<api-key-value>"
apiBaseURL = 'http://api.themoviedb.org/3/movie/'

mycursor.execute("CREATE TABLE movies (id INT AUTO_INCREMENT PRIMARY KEY, original_title VARCHAR(32) NOT NULL, poster_path VARCHAR(32),vote_average VARCHAR(8), release_date DATE, overview LONGTEXT, genre_id  INT, movie_url VARCHAR(32))")   
sql="INSERT INTO movies(original_title, poster_path, vote_average, release_date, overview, genre_id, movie_url ) VALUES(%s, %s, %s, %s, %s, %s,%s) "

for i in range(27501,30001):
    print(i)
    response = requests.get(apiBaseURL+str(i)+apiKey+"&adult=false")
    Response = requests.get(apiBaseURL+str(i)+'/videos'+apiKey)
    #print(response.json())
    if(response.status_code == 200):
        movie=response.json()
        url=Response.json()
        if(movie['genres']):
            genre_id=movie['genres'][0]['id']
        else:
            genre_id=0
        if(url['results']):
            movie_url=url['results'][0]['key']
        else:
            movie_url=" "
 
        val=(
            movie["original_title"],    
            movie["poster_path"], 
            movie["vote_average"],
            movie["release_date"],
            movie["overview"],
            genre_id,
            movie_url
            )
        mycursor.execute(sql, val)
        mydb.commit()
   