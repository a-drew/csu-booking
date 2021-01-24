import {beforeEach, expect, jest, test} from "@jest/globals";

jest.mock('laravel-jetstream')

import {createLocalVue, mount, shallowMount} from '@vue/test-utils'
import {InertiaApp} from '@inertiajs/inertia-vue'
import {InertiaForm} from 'laravel-jetstream'
import Component from '@src/Jetstream/Checkbox'

let localVue

beforeEach(() => {
    localVue = createLocalVue()
    localVue.use(InertiaApp)
    localVue.use(InertiaForm)

});

test('should mount without crashing', () => {
    const wrapper = shallowMount(Component, {localVue});

    expect(wrapper.text()).toBeDefined();
})

test('verify computed proxy field', () => {
    const wrapper = shallowMount(Component, {localVue});

    wrapper.setProps({value: true});
    wrapper.vm.proxyChecked = !wrapper.vm.proxyChecked;

    wrapper.vm.$nextTick(() => {
        expect(wrapper.emitted().change).toBeTruthy()
    })

})
