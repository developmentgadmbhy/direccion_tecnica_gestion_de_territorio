<?php
class Autocompletar
{

	private $dbh;

	public function __construct()
	{
		$this->dbh = new PDO("mysql:host=localhost;dbname=db_master_bbh, "root", "");
	}

	public function findData($search)
	{
		$query = $this->dbh->prepare("SELECT  idPersona, Cedula,Nombres, Apellidos, Telefono,  Email,  Foto,  id_Cargo, type, iddepartamento FROM  db_master_bbh.persona WHERE Nombres LIKE :search");
        $query->execute(array(':search' => '%'.$search.'%'));
        $this->dbh = null;
        if($query->rowCount() > 0)
        {
        	echo json_encode(array('res' => 'full', 'data' => $query->fetchAll()));
        }
        else
        {
        	echo json_encode(array('res' => 'empty'));
        }
	}
}