import TAB_ENUM from '../../enums/tab-enum';

export default {

    dependencies: {
        orderService: null,
        loggerService: null,
        toastService: null
    },

    buyOrders: [],
    sellOrders: [],
    userOrders: [],
    userRequests: [],

    globalData: {
        locale: 'en',
        isUserLoggedIn: false,
        csrfToken: null
    },

    activeModals: {
        createBuyOrder: false,
        createSellOrder: false,
        login: false
    },
    
    selectedTab: TAB_ENUM['BUY_ORDER'],
    availableTabs: TAB_ENUM
};