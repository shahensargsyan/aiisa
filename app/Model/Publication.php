<?php

class Publication extends AppModel {

    public $name = "Publication";
    //var $belongsTo = array('PublicationRegion');
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
            $fields = "COUNT(*) as `count` ";

            $query = "SELECT * FROM (
                        (
                            SELECT id, title, 'publication' AS TYPE
                            FROM publications 
                            WHERE content LIKE '%".$conditions."%' OR title LIKE '%".$conditions."%'
                        ) 
                        UNION
                        (
                            SELECT id, title, 'comment' AS TYPE
                            FROM expert_comments 
                            WHERE title LIKE '%".$conditions."%' OR title LIKE '%".$conditions."%'
                        ) 
                        UNION
                        (
                            SELECT id, title, 'event' AS TYPE
                            FROM `events` 
                            WHERE title LIKE '%".$conditions."%' OR title LIKE '%".$conditions."%'
                        )
                    )AS result ORDER BY result.id
                    ";
            $p = $this->query($query);
            return count($p);
        }
        if($extra['queryId'] == 2){
           $query = 'SELECT `Publication`.* '
                   . 'FROM `publications` AS `Publication` '
                   . 'LEFT JOIN `experts` AS `Expert` ON (`Expert`.`id` = `Publication`.`expert_id`)'
                   . 'LEFT JOIN `topics` AS `Topic` ON (`Topic`.`id` = `Publication`.`topic_id`) '
                   . 'LEFT JOIN `publication_regions` AS `PublicationRegions` ON (`Publication`.`id` = `PublicationRegions`.`publication_id`) '
                   . 'LEFT JOIN `regions` AS `Region` ON (`Region`.`id` = `PublicationRegions`.`region_id`) '
                   . 'WHERE 1=1 '.$conditions
                   . ' GROUP BY Publication.id ORDER BY `Publication`.`id` DESC ';
           $p = $this->query($query);
            return count($p);
        }
        if($extra['queryId'] == 3){
           $query = 'SELECT *'
            . 'FROM `publications` AS `Publication` '
            . 'LEFT JOIN `topics` AS `Topic` ON (`Topic`.`id` = `Publication`.`topic_id`) '
            . 'LEFT JOIN `publication_regions` AS `PublicationRegions` ON (`Publication`.`id` = `PublicationRegions`.`publication_id`) '
            . 'LEFT JOIN `regions` AS `Region` ON (`Region`.`id` = `PublicationRegions`.`region_id`) '
            . 'WHERE `Publication`.`active`=1 AND '.$conditions
            . ' GROUP BY `Publication`.`id` ';
            $p = $this->query($query);
            return count($p);
        }
        if($extra['queryId'] == 4){
            $fields = "COUNT(*) as `count` ";

            $query = "SELECT * FROM (
                        (
                            SELECT id, title, 'publication' AS TYPE
                            FROM publications 
                            WHERE ".$conditions[1]."
                        ) 
                        UNION
                        (
                            SELECT id, title, 'comment' AS TYPE
                            FROM expert_comments 
                            WHERE ".$conditions[0]."
                        ) 
                        UNION
                        (
                            SELECT id, title, 'event' AS TYPE
                            FROM `events` 
                            WHERE ".$conditions[2]."
                        )
                    )AS result ORDER BY result.id DESC
                    ";
            $p = $this->query($query);
            return count($p);
        }
    }

    public function paginate($conditions, $fields, $order, $limit, $page, $recursive, $extra){
        $pageNumber = $page - 1;
        $pageNumber = ($pageNumber < 0) ? 0 : $pageNumber;
        $offset = $pageNumber * $limit;
        
        if($extra['queryId'] == 1){

            $query = "SELECT * FROM (
                        (
                            SELECT publications.id, title, 'publication' AS TYPE ,intro_text as intro,
                            publications.created as date,Expert.first_name,Expert.last_name,'' AS event_type,Topic.name as topic_name
                            FROM publications 
                            left join experts AS Expert ON Expert.id=publications.expert_id
                            left join topics AS Topic ON Topic.id=publications.topic_id
                            WHERE content LIKE '%".$conditions."%' OR title LIKE '%".$conditions."%'
                        )
                        UNION
                        (
                            SELECT expert_comments.id, title, 'comment' AS TYPE,intro_text as intro,
                            expert_comments.created as date,Expert.first_name,Expert.last_name,'' AS event_type,Topic.name as topic_name
                            FROM expert_comments 
                            left join experts AS Expert On Expert.id=expert_comments.expert_id
                            left join topics AS Topic ON Topic.id=expert_comments.topic_id
                            WHERE title LIKE '%".$conditions."%' OR title LIKE '%".$conditions."%'
                        ) 
                        UNION
                        (
                            SELECT events.id, title, 'event' AS TYPE, participants as intro,event_date as date,'','',
                            EventType.name AS event_type,''
                            FROM `events`
                            left join event_types AS EventType ON EventType.id=events.event_type
                            WHERE title LIKE '%".$conditions."%' OR title LIKE '%".$conditions."%'
                        )
                    )AS result ORDER BY result.id LIMIT ". $offset . "," . $limit;
            $p = $this->query($query);
            return $p;
        }
        if($extra['queryId'] == 2){
           $query = 'SELECT `Publication`.*, `Expert`.`first_name`, `Expert`.`last_name`, `Expert`.`id`, `Expert`.`photo`, `Expert`.`job_title`, `Topic`.* '
                   . 'FROM `publications` AS `Publication` '
                   . 'LEFT JOIN `experts` AS `Expert` ON (`Expert`.`id` = `Publication`.`expert_id`)'
                   . 'LEFT JOIN `topics` AS `Topic` ON (`Topic`.`id` = `Publication`.`topic_id`) '
                   . 'LEFT JOIN `publication_regions` AS `PublicationRegions` ON (`Publication`.`id` = `PublicationRegions`.`publication_id`) '
                   . 'LEFT JOIN `regions` AS `Region` ON (`Region`.`id` = `PublicationRegions`.`region_id`) '
                   . 'WHERE 1=1 '.$conditions
                   . ' order by Publication.date DESC; '
                   . ' GROUP BY Publication.id ORDER BY `Publication`.`id` DESC '
                   . 'LIMIT '.$offset.', '.$limit;
           $p = $this->query($query);
           return $p;
        }
        if($extra['queryId'] == 3){
            $query = 'SELECT `Publication`.`title`, `Publication`.`id`, `Publication`.`photo`, `Publication`.`photo_by`, `Topic`.* '
            . 'FROM `publications` AS `Publication` '
            . 'LEFT JOIN `topics` AS `Topic` ON (`Topic`.`id` = `Publication`.`topic_id`) '
            . 'LEFT JOIN `publication_regions` AS `PublicationRegions` ON (`Publication`.`id` = `PublicationRegions`.`publication_id`) '
            . 'LEFT JOIN `regions` AS `Region` ON (`Region`.`id` = `PublicationRegions`.`region_id`) '
            . 'WHERE `Publication`.`active`=1 AND '.$conditions 
            . ' GROUP BY `Publication`.`id` '
            .  ' LIMIT '.$offset.', '.$limit;
             $p = $this->query($query);
            
            return $p;
        }
        if($extra['queryId'] == 4){

            $query = "SELECT * FROM (
                        (
                            SELECT publications.id, publications.title, 'publication' AS TYPE ,intro_text as intro,
                            publications.created as date,Expert.first_name,Expert.last_name,'' AS event_type,Topic.name as topic_name,
                            publications.photo as photo
                            FROM publications 
                            left join experts AS Expert ON Expert.id=publications.expert_id
                            left join topics AS Topic ON Topic.id=publications.topic_id
                            WHERE ".$conditions[1]."
                        )
                        UNION
                        (
                            SELECT expert_comments.id, expert_comments.title, 'comment' AS TYPE,intro_text as intro,
                            expert_comments.created as date,Expert.first_name,Expert.last_name,'' AS event_type,Topic.name as topic_name,
                            expert_comments.photo as photo
                            FROM expert_comments 
                            left join experts AS Expert On Expert.id=expert_comments.expert_id
                            left join topics AS Topic ON Topic.id=expert_comments.topic_id
                            WHERE ".$conditions[0]."
                        ) 
                        UNION
                        (
                            SELECT events.id, events.title, 'event' AS TYPE, participants as intro,event_date as date,'','',
                            EventType.name AS event_type,'',events.photo as photo
                            FROM `events`
                            left join event_types AS EventType ON EventType.id=events.event_type
                            WHERE ".$conditions[2]."
                        )
                    )AS result ORDER BY result.id DESC LIMIT ". $offset . "," . $limit;
            $p = $this->query($query);
            return $p;
        }
    }
    public function getlatestCount($conditions){

        $query = "SELECT * FROM (
                    (
                        SELECT publications.id, title, 'publication' AS TYPE
                        FROM publications 
                        left join publication_regions AS PublicationRegion ON PublicationRegion.publication_id=publications.id
                        WHERE ".$conditions[1]."
                    ) 
                    UNION
                    (
                        SELECT id, title, 'comment' AS TYPE
                        FROM expert_comments 
                        WHERE ".$conditions[0]."
                    ) 
                    UNION
                    (
                        SELECT id, title, 'event' AS TYPE
                        FROM `events` 
                        WHERE ".$conditions[2]."
                    )
                )AS result ORDER BY result.id DESC
                ";
        $p = $this->query($query);
        
        return count($p);
    }

}

