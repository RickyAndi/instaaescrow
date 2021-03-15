<template>
    <span>
         <div class="field">
            <label class="label">{{ $t('btcAmount') }}</label>
            <div class="control">
                <input data-bitcoin-amount :class="{'is-danger': canErrorFieldBeShown('buyOrder', 'bitcoinAmount')}" v-model="forms.buyOrder.data.bitcoinAmount" @keyup="onFieldKeyup('buyOrder', 'bitcoinAmount')" class="input" type="number">
            </div>
            <p v-if="canErrorFieldBeShown('buyOrder', 'bitcoinAmount')" class="help is-danger">{{ getFieldErrorMessage('buyOrder', 'bitcoinAmount') }}</p>
        </div>
        <div class="field">
            <label class="label">{{ $t('totalAmount') }}</label>
            <div class="control">
                <input data-total-amount :class="{'is-danger': canErrorFieldBeShown('buyOrder', 'totalAmount')}" v-model="forms.buyOrder.data.totalAmount" class="input" type="number" @keyup="onFieldKeyup('buyOrder', 'totalAmount')" placeholder="">
            </div>
            <p v-if="canErrorFieldBeShown('buyOrder', 'totalAmount')" class="help is-danger">{{ getFieldErrorMessage('buyOrder', 'totalAmount') }}</p>
        </div>
        <div class="field">
            <label class="label">{{ $t('pricePerBtc') }}</label>
            <div class="control">
                <input readonly :value="pricePerBtc" class="input" type="number">
            </div>
        </div>
        <div class="field">
            <label class="label">{{ $t('receiverBtcAddress') }}</label>
            <div class="control">
                <input data-bitcoin-address :class="{'is-danger': canErrorFieldBeShown('buyOrder', 'bitcoinAddress')}" v-model="forms.buyOrder.data.bitcoinAddress"  class="input" type="text" @keyup="onFieldKeyup('buyOrder', 'bitcoinAddress')" placeholder="">
            </div>
            <p v-if="canErrorFieldBeShown('buyOrder', 'bitcoinAddress')" class="help is-danger">{{ getFieldErrorMessage('buyOrder', 'bitcoinAddress') }}</p>
        </div>
        <div class="field">
            <button data-form-submit-button @click="submitForm()" class="button is-info">{{ $t('saveBuyOrder') }}</button>
            <button data-close-modal-button @click="inactivateCreateBuyOrderModal" class="button is-danger">{{ $t('cancel') }}</button>
        </div>
    </span>
</template>

<script>
    import formValidationMixin from '../mixins/form-validation';
    import { INACTIVATE_CREATE_BUY_ORDER_MODAL } from '../state/marketplace/mutation';
    import { CREATE_ORDER_BUY } from '../state/marketplace/actions';
    import { OrderService, ToastService } from '../services/index';
    import { HttpValidationError } from '../exceptions/index';

    export default {
        data() {
            return {
                isFormSubmitting: false,
                forms: {
                    buyOrder: {
                        fieldViewName: {
                            bitcoinAddress: "Alamat penerima Bitcoin",
                            bitcoinAmount: "Jumlah Bitcoin",
                            totalAmount: "Jumlah harga",
                        },
                        fieldStatuses: {
                            bitcoinAddress: {
                                pristine: true,
                                valid: false
                            },
                            bitcoinAmount: {
                                pristine: true,
                                valid: false
                            },
                            totalAmount: {
                                pristine: true,
                                valid: false
                            },
                        },
                        rules: {
                            bitcoinAddress: [
                                {
                                    name: "required",
                                    params: {

                                    }
                                }
                            ],
                            bitcoinAmount: [
                                {
                                    name: "minimum",
                                    params: {
                                        minimumValue: 0.001
                                    }
                                }
                            ],
                            totalAmount: [
                                {
                                    name: "minimum",
                                    params: {
                                        minimumValue: 100000
                                    }
                                }
                            ]
                        },
                        defaultValues: {
                            bitcoinAddress: "",
                            bitcoinAmount: 0,
                            totalAmount: 0,
                        },
                        data: {
                            bitcoinAddress: "",
                            bitcoinAmount: 0,
                            totalAmount: 0,
                        },
                        errors: {
                            bitcoinAddress: "",
                            bitcoinAmount: "",
                            totalAmount: "",
                        }
                    }
                }
            }
        },
        methods: {
            inactivateCreateBuyOrderModal() {
                this.resetForm('buyOrder');
                this.$store.commit(INACTIVATE_CREATE_BUY_ORDER_MODAL);
            },
            async submitForm() {
                this.validateForm('buyOrder');
                const isFormValid = this.isFormValid('buyOrder');

                if (isFormValid) {
                    
                    this.isFormSubmitting = true;
                    
                    try {
                        await this.$store.dispatch(CREATE_ORDER_BUY, {
                            bitcoinAmount: this.getFormFieldValue('buyOrder', 'bitcoinAmount'),
                            totalAmount: this.getFormFieldValue('buyOrder', 'totalAmount'),
                            bitcoinAddress: this.getFormFieldValue('buyOrder', 'bitcoinAddress')
                        });
                        
                        this.isFormSubmitting = false;

                        this.inactivateCreateBuyOrderModal();

                    } catch (error) {
                        if (error instanceof HttpValidationError) {
                            console.log(error.message)
                        }
                    }
                }
            }
        },
        computed: {
            pricePerBtc() {
                const pricePerBtc = (parseFloat(1) / parseFloat(this.forms.buyOrder.data.bitcoinAmount)) * (parseFloat(this.forms.buyOrder.data.totalAmount));
                return pricePerBtc.toFixed(2);
            }
        },
        mixins: [
            formValidationMixin
        ]
    }
</script>