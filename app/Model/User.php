<?php

class User extends AppModel {

    public $name = "User";
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
        'city' => array(
            'rule'    => "/^[a-z-' ]{3,}$/i",
            'allowEmpty' => true,
            'message' =>"Please make sure you type a correct City"),
        'state' => array(
            'rule'    => "/^[a-z-' ]{3,}$/i",
            'allowEmpty' => true,
            'message' =>"Please make sure you type a correct State"),        
        'country' => array(
            'rule'    => "/^[a-z-' ]{3,}$/i",
            'allowEmpty' => true,
            'message' =>"Please make sure you type a correct Country"),
        'phone_number' => array(
            'rule' => 'numeric',
            'allowEmpty' => true,
            'message'=>'Phone number should be numeric'),
        'postal' => array(
            'rule' => array('maxLength', 255),
            'allowEmpty' => true,
            'message' => 'Postal must be no larger than 255 characters long.'), 
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
    
    function getCountries(){
         return  array(
                'Afghanistan' => 'Afghanistan', 'Albania' => 'Albania', 'Algeria' => 'Algeria',
                'American Samoa' => 'American Samoa', 'Andorra' => 'Andorra',
                'Angola' => 'Angola', 'Anguilla' => 'Anguilla',
                'Antarctica' => 'Antarctica', 'Antigua and Barbuda' => 'Antigua and Barbuda',
                'Argentina' => 'Argentina', 'Armenia' => 'Armenia',
                'Aruba' => 'Aruba', 'Australia' => 'Australia',
                'Austria' => 'Austria', 'Bahamas' => 'Bahamas',
                'Bahrain' => 'Bahrain', 'Bangladesh' => 'Bangladesh',
                'Barbados' => 'Barbados', 'Belarus' => 'Belarus',
                'Belgium' => 'Belgium', 'Belize' => 'Belize',
                'Benin' => 'Benin', 'Bermuda' => 'Bermuda',
                'Bhutan' => 'Bhutan', 'Bolivia' => 'Bolivia',
                'Bosnia and Herzegovina' => 'Bosnia and Herzegovina', 'Botswana' => 'Botswana',
                'Bouvet Island' => 'Bouvet Island', 'Brazil' => 'Brazil',
                'British Indian Ocean Territory' => 'British Indian Ocean Territory', 'Brunei Darussalam' => 'Brunei Darussalam',
                'Bulgaria' => 'Bulgaria', 'Burkina Faso' => 'Burkina Faso',
                'Burundi' => 'Burundi', 'Cambodia' => 'Cambodia',
                'Cameroon' => 'Cameroon', 'Canada' => 'Canada',
                'Cape Verde' => 'Cape Verde', 'Cayman Islands' => 'Cayman Islands',
                'Central African Republic' => 'Central African Republic', 'Chad' => 'Chad',
                'Chile' => 'Chile', 'China' => 'China',
                'Christmas Island' => 'Christmas Island', 'Cocos (Keeling) Islands' => 'Cocos (Keeling) Islands',
                'Colombia' => 'Colombia', 'Comoros' => 'Comoros',
                'Congo' => 'Congo', 'Congo, The Democratic Republic of The' => 'Congo, The Democratic Republic of The',
                'Cook Islands' => 'Cook Islands', 'Costa Rica' => 'Costa Rica',
                'Cote Divoire' => 'Cote Divoire', 'Croatia' => 'Croatia',
                'Cuba' => 'Cuba', 'Cyprus' => 'Cyprus',
                'Czech Republic' => 'Czech Republic', 'Denmark' => 'Denmark',
                'Djibouti' => 'Djibouti', 'Dominica' => 'Dominica',
                'Dominican Republic' => 'Dominican Republic', 'Ecuador' => 'Ecuador',
                'Egypt' => 'Egypt', 'El Salvador' => 'El Salvador',
                'Equatorial Guinea' => 'Equatorial Guinea', 'Eritrea' => 'Eritrea',
                'Estonia' => 'Estonia', 'Ethiopia' => 'Ethiopia',
                'Falkland Islands (Malvinas)' => 'Falkland Islands (Malvinas)', 'Faroe Islands' => 'Faroe Islands',
                'Fiji' => 'Fiji', 'Finland' => 'Finland',
                'France' => 'France', 'French Guiana' => 'French Guiana',
                'French Polynesia' => 'French Polynesia', 'French Southern Territories' => 'French Southern Territories',
                'Gabon' => 'Gabon', 'Gambia' => 'Gambia',
                'Georgia' => 'Georgia', 'Germany' => 'Germany',
                'Ghana' => 'Ghana', 'Gibraltar' => 'Gibraltar',
                'Greece' => 'Greece', 'Greenland' => 'Greenland',
                'Grenada' => 'Grenada', 'Guadeloupe' => 'Guadeloupe',
                'Guam' => 'Guam', 'Guatemala' => 'Guatemala',
                'Guinea' => 'Guinea', 'Guinea-bissau' => 'Guinea-bissau',
                'Guyana' => 'Guyana', 'Haiti' => 'Haiti',
                'Heard Island and Mcdonald Islands' => 'Heard Island and Mcdonald Islands', 'Holy See (Vatican City State)' => 'Holy See (Vatican City State)',
                'Honduras' => 'Honduras', 'Hong Kong' => 'Hong Kong',
                'Hungary' => 'Hungary', 'Iceland' => 'Iceland',
                'India' => 'India', 'Indonesia' => 'Indonesia',
                'Iran, Islamic Republic of' => 'Iran, Islamic Republic of', 'Iraq' => 'Iraq',
                'Ireland' => 'Ireland', 'Israel' => 'Israel',
                'Italy' => 'Italy', 'Jamaica' => 'Jamaica',
                'Japan' => 'Japan', 'Jordan' => 'Jordan',
                'Kazakhstan' => 'Kazakhstan', 'Kenya' => 'Kenya',
                'Kiribati' => 'Kiribati', 'Korea, Democratic Peoples Republic of' => 'Korea, Democratic Peoples Republic of',
                'Korea, Republic of' => 'Korea, Republic of', 'Kuwait' => 'Kuwait',
                'Kyrgyzstan' => 'Kyrgyzstan', 'Lao Peoples Democratic Republic' => 'Lao Peoples Democratic Republic',
                'Latvia' => 'Latvia', 'Lebanon' => 'Lebanon',
                'Lesotho' => 'Lesotho', 'Liberia' => 'Liberia',
                'Libyan Arab Jamahiriya' => 'Libyan Arab Jamahiriya', 'Liechtenstein' => 'Liechtenstein',
                'Lithuania' => 'Lithuania', 'Luxembourg' => 'Luxembourg',
                'Macao' => 'Macao', 'Macedonia, The Former Yugoslav Republic of' => 'Macedonia, The Former Yugoslav Republic of',
                'Madagascar' => 'Madagascar', 'Malawi' => 'Malawi',
                'Malaysia' => 'Malaysia', 'Maldives' => 'Maldives',
                'Mali' => 'Mali', 'Malta' => 'Malta',
                'Marshall Islands' => 'Marshall Islands', 'Martinique' => 'Martinique',
                'Mauritania' => 'Mauritania', 'Mauritius' => 'Mauritius',
                'Mayotte' => 'Mayotte', 'Mexico' => 'Mexico',
                'Micronesia, Federated States of' => 'Micronesia, Federated States of', 'Moldova, Republic of' => 'Moldova, Republic of',
                'Monaco' => 'Monaco', 'Mongolia' => 'Mongolia',
                'Montserrat' => 'Montserrat', 'Morocco' => 'Morocco',
                'Mozambique' => 'Mozambique', 'Myanmar' => 'Myanmar',
                'Namibia' => 'Namibia', 'Nauru' => 'Nauru',
                'Nepal' => 'Nepal', 'Netherlands' => 'Netherlands',
                'Netherlands Antilles' => 'Netherlands Antilles', 'New Caledonia' => 'New Caledonia',
                'New Zealand' => 'New Zealand', 'Nicaragua' => 'Nicaragua',
                'Niger' => 'Niger', 'Nigeria' => 'Nigeria',
                'Niue' => 'Niue', 'Norfolk Island' => 'Norfolk Island',
                'Northern Mariana Islands' => 'Northern Mariana Islands', 'Norway' => 'Norway',
                'Oman' => 'Oman', 'Pakistan' => 'Pakistan',
                'Palau' => 'Palau', 'Palestinian Territory, Occupied' => 'Palestinian Territory, Occupied',
                'Panama' => 'Panama', 'Papua New Guinea' => 'Papua New Guinea', 'Paraguay' => 'Paraguay',
                'Peru' => 'Peru', 'Philippines' => 'Philippines',
                'Pitcairn' => 'Pitcairn', 'Poland' => 'Poland',
                'Portugal' => 'Portugal', 'Puerto Rico' => 'Puerto Rico',
                'Qatar' => 'Qatar', 'Reunion' => 'Reunion',
                'Romania' => 'Romania', 'Russian Federation' => 'Russian Federation',
                'Rwanda' => 'Rwanda', 'Saint Helena' => 'Saint Helena', 'Saint Kitts and Nevis' => 'Saint Kitts and Nevis',
                'Saint Lucia' => 'Saint Lucia', 'Saint Pierre and Miquelon' => 'Saint Pierre and Miquelon',
                'Saint Vincent and The Grenadines' => 'Saint Vincent and The Grenadines', 'Samoa' => 'Samoa',
                'San Marino' => 'San Marino', 'Sao Tome and Principe' => 'Sao Tome and Principe',
                'Saudi Arabia' => 'Saudi Arabia', 'Senegal' => 'Senegal',
                'Serbia and Montenegro' => 'Serbia and Montenegro', 'Seychelles' => 'Seychelles',
                'Sierra Leone' => 'Sierra Leone', 'Singapore' => 'Singapore',
                'Slovakia' => 'Slovakia', 'Slovenia' => 'Slovenia',
                'Solomon Islands' => 'Solomon Islands', 'Somalia' => 'Somalia',
                'South Africa' => 'South Africa', 'South Georgia and The South Sandwich Islands' => 'South Georgia and The South Sandwich Islands',
                'Spain' => 'Spain', 'Sri Lanka' => 'Sri Lanka',
                'Sudan' => 'Sudan', 'Suriname' => 'Suriname',
                'Svalbard and Jan Mayen' => 'Svalbard and Jan Mayen', 'Swaziland' => 'Swaziland',
                'Syrian Arab Republic' => 'Syrian Arab Republic', 'Taiwan, Province of China' => 'Taiwan, Province of China',
                'Tajikistan' => 'Tajikistan', 'Tanzania, United Republic of' => 'Tanzania, United Republic of',
                'Thailand' => 'Thailand', 'Timor-leste' => 'Timor-leste',
                'Togo' => 'Togo', 'Trinidad and Tobago' => 'Trinidad and Tobago',
                'Tunisia' => 'Tunisia', 'Turkmenistan' => 'Turkmenistan',
                'Tuvalu' => 'Tuvalu', 'Uganda' => 'Uganda',
                'Ukraine' => 'Ukraine', 'United Arab Emirates' => 'United Arab Emirates',
                'United Kingdom' => 'United Kingdom', 'United States' => 'United States',
                'United States Minor Outlying Islands' => 'United States Minor Outlying Islands', 'Uruguay' => 'Uruguay',
                'Uzbekistan' => 'Uzbekistan', 'Vanuatu' => 'Vanuatu', 'Venezuela' => 'Venezuela',
                'Viet Nam' => 'Viet Nam', 'Virgin Islands, British' => 'Virgin Islands, British',
                'Virgin Islands, U.S.' => 'Virgin Islands, U.S.', 'Wallis and Futuna' => 'Wallis and Futuna',
                'Western Sahara' => 'Western Sahara', 'Yemen' => 'Yemen',
                'Zambia' => 'Zambia', 'Zimbabwe' => 'Zimbabwe',
            );
    }

}
