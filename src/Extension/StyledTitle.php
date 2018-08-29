<?php

namespace Derralf\ElementalStyling;

use SilverStripe\Core\Config\Config;
use SilverStripe\Forms\DropdownField;
use SilverStripe\Forms\FieldList;
use SilverStripe\ORM\DataExtension;

class StyledTitle extends DataExtension
{
    private static $db = [
        'TitleTag'           => 'Varchar(255)',
        'TitleAlignment'     => 'Varchar(255)',
    ];

    private static $title_tag_default = 'h2';

    public function updateFieldLabels(&$labels)
    {
        parent::updateFieldLabels($labels);
        $labels['TitleTag'] = _t(__CLASS__.'.TitleTagLabel', 'Title Tag');
        $labels['TitleAlignment'] = _t(__CLASS__.'.TitleAlignmentLabel', 'Alignment');
    }


    public function updateCMSFields(FieldList $fields)
    {

        // Title Alignment
        $title_alignments = $this->owner->getAvailableTitleAlignmentVariants();
        if (is_array($title_alignments) && !empty($title_alignments)) {
            $TitleAlignment = new DropdownField('TitleAlignment', $this->owner->fieldLabel('TitleAlignment'), $title_alignments);
            $TitleAlignment->setEmptyString(_t(__CLASS__.'.TitleAlignmentEmptyString', 'default'));
            $fields->insertAfter('TitleAndDisplayed', $TitleAlignment);
        } else {
            $fields->removeByName('TitleAlignment');
        }


        // Title Tags
        $title_tags = $this->owner->getAvailableTitleTagVariants();
        if (is_array($title_tags) && !empty($title_tags)) {
            $TitleTag = new DropdownField('TitleTag', $this->owner->fieldLabel('TitleTag'), $title_tags);
            $TitleTag->setDescription(sprintf(_t(__CLASS__.'.TitleTagDescription','default: %s'), $this->owner->getTitleTagDefault()));
            $TitleTag->setEmptyString('default');
            $fields->insertAfter('TitleAndDisplayed', $TitleTag);
        } else {
            $fields->removeByName('TitleTag');
        }

        return $fields;
    }


    /**
     * get available values for TitleTag from config
     * @return mixed
     */
    public function getAvailableTitleTagVariants()
    {
        if ($this->owner->config()->get('title_tag_variants', Config::UNINHERITED)) {
            return $this->owner->config()->get('title_tag_variants', Config::UNINHERITED);
        } else {
            return $this->owner->config()->get('title_tag_variants');
        }
    }

    /**
     * get verified value from TitleTag or fallback
     * @return mixed|string
     */
    public function getTitleTagVariant()
    {
        $title_tag = $this->owner->TitleTag;
        $title_tag_variants = $this->owner->getAvailableTitleTagVariants();
        // only return when value is in array of available variants
        if ($title_tag && is_array($title_tag_variants) && !empty($title_tag_variants) && isset($title_tag_variants[$title_tag])) {
            return $this->owner->TitleTag;
        }
        // return fallback
        return $this->getTitleTagDefault();
    }

    /**
     * get fallback value for TitleTag from config
     * @return mixed
     */
    public function getTitleTagDefault()
    {
        return $this->owner->config()->get('title_tag_default');
    }



    /**
     * get available values for TitleAlignment from config
     * @return mixed
     */
    public function getAvailableTitleAlignmentVariants()
    {
        if ($this->owner->config()->get('title_alignment_variants', Config::UNINHERITED)) {
            return $this->owner->config()->get('title_alignment_variants', Config::UNINHERITED);
        } else {
            return $this->owner->config()->get('title_alignment_variants');
        }
    }

    /**
     * getverified value from TitleAlignment
     * @return mixed|string
     */
    public function getTitleAlignmentVariant()
    {
        $title_alignment= $this->owner->TitleAlignment;
        $title_alignment_variants = $this->owner->getAvailableTitleAlignmentVariants();
        // only return when value is in array of available variants
        if (is_array($title_alignment_variants) && !empty($title_alignment_variants) && isset($title_alignment_variants[$title_alignment])) {
            return $title_alignment;
        } else {
            return '';
        }

    }


}
