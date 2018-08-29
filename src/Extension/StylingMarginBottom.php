<?php

namespace Derralf\ElementalStyling;

//use App\Model\ElementalPage;
//use DNADesign\Elemental\Models\ElementalArea;
//use Page;
use SilverStripe\Core\Config\Config;
use SilverStripe\Forms\DropdownField;
use SilverStripe\Forms\FieldList;
//use SilverStripe\Forms\LiteralField;
use SilverStripe\ORM\DataExtension;
//use SilverStripe\ORM\DataList;
//use SilverStripe\View\ArrayData;

class StylingMarginBottom extends DataExtension
{
    private static $db = [
//        'CustomInlineStyles' => 'Varchar(255)',
        'MarginBottom'       => 'Varchar(255)',
    ];


    public function updateFieldLabels(&$labels)
    {
        parent::updateFieldLabels($labels);
        $labels['MarginBottom'] = _t(__CLASS__.'.MarginBottomLabel', 'Title Tag');
    }



    public function updateCMSFields(FieldList $fields)
    {

        // Margin Bottom
        $margin_bottom_values  = $this->owner->getAvailableMarginBottomVariants();
        if (is_array($margin_bottom_values) && !empty($margin_bottom_values)) {
            $marginBottomDropdown = DropdownField::create('MarginBottom', _t(__CLASS__.'.MarginBottomLabel', 'margin bottom'), $margin_bottom_values);
            $marginBottomDropdown->setDescription(_t(__CLASS__.'.MarginBottomDescription', 'override margin bottom'));
            $fields->insertBefore($marginBottomDropdown, 'ExtraClass');
            $marginBottomDropdown->setEmptyString(_t(__CLASS__.'.MarginBottomEmptyString', 'Margin Bottom...'));
        } else {
            $fields->removeByName('MarginBottom');
        }

        return $fields;
    }

    /**
     * get available values for MarginBottom from config
     * @return mixed
     */
    public function getAvailableMarginBottomVariants()
    {
        if ($this->owner->config()->get('margin_bottom_variants', Config::UNINHERITED)) {
            return $this->owner->config()->get('margin_bottom_variants', Config::UNINHERITED);
        } else {
            return $this->owner->config()->get('margin_bottom_variants');
        }
    }

    /**
     * getverified value from MarginBottom
     * @return mixed|string
     */
    public function getMarginBottomVariant()
    {
        $margin_bottom = $this->owner->MarginBottom;
        $margin_bottom_variants = $this->owner->getAvailableMarginBottomVariants();
        // only return when value is in array of available variants
        if (is_array($margin_bottom_variants) && !empty($margin_bottom_variants) && isset($margin_bottom_variants[$margin_bottom])) {
            $margin_bottom = strtolower($margin_bottom);
            return $margin_bottom;
        } else {
            return '';
        }
    }

}
