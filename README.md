# SilverStripe Elemental Styling Extension

Adds some Styling options to Elemental Blocks.  
(private project, no help/support provided)

## Requirements

* SilverStripe ^4.2
* dnadesign/silverstripe-elemental ^3.0


## Installation

- Install a module via Composer
  
  ```
  composer require derralf/silverstripe-styling
  ```

- Apply a desired extension on Block class (ie. ElementContent that ships with Core module or BaseElement to apply to all child elements) **mysite/_config/elements.yml**
  
  ```
  DNADesign\Elemental\Models\BaseElement:
  extensions:
      - Derralf\ElementalStyling\ElementEditlink
      - Derralf\ElementalStyling\StyledTitle
      - Derralf\ElementalStyling\StylingMarginBottom
      - Derralf\ElementalStyling\StylingCustomInlineStyles

  ```


## <a name="configuration_example"></a>Configuration Example

A basic/default config. Add this to your **mysite/\_config/elements.yml**

```

---
Name: elementalstyling
---
DNADesign\Elemental\Models\BaseElement:
  # use included holder template ElementHolderStyled.ss
  controller_template: 'ElementHolderStyled'
  # StyledTitle config
  title_tag_default: 'h2'
  title_tag_variants:
    '': 'default'
    h2 : 'H2'
    h3 : 'H3'
    h4 : 'H4'
  title_alignment_variants:
    text-left: 'left'
    text-center: 'centered'
    text-right: 'right'
  # StylingMarginBottom config
  margin_bottom_variants:
    mb-0: '0 (none)'
    mb-1: 'XS'
    mb-2: 'Small'
    mb-3: 'Medium'
    mb-4: 'Large'
    mb-5: 'XL'
```

Override title tag variants or title alignment classes for child elements:

```
My\Namespaced\Element:
  title_tag_variants:
    '': 'default'
    h3 : 'H3'
    h4 : 'H4'
  title_alignment_variants:  
    text-center: 'centered'

My\Namespaced\OtherElement:
  title_tag_variants: null
  title_alignment_variants: null
  
```


Additionally you may apply the default styles for StylingMarginBottom Extensions:

```
# add default styles
DNADesign\Elemental\Controllers\ElementController:
  default_styles:
    - derralf/elemental-styling:client/dist/styles/elemental_styling_margin_bottom_variants.css
```

(also see Elemental Docs for [how to disable the default styles](https://github.com/dnadesign/silverstripe-elemental#disabling-the-default-stylesheets))


## Extensions

- **ElementEditlink**  
  Adds links to backend for editors
  (modified ElementHolder template necessary)
- **Derralf\ElementalStyling\StyledTitle**  
  Adds styling options to Element Title (tag, alignment) - to content tab.
  (modifications to the/your Element-templates will be necessary)
- **Derralf\ElementalStyling\StylingMarginBottom**  
  Add CSS selector (for bottom margin) to the Element / Element Holder - see Settings tab.  
  (modified ElementHolder template necessary)
- **Derralf\ElementalStyling\StylingCustomInlineStyles**  
  Add inline CSS to the Element / Element Holder - see "Expert Settigs" tab.  
  (modified ElementHolder template necessary)

See [HolderTemplate](#holder_template) for included modified ElementHOlder Template.  
Also see [Template Notes](#template_notes) for StylingMarginBottom extension.

## <a name="template_notes"></a>Template Notes

### ElementEditlink

In your controller class like mysite/code/PageController.php:

```
Requirements::css('derralf/elemental-styling:client/dist/styles/elemental_editlink.css');
Requirements::javascript('derralf/elemental-styling:client/dist/js/elemental_editlink.js');
```


### StyledTitle

In your elements-templates replace

```<h2>$Title</h2>```(or similar)  
with  
```<% include Derralf\\Elements\\ElementTitleStyled %>```  
or something like  
```<{$TitleTagVariant} class="element__title {$TitleAlignmentVariant}">$Title</{$TitleTagVariant}>```



### StylingMarginBottom

Default config uses bootstrap 4 spacing selectors.

Optionally you can use the basic stylings provided with this module in your controller class like **mysite/code/PageController.php**
  ```
      Requirements::css('derralf/elemental-styling:dist/styles/elemental_styling_margin_bottom_variants.css');
  ```

Use [HolderTemplate](#holder_template) or add `class="{$MarginBottomVariant}"` to your ElementHolder template.


### StylingCustomInlineStyles

Use [HolderTemplate](#holder_template) or add `style="{$CustomInlineStyles.ATT}"` to your ElementHolder template.


### <a name="holder_template"></a> Custom Holder Template / Controller Template

This extension contains a modified controller template. Activate it like this:
`controller_template: 'ElementHolderStyled'` (see [Configuration Example](#configuration_example) above)

The Template can be found here [templates/DNADesign/Elemental/Layout/ElementHolderStyled.ss](templates/DNADesign/Elemental/Layout/ElementHolderStyled.ss)

If you don't use any of the above extensions that require that special template there is no need to set `controller_template`.

Altenatively you can also override the default ElementHolder.ss with a custom template in `/themes/[YourTheme]/templates/DNADesign/Elemental/Layout/ElementHolder.ss`

Further information: [https://github.com/dnadesign/silverstripe-elemental#defining-your-own-html](https://github.com/dnadesign/silverstripe-elemental#defining-your-own-html)