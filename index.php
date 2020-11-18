<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Faker API Fake Info Generator</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <link href="css/styles.css" rel="stylesheet" type="text/css" />
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Goldman&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@500&display=swap" rel="stylesheet">
    </head>
    
    <body>
        <h1>Faker API Fake Info Generator!</h1><br>
        <span id="photo"></span><hr>
        
        <form id="thingForm">
            <h2>Select a type, quantity, and any options, and then click Generate!</h2><br>
            
            Type: <select id="type" name="type">
                <option value ="NA">Select One</option>
                <option value = "0">Person</option>
                <option value = "1">Book</option>
                <option value = "2">Company</option>
            </select><br>
            <span id="emptyError"></span><br>
            Quantity: <input type="text" id="quantity"><br>
            <span id="numberError"></span><br>
            <span id="genderOption">Gender: <select id="gender" name="gender">
                <option value = "">Any Gender</option>
                <option value = "&_gender=male">Male</option>
                <option value= "&_gender=female">Female</option>
            </select></span><br><br>
            
            <h2><input type="submit" value="Generate!"><br></h2>
            
        </form>
        
        <br><span id="result"></span>
        
        
        <footer>
            <hr>CST336 Internet Programming. Copyright Sean Wilson &copy;2020<br>
            <b>Disclaimer: This page is only for educational purposes. Faker API can be found at <a href="https://fakerapi.it/en">https://fakerapi.it/en</a></br>
            <a href="http://www.csumb.edu"><img src="img/csumb.png" alt ="The CSUMB Logo" width="200"></a>
        </footer>
        
        <script>
            /*global $*/
            
            //check the user input
            function checkValid(){
                
                let valid = true;
                $("#emptyError").html("");
                $("#numberError").html("");
                
                //check that the user selected a category
                if($("#type").val() == "NA")
                {
                    $("#emptyError").html("You didn't select a category!");
                    valid = false;
                }
                
                //check that the quantity is a valid number
                if(!typeof($("#quantity").val()) === 'number')
                {
                    $("#numberError").html("This isn't a valid number!");
                    valid = false;
                }else if ($("#quantity").val() <= 0)
                {
                    $("#numberError").html("This isn't a valid number!");
                    valid = false;
                }
                
                return  valid;
            }
            
            //print data for persons
            async function printPerson(){
                let gender = $("#gender").val();
                let quantity = $("#quantity").val();
                let url =  `https://fakerapi.it/api/v1/persons?_quantity=${quantity}${gender}`;
                let response = await fetch(url);
                let data = await response.json();
                
                //for loop so that multiple persons can be printed
                $("#result").html("");
                for (let i=0;i<quantity;++i)
                {
                    $("#result").append(`Name: ${data.data[i].firstname} ${data.data[i].lastname}<br>`);
                    $("#result").append(`Date of Birth: ${data.data[i].birthday}<br>`);
                    $("#result").append(`Email: ${data.data[i].email}<br>`);
                    $("#result").append(`Phone Number: ${data.data[i].phone}<br>`);
                    $("#result").append(`City: ${data.data[i].address.city}, ${data.data[i].address.country}<br><br>`);
                }
            }
            
            //printbook and printcompany are essentially the same as printperson
            async function printBook(){
                let quantity = $("#quantity").val();
                let url =  `https://fakerapi.it/api/v1/books?_quantity=${quantity}`;
                let response = await fetch(url);
                let data = await response.json();
                
                $("#result").html("");
                for (let i=0;i<quantity;++i)
                {
                    $("#result").append(`Title: ${data.data[i].title}<br>`);
                    $("#result").append(`Author: ${data.data[i].author}<br>`);
                    $("#result").append(`Genre: ${data.data[i].genre}<br>`);
                    $("#result").append(`Published: ${data.data[i].published}<br><br>`);
                }
            }
            
            async function printCompany(){
                let quantity = $("#quantity").val();
                let url =  `https://fakerapi.it/api/v1/companies?_quantity=${quantity}`;
                let response = await fetch(url);
                let data = await response.json();
                
                $("#result").html("");
                for (let i=0;i<quantity;++i)
                {
                    $("#result").append(`Name: ${data.data[i].name}<br>`);
                    $("#result").append(`Email: ${data.data[i].email}<br>`);
                    $("#result").append(`Phone: ${data.data[i].phone}<br>`);
                    $("#result").append(`Country: ${data.data[i].country}<br><br>`);
                }
            }
            
            
            $("#thingForm").on("submit", function(e) {
                e.preventDefault();
                
                //make sure the input is valid
                if (checkValid() == false)
                {
                    
                    return;
                }
                
               
                //decide which function to use
                if ($("#type").val() == "0")
                {
                    printPerson();
                    return;
                }
                if ($("#type").val() == "1")
                {
                    printBook();
                    return;
                }
                printCompany();
               
            });
            
            //hide the gender option if the "Person" category isn't selected
            $("#type").on("change",function(){
                if($("#type").val() == "0"){
                    $("#genderOption").css("visibility", "visible");
                }else{
                    $("#genderOption").css("visibility", "hidden");
                }
            });
            
            $(document).ready(async function(){
                
                //generate the header image each time the page loads
                let url =  `https://fakerapi.it/api/v1/images?_quantity=1&_type=kittens&_height=300`;
                let response = await fetch(url);
                let data = await response.json();

                $("#photo").html(`<img src="${data.data[0].url}" alt="${data.data[0].title}" height="75" title="Refresh the page for more random cat images!"><figcaption>${data.data[0].description}<br>`)
                
                
            });
            
        </script>
        
    </body>
</html>