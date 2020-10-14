import Vue from 'vue'
import {mount} from '@vue/test-utils'
import {InertiaApp} from '@inertiajs/inertia-vue'
import {InertiaForm} from 'laravel-jetstream'
import CreateRoleForm from '../../../../../resources/js/Pages/Admin/Roles/CreateRoleForm'
import {test} from "@jest/globals";

Vue.use(InertiaApp)
Vue.use(InertiaForm)

//This is an example, please do more than just test if it crashes :p
test('should mount without crashing', () => {
    // mount() returns a wrapped Vue component we can interact with
    const wrapper = mount(CreateRoleForm, {
        data() {
            return {
                form: {
                    hasErrors(bag) {
                        return false;
                    },
                    error(name) {
                        return "";
                    }
                }
            }
        }
    })

    // Assert the rendered text of the component
    expect(wrapper.text()).toBeDefined()
})
