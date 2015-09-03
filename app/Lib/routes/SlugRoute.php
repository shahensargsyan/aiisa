<?php

App::uses('Postcard', 'Model');
App::uses('UserPostcard', 'Model');
App::uses('Category', 'Model');
App::uses('SitePage', 'Model');
App::uses('CakeRoute', 'Routing/Route');

class SlugRoute extends CakeRoute{

    public function __construct($template, $defaults = array(), $options = array()){
        parent::__construct($template, $defaults, $options);
        
        /*$this->Postcard = new Postcard();
        $this->UserPostcard = new UserPostcard();
        $this->Category = new Category();
        $this->SitePage = new SitePage();*/
        
    }

    public function parse($url){
        
        $params = parent::parse($url);
        var_dump($url,$params);die('sd');
        if(empty($params)){
            return false;
        }
        //var_dump($params);die;
        if(isset($params['slug'])){
//            $params['language'] = 'eng';
            $params['slug'] = 38;
            $params['action'] = 'fill_information';
            $params['controller'] = 'contracts';
//            var_dump($params);die;
            return $params;
            $categoryId = $this->Contract->find('first', array(
                'conditions'=> array(
                    'Contract.id LIKE ?' => $params['slug']
                ),
                'fields' => array(
                    'Contract.id',
                )
            ));
            
            
            /////////////////////////////Postcard category
            $url2 = str_replace("-", " ", $params['slug']);
            $params['slug'] = $url2;
//            $categoryId = $this->Category->field('id', array('Category.name LIKE ?' => $params['slug']));
            $categoryId = $this->Category->find('first', array(
                'conditions'=> array(
                    'Category.name LIKE ?' => $params['slug']
                ),
                'fields' => array(
                    'Category.id',
                    'Category.parent_id'
                )
            ));
            if(!empty($categoryId['Category']['id'])){
                if($categoryId['Category']['parent_id']){
                    $params['action'] = 'postcards';
                }else{
                    $params['action'] = 'category';                    
                }
                $params['pass']['slag'] = $categoryId['Category']['id'];
                return $params;
            }
            /*
            /////////////////////////////pages
            $pageUrl = $this->SitePage->field('url', array('SitePage.slug LIKE ?' => $params['slug']));
            if(!empty($pageUrl)){
                $params['controller'] = 'pages';
                $params['action'] = $pageUrl;
                return $params;
            }*/
        }
        if(isset($params['slug']) && isset($params['slug2'])){
            $url2 = str_replace("-", " ", $params['slug2']);
            $url2 = strtolower($url2);
            $params['slug2'] = $url2;
            if (!preg_match('#[0-9]#',$params['slug'])){
                ///////////invitations
                ///////////////////////////look with slug
                $postcardId = $this->Postcard->field('id', array('Postcard.slug LIKE ?' => $params['slug']));
                $categoryId = $this->Category->field('id', array('Category.name LIKE ?' => $params['slug2']));
                if(!empty($postcardId)){
                    $params['pass']['slag'] = $postcardId;
                    $params['pass']['slag2'] = $categoryId;
                    return $params;
                }
                //////////////////////slug is empty, look with name
                if(empty($postcardId)){
                    $url2 = str_replace("-", " ", $params['slug']);
                    $postcardId = $this->Postcard->field('id', array('Postcard.name LIKE ?' => $url2));
                    if(!empty($postcardId)){
                        $params['pass']['slag'] = $postcardId;
                        $params['pass']['slag2'] = $categoryId;
                        return $params;
                    }
                }
            }else{
                ////////////////////////////for edit
                $matches = explode(" ", $params['slug']);
                $postcardCurrentId = end($matches);
                $postcardId = $this->UserPostcard->field('id', array('UserPostcard.id =' => $postcardCurrentId));
                $categoryId = $this->Category->field('id', array('Category.name LIKE ?' => $params['slug2']));
                if(!empty($postcardId)){
                    $params['action'] = 'editPostcard';
                    $params['pass']['slag'] = $postcardId;
                    $params['pass']['slag2'] = $categoryId;
                    return $params;
                }
            }
            
        }
        return false;
    }

}
