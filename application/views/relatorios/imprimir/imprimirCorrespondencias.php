  <head>
    <title>Sistema de Gestão de Documentos</title>
    <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap-responsive.min.css" />
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/fullcalendar.css" />
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/main.css" />
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/blue.css" class="skin-color" />
    <script type="text/javascript"  src="<?php echo base_url();?>assets/js/jquery-1.10.2.min.js"></script>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /></head>

  <body style="background-color: transparent">



      <div class="container-fluid">

          <div class="row-fluid">
              <div class="span12">

                  <div class="widget-box">
                      <div class="widget-title">
                          <h4 style="text-align: center">Correspondências</h4>
                      </div>
                      <div class="widget-content nopadding">

                  <table class="table table-bordered">
                    <thead>
                      <tr>
                          <th style="font-size: 1.2em; padding: 5px; text-align: center">Correspondência</th>
                          <th style="font-size: 1.2em; padding: 5px;  text-align: center">Tipo Proviniência</th>
                          <th style="font-size: 1.2em; padding: 5px;  text-align: center">Prioridade</th>
                          <th style="font-size: 1.2em; padding: 5px;  text-align: center">Ref. de Recepção</th>
                          <th style="font-size: 1.2em; padding: 5px;  text-align: center">Usuário</th>
                          <th style="font-size: 1.2em; padding: 5px;  text-align: center">Data</th>
                          </tr>
                      </thead>
                      <tbody>
                          <?php
                          foreach ($correspondencias as $c) {
                              echo '<tr>';
                              echo '<td>' . $c->numCorrespondencia. '</td>';
                              echo '<td>' . $c->tipo_pro . '</td>';
                              echo '<td>' . $c->prioridades . '</td>';
                              echo '<td>' . $c->refRec . '</td>';
                              echo '<td>' . $c->usuarios . '</td>';
                              echo '<td>' . $c->date. '</td>';
                              echo '</tr>';
                          }
                          ?>
                      </tbody>
                  </table>

                  </div>

              </div>
                  <h5 style="text-align: right">Data do Relatório: <?php echo date('d/m/Y');?></h5>

          </div>



      </div>
</div>


  </body>
</html>

