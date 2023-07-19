<!-- jquery -->
<script src="{{ URL::asset('public/assets/js/jquery-3.3.1.min.js') }}"></script>
<!-- plugins-jquery -->
<script src="{{ URL::asset('public/assets/js/plugins-jquery.js') }}"></script>
<!-- jquery.nicescroll -->
{{-- <script src="{{ URL::asset('public/assets/js/nicescroll/jquery.nicescroll.js') }}"></script> --}}
<!-- plugin_path -->
<script>

    var plugin_path = '{{ asset("public/assets/js/") }}'+'/';

    //console.log(plugin_path);

</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>

<!-- chart -->
<script src="{{ URL::asset('public/assets/js/chart-init.js') }}"></script>
<!-- calendar -->
<script src="{{ URL::asset('public/assets/js/calendar.init.js') }}"></script>
<!-- charts sparkline -->
<script src="{{ URL::asset('public/assets/js/sparkline.init.js') }}"></script>
<!-- charts morris -->
<script src="{{ URL::asset('public/assets/js/morris.init.js') }}"></script>
<!-- datepicker -->
<script src="{{ URL::asset('public/assets/js/datepicker.js') }}"></script>
<!-- sweetalert2 -->
<script src="{{ URL::asset('public/assets/js/sweetalert2.js') }}"></script>
<!-- toastr -->
@yield('js')
<script src="{{ URL::asset('public/assets/js/toastr.js') }}"></script>
<!-- validation -->
<script src="{{ URL::asset('public/assets/js/validation.js') }}"></script>
<!-- lobilist -->
<script src="{{ URL::asset('public/assets/js/lobilist.js') }}"></script>
<!-- custom -->
<script src="{{ URL::asset('public/assets/js/custom.js') }}"></script>

<script>
  function CheckAll(ClassName,elem){
    let elements = document.getElementsByClassName(ClassName);
    let l = elements.length;

    if(elem.checked){
        for(let i = 0; i < l ; i++){
                elements[i].checked = true;
            }
        }else{

            for(let i = 0; i < l ; i++){
               elements[i].checked = false;
            }

        }
    }
</script>

 @livewireScripts
