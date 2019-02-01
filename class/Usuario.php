<?php
class Usuario {
//------------------------------ATRIBUTOS----------------------------------------------------	
	private $idusuario ;
	private $deslogin ;
	private $dessenha ;
	private $dtcadastro ;
//--------------------------------------INSERT----------------------------------------------


	public function insert(){
		$sql = new Sql();

		$result = $sql->select("CALL sp_usuarios_insert(:LOGIN , :PASS)",array(
			":LOGIN" => $this->getDeslogin() ,
			":PASS"  => $this->getDessenha()
		));

		if(count($result) > 0){
			$this->setData($result[0]);
		}


	}
	public function update($login , $senha){

		$this->setDeslogin($login);
		$this->setDessenha($senha);

		$sql = new Sql();
		$sql->query("UPDATE tb_usuarios SET deslogin = :LOG , dessenha = :PASS WHERE idusuario = :ID" , array(
			":LOG" => $this->getDeslogin(),
			":PASS" =>$this->getDessenha(),
			":ID" => $this->getId()
		));
	}

	public function delete(){
		$sql = new Sql();

		$sql->query("DELETE FROM tb_usuarios WHERE = idusuario = :ID",array(
			":ID" => $this->getId()
		));
		$this->setId(0);
		$this->setDeslogin("");
		$this->setDessenha("");
		$this->setDtcadastro(new DateTime());
	}

	public function __construct($login = "", $pass = ""){
		$this->setDeslogin($login);
		$this->setDessenha($pass);
	}

//---------------------------------------SELECT-------------------------------------------
	public function setData($row){
		$this->setId($row['idusuario']);
		$this->setDeslogin($row['deslogin']);
		$this->setDessenha($row['dessenha']);
		$this->setDtcadastro(new DateTime($row['dtcadastro']));
	}


	public function getUser($id){
		$sql = new Sql();

		$result = $sql->select(" SELECT * FROM tb_usuarios WHERE idusuario = :ID " , array(
			":ID"=>$id 
		));

		if(isset($result)){
	
			$this->setData($result[0]) ;
		}

	}
	public static function getList(){

		$sql = new Sql();
		return $sql->select("SELECT * FROM tb_usuarios ORDER BY deslogin ; ");

	}
	public static function search($login){
		$sql = new Sql();
		return $sql->select("SELECT * FROM tb_usuarios WHERE deslogin LIKE :SEARC ORDER BY deslogin ", array(
			':SEARC'=> "%".$login."%"
		)) ;
	}
	public function login($login , $pass){
		$sql = new Sql();

		$result = $sql->select(" SELECT * FROM tb_usuarios WHERE deslogin = :LOG AND dessenha = :PASS " , array(
			":LOG"=>$login,
			":PASS"=>$pass 
		));

		if(isset($result)){
			$this->setData($result[0]);
		}else{
			throw new Exception("Não foi possível completar a operação");
		}
	}




//-----------------------------CONSTRUTOR TOSTRING---------------------------------------


	public function __toString(){

		return json_encode(
			array(
			'idusuario' => $this->getId(),
			'deslogin' => $this->getDeslogin(),
			'dessenha' => $this->getDessenha(),
			'dtcadastro' => $this->getDtcadastro()->format("d/m/Y")
		)
		);

	}



//---------------------------GETTER E SETTER-----------------------------------------
	public function getId(){
		return $this->idusuario ;
	}
	public function setId($value){
		$this->idusuario = $value ;
	}
	public function getDeslogin(){
		return $this->deslogin ;
	}
	public function setDeslogin($value){
		$this->deslogin = $value ;
	}
	public function getDessenha(){
		return $this->dessenha ;
	}
	public function setDessenha($value){
		$this->dessenha = $value ;
	}
	public function getDtcadastro(){
		return $this->dtcadastro ;
	}
	public function setDtcadastro($value){
		$this->dtcadastro = $value ;
	}

//--------------------------------------------------------------------
}


