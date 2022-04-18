//Getting value from "ajax.php".

$(document).ready(function() {
    //On pressing a key on "Search box" in "search.php" file. This function will be called.

    $("#search").keyup(function() {
        // console.log("Ajax");
        //Assigning search box value to javascript variable named as "name".
        let name = $('#search').val();

        //Validating, if "name" is empty.
        if ( name.length >= 2) {
            console.log(name.length);
            $('.list-group').css('display', 'block');
            $.ajax({
                //AJAX type is "Post".
                type: "POST",
                //Data will be sent to "ajax.php".
                url: "/" + "ajax.php",
                //Data, that will be sent to "ajax.php".
                data: {
                    //Assigning value of "name" into "search" variable.
                    search: name
                },
                //If result found, this funtion will be called.
                success: function(html) {
                    //Assigning result to "display" div in "search.php" file.
                    $(".list-group").html(html);
                }
            });

        }
        if(name.length === 0)
        {
            $('.list-group').css('display', 'none');
        }

    });
});