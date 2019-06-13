$( document ).ready(function() {
    console.log( "ready!" );
    
    $("#reg_form").submit(function (e) {
                var url = "/commands/register.php";
                var $that = $(this);
                var formData = new FormData($that.get(0));
                $.ajax({
                    contentType: false, 
                    processData: false, 
                    type: "POST",
                    url: url,
                    //data: $("#reg_form").serialize(),
                    data: formData,
                    success: function (data)
                    {   
                        console.log(data);
                        $('#profile').html(data);
                    }
                });
                e.preventDefault();
            });

    $("#login_form").submit(function (e) {
                var url = "/commands/login.php";
                var $that = $(this);
                var formData = new FormData($that.get(0));
                $.ajax({
                    contentType: false, 
                    processData: false, 
                    type: "POST",
                    url: url,
                    //data: $("#reg_form").serialize(),
                    data: formData,
                    success: function (data)
                    {   
                        console.log(data);
                        $('#profile').html(data);
                    }
                });
                e.preventDefault();
            });
   
    
});    