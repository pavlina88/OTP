<?php

/*
 * Dn Class
 * This class is used for database related (connect, insert, and update) operations
 *
 */

class Db
{
    private string $dbHost = "localhost";
    private string $dbUsername = "root";
    private string $dbPassword = "";
    private string $dbName = "otp";

    public function __construct()
    {
        if (!isset($this->db)) {
            // Connect to the database
            $conn = new mysqli($this->dbHost, $this->dbUsername, $this->dbPassword, $this->dbName);
            if ($conn->connect_error) {
                die("Failed to connect with MySQL: " . $conn->connect_error);
            } else {
                $this->db = $conn;
            }
        }
    }

    /*
     * Insert data into the database
     * @param string name of the table
     * @param array the data for inserting into the table
     */
    public function insert($table, $data): bool|int|string
    {
        if (!empty($data) && is_array($data)) {
            $columns = $values = '';
            $i       = 0;
            foreach ($data as $key => $val) {
                $pre     = ($i > 0) ? ', ' : '';
                $columns .= $pre . $key;
                $values  .= $pre . "'" . $val . "'";
                $i++;
            }
            $query  = "INSERT INTO " . $table . " (" . $columns . ") VALUES (" . $values . ")";
            $insert = $this->db->query($query);
            return $insert ? $this->db->insert_id : false;
        } else {
            return false;
        }
    }

    /*
     * Update data into the database
     * @param string name of the table
     * @param array the data for updating into the table
     * @param array where condition on updating data
     */
    public function update($table, $data, $conditions): bool|int|string
    {
        if (!empty($data) && is_array($data)) {
            $colvalSet = '';
            $i         = 0;
            foreach ($data as $key => $val) {
                $pre       = ($i > 0) ? ', ' : '';
                $colvalSet .= $pre . $key . "='" . $val . "'";
                $i++;
            }
            $this->addWhereCondition($whereSql = '', $conditions);
            $query  = "UPDATE " . $table . " SET " . $colvalSet . $whereSql . 'ORDER BY date_create DESC LIMIT 1';
            var_dump(['$query' => $query]);
            $update = $this->db->query($query);
            return $update ? $this->db->affected_rows : false;
        } else {
            return false;
        }
    }

    /**
     * @param $table
     * @param $contion
     *
     * @return void
     */

    /*
     * Function returns the number of records returned by a select query.
     * @param string name of the table
     * @param array where condition on updating data
     */
    public function count($table, $conditions)
    {
        $whereSql = '';
        if (!empty($conditions) && is_array($conditions)) {
            $whereSql .= ' WHERE ';
            $i        = 0;
            foreach ($conditions as $key => $value) {
                $pre      = ($i > 0) ? ' AND ' : '';
                $whereSql .= $pre . $key . " = '" . $value . "'";
                $i++;
            }
            $query = "SELECT COUNT(*) AS coutn FROM " . $table . $whereSql;
            $count = $this->db->query($query)->fetch_array();
            return $count ? (int)$count[0] : 0;
        } else {
            return false;
        }
    }

    /*
     * The SELECT statement is used to select data from a database.
     *The data returned is stored in a result table, called the result-set.
     * @param string name of the table
     * @param array the data for select into the table
     * @param array where condition on select data
     */
    public function select($table, $data, $conditions)
    {
        if (!empty($data) && is_array($conditions)) {
            $i        = 0;
            $this->addWhereCondition($whereSql = '', $conditions);
            $query  = "SELECT " . $data . " FROM " . $table . $whereSql . 'ORDER BY date_create DESC LIMIT 1';
            $select = $this->db->query($query)->fetch_array();
            return $select ? $select[0] : false;
        } else {
            return false;
        }
    }

    /**
     * @param string $whereSql
     * @param $conditions
     *
     * @return void
     */
    public function addWhereCondition(string $whereSql = '',$conditions): void
    {
        if (!empty($conditions) && is_array($conditions)) {
            $whereSql .= ' WHERE ';
            $i        = 0;
            foreach ($conditions as $key => $value) {
                $pre      = ($i > 0) ? ' AND ' : '';
                $whereSql .= $pre . $key . " = '" . $value . "'";
                $i++;
            }
        }
    }
}