<?php declare(strict_types=1);

namespace AfTopsellerSlider\Subscriber;

use Shopware\Core\Content\Cms\Events\CmsPageLoadedEvent;
use Shopware\Core\Framework\DataAbstractionLayer\Search\Criteria;
use Shopware\Core\Framework\DataAbstractionLayer\Search\Filter\EqualsFilter;
use Shopware\Core\Framework\DataAbstractionLayer\Search\Sorting\FieldSorting;
use Shopware\Core\System\SalesChannel\Entity\SalesChannelRepository;
use Shopware\Core\System\SystemConfig\SystemConfigService;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class FrontendSubscriber implements EventSubscriberInterface
{
    private SystemConfigService $systemConfigService;
    private SalesChannelRepository $salesChannelRepository;

    /**
     * @param SystemConfigService $systemConfigService
     * @param SalesChannelRepository $salesChannelRepository
     *
     */
    public function __construct(SystemConfigService $systemConfigService, SalesChannelRepository $salesChannelRepository){
        $this->systemConfigService = $systemConfigService;
        $this->salesChannelRepository = $salesChannelRepository;
    }
    public static function getSubscribedEvents(): array
    {
        return [
            CmsPageLoadedEvent::class => 'onCmsPageLoaded'
        ];
    }

    public function onCmsPageLoaded(CmsPageLoadedEvent $event) : void
    {
        //dump($event);
        $pageResult = current($event->getResult()->getElements());
        //dump($pageResult);
        //die();
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
        $result = $this->salesChannelRepository->search($criteria, $salesChannelContext)->getEntities();
        $pageResult->addExtension("af_topseller", $result);
    }
}
