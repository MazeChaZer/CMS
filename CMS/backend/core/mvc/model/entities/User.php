<?php

/**
 * Description of User
 *
 * @author Lukas
 */

namespace ITC\CMS;

use PDO;

class User extends Entity {
    
    private $userID = 0;
    
    private $username;
    private $email;
    private $password;

    public function setUsername($username)
    {
        $this->username = $username;
        return 0;
    }
    public function getUserID() {
        return $this->userID;
    }

        
    public function setEmail($Email)
    {
        $this->email = $Email;
        return 0;
    }
    
    public function setPassword($password)
    {
        $this->password = $password;
        return 0;
    }
    
    public function getUsername()
    {
        return $this->username;
    }
    
    public function getEmail()
    {
        return $this->email;
    }
    
    public function getPassword()
    {
        return $this->password;
    }
    
    private function getNewID()
    {
        $SQL = "SELECT MAX(userID) AS maxID FROM USER;";
        $stmt = self::$db->query($SQL);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['maxID'] + 1;
    }
    
    public function loadByEmail($email)
    {
            $st = self::$db->prepare(
               "SELECT * FROM user
                   WHERE email = :email"
            );
            $st->execute(array(
               ':email' => $email)
            );
            $result = $st->fetch(PDO::FETCH_ASSOC);
            if(isSet($result))
            {
                $this->username = $result['username'];
                $this->password = $result['password'];
                $this->email = $result['email'];
                $this->userID = $result['userID'];
                return 0;   // User successfully loaded!
            }
            else
            {
                return 1; // User not found!
            }
    }
    
    public function loadByUsername($name)
    {
            $st = self::$db->prepare(
               "SELECT * FROM user
                   WHERE username = :name"
            );
            $st->execute(array(
               ':name' => $name)
            );
            $result = $st->fetch(PDO::FETCH_ASSOC);
            if(isSet($result))
            {
                $this->username = $result['username'];
                $this->password = $result['password'];
                $this->email = $result['email'];
                $this->userID = $result['userID'];
                return 0;   // User successfully loaded!
            }
            else
            {
                return 1; // User not found!
            }
    }
    
    public function save()  //update or create the user
    {
        if($this->userID == 0)
        {
            $this->userID = $this->getNewID();
            $st = self::$db->prepare(
                "INSERT INTO user
                    ( userID, username, email, password, create_time )
                 VALUES 
                    ( :userID, :username, :email, :password, :create_time )"
            );
            $st->execute(array(
                ':userID' => $this->userID,
                ':username' => $this->username,
                ':email' => $this->email,
                ':password' => $this->password,
                ':create_time' => date("Y-m-d H:i:s",time()))
            );
            return 0;
        }
        else
        {
            $st = self::$db->prepare(
                "UPDATE user
                    SET  
                        username = :username,
                        email = :email,
                        password = :password
                     WHERE userID = :userID"
             );
             $st->execute(array(
                ':userID' => $this->userID,
                ':username' => $this->username,
                ':email' => $this->email,
                ':password' => $this->password)
             );
             return 0;
        }
    } 
    
    public function delete()
    {
        if($this->userID != 0)
        {
            $st = self::$db->prepare(
               "DELETE FROM user
                   WHERE userID = :userID"
            );
            $st->execute(array(
               ':userID' => $this->userID)
            );
        }
        return 0;
    }  
    
    public function load($userID)
    {
            $st = self::$db->prepare(
               "SELECT * FROM user
                   WHERE userID = :userID"
            );
            $st->execute(array(
               ':userID' => $userID)
            );
            $result = $st->fetch(PDO::FETCH_ASSOC);
            if(isSet($result))
            {
                $this->username = $result['username'];
                $this->password = $result['password'];
                $this->email = $result['email'];
                $this->userID = $result['userID'];
                return 0;   // User successfully loaded!
            }
            else
            {
                return 1; // User not found!
            }
    }
    
    public function setRight($RechtID, $Recht)
    {
        if($this->userID != 0)
        {
            $st = self::$db->prepare(
               "DELETE FROM userrights
                        WHERE userID = :userID
                            AND rechtID = :rechtID"
            );
            $st->execute(array(
               ':userID' => $this->userID,
               ':rechtID' => $RechtID)
            );
            
            
            $st2 = self::$db->prepare(
               "INSERT INTO userrights
                    ( userID, rechtID, recht )
                VALUES 
                    ( :userID, :rechtID, :recht )"
            );
            $st2->execute(array(
                ':userID' => $this->userID,
                ':rechtID' => $RechtID,
                ':recht' => $Recht)
             ); 
            return 0;         
        }
        else
        {
            return 1; //User existiert noch nicht.
        }
    }
    
    public function checkRight($RechtID)
    {
        if($this->userID != 0)
        {
            $st = self::$db->prepare(
               "SELECT recht FROM userrights
                   WHERE userID = :userID
                     AND rechtID = :rechtID"
            );
            $st->execute(array(
               ':userID' => $this->userID,
                ':rechtID' => $RechtID)
            );
            $result = $st->fetch(PDO::FETCH_ASSOC);
            if(isSet($result) && $result['recht'] = 1)
            {
                return true;
            }
            else
            {
                return false;
            }
        }
        else
        {
            return false; //User existiert noch nicht!
        }
    }
    
    
}
