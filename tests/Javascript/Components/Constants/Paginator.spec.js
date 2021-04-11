import {beforeEach, jest, test} from "@jest/globals";

jest.mock('laravel-jetstream')

import {createLocalVue, mount, shallowMount} from '@vue/test-utils'
import {InertiaApp} from '@inertiajs/inertia-vue'
import {InertiaForm} from 'laravel-jetstream'
import Paginator from '@src/Components/Paginator';
import {InertiaFormMock} from "@test/__mocks__/laravel-jetstream";

let localVue;

beforeEach(() => {
  InertiaFormMock.error.mockClear()
  InertiaFormMock.post.mockClear()

  localVue = createLocalVue()
  localVue.use(InertiaApp)
  localVue.use(InertiaForm)

});
afterEach(() => {
  localVue = null
})

let test_paginator =  {
  "current_page": 1,
  "data": [],
  "first_page_url": "http://application.test/bookings/search?page=1",
  "from": 1,
  "last_page": 2,
  "last_page_url": "http://application.test/bookings/search?page=2",
  "links": [
    {
      "url": null,
      "label": "&laquo; Previous",
      "active": false
    },
    {
      "url": "http://application.test/bookings/search?page=1",
      "label": 1,
      "active": true
    },
    {
      "url": "http://application.test/bookings/search?page=2",
      "label": 2,
      "active": false
    },
    {
      "url": "http://application.test/bookings/search?page=2",
      "label": "Next &raquo;",
      "active": false
    }
  ],
  "next_page_url": "http://application.test/bookings/search?page=2",
  "path": "http://application.test/bookings/search",
  "per_page": 5,
  "prev_page_url": null,
  "to": 5,
  "total": 7
}


test('should mount without crashing', () => {

  const wrapper = shallowMount(Paginator, {
    localVue
  })

  expect(wrapper.text()).toBeDefined()
})


test('should parse dots properly', () => {

  const wrapper = shallowMount(Paginator, {
    localVue
  })

  expect(wrapper.vm.isFirstOrLastOrDots('Nothing')).toBe(false)
  expect(wrapper.vm.isFirstOrLastOrDots('Next')).toBe(true)
  expect(wrapper.vm.isFirstOrLastOrDots('Previous')).toBe(true)
  expect(wrapper.vm.isFirstOrLastOrDots('...')).toBe(true)
})

test('should generate appropriate computed fields', () => {

  const wrapper = shallowMount(Paginator, {
    localVue,
    propsData:{
      paginator: test_paginator
    }
  })

  expect(wrapper.vm.onFirstPage).toBe(true);
  expect(wrapper.vm.hasMorePages).toBe(true);
  expect(wrapper.vm.nextPageUrl).toStrictEqual("http://application.test/bookings/search?page=2");
  expect(wrapper.vm.previousPageUrl).toStrictEqual(null);
  expect(wrapper.vm.firstItem).toBe(1)
  expect(wrapper.vm.lastItem).toBe(5)
  expect(wrapper.vm.total).toBe(7)
})
