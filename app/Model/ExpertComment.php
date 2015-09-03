<?php


class ExpertComment extends AppModel {

    public $name = "ExpertComment";
    
    public $validate = array(
        'content' => array(
            'rule' => 'notEmpty',
            'message' => 'content cannot be empty'
        ),
        'topic_id' => array(
            'rule' => 'numeric',
            'message' => 'content cannot be empty'
        ),
        'title' => array(
            'rule' => 'notEmpty',
            'message' => 'title cannot be empty'
        ),
    );
    
    public function paginateCount($conditions, $recursive, $extra){
        if($extra['queryId'] == 1){
           $query = 'SELECT
                `ExpertComment`.*
                FROM `expert_comments` AS `ExpertComment`
                LEFT JOIN `experts` AS `Expert`
                  ON (`Expert`.`id` = `ExpertComment`.`expert_id`)
                WHERE 1 = 1 '.$conditions.'
                GROUP By `ExpertComment`.`id`
                ORDER BY `ExpertComment`.`id` DESC ';
           $p = $this->query($query);
            return count($p);
        }
        if($extra['queryId'] == 2){
              $query = 'SELECT
                COUNT(*) AS `count`
                FROM `expert_comments` AS `ExpertComment`
                LEFT JOIN `topics` AS `Topic`
                  ON (`Topic`.`id` = `ExpertComment`.`topic_id`)
                LEFT JOIN `regions` AS `Region`
                  ON (`Region`.`id` = `ExpertComment`.`region_id`)
              WHERE  1=1 AND '.$conditions;
              $p = $this->query($query);
              
            return $p[0][0]["count"];
        }
    }

    public function paginate($conditions, $fields, $order, $limit, $page, $recursive, $extra){
        $pageNumber = $page - 1;
        $pageNumber = ($pageNumber < 0) ? 0 : $pageNumber;
        $offset = $pageNumber * $limit;

        if($extra['queryId'] == 1){
           $query = 'SELECT
                `ExpertComment`.*,
                `Expert`.`first_name`,
                `Expert`.`last_name`,
                `Expert`.`id`,
                `Expert`.`photo`,
                `Expert`.`job_title`
                FROM `expert_comments` AS `ExpertComment`
                LEFT JOIN `experts` AS `Expert`
                  ON (`Expert`.`id` = `ExpertComment`.`expert_id`)
                WHERE 1 = 1 '.$conditions.'
                GROUP By `ExpertComment`.`id`
                ORDER BY `ExpertComment`.`date` DESC
                LIMIT '.$offset.', '.$limit;
           $p = $this->query($query);
           return $p;
        }
        if($extra['queryId'] == 2){
             $query = 'SELECT
                `ExpertComment`.`title`,
                `ExpertComment`.`id`,
                `ExpertComment`.`photo`,
                `ExpertComment`.`photo_title`,
                `Topic`.`name`
              FROM `expert_comments` AS `ExpertComment`
                LEFT JOIN `topics` AS `Topic`
                  ON (`Topic`.`id` = `ExpertComment`.`topic_id`)
                LEFT JOIN `regions` AS `Region`
                  ON (`Region`.`id` = `ExpertComment`.`region_id`)
              WHERE   1=1 AND '.$conditions.'
              ORDER BY `ExpertComment`.`id` ASC
              LIMIT '.$offset.', '.$limit;
         $p = $this->query($query);
          return $p;
        }
        
    }


}

