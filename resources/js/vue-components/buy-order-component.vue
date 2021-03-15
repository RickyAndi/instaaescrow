<template>
  <div>
    <h3 class="title is-5">{{ $t('buyOrderTitle') }}</h3>
    <button @click="toggleModal" class="button is-info is-small-mobile">
      {{ $t('createBuyOrder') }}
    </button>
    <table
      class="table is-bordered is-striped is-narrow is-hoverable is-fullwidth mt-3"
    >
      <thead>
        <tr>
          <th>{{ $t('btcAmount') }}</th>
          <th>{{ $t('totalAmount') }}</th>
          <th>{{ $t('pricePerBtc') }}</th>
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
            <button class="button is-info is-small">
              {{ $t('requestOrderButton') }}
            </button>
          </td>
        </tr>
      </tbody>
      <tbody v-if="!orders.length">
        <tr>
          <td class="has-text-centered" colspan="4">
            {{ $t('noOrders') }}
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>

import {
  ACTIVATE_CREATE_BUY_ORDER_MODAL
} from '../state/marketplace/mutation';

export default {
    data() {
        return {
            
        }
    },
    methods: {
        toggleModal() {
            this.$store.commit(ACTIVATE_CREATE_BUY_ORDER_MODAL);
        }
    },
    computed: {
        orders() {
            return this.$store.state.buyOrders;
        }
  },
};
</script>