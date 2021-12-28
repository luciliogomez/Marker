<?php
namespace Source\Config;

define("DATABASE_DBNAME","marcacoes");
define("DATABASE_HOST","localhost");
define("DATABASE_USER","root");
define("DATABASE_PASSWORD","");
define("DATABASE_CHARSET","utf8");

define("BASE_URL","http://localhost/marcacoes/");

$dir = str_replace("\\",DIRECTORY_SEPARATOR,"/opt/lampp/htdocs/marcacoes/");
define("BASE_DIR",$dir);

define("PRESENTE",1);
define("AUSENTE",0);
define("HOJE",date("Y-m-d"));