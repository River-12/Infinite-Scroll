<?php

namespace Riverstone\InfiniteScroll\Model\Config;

use Magento\Config\Block\System\Config\Form\Field;
use Magento\Framework\Data\Form\Element\AbstractElement;

class Colorpicker extends Field
{
    /**
     * Color picker
     *
     * @param AbstractElement $element
     * @return string
     *
     * @SuppressWarnings(PHPMD.CamelCaseMethodName)
     */
    protected function _getElementHtml(AbstractElement $element)
    {
        $html = $element->getElementHtml();
        $values = $element->getData('value');
        $html .= '<script type="text/javascript">
            require(["jquery","jquery/colorpicker/js/colorpicker"], function ($) {
                $(document).ready(function () {
                    var element = $("#' . $element->getHtmlId() . '");
                    element.css("backgroundColor", "' . $values . '");
                    element.ColorPicker({
                        color: "' . $values . '",
                        onChange: function (hsb, hex, rgb) {
                            element.css("backgroundColor", "#" + hex).val("#" + hex);
                        }
                    });
                });
            });
            </script>';
        return $html;
    }
}
