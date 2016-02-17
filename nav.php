    <div class="social">
      <a href="https://www.facebook.com/vetzooft.co" target="_blank"><img id="social" src="/index/assets/img/facebook.png"></a><br>
      <a  href="https://twitter.com/Vetzooft" target="_blank"><img id="social" src="/index/assets/img/twitter.png"></a><br>
      <a href="https://www.youtube.com/channel/UCpDBjgxmwhzfrifqkymSAAg" target="_blank"><img id="social" src="/index/assets/img/youtube.png"></a>
    </div>

  <?php require('php/conectar/conexion-joomla.php');  ?>
  <?php
    $consultar = "SELECT * FROM  joom_menu WHERE menutype = 'nav-menu' AND parent_id = '1' ORDER BY lft ASC";
    $conexion->select_db($bd);
    $resultado = $conexion->query($consultar) or die(mysql_error());

    if ( $resultado->num_rows > 0 ) {
  ?>
  <nav class="navbar navbar-inverse navbar-fixed-top med">
        <div class="container"> 
          <div class="navbar-header ">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#menu-mobile">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>           
              <a  href="/index/" class="navbar-brand "><img  class="up" id="logoNav" alt="Logo Vetzooft" src="/index/assets/img/letra.png"></a>           
          </div>
          <div class="collapse navbar-collapse" id="menu-mobile">
          <ul class="nav navbar-nav navbar-right">      
    <?php 
      while( $row = mysqli_fetch_assoc( $resultado ) ) { 
        
        $menu_dos = "SELECT * FROM  joom_menu WHERE menutype = 'nav-menu' and parent_id = '".$row["id"]."' ORDER BY lft ASC";
        $resultado_submenu = $conexion->query($menu_dos) or die(mysql_error());
        $contar_submenu = "";


        while( $num_submenu = mysqli_fetch_assoc( $resultado_submenu  ) ) { 
            $contar_submenu = count( $num_submenu["id"] );
            $contar_submenu;
        } 
      ?>
      <?php if( $row["published"] === "1" ): ?>
      <?php if( $contar_submenu < 1 ): ?>
        <li class="dropdown"> 
            <?php if ( $row['id']  != '110' ) { ?>
              <li>
                <a href="<?php echo "/index/contenido/index.php/".$row['alias'] ?>">
                  <?php echo utf8_encode( $row['title'] ) ?>
                </a>
              </li>  
            <?php  } else  { ?>
              <li><a href="<?php echo $row['link'] ?>"><?php echo utf8_encode( $row['title'] ) ?></a></li>        
            <?php } ?>
          </li>
      <?php endif ?>
      <?php if( $contar_submenu > 0 ): ?>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><?php echo $row['title'] ?><span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
                <?php
                $menu_dos = "SELECT * FROM  joom_menu WHERE  menutype = 'nav-menu' AND parent_id = '".$row["id"]."' ORDER BY lft ASC";
                $resultado_submenu = $conexion->query($menu_dos) or die(mysql_error());

                while( $row_submenu = mysqli_fetch_assoc($resultado_submenu) ) { 
                      $con_parent = "SELECT * FROM  joom_menu WHERE menutype = 'nav-menu' and id = '".$row_submenu["parent_id"]."' ";
                      $parent = $conexion->query($con_parent);
                      $parent_con = mysqli_fetch_assoc( $parent );

                      if ( $row_submenu['parent_id']  === '112' &&  $row_submenu['id']  != '122' && $row_submenu['id'] != '123' ) { ?>
                          <li>
                            <a href="<?php echo "/index/contenido/index.php/".$parent_con['alias']."/".$row_submenu['alias'] ?>">
                              <?php echo utf8_encode( $row_submenu['title'] ) ?>
                            </a>
                          </li>                          
                      <?php } else { ?>
                            <li>
                              <a href="<?php echo $row_submenu['link'] ?>">
                                <?php echo utf8_encode( $row_submenu['title'] ) ?>
                              </a>
                            </li>
                      <?php } ?>
              <?php } ?>
            </ul>
          </li>       
        <?php endif ?>
      <?php endif ?>
    <?php             
    } 
  } 
?>

      </div>
  </div>  
</nav>
