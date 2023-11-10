<?php

namespace Riverstone\InfiniteScroll\Model\Config\Source;

use Magento\Framework\Data\OptionSourceInterface;

class LoaderType implements OptionSourceInterface
{
    /**
     * Options array
     *
     * @return array[]
     */
    public function toOptionArray()
    {
        return [
            ['value' => 0, 'label' => __('Autoloader')],
            ['value' => 1, 'label' => __('Load more button')]];
    }
}
