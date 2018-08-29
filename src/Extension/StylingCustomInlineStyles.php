<?php

namespace Derralf\ElementalStyling;

use SilverStripe\Forms\FieldList;
use SilverStripe\ORM\DataExtension;


class StylingCustomInlineStyles extends DataExtension
{
    private static $db = [
        'CustomInlineStyles' => 'Varchar(255)',
    ];

    public function updateFieldLabels(&$labels)
    {
        parent::updateFieldLabels($labels);
        $labels['CustomInlineStyles'] = _t(__CLASS__.'.CustomInlineStylesLabel', 'CustomInlineStyles');
    }


    public function updateCMSFields(FieldList $fields)
    {
        // Custom inline Styles: move to Settings Tab
        $CustomInlineStyles = $fields->dataFieldByName('CustomInlineStyles');
        $fields->removeByName('CustomInlineStyles');
        $fields->addFieldToTab('Root.ExpertSettings', $CustomInlineStyles);


        return $fields;
    }

}
