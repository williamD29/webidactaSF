<?php

namespace App\Doctrine;

use App\Entity\Sheet;
use Symfony\Component\Security\Core\Security;

class SheetSetOwnerListener
{
    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    public function prePersist(Sheet $sheet)
    {
        if($sheet->getUserId()) {
            return;
        }

        if($this->security->getUser()) {
            $sheet->setUserId($this->security->getUser()->getId());
        }
    }

}