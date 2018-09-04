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

class StylingMarginTop extends DataExtension
{
    private static $db = [
        'MarginTop'       => 'Varchar(255)',
    ];


    public function updateFieldLabels(&$labels)
    {
        parent::updateFieldLabels($labels);
        $labels['MarginTop'] = _t(__CLASS__.'.MarginTopLabel', 'Margin Top');
    }



    public function updateCMSFields(FieldList $fields)
    {

        // Margin Top
        $margin_top_values  = $this->owner->getAvailableMarginTopVariants();
        if (is_array($margin_top_values) && !empty($margin_top_values)) {
            $marginTopDropdown = DropdownField::create('MarginTop', _t(__CLASS__.'.MarginTopLabel', 'margin top'), $margin_top_values);
            $marginTopDropdown->setDescription(_t(__CLASS__.'.MarginTopDescription', 'override margin top'));
            $fields->insertBefore($marginTopDropdown, 'ExtraClass');
            $marginTopDropdown->setEmptyString(_t(__CLASS__.'.MarginTopEmptyString', 'Margin Top...'));
        } else {
            $fields->removeByName('MarginTop');
        }

        return $fields;
    }

    /**
     * get available values for MarginTop from config
     * @return mixed
     */
    public function getAvailableMarginTopVariants()
    {
        if ($this->owner->config()->get('margin_top_variants', Config::UNINHERITED)) {
            return $this->owner->config()->get('margin_top_variants', Config::UNINHERITED);
        } else {
            return $this->owner->config()->get('margin_top_variants');
        }
    }

    /**
     * getverified value from MarginTop
     * @return mixed|string
     */
    public function getMarginTopVariant()
    {
        $margin_top = $this->owner->MarginTop;
        $margin_top_variants = $this->owner->getAvailableMarginTopVariants();
        // only return when value is in array of available variants
        if (is_array($margin_top_variants) && !empty($margin_top_variants) && isset($margin_top_variants[$margin_top])) {
            $margin_top = strtolower($margin_top);
            return $margin_top;
        } else {
            return '';
        }
    }

}
