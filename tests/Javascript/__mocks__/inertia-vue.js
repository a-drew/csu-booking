import {jest} from "@jest/globals";

export const InertiaFormMock = {
    hasErrors: jest.fn(),
    error: jest.fn(),
    post: jest.fn(),
    put: jest.fn(),
    delete: jest.fn(),
    successful: jest.fn()
}

export const InertiaForm = {
    install(app) {
        if (app.version.split('.')[0] === 3) {
            Object.defineProperty(app.config.globalProperties.$inertia, 'form', {
                value: (data = {}, options = {}) => {
                    return InertiaFormMock
                }});
        } else {
            app.prototype.$inertia.form = (data = {}, options = {}) => {
                return InertiaFormMock
            };
        }
    },
}

export const plugin = {
  install(Vue) {
    Inertia.form = form
    Object.defineProperty(Vue.prototype, '$inertia', { get: () => Inertia })
    Object.defineProperty(Vue.prototype, '$page', { get: () => app.page })
    Vue.mixin(remember)
    Vue.component('InertiaLink', link)
  },
}
