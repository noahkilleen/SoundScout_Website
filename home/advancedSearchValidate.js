
function validateForm()
{
    var keywordToggle = document.getElementById("keywordToggle").checked;
    var keywords = document.getElementById("keywords").value;
    var genreToggle = document.getElementById("genreToggle").checked;
    var genre = document.getElementById("genre").value;
    var tagToggle = document.getElementById("tagToggle").checked;
    var tag = document.getElementsByName("tag");
    var error = false;
    
    document.getElementById("overallErrorMessage").innerHTML = "";
    document.getElementById("keywordErrorMessage").innerHTML = "";
    document.getElementById("tagErrorMessage").innerHTML = "";
    
    if (keywordToggle == false && genreToggle == false && tagToggle == false)
    {
        document.getElementById("overallErrorMessage").innerHTML = "Error: No fields are active";
        error = true;
    }
    
    if (keywordToggle == true && keywords == "")
    {
        document.getElementById("keywordErrorMessage").innerHTML = "Error: Keyword required if field is active";
        var error = true;
    }
    
    isSelectedTag = false;
    for (x = 0; x < 12; x++)
    {
        if (tag[x].checked == true)
        {
            isSelectedTag = true;
        }
    }
    
    if (tagToggle == true && isSelectedTag == false)
    {
        document.getElementById("tagErrorMessage").innerHTML = "Error: Tag selection required if field is active";
        var error = true;
    }
    
    instrumental = document.getElementById("instrumental").checked;
    vocalsonly = document.getElementById("vocalsonly").checked;
    explicit = document.getElementById("explicit").checked;
    nonexplicit = document.getElementById("nonexplicit").checked;
    
    if (tagToggle == true && (instrumental == true && vocalsonly == true) | (explicit == true && nonexplicit == true))
    {
        document.getElementById("tagErrorMessage").innerHTML = "Error: Incoherent tag selection"
        var error = true;
    }
    
    if (error == true)
    {
        return false;
    }
    
    

}