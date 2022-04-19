<!DOCTYPE html>
<html lang="en">

<head>
    <title>Bootstrap Example</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>
    <select class="country">
        <option value="usa">United States</option>
        <option value="india">India</option>
        <option value="uk">United Kingdom</option>
    </select>
    <input id="input" style="display: none"  type="text" name="name" placeholder="Write Something">
<p>hello</p>
</body>
<script>
    $(document).ready(function(){
        $('.country').change(function(){
            // alert($(this).children('option:selected').val())
            var x = $(this).children('option:selected').val();
            if(x=='india'){
                // $('#input').css('display':'none');
                $("#input").css("display", "block");
            }
            if(x=='uk'){
                // $('#input').css('display':'none');
                $("#input").css("display", "none");
            }
        })
    })
</script>
</html>
