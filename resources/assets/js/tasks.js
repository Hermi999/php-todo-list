$( document ).ready(function(){
  $(".task-resolved").change(function(){
    var task_id = $(this).data("taskid");
    var task_resolved = $(this).is(":checked");

    $.ajax({
      url: '/task/' + task_id,
      type: 'PUT',
      data: {resolved: task_resolved},
      success: function(res){
        var text = (res.resolved)?"resolved":"unresolved";

        if($(".notification").is(":visible")){
          var last = $(".notification").last();
          var id_neu = parseInt(last.attr("id").replace( /^\D+/g, ''))+1;

          last.clone()
              .attr("id", "notification-"+id_neu)
              .addClass("removable-notification")
              .css({top: (parseFloat(last.css('top')) + 75) + 'px',
                    backgroundColor: "rgba(0, 150, 136, 0.91)",
                    opacity: 1,
                    })
              .html("Successfully " + text)
              .insertAfter(last)
              .fadeOut(4000);
        }else{
          $(".removable-notification").remove();
          $("#notification-1").html("Successfully " + text)
                              .css({backgroundColor: "rgba(0, 150, 136, 0.91)",
                                  opacity: 1})
                              .show()
                              .fadeOut(4000);
        }
      },
      error: function(){
        $("#notification-1").html("Server error occured")
                            .css("background-color", "red")
                            .show()
                            .fadeOut(4000);
      }
    });
  });
});