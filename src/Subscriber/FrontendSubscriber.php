<?php declare(strict_types=1);

namespace AfTopsellerSlider\Subscriber;

use Shopware\Core\Framework\DataAbstractionLayer\Search\Criteria;
use Shopware\Core\Framework\DataAbstractionLayer\Search\Filter\EqualsFilter;
use Shopware\Core\Framework\DataAbstractionLayer\Search\Sorting\FieldSorting;
use Shopware\Core\System\SystemConfig\SystemConfigService;
use Shopware\Storefront\Page\Product\ProductPageLoadedEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Shopware\Core\Framework\DataAbstractionLayer\EntityRepository;

class FrontendSubscriber implements EventSubscriberInterface
{
    private EntityRepository $productRepository;
    private SystemConfigService $systemConfigService;

    public function __construct(EntityRepository $productRepository, SystemConfigService $systemConfigService){
        $this->productRepository = $productRepository;
        $this->systemConfigService = $systemConfigService;
    }
    public static function getSubscribedEvents(): array
    {
        return [
            ProductPageLoadedEvent::class => 'onProductPageLoaded'
        ];
    }

    public function onProductPageLoaded(ProductPageLoadedEvent $event)
    {
        $page = $event->getPage();
        $context = $event->getContext();

        $salesChannelContext = $event->getSalesChannelContext(); 
        $salesChannelId = $salesChannelContext->getSalesChannel()->getId();

        $sliderAmount = $this->systemConfigService->get('AfTopsellerSlider.config.sliderAmount', $salesChannelId);
        $sorting = $this->systemConfigService->get('AfTopsellerSlider.config.sorting', $salesChannelId);

        $criteria = new Criteria();
        $criteria->addFilter(new EqualsFilter('active', "1"));


        if($sorting != null && $sorting == "asc"){
            $criteria->addSorting(new FieldSorting('sales', FieldSorting::ASCENDING));
        }else{
            $criteria->addSorting(new FieldSorting('sales', FieldSorting::DESCENDING));
        }

        if($sliderAmount != 5){
            $criteria->setLimit($sliderAmount);
        }else{
            $criteria->setLimit(5);
        }
        $result = $this->productRepository->search($criteria, $context)->getEntities();
        $page->addExtension("af_topseller", $result);
    }
}
