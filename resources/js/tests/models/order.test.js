import Order from '../../models/Order';

describe("Order model", () => {
    test("can set the number formatter", () => {
        const format = jest.fn();
        const currencyFormatter = jest.fn();
        currencyFormatter.mockReturnValueOnce({format: format});
        
        Order.setCurrencyFormatter(currencyFormatter);

        const order = new Order(1, 0.001, 100, 100, 0);
        order.getFormattedPrice();

        expect(currencyFormatter.mock.calls.length).toBe(1);
        expect(format.mock.calls.length).toBe(1);
    });

    test("can change label sell and buy", () => {
        Order.setLabelBuy("beli");
        Order.setLabelSell("jual");
    
        const orderOne = new Order(1, 0.001, 100, 100, 0);
        const orderTwo = new Order(1, 0.001, 100, 100, 1);
        
        expect(orderOne.getType()).toEqual("beli");
        expect(orderTwo.getType()).toEqual("jual");
    });

    test("can be instantiated", () => {
        const order = new Order(1, 0.001, 100, 100, 0);
        expect(order).toBeInstanceOf(Order);
    });

    test("should get the same values that are given in constructor", () => {
        const order = new Order(1, 0.001, 100, 100, 0);
        expect(order.id).toEqual(1);
        expect(order.cryptocurrencyAmount).toEqual(0.001);
        expect(order.pricePerUnit).toEqual(100);
        expect(order.price).toEqual(100);
        expect(order.type).toEqual(0);
    });
});