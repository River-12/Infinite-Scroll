<?php

namespace Riverstone\InfiniteScroll\Block;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Magento\Store\Model\ScopeInterface;
use Magento\Store\Model\StoreManagerInterface;

class SearchScroll extends Template
{
    public const MODULE_ENABLE = 'riverstone_scroll/general/enable';
    public const LOADER_TYPE = 'riverstone_scroll/general/search_loader_type';
    public const END_PAGE_TEXT = 'riverstone_scroll/general/search_end_page_text';
    public const NO_OF_TILES = 'riverstone_scroll/general/search_no_of_tiles';
    public const DISPLAY_BACK_BUTTON = 'riverstone_scroll/general/search_display_back_button';
    public const LOADER_BUTTON_TEXT = 'riverstone_scroll/general/search_loader_button_text';
    public const LOADER_BUTTON_COLOR = 'riverstone_scroll/general/search_loader_button_color';
    public const TOP_BUTTON_TEXT = 'riverstone_scroll/general/search_back_text';
    public const TOP_BUTTON_COLOR = 'riverstone_scroll/general/search_back_button_color';

    /**
     * @var ScopeConfigInterface
     */
    private ScopeConfigInterface $scopeConfig;
    /**
     * @var StoreManagerInterface
     */
    private StoreManagerInterface $storeManager;

    /**
     * @param Context $context
     * @param ScopeConfigInterface $scopeConfig
     * @param StoreManagerInterface $storeManager
     * @param array $data
     */
    public function __construct(
        Template\Context      $context,
        ScopeConfigInterface  $scopeConfig,
        StoreManagerInterface $storeManager,
        array                 $data = []
    ) {
        parent::__construct($context, $data);
        $this->scopeConfig = $scopeConfig;
        $this->storeManager = $storeManager;
    }

    /**
     * Returns  whether module is enabled or not
     *
     * @return mixed
     */
    public function getModuleEnable()
    {
        return $this->getConfigValue(self::MODULE_ENABLE);
    }

    /**
     * Returns config value
     *
     * @param mixed $configPath
     * @return mixed
     */
    public function getConfigValue($configPath)
    {
        return $this->scopeConfig->getValue($configPath, ScopeInterface::SCOPE_STORE, $this->getStoreId());
    }

    /**
     * Returns store id
     *
     * @return int
     * @throws NoSuchEntityException
     */
    public function getStoreId()
    {
        return $this->storeManager->getStore()->getId();
    }

    /**
     * Returns loader type
     *
     * @return mixed
     */
    public function getLoaderType()
    {
        return $this->getConfigValue(self::LOADER_TYPE);
    }

    /**
     * Returns Loaderbutton text
     *
     * @return mixed
     */
    public function getLoaderButtonTxt()
    {
        return $this->getConfigValue(self::LOADER_BUTTON_TEXT);
    }

    /**
     * Returns end page text
     *
     * @return mixed
     */
    public function getEndPageText()
    {
        return $this->getConfigValue(self::END_PAGE_TEXT);
    }

    /**
     * Returns Loaderbutton color
     *
     * @return mixed
     */
    public function getLoaderButtonColor()
    {
        return $this->getConfigValue(self::LOADER_BUTTON_COLOR);
    }

    /**
     * Returns backbutton text
     *
     * @return mixed
     */
    public function getBackButtonTxt()
    {
        return $this->getConfigValue(self::TOP_BUTTON_TEXT);
    }

    /**
     * Returns backbutton color
     *
     * @return mixed
     */
    public function getBackButtonColor()
    {
        return $this->getConfigValue(self::TOP_BUTTON_COLOR);
    }

    /**
     * Returns whether backbutton is enabled or not
     *
     * @return mixed
     */
    public function getBackButtonEnable()
    {
        return $this->getConfigValue(self::DISPLAY_BACK_BUTTON);
    }

    /**
     * Returns number of tiles
     *
     * @return mixed
     */
    public function getPageNo()
    {
        return $this->getConfigValue(self::NO_OF_TILES);
    }
}
