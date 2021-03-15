import { 
    LabelDoesNotExistError, 
    GlobalDataDoesNotExistError,
    ObjectKeyDoesNotExistError
}  from '../../exceptions/index';

export const ACTIVATE_CREATE_BUY_ORDER_MODAL = 'ACTIVATE_CREATE_BUY_ORDER_MODAL';
export const INACTIVATE_CREATE_BUY_ORDER_MODAL = 'INACTIVATE_CREATE_BUY_ORDER_MODAL';
export const ACTIVATE_CREATE_SELL_ORDER_MODAL = 'ACTIVATE_CREATE_SELL_ORDER_MODAL';
export const INACTIVATE_CREATE_SELL_ORDER_MODAL = 'INACTIVATE_CREATE_SELL_ORDER_MODAL';
export const ACTIVATE_LOGIN_MODAL = 'ACTIVATE_LOGIN_MODAL';
export const INACTIVATE_LOGIN_MODAL = 'INACTIVATE_LOGIN_MODAL';
export const SET_SELECTED_TAB = 'SET_SELECTED_TAB';
export const SET_GLOBAL_DATA = 'SET_GLOBAL_DATA';
export const SET_LABEL = 'SET_LABEL';
export const ADD_BUY_ORDER = 'ADD_BUY_ORDER';
export const ADD_SELL_ORDER = 'ADD_SELL_ORDER';
export const ADD_USER_ORDER = 'ADD_USER_ORDER';
export const ADD_USER_REQUEST = 'ADD_USER_REQUEST';
export const SET_DEPENDENCY = 'SET_DEPENDENCY';
export const EMPTY_BUY_ORDERS = 'EMPTY_BUY_ORDERS';

export const mutations = {
    [EMPTY_BUY_ORDERS](state) {
        state.buyOrders.splice(0, (state.buyOrders.length));
    },
    [SET_DEPENDENCY](state, payload) {
        const key = payload.key;
        const value = payload.value;

        if (state.dependencies[key] === undefined) {
            throw new ObjectKeyDoesNotExistError(`dependency ${key} does not exist`);
        }

        state.dependencies[key] = value;
    },
    [ACTIVATE_CREATE_BUY_ORDER_MODAL](state) {
        if (!state.globalData.isUserLoggedIn) {
            state.activeModals.login = true;
        } else {
            state.activeModals.createBuyOrder = true;
        }
    },
    [INACTIVATE_CREATE_BUY_ORDER_MODAL](state) {
        state.activeModals.createBuyOrder = false;
    },

    [ACTIVATE_CREATE_SELL_ORDER_MODAL](state) {
        if (!state.globalData.isUserLoggedIn) {
            state.activeModals.login = true;
        } else {
            state.activeModals.createSellOrder = true;
        }
    },
    [INACTIVATE_CREATE_SELL_ORDER_MODAL](state) {
        state.activeModals.createSellOrder = false;
    },

    [ACTIVATE_LOGIN_MODAL](state) {
        state.activeModals.login = true;
    },
    [INACTIVATE_LOGIN_MODAL](state) {
        state.activeModals.login = false;
    },

    [SET_SELECTED_TAB](state, payload) {
        state.selectedTab = payload.selectedTab;
    },

    [SET_GLOBAL_DATA](state, payload) {
        if (state.globalData[payload.key] == undefined) {
            throw new GlobalDataDoesNotExistError(`global data  ${payload.key} does not exist`);
        }

        state.globalData[payload.key] = payload.value;
    },

    [SET_LABEL](state, payload) {
        if (state.labels[payload.key] == undefined) {
            throw new LabelDoesNotExistError(`label ${payload.key} does not exist`);
        }

        state.labels[payload.key] = payload.value;
    },

    [ADD_BUY_ORDER](state, payload) {
        state.buyOrders.push(payload.order);
    },
    
    [ADD_SELL_ORDER](state, payload) {
        state.buyOrders.push(payload.order);
    },

    [ADD_USER_ORDER](state, payload) {
        state.userOrders.push(payload.order);
    },

    [ADD_USER_REQUEST](state, payload) {
        state.userRequests.push(payload.request);
    }
};