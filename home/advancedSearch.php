<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="../layout/layout.css" type="text/css" >
    <link rel="stylesheet" href="./home.css">
    <link rel="stylesheet" href="./searchResults.css">
    <script type = "text/javascript" src = "./home.js"></script>
    <title>SoundScout - Home</title>
</head>

<body>
    <div class="row">
        <!-- Top Header -->
        <div class="head" >
            <!--Middle column for logo (4 wide)-->
            <div>
                <img src="../images/SoundScout.png" class="logo-head img-responsive center-block" alt="SoundScout" >
            </div>

        </div>
    </div>
    <!-- Navigation Bar -->
    <div class ="nav">
        <div class="container" >
            <div class ="row">
                <div class ="col-xs-2">
                    <a href="../home/home.html"> Home</a> 
                </div>
                <div class ="col-xs-2">
                    <a href="../events/events.html"> Events</a> 
                </div>
                <div class ="col-xs-2">
                    <a href="../song/song.html"> Discover</a> 
                </div>
                <div class ="col-xs-2">
                    <a href="../contact/contact.html"> Contact Us</a> 
                </div>
                <div class ="col-xs-4">
                    <p class="search">
                    	<form name="searchform" action ="search.php" method="post" class = "form-inline">
                            <div class = "form-group">
                                <input type ="text" name="searchfield" class = "form-control">
                                <button type="Submit" value="Search" class = "btn btn-primary btn-md" >Search</button>
                            </div>
                    	</form>
                    </p>
                </div>
            </div>
        </div>
    </div>
        
<!-- Main Content Area -->
<div class = "container">
    <div class = "content">
        <div class = "row">
            <h1>Advanced Search Results:</h1>
        </div>
        
            <?php
            
                $host = "fall-2016.cs.utexas.edu";
                $user = "nkilleen";
                $pwd = "2rqtG8DGpd";
                $dbs = "cs329e_nkilleen";
                $port = "3306";
                
                $connect = mysqli_connect ($host, $user, $pwd, $dbs, $port);
                
                $table = "songs";
                
                $queryStarted = false;

                print <<< RESULTSSTART
                <div class = "row">
                    <table class = "table table-striped table-hover">
                
RESULTSSTART;
            
                if (isset($_POST["keywordToggle"]))
                {
                    $keywords = $_POST["keywords"];
                    $query = "SELECT * from $table where song_name like '%$keywords%'";
                    $queryStarted = true;
                    
                }
                
                if (isset($_POST["genreToggle"]))
                {
                    $genre = $_POST["genre"];
                    if ($queryStarted == false)
                    {
                        $query = "SELECT * from $table where genre = '$genre'";
                        $queryStarted = true;
                    }
                    
                    else
                    {
                        $query = $query." and genre = '$genre'";
                    }
                    
                }
                
                if ($_POST["tagToggle"] == "1")
                {
                    $tags = $_POST["tags"];
                    foreach ($tags as $tag)
                    {
                        if ($queryStarted == false)
                        {
                            $query = "SELECT * from $table where tags like '%$tag%'";
                            $queryStarted = true;
                        }
                        else
                        {
                            $query = $query." and tags like '%$tag%'";
                        }
                    }
                }
                  
                if ($queryStarted == true)
                {
                    $result = mysqli_query($connect, $query);
                    while ($row = $result->fetch_row())
                    {
                        print <<< ROW
                        <tr>
                            <td class = "searchResult">
                                <img src = "../images/$row[6]" width = "200px" height = "200px" class = "searchResultImage"/><br><br>
                                <audio controls> 
                                    <source src="../music/$row[5]" type = "audio/mpeg">
                                </audio>
                            </td>
                            <td>
                                <h1 class = "songName">Song Name: <a href = "../song/$row[7]"><b>$row[1]</b></a></h1>
                                <h3 class = "artist">Artist: <b>$row[2]</b></h3>
                                <h3 class = "genre">Genre: <b>$row[3]</b></h3><br>
                                <p class = "tags">Tags: $row[4]</p>
                            </td>
                        </td></tr>
ROW;
                    }
                }
                
                
                if (mysqli_num_rows($result) == 0)
                {
                    print <<< NORESULT
                    <tr>
                        <td>
                            <h1>No songs match search parameters.</h1>
                        </td>
                    </tr>
NORESULT;
                }
                
                print <<< RESULTSEND
                    </table>
                </div>
                
RESULTSEND;

                $result->free();
                mysqli_close($connect);

            
            ?>
        
        
    </div>        
</div>
<div class = "row">
    <div class ="foot">
    <footer>

        <i>Copyright &copy; 2016 Sound Scout | Music: <a href="http://www.bensound.com"> http://www.bensound.com </a></i> 
    </footer>
</div>
    

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
</body>
</html>

