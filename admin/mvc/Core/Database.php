<?php

class Database
{
    /**
     * 1: Kết nối db
     * 2: Thêm dữ liệu
     * 3: Sửa dữ liệu
     * 4: Xóa dữ liệu
     * 5: Lấy danh sách theo điều kiện or không theo điều kiện
     * 6: Lấy 1 hàng dữ liệu
     * 7: Lấy số lượng hàng theo điều kiện
     */
    const DB_HOST = 'localhost';
    const DB_USER = 'root';
    const DB_PASS = '';
    const DB_NAME = 'quanlysanpham';

    private $conn;

    public function __construct()
    {
        $this->connection();
    }

    public function _query( $sql ) {
        return $this->conn->query( $sql );
    }

    public function escape_string( $str ) {
        return $this->conn->real_escape_string( $str );
    }

    public function connection() {
       @$this->conn = new mysqli( self::DB_HOST, self::DB_USER, self::DB_PASS, self::DB_NAME );
        if( $this->conn->connect_error ) {
            die('Connect to database unsuccess, [Error: ' . $this->conn->connect_error . ']');
        }
    }

    public function insert( $table, $data ) {
        foreach( $data as $field => $value ) {
            $listField[] = "`{$field}`";
            $listValue[] = "'{$this->escape_string($value)}'";
        }
        $listField = implode(",", $listField);
        $listValue = implode(",", $listValue);

        $sql = "INSERT INTO {$table} ({$listField}) VALUES ({$listValue})";

        if( $this->_query($sql) ) return $this->conn->insert_id;
        echo "Insert unsuccess [ ERROR: " . $this->conn->error . " ]";

    }

    public function update( $table, $data, $where ) {
        foreach( $data as $field => $value ) {
            $arrUpdate[] = "`{$field}` = '{$this->escape_string($value)}'";
        }
        $strUpdate = implode( ",", $arrUpdate );
        $sql = "UPDATE $table SET {$strUpdate} WHERE {$where}";
        if( $this->_query( $sql ) ) return true;
        echo "Update unsuccessful [ ERROR: " . $this->conn->error . " ]";
    }

    public function detele( $table, $where ) {
        $sql = "DELETE FROM {$table} WHERE {$where}";
        if( $this->_query( $sql ) ) return true;
        echo "Delete unsuccessful [ ERROR: " . $this->conn->error . " ]";
    }

    public function selectByQuery( $sql ) {
        $result = $this->conn->query( $sql );
        if( !empty($result) ) {
            if( $result->num_rows > 0 ) {
                $data = [];
                while( $row = $result->fetch_assoc() ) {
                    $data[] = $row;
                }
                return $data;
            }
        } return [];
    }

    public function selectRowItem( $sql ) {
        $result = $this->conn->query( $sql );
        if( !empty( $result ) ) {
            if( $result->num_rows > 0 ) {
                return $result->fetch_assoc();
            }
        } return null;
    }

    public function getNumRows( $sql ) {
        $result = $this->conn->query( $sql );
        if( !empty($result) ) {
            return $result->num_rows;
        } return 0;
    }
}