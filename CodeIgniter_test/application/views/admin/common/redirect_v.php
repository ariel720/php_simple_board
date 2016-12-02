<!DOCTYPE HTML>
<html lang="en-US">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="refresh" content="0; url=<?=$back_url?>" />
        <? if (!empty($alert)) { ?>
        <script type="text/javascript">
            alert("<?=$alert?>");
        </script>
        <? } ?>
        <script type="text/javascript">
            window.location.href = "<?=$back_url?>"
        </script>
        <title>Page Redirection</title>
    </head>
    <body>
        If you are not redirected automatically, follow the <a href='<?=$back_url?>'>link to example</a>
    </body>
</html>