
function validateForm()
{
    
    var keywordToggle = document.getElementById("keywordToggle").checked;
    var keywords = document.getElementById("keywords").value;
    var genreToggle = document.getElementById("genreToggle").checked;
    var genre = document.getElementById("genre").value;
    var tagToggle = document.getElementById("tagToggle").checked;
    var tags = document.getElementsByName("tags[]");
    var error = false;
    
    document.getElementById("overallErrorMessage").innerHTML = "";
    document.getElementById("keywordErrorMessage").innerHTML = "";
    document.getElementById("tagErrorMessage").innerHTML = "";
    
    if (keywordToggle == false && genreToggle == false && tagToggle == false)
    {
        document.getElementById("overallErrorMessage").innerHTML = "Error: No fields are active";
        var error = true;
    }
    
    if (keywordToggle == true && keywords == "")
    {
        document.getElementById("keywordErrorMessage").innerHTML = "Error: Keyword required if field is active";
        var error = true;
    }
    
    isSelectedTag = false;
    for (x = 0; x < tags.length; x++)
    {
        if (tags[x].checked == true)
        {
            isSelectedTag = true;
            break;
        }
    }
    
    if (tagToggle == true && isSelectedTag == false)
    {
        document.getElementById("tagErrorMessage").innerHTML = "Error: Tag selection required if field is active";
        var error = true;
    }
    
    low_tempo = document.getElementById("low_tempo").checked;
    high_tempo = document.getElementById("high_tempo").checked;
    instrumental = document.getElementById("instrumental").checked;
    synthetic = document.getElementById("synthetic").checked;
    
    if (tagToggle == true && (low_tempo == true && high_tempo == true) | (instrumental == true && synthetic == true))
    {
        document.getElementById("tagErrorMessage").innerHTML = "Error: Incoherent tag selection"
        var error = true;
    }
    
    if (error == true)
    {
        return false;
    }
    
    

}