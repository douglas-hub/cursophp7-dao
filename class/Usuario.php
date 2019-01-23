<?php
class Usuario {
	private $idusuario ;
	private $deslogin ;
	private $dessenha ;
	private $dtcadastro ;

	public function getUser($id){
		$sql = new Sql();

		$result = $sql->select(" SELECT * FROM tb_usuarios WHERE idusuario = :ID " , array(
			":ID"=>$id 
		));

		if(isset($result)){
			$row = $result[0];

			$this->setId($row['idusuario']);
			$this->setDeslogin($row['deslogin']);
			$this->setDessenha($row['dessenha']);
			$this->setDtcadastro(new DateTime($row['dtcadastro']));
		}

	}

	public function __toString(){

		return json_encode(array(
			'idusuario' => $this->getId(),
			'deslogin' => $this->getDeslogin(),
			'dessenha' => $this->getDessenha(),
			'dtcadastro' => $this->getDtcadastro()->format("d/m/Y")
		));

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


