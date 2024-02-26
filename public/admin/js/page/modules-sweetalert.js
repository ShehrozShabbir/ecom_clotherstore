"use strict";

$("#swal-1").click(function() {
	swal('Hello');
});

$("#swal-2").click(function() {
	swal('Good Job', 'You clicked the button!', 'success');
});

$("#swal-3").click(function() {
	swal('Good Job', 'You clicked the button!', 'warning');
});

$("#swal-4").click(function() {
	swal('Good Job', 'You clicked the button!', 'info');
});

$("#swal-5").click(function() {
	swal('Good Job', 'You clicked the button!', 'error');
});

$("#swal-6").click(function() {
  swal({
      title: 'Are you sure?',
      text: 'Once deleted, you will not be able to recover this imaginary file!',
      icon: 'warning',
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
      swal('Poof! Your imaginary file has been deleted!', {
        icon: 'success',
      });
      } else {
      swal('Your imaginary file is safe!');
      }
    });
});

$("#swal-7").click(function() {
  swal({
    title: 'What is your name?',
    content: {
    element: 'input',
    attributes: {
      placeholder: 'Type your name',
      type: 'text',
    },

    },
  }).then((data) => {
    swal('Hello, ' + data + '!');
  });
});

$("#swal-8").click(function() {
  swal('This modal will disappear soon!', {
    buttons: false,
    timer: 3000,
  });
});
function disableStudent(id,user) {
    swal({
      title: 'Are you sure?',
      text: 'Do you want to disable it!',
      icon: 'warning',
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {

         $.ajax({
                url: '/admin/disable',
                type: 'POST',
                dataType: "json",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data:{disableId:id,type:user,action:"dis"},
                success: function (response) {
                    swal('', response.msg, response.sts);
                   setTimeout(function(){
                    location.reload();
                   },2000);
                  $('.dataTable1').load(".dataTable1 "+location.href);

                },
                error: function (xhr) {
                    console.log(xhr.responseText);
                }
          });

      } else {

      }
    });
}
function enableStudent(id,user) {
    swal({
      title: 'Are you sure?',
      text: 'Do you want to Enable it!',
      icon: 'warning',
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {

         $.ajax({
                url: '/admin/disable',
                type: 'POST',
                dataType: "json",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data:{disableId:id,type:user,action:"enable"},
                success: function (response) {
                    swal('', response.msg, response.sts);
                     setTimeout(function(){
                    location.reload();
                   },2000);
                  $('.dataTable1').load(".dataTable1 "+location.href);

                },
                error: function (xhr) {
                    console.log(xhr.responseText);
                }
          });

      }
    });
}
function deleteStudent(id,user) {
    swal({
      title: 'Are you sure?',
      text: 'Do you want to delete it!',
      icon: 'warning',
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {

         $.ajax({
                url: '/admin/disable',
                type: 'POST',
                dataType: "json",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data:{disableId:id,type:user,action:"dis"},
                success: function (response) {
                    swal('', response.msg, response.sts);
                     setTimeout(function(){
                    location.reload();
                   },2000);
                  $('.dataTable1').load(".dataTable1 "+location.href);

                },
                error: function (xhr) {
                    console.log(xhr.responseText);
                }
          });

      } else {

      }
    });
}
