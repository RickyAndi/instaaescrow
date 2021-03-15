import {Order} from '../models/index';

export default class OrderService {
    constructor(httpService, rootUrl) {
        this.httpService = httpService;
        this.rootUrl = rootUrl;
    }
    
    async createBuyOrder(data) {
        const url = `${this.rootUrl}/ajax/order/buy/create`;
        return await this.httpService.post(url, data);
    }

    async getBuyOrders() {
        const url = `${this.rootUrl}/ajax/order/buy`;
        const orderData = await this.httpService.get(url);

        const orders = [];
        for (datum in orderData) {
            orders.push(
                new Order(
                    datum['id'],
                    datum['cryptocurrency_amount'],
                    datum['price_per_unit'],
                    datum['price']
                )
            );
        }

        return orders;
    }
}
