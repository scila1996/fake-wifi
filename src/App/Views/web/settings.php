<!DOCTYPE HTML>
<html>
    <head>
        <link rel="stylesheet" href="/asset/web/dist/css/bootstrap.css" />
        <link rel="stylesheet" href="/asset/web/dist/css/bootstrap-theme.min.css" />
        <script src="/asset/web/jquery-1.12.4.min.js"></script>
        <script src="/asset/web/jquery.validate.min.js"></script>
        <script src="/asset/web/dist/js/bootstrap.min.js"></script>
        <style>
            .body
            {
                font-family: "Times New Roman", Times, serif;
            }
            .no-border-radius
            {
                border-radius: 0px;
            }
            .no-underline
            {
                text-decoration: none;
            }
            .no-underline:hover
            {
                text-decoration: none;
            }
        </style>
        <title> Setup for Fake AP </title>
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-sm-8 col-sm-offset-2">
                    <form method="post" id="form-mic">
                        <h3 class="text-muted"> Configuration </h3>
                        <div class="form-group">
                            <h4 class="text-muted"> AP's name </h4>
                            <input type="text" class="form-control no-border-radius" placeholder="My Wifi" name="ap_name" value="<?= $opts['ap_name'] ?>" autofocus />
                        </div>
                        <div class="form-group">
                            <h4 class="text-muted"> Input Wifi password times </h4>
                            <input type="number" class="form-control no-border-radius" placeholder="2" name="pw_input_times" value="<?= $opts['pw_input_times'] ?>" autofocus />
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary"><strong><span class="glyphicon glyphicon-ok"></span>&nbsp; OK </strong></button>
                        </div>
                    </form>
                    <div class="form-group">
                        <ul class="list-group">
                            <?php
                            if ($pws->count()):
                                foreach ($pws as $p):
                                    ?>
                                    <li class="list-group-item"> <?= $p ?> </li>
                                    <?php
                                endforeach;
                            else:
                                ?>
                                <li class="list-group-item disabled"> Not Found </li>
                            <?php endif;
                            ?>
                        </ul>
                    </div>
                    <div class="form-group">
                        <a class="btn btn-danger" href="/clear"><strong><span class="glyphicon glyphicon-remove"></span>&nbsp; Delete All Passwords </strong></a>
                    </div>
                    <hr />
                </div>
            </div>
            <div class="row">
                <div class="col-sm-8 col-sm-offset-2">
                    <footer>
                        <em> Config settings & clean data </em><br />
                    </footer>
                </div>
            </div>
        </div>
        <script>
            $(document).ready(function () {
                $(document).on('focus', 'a, button', function () {
                    $(this).blur();
                });
                $('#form-mic').validate({
                    errorClass: 'text-danger',
                    rules: {
                        pass: {
                            required: true
                        }
                    },
                });
            });
        </script>
    </body>
</html>
