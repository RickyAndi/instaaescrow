import {ADD_BUY_ORDER, EMPTY_BUY_ORDERS} from './mutation';

export const CREATE_ORDER_BUY = 'CREATE_ORDER_BUY';

export const actions = {
    async [CREATE_ORDER_BUY]({commit, state}, {data}) {
        const orderService = state.dependencies.orderService;
        await orderService.createBuyOrder(data);

        const orders = await orderService.getBuyOrders();
        
        commit(EMPTY_BUY_ORDERS);

        for (order in orders) {
            commit(ADD_BUY_ORDER, {
                order: order
            });
        }
    }
};