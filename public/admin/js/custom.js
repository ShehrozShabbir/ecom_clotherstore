/**
 *
 * You can write your JS code here, DO NOT touch the default style file
 * because it will make it harder for you to update.
 *
 */

"use strict";
$("#Schedule_data").fadeOut(5);
$("#meeting_type").change(function() {
    let meeting_type=$("#meeting_type").val();

    if(meeting_type=='instant'){
        $("#Schedule_data").fadeOut(5);
    }else{
        $("#Schedule_data").fadeIn(5);
    }
});
$('#addClassModals').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) 
  let name = button.data('name') 
   let uid = button.data('uid') 
  var modal = $(this)
  modal.find('.modal-title').text(name)

   modal.find('.modal-body input[name="uid"]').val(uid)
})
$('#addCreditsModals').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) 
  let name = button.data('name') 
   let uid = button.data('uid') 
  var modal = $(this)
  modal.find('.modal-title').text(name)

   modal.find('.modal-body input[name="uid"]').val(uid)
})
$("#class_group_id_val,#meeting_date").change(function() {
    let classDay=$("#class_group_id_val :selected").data('day');
    let meeting_date=$("#meeting_date").val();
        
    if (classDay!="") {
        let getDay=getDayOfWeek(meeting_date);
        if (getDay!=classDay) {
                swal('Oops', 'Date of Class day should same', 'warning');
                $("#meeting_create_btn").prop('disabled',true);
        }else{
            $("#meeting_create_btn").prop('disabled',false);
        }

    }else{
        $("#meeting_create_btn").prop('disabled',true);
    }
});

function getDayOfWeek(dateString) {
  // Create a Date object from the input string
  const date = new Date(dateString);

  // Get the day of the week (0-6)
  const dayOfWeek = date.getDay();

  // Define an array of day names
  const daysOfWeek = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];

  // Get the day name based on the day of the week
  const dayName = daysOfWeek[dayOfWeek];

  return dayName;
}
