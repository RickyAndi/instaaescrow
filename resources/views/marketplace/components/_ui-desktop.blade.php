<div class="column is-12 is-hidden-touch">

    <div class="block">
        <h2 class="title is-2">BTC / USD</h2>
    </div>

    <div class="columns">
        <div class="column">
            <div class="box">
                <div class="columns is-multiline">
                    <div class="column is-12">
                        <div class="tabs is-right is-boxed">
                            <ul>
                                <li v-bind:class="{'is-active': isSelectedTab(availableTabs['BUY_ORDER']) }">
                                    <a @click="setSelectedTab(availableTabs['BUY_ORDER'])">
                                        <span class="icon is-small"><i class="fas fa-book" aria-hidden="true"></i></span>
                                        <span>{{ __('label.buy_order') }}</span>
                                    </a>
                                </li>
                                <li v-bind:class="{'is-active': isSelectedTab(availableTabs['SELL_ORDER']) }">
                                    <a @click="setSelectedTab(availableTabs['SELL_ORDER'])">
                                        <span class="icon is-small"><i class="fas fa-book" aria-hidden="true"></i></span>
                                        <span>{{ __('label.sell_order') }}</span>
                                    </a>
                                </li>
                                <li v-bind:class="{'is-active': isSelectedTab(availableTabs['MINE']) }">
                                    <a @click="setSelectedTab(availableTabs['MINE'])">
                                        <span class="icon is-small"><i class="fas fa-book" aria-hidden="true"></i></span>
                                        <span>{{ __('label.mine') }}</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div v-if="isSelectedTab(availableTabs['BUY_ORDER'])" class="column is-12">
                        <buy-order-component></buy-order-component> 
                    </div>
                    <div v-if="isSelectedTab(availableTabs['SELL_ORDER'])" class="column is-12">
                       
                    </div>
                    <div v-if="isSelectedTab(availableTabs['MINE'])" class="column is-12">
                       
                    </div>
                </div>
            </div>
        </div>
        <div class="column">
            <div class="box">
                <div class="columns is-multiline">
                    <div class="column is-12">
                        <div class="tabs is-boxed is-right">
                            <ul>
                                <li class="is-active"><a>
                                    <span class="icon is-small"><i class="fas fa-history" aria-hidden="true"></i></span>
                                    <span>Histori Transaksi</span>
                                </a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>