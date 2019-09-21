<?php

namespace NathanDay\SubCategoryBlocks\Block\Category;

use Magento\Catalog\Block\Category\View as CategoryView;
use NathanDay\SubCategoryBlocks\Model\Category;

class View extends CategoryView
{
    /** @var \Magento\Catalog\Helper\Output */
    protected $outputHelper;

    /** @var \Magento\Catalog\Helper\Image */
    protected $imageHelper;

    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Catalog\Model\Layer\Resolver $layerResolver,
        \Magento\Framework\Registry $registry,
        \Magento\Catalog\Helper\Category $categoryHelper,
        \Magento\Catalog\Helper\Output $outputHelper,
        \Magento\Catalog\Helper\ImageFactory $helperImageFactory,
        array $data = []
    ) {
        parent::__construct($context, $layerResolver, $registry, $categoryHelper, $data);

        $this->imageHelper = $helperImageFactory->create();
        $this->outputHelper = $outputHelper;
    }

    public function showProducts() : bool
    {
        if ($this->getCurrentCategory()->getDisplayMode() === null) {
            return true;
        }

        return in_array($this->getCurrentCategory()->getDisplayMode(),
            [
                Category::DM_PRODUCT,
                Category::DM_MIXED,
                Category::DM_BLOCKS_AND_PRODUCTS,
                Category::DM_BLOCKS_AND_PAGE_AND_PRODUCTS,
                Category::DM_LIST_AND_PRODUCTS,
                Category::DM_LIST_AND_PAGE_AND_PRODUCTS,
            ]
        );
    }

    public function showCms() : bool
    {
        return in_array($this->getCurrentCategory()->getDisplayMode(),
            [
                Category::DM_PAGE,
                Category::DM_MIXED,
                Category::DM_BLOCKS_AND_PAGE,
                Category::DM_BLOCKS_AND_PAGE_AND_PRODUCTS,
                Category::DM_LIST_AND_PAGE,
                Category::DM_LIST_AND_PAGE_AND_PRODUCTS,
            ]
        );
    }

    public function showSubCategories() : bool
    {
        return in_array($this->getCurrentCategory()->getDisplayMode(),
            [
                Category::DM_BLOCKS,
                Category::DM_BLOCKS_AND_PAGE,
                Category::DM_BLOCKS_AND_PRODUCTS,
                Category::DM_BLOCKS_AND_PAGE_AND_PRODUCTS,
                Category::DM_LIST,
                Category::DM_LIST_AND_PAGE,
                Category::DM_LIST_AND_PRODUCTS,
                Category::DM_LIST_AND_PAGE_AND_PRODUCTS,
            ]
        );
    }

    public function showSubCategoryBlocks() : bool
    {
        return in_array($this->getCurrentCategory()->getDisplayMode(),
            [
                Category::DM_BLOCKS,
                Category::DM_BLOCKS_AND_PAGE,
                Category::DM_BLOCKS_AND_PRODUCTS,
                Category::DM_BLOCKS_AND_PAGE_AND_PRODUCTS,
            ]
        );
    }

    public function showSubCategoryList() : bool
    {
        return in_array($this->getCurrentCategory()->getDisplayMode(),
            [
                Category::DM_LIST,
                Category::DM_LIST_AND_PAGE,
                Category::DM_LIST_AND_PRODUCTS,
                Category::DM_LIST_AND_PAGE_AND_PRODUCTS,
            ]
        );
    }

    public function getSubcategoryMode(): string
    {
        switch (true) {
            case $this->showSubCategoryBlocks(): return 'grid';
            case $this->showSubCategoryList(): return 'list';
            default: return 'grid';
        }
    }

    /**
     * @return Category[]|\Magento\Catalog\Model\ResourceModel\Category\Collection
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getSubcategories()
    {
        $category = $this->getCurrentCategory();
        $childrenCategories = $category->getChildrenCategories();
        if ($childrenCategories instanceof \Magento\Catalog\Model\ResourceModel\Collection\AbstractCollection) {
            $childrenCategories->addAttributeToSelect('image')
                ->addAttributeToSelect('image_url')
                ->addAttributeToSelect('url')
                ->addAttributeToSelect('description');
        } elseif (is_array($childrenCategories)) {
            foreach ($childrenCategories as $childCategory) {
                $childCategory->load($childCategory->getId());
            }
        }
        return $childrenCategories;
    }

    public function getOutputHelper()
    {
        return $this->outputHelper;
    }

    public function getCategoryImageUrl($category) {
        $imgUrl = $category->getImageUrl();

        return $imgUrl ?: $this->imageHelper->getDefaultPlaceholderUrl('image');
    }
}
