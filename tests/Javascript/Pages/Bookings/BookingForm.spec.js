import {beforeEach, jest, test} from "@jest/globals";

jest.mock('laravel-jetstream')

import {createLocalVue, mount, shallowMount} from '@vue/test-utils'
import {InertiaApp} from '@inertiajs/inertia-vue'
import {InertiaForm} from 'laravel-jetstream'
import Component from '@src/Pages/Requestee/BookingForm'

let localVue

beforeEach(() => {
    localVue = createLocalVue()
    localVue.use(InertiaApp)
    localVue.use(InertiaForm)

});

test('should mount without crashing', () => {
    const wrapper = shallowMount(Component, {localVue,
        propsData: {
            room: {
                id: 1,
                name: 'a',
                building: 'a',
                floor: 'a',
            },
            reservations: [
                { start: "2020-01-20T18:02", end: "2020-01-20T18:05" },
                { start: "2020-01-21T18:02", end: "2020-01-21T18:05" },
            ]
        },
        computed: {
            reservation() { return { start: "2020-01-20T18:02", end: "2020-01-20T18:05" }; },
            minStart() { return "2020-01-20T18:02"; },
            maxEnd() { return "2020-01-20T18:06"; },
        },
    });

    expect(wrapper.text()).toBeDefined();
})

