<?php

namespace NathanDay\SubCategoryBlocks\Model;

class Category extends \Magento\Catalog\Model\Category
{
    const DM_BLOCKS = 'BLOCKS';
    const DM_BLOCKS_AND_PAGE = 'BLOCKS_AND_PAGE';
    const DM_BLOCKS_AND_PRODUCTS = 'BLOCKS_AND_PRODUCTS';
    const DM_BLOCKS_AND_PAGE_AND_PRODUCTS = 'BLOCKS_AND_PAGE_AND_PRODUCTS';
    const DM_LIST = 'LIST';
    const DM_LIST_AND_PAGE = 'LIST_AND_PAGE';
    const DM_LIST_AND_PRODUCTS = 'LIST_AND_PRODUCTS';
    const DM_LIST_AND_PAGE_AND_PRODUCTS = 'LIST_AND_PAGE_AND_PRODUCTS';
}