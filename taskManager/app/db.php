<?php


class db
{
    protected $pdo;
    private $db;
    private $user;
    private $pass;
    private $tbl;

    public function __construct($db = "taskManager", $user = "root", $pass = "")
    {
        $this->db = $db;
        $this->user = $user;
        $this->pass = $pass;
        $this->connecting();
    }

    public function connecting()
    {   
        try {
            $this->pdo = new PDO("mysql:host=localhost;dbname={$this->db}", $this->user, $this->pass);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function setTbl($tbl)
    {
        $this->tbl = $tbl;
    }

    public function selectData($name)
    {
        if (is_array($name)) {
            $names = "'" . implode("','", $name) . "'";
            $stm = $this->pdo->prepare("SELECT {$names} FROM {$this->tbl}");
        } else {
            $stm = $this->pdo->prepare("SELECT {$name} FROM {$this->tbl}");
        }
        $stm->execute();
        $row = $stm->fetchAll(PDO::FETCH_OBJ);
        return $row;
    }

    public function insertData($filds, $data)
    {
        if (is_array($data)) {
            $names = "'" . implode("','", $data) . "'";
            $filds = implode(",", $filds);
            $sql = $this->pdo->prepare("INSERT INTO {$this->tbl} ($filds) values ($names)");
            $sql->execute();
        }
    }

    public function editData($filds, $data, $id)
    {
        foreach ($filds as $key => $val) {
            $txt[] = $val . "='" . $data[$val] . "'";
        }
        $query = implode(",", $txt);
        $sql = $this->pdo->prepare("update {$this->tbl} set " . $query . " where id=" . $id);
        $sql->execute();
    }

    public function deleteData($id)
    {
        $sql = $this->pdo->prepare("DELETE FROM {$this->tbl} WHERE id=:id");
        $sql->bindParam("id", $id, PDO::PARAM_INT);
        $sql->execute();
    }

    public function showEditData($id)
    {
        $sql = $this->pdo->prepare("SELECT * FROM {$this->tbl} WHERE id='$id' ");
        $sql->execute();
        $result = $sql->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    public function returnSafeText($text){
            $text = strip_tags($text);
            $text = trim($text);
            $text = htmlspecialchars($text);
            return $text;
    }

}
// $object = new db();
// $object->insertData(['title','text'],['titleeee','texttttt']);