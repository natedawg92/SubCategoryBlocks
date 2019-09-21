<?php

namespace NathanDay\SubCategoryBlocks\Plugin\Catalog\Model\Category\Attribute\Source;

use Magento\Catalog\Model\Category\Attribute\Source\Mode as CategoryMode;
use NathanDay\SubCategoryBlocks\Model\Category;

class Mode {

    /**
     * @param Mode $subject
     * @param array $result
     * @return array
     */
    public function afterGetAllOptions(CategoryMode $subject, array $result) : array
    {
        $tilingOptions = [
            ['value' => Category::DM_BLOCKS, 'label' => __('Sub Category Blocks only')],
            ['value' => Category::DM_BLOCKS_AND_PAGE, 'label' => __('Sub Category Blocks and Static Blocks')],
            ['value' => Category::DM_BLOCKS_AND_PRODUCTS, 'label' => __('Sub Category Blocks and Products')],
            [
                'value' => Category::DM_BLOCKS_AND_PAGE_AND_PRODUCTS, '
                label' => __('Sub Category Blocks, Static Blocks and Pages')
            ],
            ['value' => Category::DM_LIST, 'label' => __('Sub Category List only')],
            ['value' => Category::DM_LIST_AND_PAGE, 'label' => __('Sub Category List and Static Blocks')],
            ['value' => Category::DM_LIST_AND_PRODUCTS, 'label' => __('Sub Category List and Products')],
            [
                'value' => Category::DM_LIST_AND_PAGE_AND_PRODUCTS, '
                label' => __('Sub Category List, Static Blocks and Pages')
            ],
        ];

        return array_merge($result, $tilingOptions);
    }
}
