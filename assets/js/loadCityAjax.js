$( document ).ready(function() {
    var defaultCity = $("#default_city").val();
    $.ajax({
        type: "GET",
        url: '/clients/getCities',
        data: {default_city: defaultCity},
        success: function(data){
            $("#city_list_ajax").html(data);
        }
    });        
});