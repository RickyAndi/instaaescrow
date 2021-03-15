export default  {
    selectedTab(state) {
        return state.selectedTab;
    },
    isSelectedTab(state) {
        return (tabName) => state.selectedTab == tabName;
    },
    availableTabs(state) {
        return state.availableTabs;
    },
    getGlobalData(state) {
        return (key) => state.globalData[key];
    },
    getLabel(state) {
        return (key) => state.labels[key];
    },

    isCreateBuyOrderModalActive(state) {
        return state.activeModals.createBuyOrder;
    },

    isCreateSellOrderModalActive(state) {
        return state.activeModals.createSellOrder;
    },

    isLoginModalActive(state) {
        return state.activeModals.login;
    }
};