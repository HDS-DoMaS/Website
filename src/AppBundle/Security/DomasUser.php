<?php

namespace AppBundle\Security;

use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\EquatableInterface;
use AppBundle\Entity\Benutzer;


class DomasUser implements UserInterface, EquatableInterface {

    private $benutzer;  // Datenbank-Entity

    const adminRole = "ROLE_ADMIN";
    const employeeRole = "ROLE_EMPLOYEE";
    const studentRole = "ROLE_STUDENT";


    public function __construct($doctrine, $shibbolethUid, $salt, array $roles, $vorname, $nachname, $email, $domasId) {

        // Benutzer in der DB suchen
        $this->benutzer = $doctrine
            ->getRepository('AppBundle:ArchivZusatzKategorie')
            ->findOneBy(
                array('shibbolethUid' => $shibbolethUid));       // TODO TESTEN

        //wenn User noch nicht in der DB existiert
        if($this->benutzer == null) {
            $this->benutzer = new Benutzer();
            $this->benutzer->setShibbolethUid($shibbolethUid);
        }

        $this->benutzer->setVorname($vorname);
        $this->benutzer->setNachname($nachname);
        $this->benutzer->setEMail($email);
        $this->setRoles($roles);

//        $queryBuilder = $doctrine->createQueryBuilder();


        $doctrine->persist($this->benutzer);
        $doctrine->flush();
    }


    public function getRoles()
    {
        return array($this->benutzer->getDomasRole());
    }

    /**
     * @param array $roles
     * mappt die Shibboleth-Roles auf die internen Domas-Role um.
     */
    private function setRoles(array $roles) {

        $temp = null;

        foreach($roles as $role) {

            if($role === "student") {
                $temp = self::studentRole;
            }
            elseif($role === "employee" && $temp === null) {
                $temp = self::employeeRole;
            }
        }
        $this->benutzer->setDomasRole($temp);
    }
    

    public function getPassword()
    {
        return null;
    }

    public function getSalt()
    {
        return null;
    }

    // "Username" wegen Zwang des Interfaces!
    public function getUsername()
    {
        return $this->benutzer->getShibbolethUid();
    }

    public function eraseCredentials()
    {
        // ?!
    }

    public function isEqualTo(UserInterface $user)
    {
        if (!($user instanceof DomasUser)) {
            return false;
        }

        if ($this->getUsername() !== $user->getUsername()) {
            return false;
        }

        return true;
    }
}