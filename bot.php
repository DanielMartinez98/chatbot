
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
</head>
<body>
    <div class="wrapper">
        <div class="title" id ="thisbt"><div class="x"><img src="chatbotLogo.png"  width="20" height="25" class="chtbot"><button class ="buttonX" id = "nextbt" value = "Show">X</button></div></div></button>
        <div id = "section">
            <div class="form">
                <div class="bot-inbox inbox">
                    <div class="icon">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="msg-header">
                        <p>Hola bienvenido a Elixr.com, soy un chat bot hecho para apoyarte a elegir un producto , ¿ cual es tu nombre ?</p>
                    </div>
                </div>
            </div>
            <div class="typing-field">
                <div class="input-data">
                    <input id="data" type="text" placeholder="Type something here.." required>
                    <button id="send-btn">Send</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        $amount = 0;
        $name ="";
        $(document).ready(function(){
           
            $("#send-btn").on("click", function(){
                
                $amount++;
                $value = $("#data").val();
                $msg = '<div class="user-inbox inbox"><div class="msg-header"><p>'+ $value +'</p></div></div>';
                $(".form").append($msg);
                $("#data").val('');
                if($amount>1)
                {
                // start ajax code
                    $.ajax({
                        url: 'message.php',
                        type: 'POST',
                        data: 'text='+$value,
                        success: function(result){
                            $replay = '<div class="bot-inbox inbox"><div class="icon"><i class="fas fa-user"></i></div><div class="msg-header"><p> Muchas gracias '+$name+result +'</p></div></div>';
                            $(".form").append($replay);
                            // when chat goes down the scroll bar automatically comes to the bottom
                            $(".form").scrollTop($(".form")[0].scrollHeight);
                        }
                    });
                }
                else
                {
                    $name = $value
                    $replay = '<div class="bot-inbox inbox"><div class="icon"><i class="fas fa-user"></i></div><div class="msg-header"><p> Hola '+$name +', ¿ donde piensas usar el perfume ? </p></div></div>';
                    $(".form").append($replay);
                    // when chat goes down the scroll bar automatically comes to the bottom
                    $(".form").scrollTop($(".form")[0].scrollHeight); 
                }
            });
            $("#thisbt").on("click", function(){
                if($("#nextbt").val() == "Hide")
                {
                    $(function() 
                    {
                    $("#section").show();
                    $("#nextbt").show();
                    $("#nextbt").val("Show");
                    
                    }); 
                }
            }); 
            $("#nextbt").on("click", function(){
                $(function() {
            $("#section").hide();
            $("#nextbt").hide();
            $("#nextbt").val("Hide");
            });
           
            
                 
        });
    });
    </script>
    
</body>
</html>