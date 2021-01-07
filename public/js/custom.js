$(document).ready( function () {
    $('.forall').DataTable();
} );
$(document).ready(function () {
    var $body = document.body;
    var $menu_trigger = $body.getElementsByClassName("menu-trigger")[0];
    if (typeof $menu_trigger !== "undefined") {
        $menu_trigger.addEventListener("click", function () {
            $body.className = $body.className == "menu-active" ? "" : "menu-active";
        });
    }
    document.documentElement.setAttribute("data-agent", navigator.userAgent);
});

$(document).on('click', '.dropdown-menu', function (e) {
  e.stopPropagation();
});

// make it as accordion for smaller screens
if ($(window).width() < 992) {
  $('.dropdown-menu a').click(function(e){
    e.preventDefault();
      if($(this).next('.submenu').length){
        $(this).next('.submenu').toggle();
      }
      $('.dropdown').on('hide.bs.dropdown', function () {
     $(this).find('.submenu').hide();
  })
  });
}
$("#subject_wise").change(function(){
   if($(this).val()=="1")
   {
       $(".class-wise-subject").show();
   }
    else
    {
        $(".class-wise-subject").hide();
    }
});

$("#subject_wise").change(function(){
   if($(this).val()=="2")
   {
       $(".course-wise-subject").show();
   }
    else
    {
        $(".course-wise-subject").hide();
    }
});
$(document).ready( function () {
    $('#for_all').DataTable();
} );
$("#subject_type").change(function(){
   if($(this).val()=="1")
   {
       $(".academic_div").show();
   }
    else
    {
        $(".academic_div").hide();
    }
});
$("#subject_type").change(function(){
   if($(this).val()=="2")
   {
       $(".highered_div").show();
   }
    else
    {
        $(".highered_div").hide();
    }
});
$("#subject_type").change(function(){
   if($(this).val()=="3")
   {
       $(".course_div").show();
   }
    else
    {
        $(".course_div").hide();
    }
});
$("#subject_type1").change(function(){
   if($(this).val()=="1")
   {
       $(".academic_div").show();
   }
    else
    {
        $(".academic_div").hide();
    }
});
$("#subject_type1").change(function(){
   if($(this).val()=="2")
   {
       $(".highered_div").show();
   }
    else
    {
        $(".highered_div").hide();
    }
});
$("#subject_type1").change(function(){
   if($(this).val()=="3")
   {
       $(".course_div").show();
   }
    else
    {
        $(".course_div").hide();
    }
});
$(document).ready(function(){
$('.add_hiw').click(function() {
    $('.block_op:last').after('<div class="block_op"><div class="row"><div class="col-sm-2"> <label for="hiw-position">Position</label> <input type="text" class="text-control" name="position[]"  value="1" placeholder="Enter Position"></div><div class="col-sm-3"> <label for="hiw-title">Title</label> <input type="text" class="text-control" name="title[]" value="Choose a Salon service" placeholder="Enter Title"></div><div class="col-sm-5"> <label for="hiw-title">Description</label> <input type="text" class="text-control" name="description[]" value="Select from various salon packages & services" placeholder="Enter description"></div> <span class="remove_hiw"><i class="fa fa-minus"></i> Remove</span></div></div></div>');
});
$('.hiw-boxes').on('click','.remove_hiw',function() {
 	$(this).parent().remove();
});
	});

var ctx = document.getElementById('myChart').getContext('2d');
var chart = new Chart(ctx, {
    // The type of chart we want to create
    type: 'line',

    // The data for our dataset
    data: {
        labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
        datasets: [{
            label: 'Registration (this week)',
            backgroundColor: '#006EAC',
            borderColor: '#015C8C',
            data: [0, 10, 5, 2, 20, 30, 45]
        }]
    },

    // Configuration options go here
    options: {}
});
new Chart(document.getElementById("polar-chart"), {
    type: 'polarArea',
    data: {
      labels: ["Africa", "Asia", "Europe", "Latin America", "North America"],
      datasets: [
        {
          label: "Registration (Traffic)",
          backgroundColor: ["#3e95cd", "#8e5ea2","#3cba9f","#e8c3b9","#c45850"],
          data: [2478,5267,734,784,433]
        }
      ]
    },
    options: {
      title: {
        display: true,
        text: 'Registration (traffic)'
      }
    }
});
