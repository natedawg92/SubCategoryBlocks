<?php

namespace NathanDay\SubCategoryBlocks\Observer;

use NathanDay\SubCategoryBlocks\Model\Category as CategoryModel;
use Magento\Framework\Event;
use Magento\Framework\Event\Observer as EventObserver;
use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Registry;
use Magento\Framework\View\Layout as Layout;
use Magento\Framework\View\Layout\ProcessorInterface as LayoutProcessor;
use NathanDay\SubCategoryBlocks\Model\Category;

/**
 *  AddCategoryLayoutUpdateHandleObserver
 */
class AddCustomCategoryLayoutHandle implements ObserverInterface
{
    /**
     * Category Custom Layout Name
     *
     * It's the filename of layout phisically located
     * at `[Vendor]/[ModuleName]/view/frontend/layout/catalog_category_view_custom_layout.xml`
     */
    const LAYOUT_HANDLE_NAME = 'catalog_category_view_with_children';

    /**
     * @var Registry
     */
    private $registry;

    /**
     * @param Registry $registry
     */
    public function __construct(Registry $registry)
    {
        $this->registry = $registry;
    }

    /**
     * @param EventObserver $observer
     *
     * @return void
     */
    public function execute(EventObserver $observer)
    {
        /** @var Event $event */
        $event = $observer->getEvent();
        $actionName = $event->getData('full_action_name');
        /** @var CategoryModel|null $category **/
        $category = $this->registry->registry('current_category');

        if ($actionName === 'catalog_category_view'
            && $category
            && $category->hasChildren()
            && in_array($category->getDisplayMode(),
                [
                    Category::DM_BLOCKS,
                    Category::DM_BLOCKS_AND_PAGE,
                    Category::DM_LIST,
                    Category::DM_LIST_AND_PAGE,
                ]
            )
        ) {
            /** @var Layout $layout */
            $layout = $event->getData('layout');

            /** @var LayoutProcessor $layoutUpdate */
            $layoutUpdate = $layout->getUpdate();
            $layoutUpdate->addHandle(self::LAYOUT_HANDLE_NAME);
        }
    }
}
