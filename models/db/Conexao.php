<?
//Esta classe deve ser incluída antes das outras, pois a conexão será trazida nos DAOs
        class Conexao extends PDO {

            private static $instancia;

            public function Conexao($dsn, $username = "", $password = "") {
                // O construtro abaixo é o do PDO
                parent::__construct($dsn, $username, $password);
            }

            public static function getInstance() {
                // Se o a instancia não existe eu faço uma
                if(!isset( self::$instancia )){
                    try {
                        self::$instancia = new Conexao("mysql:host=localhost;dbname=sisbon_teste", "root", "edmo");
                    } catch ( Exception $e ) {
                        echo 'Erro ao conectar' . $e->getMessage() . ' - ' . $e->getFile() . ' '.$e->getLine();
                        exit ();
                    }
                }
                // Se já existe instancia na memória eu retorno ela
                self::$instancia->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                return self::$instancia;
            }
			
			public function alertaEnviaEmail($e,$local)
			{
				//Conexao::alertaEnviaEmail("<code>" . $i->getMessage() . "</code>", $_SERVER['SCRIPT_NAME']);
				$seu_email = "sisbon@sisbon.com.br";
				$to = "edmofarias@gmail.com";
				$subject = "ERRO NO SISTEMA SISBON";
				$message = "
								<h1>Ocorreu um erro</h1>
							  <p><b>Data:</b> ".date('d/m/Y H:i:s')."</p>
							  <p><b>Local:</b> ".$local."</p>
							  <p><b>Menssagem:</b> ".$e."</p>
							  <p><b>Ip:</b> ".$_SERVER['REMOTE_ADDR']."</p>
							  ";
					
				$headers = "Content-Type: text/html; charset=UTF-8\n";
				$headers .= "From: $seu_email \n";
				mail($to, $subject, $message, $headers);
				echo "<script>alert('ERROR: Ocorreu um erro inexperado, e um alerta foi enviado para os responsaveis. Tente novamente mais tarde! $e'); history.back();</script>";
			}
        }

//Para obter uma instância da conexão basta digitar Conexao::getInstance(); e atribuir a uma varíavel
//Por exemplo $con = Conexao::getInstance(); Você verá nos exemplos dos DAO´s

?>
