import createStore from '../../../state/marketplace/store';
import {SET_DEPENDENCY} from '../../../state/marketplace/mutation';
import {CREATE_ORDER_BUY} from '../../../state/marketplace/actions';
import { ObjectKeyDoesNotExistError } from '../../../exceptions/index';

describe("marketplace store", () => {
    describe("about dependency", () => {
        test("can set dependency dependency", () => {
            const store = createStore();
            store.commit(SET_DEPENDENCY, {
                key: 'orderService',
                value: {}
            });
    
            expect(store.state.dependencies.orderService).not.toBe(null);
        });
    
        test("throw error if dependency key does not exist", () => {
            const store = createStore();
            expect(() => {
                store.commit(SET_DEPENDENCY, {
                    key: 'nonexistentkey',
                    value: {}
                });
            }).toThrow(ObjectKeyDoesNotExistError);
        });
    });

    describe("about actions", () => {
        test("can create buy order action", async () => {
            
            const store = createStore();

            const createBuyOrder = jest.fn();
            createBuyOrder.mockReturnValueOnce(Promise.resolve([]));
            const getBuyOrders = jest.fn();
            getBuyOrders.mockReturnValueOnce(Promise.resolve([]));

            const orderService = {
                createBuyOrder: createBuyOrder,
                getBuyOrders: getBuyOrders
            }

            store.commit(SET_DEPENDENCY, {
                key: 'orderService',
                value: orderService
            });

            await store.dispatch(CREATE_ORDER_BUY, {});

            expect(createBuyOrder.mock.calls.length).toBe(1);
            expect(getBuyOrders.mock.calls.length).toBe(1);
        });
    });
});