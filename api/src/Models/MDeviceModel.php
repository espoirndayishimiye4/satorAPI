<?php
namespace Src\Models;

class MDeviceModel{

    private $db = null;

    public function __construct($db)
    {
      $this->db = $db;
    }

    public function findAll()
    {
      $statement = "
          SELECT 
              *
          FROM
              m_device;
      ";

      try {
          $statement = $this->db->query($statement);
          $result = $statement->fetchAll(\PDO::FETCH_ASSOC);
          return $result;
      } catch (\PDOException $e) {
          exit($e->getMessage());
      }
    }


    public function find($id)
    {
        $statement = "
            SELECT 
                *
            FROM
                m_device
            WHERE serialnumber = ? AND status = ?;
        ";

        try {
            $statement = $this->db->prepare($statement);
            $statement->execute(array($id,1));
            $result = $statement->fetchAll(\PDO::FETCH_ASSOC);
            return $result;
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }    
    }

}
?>