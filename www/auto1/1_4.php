<?php

/*

Please make an implementation of the class User, so that code
```
$user = new User();

$user->setFirstName('John')
    ->setLastName('Doe')
    ->setEmail('john.doe@example.com')
;

echo $user;
```

Will result a string

```
"John Doe <john.doe@example.com>"
```

Expected result: only an implementation of a class User

*/

/**
 * User controller.
 *
 * I have no requirements for the class. Which PHP version should I support.
 * In this case I have no chance to get the requirements, so I will use my own.
 *
 * PHP7. Strict string type for input (first/last name, email).
 * NULL values are allowed when printing. So in case of no values for name and email, the result will look like '  <>'
 *
 * This class requires PHP7.
 */

/**
 * User class.
 *
 * I have no requirements for the class. Which PHP version should I support.
 * In this case I have no chance to get the requirements, so I will use my own.
 *
 * PHP7. Strict string type for input (first/last name, email).
 * Class checks incoming values and throws Exception if an error occurs
 *
 * This class requires PHP7.
 *
 * @property string $firstName
 * @property string $lastName
 * @property string $email
 */
class User
{
    /**
     * User first name.
     *
     * @var string
     */
    protected $firstName;

    /**
     * User last name.
     *
     * @var string
     */
    protected $lastName;

    /**
     * User email.
     *
     * @var string
     */
    protected $email;

    public function __construct(string $firstName = '', string $lastName = '', string $email = '')
    {
        $this->setFirstName($firstName);
        $this->setLastName($lastName);
        $this->setEmail($email);
    }

    /**
     * @return string
     */
    public function getFirstName() : string
    {
        return $this->firstName;
    }
    
    /**
     * @param string $firstName
     * @return User
     */
    public function setFirstName(string $firstName)
    {
        $this->firstName = $firstName;
        return $this;
    }
    
    /**
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }
    
    /**
     * @param string $lastName
     * @return User
     */
    public function setLastName(string $lastName)
    {
        $this->lastName = $lastName;
        return $this;
    }
    
    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }
    
    /**
     * @param string $email
     * @return User
     */
    public function setEmail(string $email)
    {
        if (!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new Exception('Incorrect Email Address');
        }
        $this->email = $email;
        return $this;
    }
    
    /**
     * get full user info
     */
    public function __toString()
    {
        $outputEmail = !empty($this->getEmail()) ? ' <' . $this->getEmail() . '>' : '';
        return trim($this->getFirstName() . ' ' . $this->getLastName() . $outputEmail);
    }
}

$user = new User();
 
$user->setFirstName('John');
    $user->setLastName('Doe')
    ->setEmail('john.doe@example.com')
;

echo $user;
