/**
 * Created by saan on 10/11/13.
 */

var callInsumos ={

        handlerData:function(resJSON){

            var templateSource   = $("#student-template").html(),

                template = Handlebars.compile(templateSource),

                studentHTML = template(resJSON);

           $('#my-container').html(studentHTML);
            console.log($("#student-template"))
        },
        loadData : function(){

            $.ajax({
                url:"http://localhost/requisiciones/requisiciones/getJson",
                method:'get',
                success:this.handlerData

            })
        }
};
