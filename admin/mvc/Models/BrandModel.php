<?php

class BrandModel extends Database {
    const TABLE_BRAND = "tbl_brand" ;

    public function getOrderMax() {
        $sql = "SELECT MAX(`brand_order`) as `orderMax` FROM " . self::TABLE_BRAND ."";
        $brandOrderMax = $this->selectRowItem($sql);
        return $brandOrderMax['orderMax'] ?? '0';
    }

    public function getAllBrand() {
        return $this->selectByQuery($sql = "SELECT * FROM ". self::TABLE_BRAND ."");
    }

    public function addBrandNew($dataBrand)
    {
        return $this->insert(self::TABLE_BRAND, $dataBrand);
    }

    public function checkBrandExists($brand_name)
    {
        $sql = "SELECT `brand_id` FROM " . self::TABLE_BRAND . " WHERE `brand_name` = '{$brand_name}'";
        $numRow = $this->getNumRows($sql);
        if($numRow > 0) return true;
        return false;
    }

    public function checkBrandExistsNotBrandCurrent($brand_name,$brand_id) {
        $sql = "SELECT * FROM " . self::TABLE_BRAND . " WHERE `brand_id` <> $brand_id AND `brand_name`  LIKE '%{$brand_name}%'";
        $numRow = $this->getNumRows($sql);
        print_r($sql);
        if($numRow > 0) return true;
        return false;
    }

    public function getListBrandByStatusAndOrderAndPagination($status, $orderField, $orderBy,  $pageStart = null, $numPerPage = null) {
        $where      = $status != 'all' ? "WHERE `brand_is_status` = '{$status}'" : '';
        $pagination = !empty($pageStart) || !empty($numPerPage) ? "LIMIT {$pageStart}, {$numPerPage}" : '';
        return $this->selectByQuery("SELECT * FROM ". self::TABLE_BRAND ." {$where} ORDER BY `{$orderField}` {$orderBy} {$pagination}");
    }

    public function getListBrandBySearchAndOrderAndStatusAndPagination($strSearch, $status, $orderField, $orderBy, $pageStart = null, $numPerPage = null)
    {
        $where      = $status != 'all' ? "AND `brand_is_status` = '{$status}'" : '';
        $pagination = !empty($pageStart) || !empty($numPerPage) ? "LIMIT {$pageStart}, {$numPerPage}" : '';
        return $this->selectByQuery("SELECT * FROM ".self::TABLE_BRAND." WHERE `brand_name` LIKE '%{$strSearch}%' {$where}  ORDER BY `{$orderField}` {$orderBy} {$pagination}");
    }

    public function updateBrand( $dataBrand, $brand_id )
    {
        return $this->update(self::TABLE_BRAND, $dataBrand, "`brand_id` = {$brand_id}");
    }

    public function deleteBrandItemById($brand_id)
    {
        return $this->detele(self::TABLE_BRAND, "`brand_id` = {$brand_id}");
    }

    public function getBrandItemId($brand_id)
    {
        return $this->selectRowItem("SELECT * FROM " .self::TABLE_BRAND. " WHERE `brand_id` = '{$brand_id}'");
    }

    public function getBrandFieldBySearchName( $strSearch, $fieldSearch )
    {
        foreach($fieldSearch as $fieldItem) {
            $filedSearchArr[] = "`{$fieldItem}`";
        }
        $filedSearchStr = implode(",", $filedSearchArr);
        $sql = "SELECT {$filedSearchStr} FROM ".self::TABLE_BRAND." WHERE `brand_name` LIKE '%{$strSearch}%'";
        return $this->selectByQuery($sql);
    }
}