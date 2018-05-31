<!DOCTYPE HTML>
<html>
<head>
    <title><?php echo $__title; ?></title>
    <link rel="stylesheet" type="text/css" href="<?php echo getoption('http_script_dir'); ?>/skins/default.css">
    <script type="text/javascript" src="<?php echo getoption('http_script_dir'); ?>/skins/cute.js"></script>
    <style>
        <?php if ($__style)
        {
            $_styles = spsep($__style);

            foreach ($_styles as $_style)
            {
                $f = fopen(SKIN.DIRECTORY_SEPARATOR.trim($_style), 'r');
                fpassthru($f);
                fclose($f);
            }

            unset($__style, $_styles, $_style);
        }
        ?>

        body { margin: 0; padding: 0; }
    </style>
</head>
<body>

<?php echo $__content; ?>

</body>
</html>