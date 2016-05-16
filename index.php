<?php 
	$conexion = mysqli_connect("localhost", "root", "", "menu");
?>
<html>
 <head>
 	<meta charset="utf-8"/>
 	<meta http-equiv="X-UA-Compatible" content=="IE=edge"/>
 	<meta name="google" value="notranslate"/>
 	<title>Menú</title>
<script src="//code.jquery.com/jquery-1.12.0.min.js"></script>
 	<link rel="stylesheet" type="text/css" href="style.css">
 	<link rel="stylesheet" type="text/css" href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
 </head>

 <body>

<?php 
$mysqli = new mysqli("localhost", "root", "", "menu");

$query = $mysqli->query("SELECT * FROM  menus ORDER BY id_parent");
$menuItens = array();
while($row = $query->fetch_object())
{
    $menuItens[$row->id_parent][$row->id] = array(
    	'ruta' => $row->ruta,
    	'text' => $row->nombre,
    	'class' => $row->clase,
    	'icono_clase' => $row->icono_clase 
    	);
}

function create_menu( array $arrayItem, $id_parent = 0, $level = 0 ) {
    echo str_repeat("" , $level ),'<ul>',PHP_EOL;

    foreach( $arrayItem[$id_parent] as $id_item => $item ) {
        echo str_repeat( "" , $level + 1 ),'<li class="',$item['class'],'"><a href="',$item['ruta'],'">
        <i class="',$item['icono_clase'],'"></i>
        ',$item['text'],'</a>',PHP_EOL;
        if(isset( $arrayItem[$id_item] ) ){
            create_menu($arrayItem , $id_item , $level + 2);
        }
        echo str_repeat("" , $level + 1 ),'</li>',PHP_EOL;
    }
    echo str_repeat("" , $level ),'</ul>',PHP_EOL;
}

 ?>

 <div class="" id="cssmenu">
 	<?php create_menu( $menuItens ); ?>
 </div>	
</body>
</html>

 <script type="text/javascript">
	$( document ).ready( function(){

	$('#cssmenu li.active').addClass('open').children('ul').show();
		$('#cssmenu li.has-sub>a').on('click', function(){
			$(this).removeAttr('href');
			var element = $(this).parent('li');
			if (element.hasClass('open')) {
				element.removeClass('open');
				element.find('li').removeClass('open');
				element.find('ul').slideUp(200);
			}
			else {
				element.addClass('open');
				element.children('ul').slideDown(200);
				element.siblings('li').children('ul').slideUp(200);
				element.siblings('li').removeClass('open');
				element.siblings('li').find('li').removeClass('open');
				element.siblings('li').find('ul').slideUp(200);
			}
		});

	});

</script>