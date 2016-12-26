<!DOCTYPE html>
<html lang="en">
    <head>
        <title><?php echo $this->settings->info->site_name ?></title>         
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Bootstrap -->
        <link href="<?php echo base_url();?>bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">

         <!-- Styles -->
        <link href="<?php echo base_url();?>styles/login_layout.css" rel="stylesheet" type="text/css">
        <link href="<?php echo base_url();?>styles/responsive.css" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/themes/smoothness/jquery-ui.css" />

        <!-- SCRIPTS -->
        <script type="text/javascript">
        var global_base_url = "<?php echo site_url('/') ?>";
        </script>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <script src="<?php echo base_url();?>bootstrap/js/bootstrap.min.js"></script>
        <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>


        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
        

        <script type="text/javascript">
            $(document).ready(function() {
                $( document ).tooltip();
            });
        </script>

        <!-- CODE INCLUDES -->
        <?php echo $cssincludes ?> 
    </head>
    <body>

    <div class="container">
    <div class="row">
    <div class="col-md-12 top-margin">
        <?php $gl = $this->session->flashdata('globalmsg'); ?>
        <?php if(!empty($gl)) :?>
        		<div class="container projects-wrap">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="alert alert-success"><b><span class="glyphicon glyphicon-ok"></span></b> <?php echo $this->session->flashdata('globalmsg') ?></div>
                        </div>
                    </div>
                </div>
        <?php endif; ?>

        <?php echo $content ?>

    </div>
    </div>
    </div>

 

    </body>
</html>