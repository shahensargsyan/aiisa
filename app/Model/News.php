<?php

class News extends AppModel {

    public $name = "News";
    
    public $validate = array(
        'label' => array(
            'rule' => 'notEmpty',
            'message' => 'label cannot be empty'
        ),
        'quote' => array(
            'rule' => 'notEmpty',
            'message' => 'quote cannot be empty'
        ),
        'title' => array(
            'rule' => 'notEmpty',
            'message' => 'title cannot be empty'
        ),
        'secondary_link' => array(
            'rule' => 'notEmpty',
            'message' => 'link cannot be empty'
        ),
        'date' => array(
            'rule' => 'notEmpty',
            'message' => 'date cannot be empty'
        ),
        'author' => array(
            'rule' => 'numeric',
            'message' => 'author cannot be empty'
        ),
    );
    public function paginateCount($conditions, $recursive, $extra){
        if($extra['queryId'] == 1){
            $query = 'SELECT `News`.*'
                    . 'FROM `news` AS `News` '
                    . 'LEFT JOIN `experts` AS `Expert` ON (`Expert`.`id` = `News`.`author`) '
                    . 'WHERE `News`.`active`=1 '.$conditions;

           $p = $this->query($query);
            return count($p);
        }
        if($extra['queryId'] == 2){
            $query = 'SELECT `News`.*'
                    . 'FROM `news` AS `News` '
                    . 'LEFT JOIN `experts` AS `Expert` ON (`Expert`.`id` = `News`.`author`) '
                    . 'WHERE `News`.`active`=1 ';

           $p = $this->query($query);
            return count($p);
        }
    }

    public function paginate($conditions, $fields, $order, $limit, $page, $recursive, $extra){
        $pageNumber = $page - 1;
        $pageNumber = ($pageNumber < 0) ? 0 : $pageNumber;
        $offset = $pageNumber * $limit;

        if($extra['queryId'] == 1){
            $query = 'SELECT `News`.*, `Expert`.`first_name`, `Expert`.`last_name`, `Expert`.`id`, `Expert`.`photo`, `Expert`.`job_title`'
                . 'FROM `news` AS `News` '
                . 'LEFT JOIN `experts` AS `Expert` ON (`Expert`.`id` = `News`.`author`) '
                . 'WHERE `News`.`active`=1 '.$conditions  
                . '  ORDER BY `News`.`date` DESC '
                . ' LIMIT '.$offset.', '.$limit;
           $p = $this->query($query);
           return $p;
        }
        if($extra['queryId'] == 2){
            $query = 'SELECT `News`.*, `Expert`.`first_name`, `Expert`.`last_name`, `Expert`.`id`, `Expert`.`photo`, `Expert`.`job_title`'
                . 'FROM `news` AS `News` '
                . 'LEFT JOIN `experts` AS `Expert` ON (`Expert`.`id` = `News`.`author`) '
                . 'WHERE `News`.`active`=1 '  
                . ' LIMIT '.$offset.', '.$limit;
           $p = $this->query($query);
           return $p;
        }
    }
}

