import {beforeEach, jest, test} from "@jest/globals";
import {createLocalVue, mount, shallowMount} from '@vue/test-utils'
import {plugin as Inertia} from '@inertiajs/inertia-vue'
import form from "@inertiajs/inertia-vue/src/form"
jest.mock('@inertiajs/inertia-vue/src/form')

import Index from '@src/Pages/Admin/Users/Index'


let localVue

beforeEach(() => {
  form.mockClear();
  localVue = createLocalVue()
  localVue.use(Inertia)

});

test('should mount without crashing', () => {
  const wrapper = shallowMount(Index, {localVue})
})

