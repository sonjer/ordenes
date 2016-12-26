<!DOCTYPE html>
<html lang="en">
<head>
    <title><?php echo $this->settings->info->site_name ?></title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap -->
    <link href="<?php echo base_url();?>bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link rel="icon" type="image/png" href="http://example.com/myicon.png">
    <!-- Styles -->
    <link href="<?php echo base_url();?>styles/main.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url();?>styles/dashboard.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url();?>styles/responsive.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url();?>styles/openSans.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url();?>styles/jquery-ui.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url();?>styles/jquery.dataTables.css" rel="stylesheet" type="text/css">

    <!-- SCRIPTS -->
    <script type="text/javascript">
        var global_base_url = "<?php echo site_url('/') ?>";
    </script>
    <script src="<?php echo base_url();?>bootstrap/js/jquery.min.js"></script>
    <script src="<?php echo base_url();?>bootstrap/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url();?>bootstrap/js/jquery-ui.min.js"></script>
    <script src="<?php echo base_url();?>bootstrap/js/jquery.dataTables.js"></script>
    <script src="<?php echo base_url();?>bootstrap/js/angular.min.js"></script>
    <script src="<?php echo base_url();?>bootstrap/js/helper.js"></script>
    <script src="<?php echo base_url();?>bootstrap/js/directivas.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $(document).tooltip();
        });
    </script>

    <!-- CODE INCLUDES -->
    <?php echo $cssincludes ?>
</head>
<body>

    <nav class="navbar navbar-header2 navbar-inverse navbar-fixed-top">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?php echo site_url() ?>" title="<?php echo $this->settings->info->site_name ?>">
                    <img src="<?php echo base_url() ?><?php echo $this->settings->info->upload_path_relative ?>/<?php echo $this->settings->info->site_logo ?>" width="123" height="32"></a>
                    <strong style="color: #E87E04">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;El sistema intranet solo funciona con navegadores Google Chrome o Firefox.</strong>
            </div>

            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav navbar-right">
                    <?php if($this->user->loggedin) : ?>
                    <li><a href="<?php echo site_url("user_settings") ?>"><?php echo $this->user->info->email ?></a></li>
                    <li><a href="<?php echo site_url("login/logout/" . $this->security->get_csrf_hash()) ?>"><span class="glyphicon glyphicon-log-out"></span></a></li>
                    <?php else : ?>
                    <li><a href="<?php echo site_url("login") ?>"><?php echo lang("ctn_150") ?></a></li>
                    <li><a href="<?php echo site_url("register") ?>"><?php echo lang("ctn_151") ?></a></li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>
    <!--  INICIO PAGE CONTENT -->
    <div class="container-fluid">
        <div class="row">
<!-- INICIO SIDEBAR -->
<div class="col-sm-3 col-md-2 sidebar">
    <?php if($this->user->loggedin) : ?>
    <div class="active-project">
        <table>
            <tr>
                <td width="55">
                    <img src="<?php echo base_url() ?><?php echo $this->settings->info->upload_path_relative ?>/<?php echo $this->user->info->avatar ?>" class="user_avatar">
                </td>
                <td valign="top">
                    <h5 class="user_name_display"><a href="<?php echo site_url("user_settings") ?>" class="white-link"><?php echo $this->user->info->username ?></a></h5>
                    <p class="user_level_display"><?php echo $this->common->getAccessLevel($this->user->info->user_level) ?></p>
                </td>
            </tr>
        </table>
    </div>
    <?php else: ?>
    <div class="active-project">
        <table>
            <tr>
                <td>
                    <h5 class="active-project-title"><?php echo lang("ctn_154") ?></h5>
                    <p><a href="<?php echo site_url("login") ?>" class="btn btn-success btn-xs"><?php echo lang("ctn_150") ?></a> <a href="<?php echo site_url("register") ?>" class="btn btn-primary btn-xs"><?php echo lang("ctn_151") ?></a></p>
                </td>
            </tr>
        </table>
    </div>
    <?php endif; ?>

    <?php if(isset($sidebar)) : ?>
    <?php// echo $sidebar ?>
    <?php endif; ?>

<!-- MENU CAJA -->
  <?php if($this->user->loggedin && $this->permisos->info->idModulo == 3) : ?>
  <ul class="newnav nav nav-sidebar">
      <li id="requisiciones_rq">
          <a data-toggle="collapse" data-parent="#insumos_menu" href="#insumos_menu_c" class="collapsed bolded <?php if(isset($activeLink['compras'])) echo "active" ?>" >
              <span class="glyphicon glyphicon-list-alt"></span> ORDENES DE COMPRA
              <span class="plus-sidebar"><span class="glyphicon glyphicon-chevron-down"></span></span>
          </a>
          <div id="insumos_menu_c" class="panel-collapse collapse sidebar-links-inner <?php if(isset($activeLink['insumos'])) echo "in" ?>">
              <ul class="inner-sidebar-links">
                  <?php if($this->user->info->user_level >= 4)  : ?>
                  <li class="<?php if(isset($activeLink['compras']['compras'])) echo "active" ?>">
                      <a href="<?php echo site_url("ordenescompra/compras") ?>">
                          <span class="glyphicon glyphicon-file"></span> POR AUTORIZAR <span class="sr-only">(current)</span>
                      </a>
                  </li>
                  <?php endif; ?>
              </ul>
              <ul class="inner-sidebar-links">
                  <?php if($this->user->info->user_level >= 4)  : ?>
                  <li class="<?php if(isset($activeLink['compras']['ordenes'])) echo "active" ?>">
                      <a href="<?php echo site_url("ordenescompra/comprasVistoBueno") ?>">
                          <span class="glyphicon glyphicon-file"></span> VO-BO <span class="sr-only">(current)</span>
                      </a>
                  </li>
                  <?php endif; ?>
              </ul>
              <ul class="inner-sidebar-links">
                  <?php if($this->user->info->user_level >= 4)  : ?>
                  <li class="<?php if(isset($activeLink['compras']['ordenes'])) echo "active" ?>">
                      <a href="<?php echo site_url("ordenescompra/comprasAut") ?>">
                          <span class="glyphicon glyphicon-file"></span> AUTORIZADAS <span class="sr-only">(current)</span>
                      </a>
                  </li>
                  <?php endif; ?>
              </ul>
          </div>
      </li>
   </ul>
   <?php endif; ?>
</div>
<!-- FIN SIDEBAR -->
<!-- INICIO VISTAS -->
<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
    <?php $gl = $this->session->flashdata('msg'); ?>
        <?php if(!empty($gl)) :?>
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-<?php echo $this->session->flashdata('class') ?> alert-dismissible fade in" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <span class="glyphicon glyphicon-info-sign"></span></b> <?php echo $this->session->flashdata('msg') ?>
                </div>
            </div>
        </div>
    <?php endif; ?>
    <?php $gl = $this->session->flashdata('globalmsg'); ?>
    <?php if(!empty($gl)) :?>
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-success alert-dismissible fade in" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <span class="glyphicon glyphicon-ok"></span></b> <?php echo $this->session->flashdata('globalmsg') ?>
            </div>
        </div>
    </div>
    <?php endif; ?>
    <?php $gl = $this->session->errordata('mensaje'); ?>
    <?php if(!empty($gl)) :?>
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-danger alert-dismissible fade in" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <span class="glyphicon glyphicon-ok"></span></b> <?php echo $this->session->errordata('globalmsg') ?>
            </div>
        </div>
    </div>
    <?php endif; ?>
    <?php echo $content ?>
</div>
<!-- FIN VISTAS -->
        </div>
    </div>
    <!--  FIN PAGE CONTENT -->
</body>
</html>
