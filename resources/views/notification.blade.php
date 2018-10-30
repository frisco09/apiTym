    <!DOCTYPE html>
    <html>
    <head>
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.css">
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    </head>
    <body>
    <div class="container">
    </div>
    <script>
      @if(Session::has('notification'))
      alert("{{ Session::get('notification.alert-type') }}");
        var type = "{{ Session::get('notification.alert-type', 'info') }}";
        switch(type){
            case 'info':
                toastr.info("{{ Session::get('notification.message') }}");
                break;
            
            case 'warning':
                toastr.warning("{{ Session::get('notification.message') }}");
                break;
            case 'success':
                toastr.success("{{ Session::get('notification.message') }}");
                break;
            case 'error':
                toastr.error("{{ Session::get('notification.message') }}");
                break;
        }
      @endif
    </script>
    </body>
    </html>