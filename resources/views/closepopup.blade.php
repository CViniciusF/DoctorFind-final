<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
    <script type="text/javascript">
      console.log(window.opener);
      window.opener.location.href = '{{$url}}';
      window.close();
    </script>
  </head>
</html>
