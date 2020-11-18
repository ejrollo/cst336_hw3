<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8" />
        
        <title> Earthquake Page </title>
        <link href="css/styles.css" rel="stylesheet" type="text/css" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        
    </head>
    
    <body>
        
        <img src="img/usgs.png" alt="USGS Logo" style="width:600px;height:300px;"/>
        
        <h1> Earthquake Update </h1> <br><br>   
            <div id="inputData">
                <span id="dateFormat">Enter a date:<strong> YEAR-MONTH-DAY </strong></span><br>
                <span><strong>(ex.</strong> 2020-11-01 or 20201101<strong>)</strong></span> <br>
                Start Date: <input type="text" id="sDate" name="sDate"> <span id="sDateError"></span><br>
                End Date: <input type="text" id="eDate" name="eDate"> <span id="eDateError"></span><br>
                Min Magnitude: <input type="text" id="mag" name="mag"> <span id="magError"></span><br><br>
            </div>
            
            <div id="button">
                <button id="submit">Results</button> <br><br>
            </div>
            
            
            <table id="data-mag">
                    
            </table>
            
        <script>
            $("#submit").on("click", async function(){
                let error = false;
                let startDate = $("#sDate").val();
                let endDate = $("#eDate").val();
                let magnitude = $("#mag").val();
                if (startDate.length == 0){
                    $("#sDateError").html("Start date is required");
                    $("#sDateError").css("color","red");
                    error=true;
                }
                if (endDate.length == 0){
                    $("#eDateError").html("End date is required");
                    $("#eDateError").css("color","red");
                    error=true;
                }
                if (magnitude.length == 0){
                    $("#magError").html("Magnitude is required");
                    $("#magError").css("color","red");
                    error=true;
                }
                
                if (!error){
                    let sDate = $("#sDate").val();
                    let eDate = $("#eDate").val();
                    let minMag = $("#mag").val();
                    let url = `https://earthquake.usgs.gov/fdsnws/event/1/query?format=geojson&starttime=${sDate}&endtime=${eDate}&minmagnitude=${minMag}`;
                    let response = await fetch(url);
                    let data = await response.json();
                    
                    $("#data-mag").html("");
                    $("#data-mag").append(`<tr id="table-header"> <td><strong>Location</strong></td> <td><strong>Magnitude</strong></td> </tr>`);
                    
                    for (i = 0; i < data.features.length; i++){
                        $("#data-mag").append(`<tr><td> ${data.features[i].properties.place} </td> <td> ${data.features[i].properties.mag} </td></tr>`);
                    }
                }
                
                
            });//update earthquake table
            
            
        </script>
        
        <footer>
            <hr>
                <img src="img/csumblogo.png" alt="CSUMB Logo" style="width:150px;height:150px;"/> <br />
                CST336 Internet Programming. 2020&copy; Rollo <br />
                <strong>Disclaimer:</strong> The information in this webpage is fictitious. <br />
                It is used for academic purposes only.<br>
                Images courtesy of http://mac.usgs.gov/isb/pubs/forms/usgsbooks.pdf
        </footer>
    </body>
</html>