import './component';
import './preview';

Shopware.Service('cmsService').registerCmsBlock({
    name: 'af-topseller',
    category: 'commerce',
    label: 'Topseller Slider',
    component: 'sw-cms-block-topseller',
    previewComponent: 'sw-cms-preview-topseller',
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
