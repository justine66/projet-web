 
        function init(){

            $.ajax({url: "menu-bandeau.php", success: function(result){
                   $cpth = result;
                   $("#cpth").html(result);
               }});
        }