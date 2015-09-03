<?php

class Expert extends AppModel {

    public $name = "Expert";
    public $validate = array(
        'first_name' => array(
            'rule' => array('maxLength', 255),
            'message' => 'names must be no larger than 255 characters long.'),
        'last_name' => array(
            'rule' => array('maxLength', 255),
            'message' => 'names must be no larger than 255 characters long.'),
        
        'address' => array(
            'rule' => array('maxLength', 255),
            'allowEmpty' => true,
            'message' =>"Address can't contain more than 255 characters."),
        'phone_number' => array(
            'rule' => array('maxLength', 255),
            'allowEmpty' => true,
            'message'=>'Phone number  cant contain more than 255 characters.'),
        'summary' => array(
            'allowEmpty' => false,
         ), 
        'password' => array(
            'rule' => array('minLength', 6),
            'message' => 'Password must be minimum 6x characters'),
        'email' => array(
            'email' => array(
                'rule' => 'email',
                'message' => 'Please supply a valid email address'
            ),
            'isUnique' => array(
                'rule' => 'isUnique',
                'message' => 'This email has already been taken.'
            ),
        )
    );

    function ValidateRegistration($data) {
        $valid = true;
        $regexp = '/^[a-zA-Z0-9-_.+]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/i';
        if (!trim($data['first_name'])) {
            throw new Exception('Please Fill in First name');
        } elseif (!trim($data['last_name'])) {
            throw new Exception('Please Fill in Last name');
        } elseif ($this->GetUser($data['email'])) {
            throw new Exception('This email is already in use!');
        } elseif (!trim($data['email'])) {
            throw new Exception('Please Fill in email');
        } elseif ($this->GetEmail($data['email'])) {
            throw new Exception('Email has been used already, please try another one');
        } elseif (!preg_match($regexp, $data['email'])) {
            throw new Exception('Please Fill in correct email address');
        } elseif (!trim($data['password'])) {
            throw new Exception('Please Fill in password');
        } elseif ($data['password'] !== $data['confirm_password']) {
            throw new Exception("password and confirm password doesn't match!");
        }
        return true;
    }

    function ValidateEmail($data) {
        $valid = true;
        $regexp = '/^[a-zA-Z0-9-_.+]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/i';
        if (!trim($data['email'])) {
            throw new Exception('Please Fill in email');
        } elseif (!preg_match($regexp, $data['email'])) {
            throw new Exception('Please Fill in correct email address');
        }
        return true;
    }

    function ValidateContact($data) {
        $valid = true;
        $regexp = '/^[a-zA-Z0-9-_.+]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/i';
        if (!trim($data['name'])) {
            throw new Exception('Please Fill in your name');
        } elseif (!trim($data['email'])) {
            throw new Exception('Please Fill in email');
        } elseif (!preg_match($regexp, $data['email'])) {
            throw new Exception('Please Fill in correct email address');
        } elseif (!trim($data['subject'])) {
            throw new Exception('Please Fill in subject');
        } elseif (!trim($data['message'])) {
            throw new Exception('Please Fill in message');
        }
        return true;
    }

    function ValidateEdit($data) {
        $valid = true;
        $zipRegExp = "/^[A-Za-z0-9-]+$/";
        $regexp = '/^[a-zA-Z0-9-_.+]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/i';
        //$regexp = '/^[\w-]+(\.[\w-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/';
        if (!trim($data['first_name'])) {
            throw new Exception('Plese Fill in First name');
        } elseif (!trim($data['last_name'])) {
            throw new Exception('Plese Fill in Last name');
        } elseif (trim($data['new_password']) && $data['new_password'] !== $data['confirm_password']) {
            throw new Exception("password and confirm password doesn't match!");
        } elseif (!preg_match($regexp, $data['email'])) {
            throw new Exception('Please Fill in correct email address');
        }
        return true;
    }

    function ValidateEditInv($data) {
        $valid = true;
        $regexp = '/^[a-zA-Z0-9-_.+]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/i';
        //$regexp = '/^[\w-]+(\.[\w-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/';
        if (!trim($data['first_name'])) {
            throw new Exception('Plese Fill in First name');
        } elseif (!trim($data['last_name'])) {
            throw new Exception('Plese Fill in Last name');
        } elseif (!trim($data['new_password'])) {
            throw new Exception('Plese Fill in Password');
        } elseif ($data['new_password'] !== $data['confirm_password']) {
            throw new Exception("password and confirm password doesn't match!");
        }
        return true;
    }

    function ValidateComment($data) {
        $valid = true;
        $regexp = '/^[a-zA-Z0-9-_.+]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/i';
        if (!trim($data['name'])) {
            throw new Exception('Please Fill in Your name');
        } elseif (!trim($data['email'])) {
            throw new Exception('Please Fill in email');
        } elseif (!preg_match($regexp, $data['email'])) {
            throw new Exception('Please Fill in correct email address');
        }
        return true;
    }

    function ValidateChangePass($data) {
        $valid = true;
        if (!trim($data['new_password'])) {
            throw new Exception('Plese Fill in Password');
        } elseif ($data['new_password'] !== $data['confirm_password']) {
            throw new Exception("password and confirm password doesn't match!");
        }
        return true;
    }

    function ValidateMail($data) {
        $valid = true;
        $zipRegExp = "/^[A-Za-z0-9-]+$/";
//        $regexp = '/^[_a-zA-Z0-9-_.+]+@[a-zA-Z0-9-]+(\.[a-zA-Z0-9-]+)*(\.[a-zA-Z]{2,4})$/';
        $regexp = '/^[a-zA-Z0-9-_.+]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/i';
        //$regexp = '/^[\w-]+(\.[\w-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/';
        if (!preg_match($regexp, $data['email'])) {
            throw new Exception('Please Fill in correct email address');
        }
        return true;
    }

    function ValidateInvitation($data) {
        $valid = true;
        $regexp = '/^[a-zA-Z0-9-_.+]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/i';
        // $regexp = '/^[\w-]+(\.[\w-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/';
        if (!trim($data['first_name'])) {
            throw new Exception('Plese Fill in First name');
        } elseif (!trim($data['last_name'])) {
            throw new Exception('Plese Fill in Last name');
        } elseif (!trim($data['username'])) {
            throw new Exception('Plese Fill in username');
        } elseif ($this->GetUser($data['username'])) {
            throw new Exception('This user name is already in use!');
        } elseif (!trim($data['email'])) {
            throw new Exception('Plese Fill in email');
        } elseif ($this->GetEmail($data['email'])) {
            throw new Exception('Email has been used already, please try another one');
        } elseif (!preg_match($regexp, $data['email'])) {
            throw new Exception('Plese Fill in correct email address');
        }
        return true;
    }

    function GetUser($email) {
        $conditions = array(
            'User.email' => $email,
        );
        $user = $this->find(
                'first', array(
            'conditions' => $conditions
                )
        );

        return !empty($user);
    }

    function GetEmail($email) {
        $conditions = array(
            'User.email' => $email
        );
        $user = $this->find(
                'first', array(
            'conditions' => $conditions
                )
        );

        return !empty($user);
    }
    public function paginateCount($conditions, $recursive, $extra){
        if($extra['queryId'] == 1){
            $query = 'SELECT
                `Expert`.`id`
                FROM `experts` AS `Expert`
                WHERE `active` = 1 '.$conditions;

           $p = $this->query($query);
            return count($p);
        }
    }

    public function paginate($conditions, $fields, $order, $limit, $page, $recursive, $extra){
        $pageNumber = $page - 1;
        $pageNumber = ($pageNumber < 0) ? 0 : $pageNumber;
        $offset = $pageNumber * $limit;

        if($extra['queryId'] == 1){
            $query = 'SELECT
                    `Expert`.`id`,
                    `Expert`.`first_name`,
                    `Expert`.`last_name`,
                    `Expert`.`summary`,
                    `Expert`.`job_title`,
                    `Expert`.`email`,
                    `Expert`.`password`,
                    `Expert`.`phone_number`,
                    `Expert`.`state`,
                    `Expert`.`address`,
                    `Expert`.`birthday`,
                    `Expert`.`gender`,
                    `Expert`.`broadcast_experience`,
                    `Expert`.`languages`,
                    `Expert`.`photo`,
                    `Expert`.`active`,
                    `Expert`.`created`,
                    `Expert`.`modified`
                  FROM `experts` AS `Expert`
                  WHERE `active` = 1 '.$conditions  
                . ' LIMIT '.$offset.', '.$limit;
           $p = $this->query($query);
           return $p;
        }
    }
}
