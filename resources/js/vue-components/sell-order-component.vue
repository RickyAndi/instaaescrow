<template>
  <div>
    <h3 class="title is-5">{{ title }}</h3>
    <button class="button is-info is-small-mobile">{{ labelCreateButton }}</button>
    <table
      class="table is-bordered is-striped is-narrow is-hoverable is-fullwidth mt-3"
    >
      <thead>
        <tr>
          <th>{{ labelBtcAmount }}</th>
          <th>{{ labelTotal }}</th>
          <th>{{ labelPricePerBtc }}</th>
          <th></th>
        </tr>
      </thead>
      <tbody v-if="orders.length">
        <tr v-for="order in orders" v-bind:key="order.id">
          <td>{{ order.cryptocurrencyAmount }}</td>
          <td>
            {{ order.getFormattedPrice() }}
          </td>
          <td>{{ order.getFormattedPricePerUnit() }}</td>
          <td class="has-text-centered">
            <button class="button is-info is-small">{{ labelRequestOrder }}</button>
          </td>
        </tr>
      </tbody>
      <tbody v-if="!orders.length">
        <tr>
          <td class="has-text-centered" colspan="4">
            {{ labelNoOrders }}
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
export default {
  computed: {
    orders() {
      return this.$store.state.buyOrders;
    },
    labelBtcAmount() {
      return this.$store.state.globalData['label_btc_amount'];
    },
    labelCreateButton() {
      return this.$store.state.globalData['label_order_buy_button'];
    },
    labelTotal() {
      return this.$store.state.globalData['label_total'];
    },
    labelPricePerBtc() {
      return this.$store.state.globalData['label_price_per_btc'];
    },
    labelNoOrders() {
      return this.$store.state.globalData['label_no_orders_buy'];
    },
    title() {
      return this.$store.state.globalData['label_buy_order_title'];
    },
    labelRequestOrder() {
      return this.$store.state.globalData['label_request_order_button'];
    }

  }
};
</script>