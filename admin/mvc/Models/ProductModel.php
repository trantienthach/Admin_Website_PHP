<?php

class ProductModel extends Database {
    const TBL_PRODUCT = 'tbl_prod';

    public function addProdNew($dataProd)
    {
        return $this->insert(self::TBL_PRODUCT, $dataProd);
    }
    public function checkProdExists($prod_name)
    {
        $sql = "SELECT `prod_id` FROM " . self::TBL_PRODUCT . " WHERE `prod_name` = '{$prod_name}'";
        $numRow = $this->getNumRows($sql);
        if($numRow > 0) return true;
        return false;
    }
    public function getlistProdByStatusAndOrderAndPagination($status, $orderField, $orderBy,  $pageStart = null, $numPerPage = null) {
        $where      = $status != 'all' ? "WHERE `prod_is_status` = '{$status}'" : '';
        $pagination = !empty($pageStart) || !empty($numPerPage) ? "LIMIT {$pageStart}, {$numPerPage}" : '';
        return $this->selectByQuery("SELECT * FROM ". self::TBL_PRODUCT ." {$where} ORDER BY `{$orderField}` {$orderBy} {$pagination}");
    }

    public function getlistProdBySearchAndOrderAndStatusAndPagination($strSearch, $status, $orderField, $orderBy, $pageStart = null, $numPerPage = null)
    {
        $where      = $status != 'all' ? "AND `prod_is_status` = '{$status}'" : '';
        $pagination = !empty($pageStart) || !empty($numPerPage) ? "LIMIT {$pageStart}, {$numPerPage}" : '';
        return $this->selectByQuery("SELECT * FROM ".self::TBL_PRODUCT." WHERE `prod_name` LIKE '%{$strSearch}%' {$where}  ORDER BY `{$orderField}` {$orderBy} {$pagination}");
    }
    
    public function updateProd( $dataProd, $prod_id )
    {
        return $this->update(self::TBL_PRODUCT, $dataProd, "`prod_id` = {$prod_id}");
    }

    public function deleteProdItemById($prod_id)
    {
        return $this->detele(self::TBL_PRODUCT, "`prod_id` = {$prod_id}");
    }
    
    public function getProdItemId($prod_id)
    {
        return $this->selectRowItem("SELECT * FROM " .self::TBL_PRODUCT. " WHERE `prod_id` = '{$prod_id}'");
    }
    public function checkProdExistsNotProdCurrent($prod_name,$prod_id) {
        $sql = "SELECT * FROM " . self::TBL_PRODUCT . " WHERE `prod_id` <> $prod_id AND `prod_name`  LIKE '%{$prod_name}%'";
        $numRow = $this->getNumRows($sql);
        if($numRow > 0) return true;
        return false;
    }
}