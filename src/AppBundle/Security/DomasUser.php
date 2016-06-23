<?php

namespace AppBundle\Security;

use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\EquatableInterface;


class DomasUser implements UserInterface, EquatableInterface {

    private $shibbolethUid;   // z.B: dave1337
    //private $password;  // passwort wird wahrscheinlich garnicht übertragen!
    private $salt;
    private $roles;
    private $vorname;
    private $nachname;
    private $email;
    private $domasId;

    const adminRole = "ROLE_ADMIN";
    const employeeRole = "ROLE_EMPLOYEE";
    const studentRole = "ROLE_STUDENT";


    public function __construct($shibbolethUid, $salt, array $roles, $vorname, $nachname, $email, $domasId)
    {
        $this->shibbolethUid = $shibbolethUid;
        $this->salt = $salt;
        $this->roles = $roles;
        $this->vorname = $vorname;
        $this->nachname = $nachname;
        $this->email = $email;
        $this->domasId = $domasId;
    }

    public function getRoles()
    {
        return $this->roles;
    }

    /**
     * @return boolean
     * ob der User über Admin-Rechte oder höher verfügt.
     */
    public function hasAdminRights()
    {
        return in_array(self::adminRole, $this->roles);
    }

    /**
     * @return boolean
     * ob der User über Employee-Rechte oder höher verfügt.
     */
    public function hasEmployeeRights()
    {
        return (in_array(self::employeeRole, $this->roles) || $this->hasAdminRights());
    }

    /**
     * @return boolean
     * ob der User über Student-Rechte oder höher verfügt.
     */
    public function hasStudentRights()
    {
        return (in_array(self::studentRole, $this->roles) || $this->hasEmployeeRights());
    }


    public function getPassword()
    {
        return $this->password;
    }

    public function getSalt()
    {
        return $this->salt;
    }

    // "Username" wegen Zwang des Interfaces!
    public function getUsername()
    {
        return $this->shibbolethUid;
    }

    public function eraseCredentials()
    {
        // ?!
    }

    public function isEqualTo(UserInterface $user)
    {
        if (!$user instanceof DomasUser) {
            return false;
        }

        if ($this->shibbolethUid !== $user->shibbolethUid()) {
            return false;
        }

        return true;
    }
}