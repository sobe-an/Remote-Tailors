<?php
/*
 * This class models the logic of accessing the Tailor information
 * required to be displayed on the webpage.
 */

class Tailor
{

    private Database $db;

    /**
     * Tailor constructor.
     */
    public function __construct()
    {
        $this->db = new Database;
    }


    // Get all tailors in Database
    public function getTailors(): array
    {
        $this->db->query('SELECT * FROM tailors');
        return $this->db->result_set();
    }


    // Get tailors by Gender preference (Male/Female)
    public function getTailorsByPref($pref): array
    {
        $this->db->query("SELECT * FROM tailors WHERE tailor_pref = '$pref'");
        return $this->db->result_set();
    }


    // Get Locations of tailors in database
    public function getTailorsLocation(): ?array
    {
        $this->db->query('SELECT DISTINCT (tailor_city) FROM tailors');
        return $this->db->result_set();
    }

    // Get tailors by Location
    public function getTailorsByLocation($city): ?array
    {
        $this->db->query("SELECT * FROM tailors WHERE tailor_city = '$city'");
        return $this->db->result_set();
    }


    // Get tailors by Email
    public function getTailorByEmail($email): bool
    {
        $this->db->query("SELECT * FROM tailors WHERE tailor_email = '$email'");
        //check row
        if ($this->db->rows_count() > 0) {
            return true;
        } else return false;
    }

    // Get tailors by Username
    public function getTailorByUser($username): bool
    {
        $this->db->query("SELECT * FROM tailors WHERE tailor_username = '$username'");
        //check row
        if ($this->db->rows_count() > 0) {
            return true;
        } else return false;
    }

    public function register($data): bool
    {
        $sql = "INSERT INTO tailors (tailor_id, tailor_fname ,tailor_lname, tailor_email,tailor_username, tailor_password,tailor_reg_date) 
                  VALUES (NULL, '" . $data['fname'] . "', '" . $data['lname'] . "','" . $data['email'] . "','" . $data['username'] . "','" . $data['password'] . "',CURRENT_TIMESTAMP)";


        /*(NULL, '" . $data['fname'] . "', '" . $data['lname'] . "','" . $data['email'] . "','" . $data['username'] . "','" . $data['password'] . "',CURRENT_TIMESTAMP)*/
        // Execute
        if ($this->db->query($sql)) {
            return $this->db->last_insert_id();
        } else return false;
    }

    // Login User
    public function login($email, $password): array
    {
        $this->db->query("SELECT * FROM tailors WHERE tailor_email = '$email'");
        $row = $this->db->single_result();
        $hashed_password = $row['tailor_password'];
        if($password === $hashed_password){
            return $row;
        }
    }

    // Get tailors by ID
    public function getTailorById($id): ?array
    {
        $this->db->query("SELECT * FROM tailors WHERE tailor_id = '$id'");
        return $this->db->single_result();
    }
}