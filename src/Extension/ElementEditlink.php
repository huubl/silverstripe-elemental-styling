<?php

namespace Derralf\ElementalStyling;

use SilverStripe\ORM\DataExtension;


class ElementEditlink extends DataExtension
{
    private static $db = [
    ];


    public function getFrontendCMSEditLink()
    {
        if ($this->owner->canEdit()) {
            return $this->owner->CMSEditLink();
        }
    }

}
