<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Faker API Fake Info Generator</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <link href="css/styles.css" rel="stylesheet" type="text/css" />
    </head>
    
    <body>
        <h1>Your Generated Person!</h1><br><br>
        
        <?php echo $_GET["gender"]; ?>
        
        <footer>
            <hr>CST336 Internet Programming. Copyright Sean Wilson &copy;2020<br>
            <b>Disclaimer: This page is only for educational purposes. Faker API can be found at <a href="https://fakerapi.it/en">https://fakerapi.it/en</a></b>
            <a href="http://www.csumb.edu"><img src="img/csumb.png" alt ="The CSUMB Logo" width="200"></a>
        </footer>
        
        <script>
        var gender = <?php echo $_GET["gender"]; ?>;
        
            $(document).ready(async function(){
                alert("hi");
                let url =  `https://fakerapi.it/api/v1/persons?_quantity=1&_gender=${gender}`;
                let response = await fetch(url);
                let data = await response.json();
            });
        </script>
        
    </body>
</html>