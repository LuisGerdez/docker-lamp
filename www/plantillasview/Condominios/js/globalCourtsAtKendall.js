let cont = 0;
$(document).ready(function () {
    
    $(document).on("click", "#add", function () {
        let datos = $("#campospages2").html();
        if(cont<=6){        
            cont++;
            let page = $("#pageChildren").append("<table class='camposCopyChildren"+cont+"'>" + datos + "</table>");
        }
        if (cont == 1 ) {
            cont++;
            let page = $("#page2").after("<div class='whiteblock' id='pageChildren'>\
            <table class='camposCopyChildren"+cont+"'>" + datos + "</table></div>");          
        }      
    });
    $(document).on("click", "#basura", function () {
        $(".camposCopyChildren"+cont+"").remove();    

        if(cont>=1){
            cont--;
        }
        if(cont==1){
            alert("termine")
            $("#pageChildren").remove();
        }
      
    })

});