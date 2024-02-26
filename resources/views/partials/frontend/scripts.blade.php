 <!-- Js Plugins -->
 <script src="{{url('frontend/js/jquery-3.3.1.min.js')}}"></script>
 <script src="{{url('frontend/js/bootstrap.min.js')}}"></script>
 <script src="{{url('frontend/js/jquery.nice-select.min.js')}}"></script>
 <script src="{{url('frontend/js/jquery.nicescroll.min.js')}}"></script>
 <script src="{{url('frontend/js/jquery.magnific-popup.min.js')}}"></script>
 <script src="{{url('frontend/js/jquery.countdown.min.js')}}"></script>
 <script src="{{url('frontend/js/jquery.slicknav.js')}}"></script>
 <script src="{{url('frontend/js/mixitup.min.js')}}"></script>
 <script src="{{url('frontend/js/owl.carousel.min.js')}}"></script>
 <script src="{{url('frontend/js/main.js')}}"></script>
 <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
 @stack('scripts')
 <script>
const Toast = Swal.mixin({
  toast: true,
  position: "top-end",
  showConfirmButton: false,
  timer: 3000,
  timerProgressBar: true,
  didOpen: (toast) => {
    toast.onmouseenter = Swal.stopTimer;
    toast.onmouseleave = Swal.resumeTimer;
  }
});

    function adding_cart(act,id,quantity,size) {

         $.ajax({
              headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'POST',
            url: `{{route('add.cart')}}`,
            data: {adding_cart:act,code:id,quantity:quantity,size:size},
            dataType:"json",
            beforeSend:function(request) {
                  return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
            },
            success:function (response) {
          //     let json = JSON.parse($.trim(response));

                $("#cartMenutb").load(location.href+" #cartMenutb > *");
                $("#cartMenu").load(location.href+" #cartMenu > *");
                $('#refreshme').css('visibility','hidden');
                 Toast.fire({
                    icon: response.status,
                    title: response.message
                    });

            }

        });
}
 </script>
