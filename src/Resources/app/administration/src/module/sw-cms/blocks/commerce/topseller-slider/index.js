import './component';
import './preview';

Shopware.Service('cmsService').registerCmsBlock({
    name: 'topseller-slider',
    category: 'commerce',
    label: 'Topseller Slider',
    component: 'sw-cms-block-topseller-slider',
    previewComponent: 'sw-cms-preview-topseller-slider',
    defaultConfig: {
        marginBottom: '20px',
        marginTop: '20px',
        marginLeft: '20px',
        marginRight: '20px',
        sizingMode: 'boxed'
    },
    slots: {
        //left: 'text',
        //right: 'image'
    }
});
