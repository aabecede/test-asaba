<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    @php
        $breadcumb = Request::path();
        $breadcumb = explode('/', $breadcumb);
        if (count($breadcumb) > 4) {
            array_pop($breadcumb);
        }
        $first_breadcumb = explodeImplode($breadcumb[0]);
    @endphp
    <title> {{ucwords($first_breadcumb ?? 'Neraca Surga')}}</title>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    @stack('css')
    <style>
        .error{
            color: rgb(214, 83, 83)
        }
    </style>
  </head>
  <body>
    @include('BaseLayout.Header')

    <div class="container">
        @yield('content')
    </div>

    <div id="main-page-loading" style="background: transparent;position: fixed;top:20vh;left: 50vw;
        border-radius: 50%;
        width: 50px;
        height: 50px; padding:4px;display: none">
        <i class="fa fa-spinner fa-spin fa-3x text-primary"></i>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="{{asset('assets/plugins/editable/SimpleTableCellEditor.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/js/jquery.validate.min.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/js/all.min.js" integrity="sha512-rpLlll167T5LJHwp0waJCh3ZRf7pO6IT1+LZOhAyP6phAirwchClbTZV3iqL3BMrVxIYRbzGTpli4rfxsCK6Vw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        var BASE_URL = `{{ url('') }}`
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        initSelect2()
        function initSelect2(){
            $('.js-select2').select2({
                width: '100%'
            })
            $('.js-select2-tags').select2({
                width: '100%',
                tags: true
            })
        }

        function customValidatorVJs(button, form, load_main_page = true){
            if(load_main_page == true || load_main_page == 1){
                $('#main-page-loading').css('display', 'block').css('z-index', '99999')
            }
            $('.invalid-feedback').remove()
            $('.is-invalid').removeClass('is-invalid')
            let is_validated = form.valid()
            let loading = `<i class="fa fa-spinner fa-spin ml-10 hide" id="loading-button"></i>`

            $(button).append(loading)
            $(button).attr('disabled', true)
            $('.invalid-feedback').remove()
            $('.is-invalid').removeClass('is-invalid')
            $("#loading-button").removeClass('hide')

            if(is_validated == false){
                if((typeof main_loading != 'undefined' && main_loading == 1) || load_main_page == true){
                    $('#main-page-loading').css('display', 'none')
                }
                $(button).removeAttr('disabled')
                $("#loading-button").remove()
                return Swal.fire({
                    icon: 'error',
                    title: 'Gagal !',
                    text: 'Validasi Tidak Lengkap!',
                })
            }

            return is_validated
        }


        function callSwal(
            {
                type,
                title,
                text,url = 0
            }
        )
        {
            return Swal({
                type: type,
                title: title,
                html: text,
                timer:3000,
            }).then((result) => {
                if (result.dismiss != '' && !(url == "" || url==0)){
                    url = String(url)
                    if(url !== '0' || url != 0)
                    {
                        newurl = "{{url('')}}/"+url;
                        window.location.href = newurl;
                    }
                }
            });
        }
        function swalLoading(message = `Sedang memproses data ...`){
            Swal({
                    type : 'warning',
                    title : 'Harap menunggu',
                    html : message,
                    showCancelButton: false,
                    allowOutsideClick: false,
                    confirmButtonText: ``,
                    onOpen: () => {
                        Swal.showLoading()
                    }
                })
            return Swal;
        }
        function swalTerjadiKesalahanServer() {
            return Swal.fire({
                icon: 'error',
                title: 'Gagal !',
                text: 'Something went wrong!',
            })
        }
    </script>
    @stack('js')

  </body>
</html>
