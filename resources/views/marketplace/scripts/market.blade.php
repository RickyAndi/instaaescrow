<script>
    (() => {

        const buyOrdersData = JSON.parse(document.getElementById('buy-orders-data').innerText);
        const sellOrdersData = JSON.parse(document.getElementById('sell-orders-data').innerText);
        const userOrdersData = JSON.parse(document.getElementById('user-orders-data').innerText);
        const userRequestsData = JSON.parse(document.getElementById('user-requests-data').innerText);
        
        class OrderRequest {
            constructor(id, type, amount, price, pricePerUnit, status) {
                this.id = id;
                this.type = type;
                this.amount = amount;
                this.price = price;
                this.pricePerUnit = pricePerUnit;
                this.status = status;
            }

            getType() {
                if (this.type == 0) {
                    return "{{ __('label.buy') }}";
                } else {
                    return "{{ __('label.sell') }}";
                }
            }

            getStatus() {
                if (this.isAccepted()) {
                    return "{{ __('label.accepted') }}"
                }

                return "{{ __('label.waiting_confirmation') }}";
            }

            isAccepted() {
                return this.status == {{ \App\Models\OrderRequest::STATUS_ACCEPTED }};
            }
        }

        class Order {
            constructor(id,cryptocurrencyAmount, pricePerUnit, price, type = null) {
                this.id = id;
                this.cryptocurrencyAmount = cryptocurrencyAmount;
                this.pricePerUnit = pricePerUnit;
                this.price = price;
                this.type = type;
            }

            getType() {
                if (this.type == 0) {
                    return "{{ __('label.buy') }}";
                } else {
                    return "{{ __('label.sell') }}";
                }
            }
        }

        const TAB_ENUM = {
            'BUY_ORDER': 'BUY_ORDER',
            'SELL_ORDER': 'SELL_ORDER',
            'MINE': 'MINE',
            'ORDER_HISTORY': 'ORDER_HISTORY'
        };

        const app = new Vue({
            el: '#app',
            data: {
                TAB_ENUM: TAB_ENUM,
                
                isLoggedIn: false,
                selectedTab: TAB_ENUM['BUY_ORDER'],

                buyOrders: [],
                sellOrders: [],

                userOrders: [],
                userRequests: []
            },

            methods: {
                setSelectedTab(tabName) {
                    this.selectedTab = tabName;
                },
                isSelectedTab(tabName) {
                    return this.selectedTab == tabName;
                },
                onRequestButtonClick(orderId) {
                    if (this.isLoggedIn) {

                    } 
                },
                formatNumberToCurrency(numberToBeFormatted) {
                    return numeral(numberToBeFormatted)
                        .format('0,0[.]00');
                }
            },

            mounted() {

                @if(Auth::guard('web')->check())
                this.isLoggedIn = true;
                @endif

                sellOrdersData.forEach((data) => {
                    this.sellOrders.push(
                        new Order(
                            data['id'],
                            data['cryptocurrency_amount'],
                            data['price_per_unit'],
                            data['price']
                        )
                    );
                });
                
                buyOrdersData.forEach((data) => {
                    this.buyOrders.push(
                        new Order(
                            data['id'],
                            data['cryptocurrency_amount'],
                            data['price_per_unit'],
                            data['price']
                        )
                    );
                });

                userOrdersData.forEach((data) => {
                    this.userOrders.push(
                        new Order(
                            data['id'],
                            data['cryptocurrency_amount'],
                            data['price_per_unit'],
                            data['price'],
                            data['type']
                        )
                    );
                });

                userRequestsData.forEach((data) => {
                    this.userRequests.push(
                        new OrderRequest(
                            data['id'], 
                            data['type'],
                            data['order']['cryptocurrency_amount'],
                            data['order']['price'],
                            data['order']['price_per_unit'],
                            data['status']
                        )
                    );
                });
            }
        });
    })();
</script>