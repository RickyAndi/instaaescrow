import numeral from 'numeral';

export default class Order {
    
    static labelBuy = "";
    static labelSell = "";

    static currencyFormatter = numeral;
    
    static setCurrencyFormatter(currencyFormatter) {
        Order.currencyFormatter = currencyFormatter;
    }

    static formatCurrency(number) {
        return Order.currencyFormatter(number)
            .format('0,0[.]00');
    }

    static setLabelBuy(labelBuy) {
        Order.labelBuy = labelBuy;
    }

    static setLabelSell(labelSell) {
        Order.labelSell = labelSell;
    }

    constructor(id,cryptocurrencyAmount, pricePerUnit, price, type = null) {
        this.id = id;
        this.cryptocurrencyAmount = cryptocurrencyAmount;
        this.pricePerUnit = pricePerUnit;
        this.price = price;
        this.type = type;
    }

    getType() {
        if (this.type == 0) {
            return Order.labelBuy;
        } else {
            return Order.labelSell;
        }
    }

    getFormattedPrice() {
        return Order.formatCurrency(this.price);
    }

    getFormattedPricePerUnit() {
        return Order.formatCurrency(this.pricePerUnit);
    }
}