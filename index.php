<?php
require_once('Connections/conexao.php');
//Seleciona os produtos
$sql = "SELECT nome, preco, categoria, descricao FROM produtos WHERE publicado='S'";
$result_product = mysql_query($sql,$connection) or die ("Error in table selection.");
$row_product = mysql_fetch_assoc($result_product);
$totalRows_product = mysql_num_rows($result_product);

//verifica se os preços serão exibidos
$sql = "SELECT exibir FROM exibir_precos";
$result_view = mysql_query($sql,$connection) or die ("Error in table selection.");
$row_view = mysql_fetch_assoc($result_view);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Snooker Sport Pub</title>
  <meta name="description" content="O melhor e mais completo Pub Esportivo de Lavras e região.">
  <meta name="keywords" content="Snooker, pub, bar, Lavras, cerveja">

  <link rel="stylesheet" type="text/css" href="fonts/satisfy.css">
  <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="css/style.css">

</head>
<body>
  <!--banner-->
  <section id="banner">
    <div class="bg-color">
      <header id="header">
        <div class="container">
          <div id="mySidenav" class="sidenav">
            <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
            <a href="#historia">História</a>
            <a href="#event">Eventos</a>
            <a href="#cardapio">Cardápio</a>
            <a href="#reserva">Reservas</a>
          </div>
          <!-- Use any element to open the sidenav -->
          <span onclick="openNav()" class="pull-right menu-icon">☰</span>
        </div>
      </header>
      <div class="container">
        <div class="row">
          <div class="inner text-center">
            <img src="img/snooker.png" class="logo-name">
            <p>O PUB QUE A GALERA AMA!</p>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- / banner -->
  <!--about-->
  <section id="historia" class="section-padding">
    <div class="container">
      <div class="row">
        <div class="col-md-12 text-center marb-35">
          <h1 class="header-h">História</h1>
          <p class="header-p">O melhor e mais completo Pub Esportivo de Lavras e região.</p>
        </div>
        <div class="col-md-1"></div>
        <div class="col-md-10">
          <div class="col-md-6 col-sm-6">
            <div class="about-info">
              <p class="text-justify">Pub (pronuncia-se pâb) é uma abreviação do inglês public house, cujo significado é casa pública, e designa um tipo de bar muito popular no Reino Unido, República da Irlanda e outros países de influência britânica, como Austrália, Nova Zelândia e Estados Unidos, onde são servidas bebidas (principalmente alcoólicas) e petiscos.</p>
              <div class="details-list">
                <ul>
                  <li class="text-justify"><i class="fa fa-check"></i>Distingue-se de outros bares por manter o estilo medieval com pouca iluminação, o que o transforma num ambiente muito acolhedor.</li>
                  <li class="text-justify"><i class="fa fa-check"></i>É o local ideal para beber uma cerveja após o trabalho ou ponto de encontro de amigos. Em alguns pubs é possível ouvir música ao vivo, assistir a jogos de futebol ou jogar sinuca, por exemplo.</li>
                </ul>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-sm-6">
            <img src="img/res01.jpg" alt="" class="img-responsive">
          </div>
        </div>
        <div class="col-md-1"></div>
      </div>
    </div>
  </section>
  <!--/about-->
  <!-- event -->
  <section id="event">
    <div class="bg-color" class="section-padding">
      <div class="container">
        <div class="row">
          <div class="col-xs-12 text-center" style="padding:60px;">
            <h1 class="header-h">Próximo evento</h1>
          </div>
          <div class="col-md-12" style="padding-bottom:60px;">
            <div class="item active left">
              <div class="col-md-6 col-sm-6 left-images">
                <img src="img/res02.jpg" class="img-responsive">
              </div>
              <div class="col-md-6 col-sm-6 details-text">
                <div class="content-holder">
                  <h2>Nome do evento</h2>
                  <p>Descrição descrição descrição descrição descrição descrição descrição descrição descrição descrição descrição descrição descrição descrição descrição descrição descrição descrição.</p>
                  <address>
                    <strong>Local: </strong>
                    Snooker Sport Pub
                    <br>
                    <strong>Horário: </strong>
                    20:30
                  </address>
                  <a class="btn btn-imfo btn-read-more" href="events-details.html">Ver mais eventos</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!--/ event -->
  <!-- menu -->
  <section id="cardapio" class="section-padding">
    <div class="container">
      <div class="row">
        <div class="col-md-12 text-center marb-35">
          <h1 class="header-h">Cardápio</h1>
          <p class="header-p">Já dizia o sábio: Nunca fiz amigos bebendo leite. </p>
        </div>
        <div class="col-md-12  text-center gallery-trigger">
          <ul>
            <li><a class="filter" data-filter="all">Todos</a></li>
            <li><a class="filter" data-filter=".category-1">Cervejas</a></li>
            <li><a class="filter" data-filter=".category-2">Drinks</a></li>
            <li><a class="filter" data-filter=".category-3">Aperitivos</a></li>
          </ul>
        </div>
        <div id="Container">
          <?php
          do{
            switch ($row_product['categoria']) {
              case 'C':
              $category = 'category-1';
              break;
              case 'D':
              $category = 'category-2';;
              break;
              case 'A':
              $category = 'category-3';;
              break;
            }
            ?>
            <div class="mix <?php echo $category; ?> menu-restaurant" data-myorder="2">
              <span class="clearfix">
                <a class="menu-title" href="#" data-meal-img="assets/img/restaurant/rib.jpg"><?php echo $row_product['nome']; ?></a>
                <span style="left: 166px; right: 44px;" class="menu-line"></span>
                <?php if($row_view['exibir']=='S'){ ?>
                    <span class="menu-price"><?php echo $row_product['preco']; ?></span>
                <?php } ?>
              </span>
              <span class="menu-subtitle"><?php echo $row_product['descricao']; ?></span>
            </div>
            <?php } while ($row_product = mysql_fetch_assoc($result_product)); ?>
        </div>
      </div>
    </div>
  </section>
  <!--/ menu -->
  <!-- contact -->
  <section id="reserva" class="section-padding">
    <div class="container">
      <div class="row">
        <div class="col-md-12 text-center">
          <h1 class="header-h">Reserva de mesa</h1>
          </div>
        </div>
        <div class="row msg-row">
          <div class="col-md-4 col-sm-4 mr-15">
            <div class="media-2">
              <div class="media-left">
                <div class="contact-phone bg-1 text-center"><span class="phone-in-talk fa fa-phone"></span></div>
              </div>
              <div class="media-body">
                <h4 class="dark-blue regular">Telefone</h4>
                <p class="light-blue regular alt-p">(35) 9 9999-9999</p>
              </div>
            </div>
            <div class="media-2">
              <div class="media-left">
                <div class="contact-email bg-14 text-center"><span class="hour-icon fa fa-clock-o"></span></div>
              </div>
              <div class="media-body">
                <h4 class="dark-blue regular">Horários de funcionamento</h4>
                <p class="light-blue regular alt-p"> Quinta a Sábado 19:00 - 01:00</p>
                <p class="light-blue regular alt-p">
                  Domingo 16:30 - 23.00
                </p>
              </div>
            </div>
          </div>
          <div class="col-md-8 col-sm-8">
            <form action="" method="post" role="form" class="contactForm">
              <div id="sendmessage">Your booking request has been sent. Thank you!</div>
              <div id="errormessage"></div>
              <div class="col-md-6 col-sm-6 contact-form pad-form">
                <div class="form-group label-floating is-empty">
                  <input type="text" name="name" class="form-control" id="name" placeholder="Seu nome" data-rule="minlen:4" data-msg="Please enter at least 4 chars" />
                  <div class="validation"></div>
                </div>

              </div>
              <div class="col-md-6 col-sm-6 contact-form">
                <div class="form-group">
                  <input type="date" class="form-control label-floating is-empty" name="date" id="date" placeholder="Data" data-rule="required" data-msg="This field is required" />
                  <div class="validation"></div>
                </div>
              </div>
              <div class="col-md-6 col-sm-6 contact-form pad-form">
                <div class="form-group">
                  <input type="email" class="form-control label-floating is-empty" name="email" id="email" placeholder="Seu E-mail" data-rule="email" data-msg="Please enter a valid email" />
                  <div class="validation"></div>
                </div>
              </div>
              <div class="col-md-6 col-sm-6 contact-form">
                <div class="form-group">
                  <input type="time" class="form-control label-floating is-empty" name="time" id="time" placeholder="Horário de chegada" data-rule="required" data-msg="This field is required" />
                  <div class="validation"></div>
                </div>
              </div>
              <div class="col-md-6 col-sm-6 contact-form">
                <div class="form-group">
                  <input type="text" class="form-control label-floating is-empty" name="phone" id="phone" placeholder="Telefone" data-rule="required" data-msg="This field is required" />
                  <div class="validation"></div>
                </div>
              </div>
              <div class="col-md-6 col-sm-6 contact-form">
                <div class="form-group">
                  <input type="text" class="form-control label-floating is-empty" name="people" id="people" placeholder="Nº de pessoas" data-rule="required" data-msg="This field is required" />
                  <div class="validation"></div>
                </div>
              </div>
              <div class="col-md-12 contact-form">
                <div class="form-group label-floating is-empty">
                  <textarea class="form-control" name="message" rows="5" rows="3" data-rule="required" data-msg="Please write something for us" placeholder="Mensagem"></textarea>
                  <div class="validation"></div>
                </div>

              </div>
              <div class="col-md-12 btnpad">
                <div class="contacts-btn-pad">
                  <button class="contacts-btn">Reservar</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </section>
    <!-- / contact -->
    <!-- footer -->
    <footer class="footer text-center">
      <div class="footer-top">
        <div class="row">
          <div class="col-md-offset-3 col-md-6 text-center">
            <div class="widget">
              <img src="img/snooker-footer.png" class="widget-title">
              <address>
                Rua Barão do Rio Branco 182<br/>
                Lavras-MG 37200-000
              </address>
              <div class="social-list">
                <a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                <a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
              </div>
              <p class="copyright clear-float">
                © Snooker Sport Pub. Todos os direitos reservados.
                <div class="credits">
                  <!--
                  All the links in the footer should remain intact.
                  You can delete the links only if you purchased the pro version.
                  Licensing information: https://bootstrapmade.com/license/
                  Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/buy/?theme=Delicious
                -->
                <!-- Designed by <a href="https://bootstrapmade.com/">Free Bootstrap Themes</a> -->
              </div>
            </p>
          </div>
        </div>
      </div>
    </div>
  </footer>
  <!-- / footer -->

  <script src="js/jquery.min.js"></script>
  <script src="js/jquery.easing.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/jquery.mixitup.min.js"></script>
  <script src="js/custom.js"></script>

</body>
</html>
