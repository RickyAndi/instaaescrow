import { shallowMount, createLocalVue } from '@vue/test-utils';
import Vuex from 'vuex';
import { INACTIVATE_CREATE_BUY_ORDER_MODAL, EMPTY_BUY_ORDERS } from '../../state/marketplace/mutation';
import { CREATE_ORDER_BUY } from '../../state/marketplace/actions';
import createBuyOrderFormComponent from '../../vue-components/create-buy-order-form-component.vue';

describe("create order buy form component", () => {
    
    const localVue = createLocalVue();
    localVue.use(Vuex);

    const inactivateCreateBuyOrderModal = jest.fn();
    const createOrderBuy = jest.fn(Promise.resolve({}));

    const store = new Vuex.Store({
        mutations: {
            [INACTIVATE_CREATE_BUY_ORDER_MODAL]: inactivateCreateBuyOrderModal
        },
        actions: {
            [CREATE_ORDER_BUY]: createOrderBuy
        }
    });

    test("should not allow form submition if the value in the field is not right", async () => {
        const wrapper = shallowMount(createBuyOrderFormComponent, { 
            store, 
            localVue,
            mocks: {
                $t: () => {}
            }
        });

        const submit = wrapper.find('[data-form-submit-button]');
        await submit.trigger('click');

        expect(createOrderBuy.mock.calls.length).toBe(0);
    });

    test("should  allow form submition if the value in the field is right", async () => {
        const wrapper = shallowMount(createBuyOrderFormComponent, { 
            store, 
            localVue,
            mocks: {
                $t: () => {}
            }
        });

        wrapper.vm.forms.buyOrder.data.bitcoinAddress = "abcdefgh";
        wrapper.vm.forms.buyOrder.data.bitcoinAmount = 0.01;
        wrapper.vm.forms.buyOrder.data.totalAmount = 10000000;

        const submit = wrapper.find('[data-form-submit-button]');
        await submit.trigger('click');

        expect(createOrderBuy.mock.calls.length).toBe(1);
    });

    test("when close modal button clicked, should fire mutation", async () => {
        const wrapper = shallowMount(createBuyOrderFormComponent, { 
            store, 
            localVue,
            mocks: {
                $t: () => {}
            }
        });

        expect(wrapper.vm.isFormSubmitting).toBe(false);

        const closeModalButton = wrapper.find('[data-close-modal-button]');
        await closeModalButton.trigger('click');

        expect(inactivateCreateBuyOrderModal.mock.calls.length).toBe(1);
    });
});