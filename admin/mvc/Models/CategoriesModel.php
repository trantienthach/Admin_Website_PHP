<?php

class CategoriesModel extends Database {
    const TABLE_CATEGORIES = "tbl_cateprod" ;

    public function handleGetMultiLevelCateProd($listCateProd, $parentID = 0, $level = 0) {
        $result = [];
        foreach ($listCateProd as $index => $cateItem) {
            if($cateItem['cateprod_parent_id'] == $parentID) {
                $cateItem['level'] = $level;
                $result[] = $cateItem ;
                unset( $listCateProd[$index] );
                $child = $this ->handleGetMultiLevelCateProd($listCateProd, $cateItem['cateprod_id'], $level + 1);
                $result = array_merge($result, $child);
            }
        }
        return $result;
    }

    public function handleGetCateAll() {
        return $this->selectByQuery("SELECT * FROM " . self::TABLE_CATEGORIES . "");
    }

    public function getProdCateParentNameById($id)
    {
        $id = (int)$id;
        $parentName = $this->selectRowItem("SELECT `cateprod_name` FROM " . self::TABLE_CATEGORIES . " WHERE `cateprod_id` = $id");
        if ($parentName == null) return "Không có danh mục cha";
        return $parentName['cateprod_name'];
    }

    public function addCateNew($dataCate)
    {
        return $this->insert(self::TABLE_CATEGORIES, $dataCate);
    }
    public function checkCateExists($cateprod_name)
    {
        $sql = "SELECT `cateprod_id` FROM " . self::TABLE_CATEGORIES . " WHERE `cateprod_name` = '{$cateprod_name}'";
        $numRow = $this->getNumRows($sql);
        if($numRow > 0) return true;
        return false;
    }
    public function getlistCateProdByStatusAndOrderAndPagination($status, $orderField, $orderBy,  $pageStart = null, $numPerPage = null) {
        $where      = $status != 'all' ? "WHERE `cateprod_is_status` = '{$status}'" : '';
        $pagination = !empty($pageStart) || !empty($numPerPage) ? "LIMIT {$pageStart}, {$numPerPage}" : '';
        return $this->selectByQuery("SELECT * FROM ". self::TABLE_CATEGORIES ." {$where} ORDER BY `{$orderField}` {$orderBy} {$pagination}");
    }

    public function getlistCateProdBySearchAndOrderAndStatusAndPagination($strSearch, $status, $orderField, $orderBy, $pageStart = null, $numPerPage = null)
    {
        $where      = $status != 'all' ? "AND `cateprod_is_status` = '{$status}'" : '';
        $pagination = !empty($pageStart) || !empty($numPerPage) ? "LIMIT {$pageStart}, {$numPerPage}" : '';
        return $this->selectByQuery("SELECT * FROM ".self::TABLE_CATEGORIES." WHERE `cateprod_name` LIKE '%{$strSearch}%' {$where}  ORDER BY `{$orderField}` {$orderBy} {$pagination}");
    }
    public function updateCateProd( $dataCateProd, $cateprod_id )
    {
        return $this->update(self::TABLE_CATEGORIES, $dataCateProd, "`cateprod_id` = {$cateprod_id}");
    }
    
    public function deleteCateProdItemById($cateprod_id)
    {
        return $this->detele(self::TABLE_CATEGORIES, "`cateprod_id` = {$cateprod_id}");
    }
    
    public function getcateProdItemId($cateprod_id)
    {
        return $this->selectRowItem("SELECT * FROM " .self::TABLE_CATEGORIES. " WHERE `cateprod_id` = '{$cateprod_id}'");
    }
    
    public function getCateProdFieldBySearchName( $strSearch, $fieldSearch )
    {
        foreach($fieldSearch as $fieldItem) {
            $filedSearchArr[] = "`{$fieldItem}`";
        }
        $filedSearchStr = implode(",", $filedSearchArr);
        $sql = "SELECT {$filedSearchStr} FROM ".self::TABLE_CATEGORIES." WHERE `cateprod_name` LIKE '%{$strSearch}%'";
        return $this->selectByQuery($sql);
    }
    public function checkCateProdExistsNotCateProdCurrent($cateprod_name,$cateprod_id) {
        $sql = "SELECT * FROM " . self::TABLE_CATEGORIES . " WHERE `cateprod_id` <> $cateprod_id AND `cateprod_name`  LIKE '%{$cateprod_name}%'";
        $numRow = $this->getNumRows($sql);
        if($numRow > 0) return true;
        return false;
    }
}