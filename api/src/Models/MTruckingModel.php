<?php
namespace Src\Models;

class MTruckingModel{

    private $db = null;

    public function __construct($db)
    {
      $this->db = $db;
    }


    public function find($id)
    {
        $statement = "
            SELECT 
                *
            FROM
             m_tracking
            WHERE serialnumber = :id ;
        ";

        try {
            $statement = $this->db->prepare($statement);
            $statement->execute(array('id' => $id));
            $result = $statement->fetchAll(\PDO::FETCH_ASSOC);
            return $result;
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }    
    }

}
?>