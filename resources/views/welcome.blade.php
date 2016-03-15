<!DOCTYPE HTML>
<html>
<head>
    @include('layouts.head')
</head>
    <body>
        <script type="text/javascript" charset="utf-8">
          webix.ui(@include('auth.ui'));
          @include('auth.logic')
        </script>
    </body>
</html>
