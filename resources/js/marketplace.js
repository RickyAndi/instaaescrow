import Vue from 'vue';
import axios from 'axios';
import VueI18n from 'vue-i18n';
import { mapGetters } from 'vuex';
import { toast } from 'bulma-toast'

import buyOrderComponent from './vue-components/buy-order-component';
import createBuyOrderFormComponent from './vue-components/create-buy-order-form-component';

import { LoggerService, HttpService, OrderService, ToastService } from './services/index';

import createStore from './state/marketplace/store';
import Order from './models/Order';

import {
    SET_GLOBAL_DATA,
    SET_LABEL,
    ADD_BUY_ORDER,
    ADD_SELL_ORDER,
    SET_SELECTED_TAB, 
    INACTIVATE_CREATE_BUY_ORDER_MODAL,
    SET_DEPENDENCY
} from './state/marketplace/mutation';

const store = createStore();

const httpService = new HttpService(axios, {
    crsfToken: window.globalData['csrfToken']
});
const orderService = new OrderService(httpService, {
    'rootUrl': window.globalData['rootUrl']
});
const loggerService = new LoggerService();
const toastService = new ToastService(toast);

store.commit(SET_DEPENDENCY, {
    'key': 'orderService',
    'value': orderService
});
store.commit(SET_DEPENDENCY, {
    'key': 'loggerService',
    'value': loggerService
});
store.commit(SET_DEPENDENCY, {
    'key': 'toastService',
    'value': toastService
});

Order.setLabelBuy(window.i18n['buy']);
Order.setLabelSell(window.i18n['sell']);

for (const key in window.globalData) {
    store.commit(SET_GLOBAL_DATA, {
        key:   key,
        value: window.globalData[key]
    });
}

window.buyOrdersData.forEach((data) => {
    store.commit(ADD_BUY_ORDER, {
        order: new Order(
            data['id'],
            data['cryptocurrency_amount'],
            data['price_per_unit'],
            data['price']
        )
    });
});

window.sellOrdersData.forEach((data) => {
    store.commit(ADD_SELL_ORDER, {
        order: new Order(
            data['id'],
            data['cryptocurrency_amount'],
            data['price_per_unit'],
            data['price']
        )
    });
});

Vue.use(VueI18n);

const i18n = new VueI18n({
    locale: window.globalData['locale'],
    messages: {
        'en': window.i18n
    }
});

const app = new Vue({
    el: '#app',
    i18n: i18n,
    store: store,
    components: {
        'buy-order-component': buyOrderComponent,
        'create-buy-order-form-component': createBuyOrderFormComponent
    },
    data() {
        return {

        };
    },
    methods: {
        setSelectedTab(selectedTab) {
            this.$store.commit(SET_SELECTED_TAB, {
                selectedTab: selectedTab
            })
        },
        inactivateCreateBuyOrderModal() {
            this.$store.commit(INACTIVATE_CREATE_BUY_ORDER_MODAL);
        }
    },
    computed: {
        ...mapGetters([
            'availableTabs',
            'isSelectedTab',
            'isCreateBuyOrderModalActive',
            'isCreateSellOrderModalActive',
            'isLoginModalActive',

            'isCreateBuyOrderModalActive',
            'isCreateSellOrderModalActive',
            'isLoginModalActive'
        ])
    }
});